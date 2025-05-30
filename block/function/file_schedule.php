<?php
header('Content-Type: application/json');

// Подключаем файл с данными для подключения к базе данных
require_once __DIR__ . '/../../login/login.php';

try {
    // Подключаемся к базе данных через PDO с кодировкой UTF-8
    $link = new PDO("mysql:host=$hn;dbname=$db;charset=utf8mb4", $un, $pw);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Ошибка подключения к базе данных.']));
}

// Подключаем автозагрузчик Composer
require __DIR__ . '/../../vendor/autoload.php'; // Путь относительно текущего файла

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadedFile = $_FILES['file'];

    // Проверяем, есть ли ошибки при загрузке
    if ($uploadedFile['error'] !== UPLOAD_ERR_OK) {
        die(json_encode(['success' => false, 'message' => 'Ошибка при загрузке файла.']));
    }

    // Получаем информацию о файле
    $fileName = $uploadedFile['name'];
    $fileTmpPath = $uploadedFile['tmp_name'];
    $fileSize = $uploadedFile['size'];
    $fileType = $uploadedFile['type'];

    // Разрешенные MIME-типы для Excel-файлов
    $allowedMimeTypes = [
        'application/vnd.ms-excel', // Для старых форматов .xls
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // Для новых форматов .xlsx
    ];

    // Разрешенные расширения
    $allowedExtensions = ['xls', 'xlsx'];

    // Проверяем расширение файла
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
        die(json_encode(['success' => false, 'message' => 'Недопустимый тип файла. Допускаются только файлы Excel (.xls, .xlsx).']));
    }

    // Проверяем MIME-тип файла
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $detectedMimeType = finfo_file($finfo, $fileTmpPath);
    finfo_close($finfo);

    if (!in_array($detectedMimeType, $allowedMimeTypes)) {
        die(json_encode(['success' => false, 'message' => 'Недопустимый MIME-тип файла. Допускаются только файлы Excel.']));
    }

    try {
        // Загружаем файл с помощью PhpSpreadsheet
        $spreadsheet = IOFactory::load($fileTmpPath);

        // Флаг для отслеживания ошибок
        $hasErrors = false;
        $errorMessage = '';

        // Проходим по всем листам
        foreach ($spreadsheet->getAllSheets() as $sheet) {
            $groupNumber = $sheet->getTitle(); // Название листа = номер группы

            // Преобразуем формат группы (если есть "_")
            $groupNumber = str_replace('_', '/', $groupNumber);

            // Находим id_group для номера группы в таблице groups
            $stmtFindGroupId = $link->prepare("SELECT `id_group` FROM `groups` WHERE `name` = :group");
            $stmtFindGroupId->execute([':group' => $groupNumber]);
            $idGroup = $stmtFindGroupId->fetchColumn();

            if (!$idGroup) {
                $hasErrors = true;
                $errorMessage .= "Группа $groupNumber не найдена в таблице groups. Пропускаем.\n";
                continue;
            }

            // Проверяем, существует ли группа в таблице schedule
            $stmtCheckGroup = $link->prepare("SELECT COUNT(*) FROM `schedule` WHERE `id_group` = :id_group");
            $stmtCheckGroup->execute([':id_group' => $idGroup]);
            $groupExists = $stmtCheckGroup->fetchColumn();

            if ($groupExists > 0) {
                continue;
            }

            // Теперь обрабатываем расписание для этой группы
            $rows = [];
            foreach ($sheet->getRowIterator() as $rowIndex => $row) {
                $rowData = [];
                foreach ($row->getCellIterator() as $cell) {
                    $value = trim($cell->getValue());
                    $rowData[] = $value ?: null; // Если ячейка пустая, записываем NULL
                }
                $rows[] = $rowData;

                // Проверяем количество столбцов
                if (count($rowData) != 7) {
                    $hasErrors = true;
                    $errorMessage .= "Ошибка: В файле обнаружено больше или мешьне 7 столбцов. Обработка прекращена.\n";
                    break;
                }
            }

            // Проверяем количество строк
            if (count($rows) != 14) {
                $hasErrors = true;
                $errorMessage .= "Ошибка: В файле обнаружено больше или меньше 14 строк. Обработка прекращена.\n";
                break;
            }

            // Разбираем данные
            $headers = array_slice($rows[0], 1); // Заголовки дней недели (без первого столбца)
            $headers = array_filter($headers, function ($header) {
                return !empty(trim($header)); // Пропускаем пустые заголовки
            });
            unset($rows[0]); // Удаляем строку заголовков

            foreach ($rows as $row) {
                $timeSlot = $row[0]; // Время урока (первый столбец)
                $lessons = array_slice($row, 1); // Остальные столбцы (уроки)

                foreach ($headers as $index => $dayOfWeek) {
                    $lesson = $lessons[$index] ?? null;

                    // Разделяем предмет и кабинет
                    $subject = null;
                    $classroom = null;
                    if (!empty($lesson)) {
                        $parts = explode('каб.', $lesson);
                        $subjectAndClassroom = trim($parts[0]);

                        if (preg_match('/^(.*?)\s+(\d+)$/', $subjectAndClassroom, $matches)) {
                            $subject = trim($matches[1]);   // Название предмета
                            $classroom = trim($matches[2]); // Номер кабинета
                        } else {
                            $hasErrors = true;
                            $errorMessage .= "Пропущена запись: Некорректный формат данных: " . htmlspecialchars($lesson) . "\n";
                            continue;
                        }
                    }

                    // Пропускаем пустые уроки
                    if (empty($subject)) {
                        $subject = '&nbsp;';
                    }
                    if (empty($classroom)) {
                        $classroom = '&nbsp;';
                    }

                    // Находим id для всех связанных таблиц
                    $stmtDay = $link->prepare("SELECT `id_d` FROM `day` WHERE `name` = :day");
                    $stmtDay->execute([':day' => $dayOfWeek]);
                    $idDay = $stmtDay->fetchColumn();

                    $stmtTime = $link->prepare("SELECT `id_time` FROM `time` WHERE `Time` = :time");
                    $stmtTime->execute([':time' => $timeSlot]);
                    $idTime = $stmtTime->fetchColumn();

                    $stmtSubject = $link->prepare("SELECT `id_sub` FROM `subject` WHERE `name` = :subject");
                    $stmtSubject->execute([':subject' => $subject]);
                    $idSubject = $stmtSubject->fetchColumn();

                    $stmtOffice = $link->prepare("SELECT `id_of` FROM `office` WHERE `number` = :office");
                    $stmtOffice->execute([':office' => $classroom]);
                    $idOffice = $stmtOffice->fetchColumn();

                    // Если какой-то id не найден, пропускаем запись
                    if (!$idDay || !$idTime || !$idSubject || !$idOffice) {
                        $hasErrors = true;
                        $errorMessage .= "Пропущена запись: Не удалось найти все необходимые id.\n";
                        continue;
                    }

                    // Вставляем данные в таблицу schedule
                    $query = "
                        INSERT INTO `schedule` (`id_d`, `id_time`, `id_sub`, `id_group`, `id_of`)
                        VALUES (:id_d, :id_time, :id_sub, :id_group, :id_of)
                    ";
                    $stmt = $link->prepare($query);
                    $stmt->execute([
                        ':id_d' => $idDay,
                        ':id_time' => $idTime,
                        ':id_sub' => $idSubject,
                        ':id_group' => $idGroup,
                        ':id_of' => $idOffice
                    ]);
                }
            }
        }

        // Удаляем временный файл
        unlink($fileTmpPath);

        // Возвращаем результат
        if ($hasErrors) {
            if (empty($errorMessage)) {
                $errorMessage = "Произошла ошибка при обработке данных.";
            }
            die(json_encode(['success' => false, 'message' => nl2br($errorMessage)])); // Преобразуем \n в <br>
        } else {
            die(json_encode(['success' => true, 'message' => 'Всё успешно сохранено.']));
        }
    } catch (\Exception $e) {
        die(json_encode(['success' => false, 'message' => 'Ошибка: ' . $e->getMessage()]));
    }
} else {
    die(json_encode(['success' => false, 'message' => 'Файл не был загружен.']));
}
?>