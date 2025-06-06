<?php
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
use PhpOffice\PhpSpreadsheet\Shared\Date;

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
        die( 'Недопустимый тип файла. Допускаются только файлы Excel (.xls, .xlsx).');
    }

    // Проверяем MIME-тип файла
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $detectedMimeType = finfo_file($finfo, $fileTmpPath);
    finfo_close($finfo);

    if (!in_array($detectedMimeType, $allowedMimeTypes)) {
        die('Недопустимый MIME-тип файла. Допускаются только файлы Excel.');
    }

    try {
        // Загружаем файл с помощью PhpSpreadsheet
        $spreadsheet = IOFactory::load($fileTmpPath);

        // Флаг для отслеживания ошибок
        $hasErrors = false;
        $errorMessage = '';

        // Проходим по всем листам
        foreach ($spreadsheet->getAllSheets() as $sheet) {
            $sheetName = $sheet->getTitle(); // Название листа (номер группы)

            // Проверяем, существует ли группа в базе данных
            $stmtCheckGroup = $link->prepare("SELECT `id_group` FROM `groups` WHERE `name` = ?");
            $stmtCheckGroup->execute([$sheetName]);
            $group = $stmtCheckGroup->fetch(PDO::FETCH_ASSOC);

            if (!$group) {
                // Если группа не найдена, пропускаем её
                $errorMessage .= "Группа '$sheetName' не найдена в базе данных. Пропускаем.\n";
                continue;
            }

            $groupId = $group['id_group']; // ID группы

            // Читаем данные из листа
            $rows = [];
           foreach ($sheet->getRowIterator() as $rowIndex => $row) {
                $rowData = [];
                foreach ($row->getCellIterator() as $cell) {
                    $value = trim($cell->getValue());
                    $dataType = $cell->getDataType();

                    // Если тип данных — число, проверяем, является ли это датой
                    if ($dataType === \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC && Date::isDateTime($cell)) {
                        $dateObject = Date::excelToDateTimeObject($cell->getValue());
                        $value = $dateObject->format('d.m.Y'); // Преобразуем в формат YYYY-MM-DD
                    }

                    $rowData[] = $value ?: null; // Если ячейка пустая, записываем NULL
                }
                $rows[] = $rowData;

                // Проверяем количество столбцов
                if (count($rowData) != 4) { // Точно 4 столбца: Фамилия, Имя, Отчество, Дата зачисления
                    $hasErrors = true;
                    $errorMessage .= "Ошибка: В файле обнаружено меньше или больше 4 столбцов. Обработка прекращена.\n";
                    break;
                }
            }

            // Проверяем количество строк
            if (count($rows) < 2) { // Минимум 2 строки: заголовки и хотя бы одна строка данных
                $hasErrors = true;
                $errorMessage .= "Ошибка: В файле обнаружено меньше 2 строк. Обработка прекращена.\n";
                break;
            }
            var_dump($rows);
            unset($rows[0]); // Удаляем строку заголовков

            // Заносим данные студентов в базу данных
            foreach ($rows as $row) {
                $surname = $row[0]; // Фамилия
                $name = $row[1];    // Имя
                $patronymic = $row[2]; // Отчество
                $data = $row[3]; // Дата зачисления
                // echo $surname."<br>".$name."<br>".$patronymic."<br>".$data;
                // Проверяем, что все обязательные поля заполнены
               if (empty($surname) || empty($name) || empty($patronymic) || empty($data)) {
                    $hasErrors = true;
                    $errorMessage .= "Пропущена запись: Не заполнены обязательные поля (Фамилия, Имя, Отчество, Дата зачисления).\n";
                    continue;
                }

                // Преобразуем дату в формат YYYY-MM-DD
                $formattedDate = null;
                if (!empty($data)) {
                    $date = DateTime::createFromFormat('d.m.Y', $data); // Ожидаемый формат: DD.MM.YYYY
                    if ($date) {
                        $formattedDate = $date->format('d.m.Y'); // Преобразуем в YYYY-MM-DD
                    } else {
                        $hasErrors = true;
                        $errorMessage .= "Ошибка: Некорректный формат даты '$data' для студента $surname $name $patronymic.\n";
                        continue;
                    }
                }

                // Проверяем, существует ли студент в базе данных
                $stmtCheckStudent = $link->prepare("
                    SELECT `id_student` 
                    FROM `students` 
                    WHERE `Surname` = ? AND `Name` = ? AND `Patronymic` = ? AND `id_group` = ?
                ");
                $stmtCheckStudent->execute([$surname, $name, $patronymic, $groupId]);
                $student = $stmtCheckStudent->fetch(PDO::FETCH_ASSOC);

                if ($student) {
                    // Если студент уже существует, пропускаем его
                    $errorMessage .= "Студент '$surname $name $patronymic' уже существует в базе данных. Пропускаем.\n";
                    continue;
                }

                // Добавляем нового студента
                $stmtInsertStudent = $link->prepare("
                    INSERT INTO students (`Surname`, `Name`, `Patronymic`, `id_group`, `date_receipts`) 
                    VALUES (?, ?, ?, ?, ?)
                ");
                if (!$stmtInsertStudent->execute([$surname, $name, $patronymic, $groupId, $data])) {
                    $hasErrors = true;
                    $errorMessage .= "Ошибка при добавлении студента: $surname $name $patronymic.\n";
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
            die(nl2br($errorMessage)); // Преобразуем \n в <br>
        } else {
            echo  'Всё успешно сохранено.';
        }
    } catch (\Exception $e) {
        die( 'Ошибка: ' . $e->getMessage());
    }
} else {
    die( 'Файл не был загружен.');
}
?>