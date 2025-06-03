<?php
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
        $sheetName = $sheet->getTitle(); // Название листа

        // Проверяем корректность имени листа (формат: "22.11 (среда)")
        if (!preg_match('/^(\d{2}\.\d{2})\s*\(([^)]+)\)$/', $sheetName, $matches)) {
            $hasErrors = true;
            $errorMessage .= "Ошибка: Некорректное имя листа '$sheetName'. Пропускаем.\n";
            continue;
        }

        $date = $matches[1]; // "22.11"
        $dayOfWeek = strtolower($matches[2]); // "среда"

        // Формируем имя таблицы
        $tableName = "ch_" . str_replace('.', '_', $date) . "__" . $dayOfWeek;

        // Читаем данные из листа
        $rows = [];
        foreach ($sheet->getRowIterator() as $rowIndex => $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $value = trim($cell->getValue());
                $rowData[] = $value ?: null; // Если ячейка пустая, записываем NULL
            }
            $rows[] = $rowData;

            // Проверяем количество столбцов
            if (count($rowData) < 2) { // Минимум 2 столбца: время и хотя бы одна группа
                $hasErrors = true;
                $errorMessage .= "Ошибка: В файле обнаружено меньше 2 столбцов. Обработка прекращена.\n";
                break;
            }
        }

        // Проверяем количество строк
        if (count($rows) < 2) { // Минимум 2 строки: заголовки и хотя бы одна строка данных
            $hasErrors = true;
            $errorMessage .= "Ошибка: В файле обнаружено меньше 2 строк. Обработка прекращена.\n";
            break;
        }

        // Разбираем данные
        $headers = array_slice($rows[0], 1); // Заголовки групп (без первого столбца)

        // Проверяем заголовки на дубликаты
        $uniqueHeaders = array_unique($headers);
        if (count($headers) !== count($uniqueHeaders)) {
            $hasErrors = true;
            $errorMessage .= "Ошибка: Встречены дубликаты в заголовках групп. Обработка прекращена.\n";
            continue;
        }

        unset($rows[0]); // Удаляем строку заголовков

        // Создаем таблицу, если она не существует
        $queryCreateTable = "
            CREATE TABLE IF NOT EXISTS `$tableName` (
                id INT AUTO_INCREMENT PRIMARY KEY,
                time VARCHAR(50),
                " . implode(", ", array_map(fn($header) => "`$header` VARCHAR(255)", $headers)) . "
            )
        ";
        if (!$link->query($queryCreateTable)) {
            $hasErrors = true;
            $errorMessage .= "Ошибка при создании таблицы '$tableName'.\n";
            continue;
        }

        // Очищаем таблицу перед вставкой новых данных
        $link->query("TRUNCATE TABLE `$tableName`");

        // Заносим данные в таблицу
        foreach ($rows as $row) {
            $timeSlot = $row[0]; // Время урока (первый столбец)
            $lessons = array_slice($row, 1); // Остальные столбцы (уроки)

            // Формируем запрос для вставки данных
            $columns = ['time'];
            $values = [$timeSlot];

            foreach ($headers as $index => $groupName) {
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

                // Формируем значение для ячейки
                $value = '';
                if (!empty($subject)) {
                    $value .= $subject;
                }
                if (!empty($classroom)) {
                    $value .= " $classroom каб.";
                }

                // Добавляем колонку и значение
                $columns[] = "`" . $groupName . "`"; // Используем название группы
                $values[] = $value;
            }

            // Формируем SQL-запрос для вставки
            $columnsStr = implode(', ', $columns);
            $placeholders = implode(', ', array_fill(0, count($values), '?'));

            $query = "INSERT INTO `$tableName` ($columnsStr) VALUES ($placeholders)";
            $stmt = $link->prepare($query);

            // Привязываем параметры и выполняем запрос
            if (!$stmt->execute($values)) { // Передаем значения напрямую в execute()
                $hasErrors = true;
                $errorMessage .= "Ошибка при вставке данных в таблицу '$tableName'.\n";
                continue;
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