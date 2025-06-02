<?php
require_once '../../login/login.php';
header('Content-Type: application/json');

// Подключение к базе данных
$link = new mysqli("$hn","$un","$pw","$db");
if ($link->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Ошибка подключения к базе данных']));
}

// Получаем данные из POST-запроса
$data = json_decode(file_get_contents('php://input'), true);

$tableName = $data['tableName'] ?? null; // Название таблицы
$headers = $data['headers'] ?? []; // Заголовки столбцов
$rows = $data['rows'] ?? []; // Данные строк
// echo "<pre>";
// var_dump ($rows);
// echo "</pre>";
if (!$tableName || empty($headers) || empty($rows)) {
    die(json_encode(['success' => false, 'message' => 'Некорректные данные']));
}

// Шаг 1: Создание таблицы, если она не существует
if (!$link->query("SHOW TABLES LIKE '$tableName'")->num_rows) {
    // Создаем таблицу с первым столбцом (id)
    $query = "CREATE TABLE `$tableName` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        time VARCHAR(50)
    )";
    if (!$link->query($query)) {
        die(json_encode(['success' => false, 'message' => 'Ошибка при создании таблицы']));
    }
}

// Шаг 2: Добавление новых столбцов
$existingColumns = [];
$result = $link->query("SHOW COLUMNS FROM `$tableName`");
while ($row = $result->fetch_assoc()) {
    $existingColumns[] = $row['Field'];
}

foreach ($headers as $header) {
    if (!in_array($header, $existingColumns)) {
        // Добавляем новый столбец
        $query = "ALTER TABLE `$tableName` ADD `$header` VARCHAR(255)";
        if (!$link->query($query)) {
            die(json_encode(['success' => false, 'message' => 'Ошибка при добавлении столбца']));
        }
    }
}

// Шаг 3: Обновление данных в таблице
// Шаг 3: Обновление данных в таблице
foreach ($rows['rows'] as $row) {
    // Проверяем, что ключи 'time' и 'data' существуют
    if (!isset($row['time']) || !isset($row['data'])) {
        die(json_encode(['success' => false, 'message' => 'Ошибка: Некорректные данные в массиве']));
    }

    $time = $row['time']; // Время (например, "08:00")
    $rowData = $row['data']; // Массив данных для каждого столбца

    // Проверяем, существует ли строка с таким временем
    $query = "SELECT id FROM `$tableName` WHERE time = ?";
    $stmt = $link->prepare($query);
    if (!$stmt) {
        die(json_encode(['success' => false, 'message' => 'Ошибка при подготовке запроса']));
    }
    $stmt->bind_param('s', $time);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Строка существует, обновляем данные
        $rowId = $result->fetch_assoc()['id'];

        foreach ($rowData as $index => $cellData) {
            // Проверяем, что данные в ячейке корректны
            if (!isset($cellData['subject']) || !isset($cellData['office'])) {
                continue; // Пропускаем некорректные данные
            }

            $subject = $cellData['subject'];
            $office = $cellData['office'];

            // Формируем значение для обновления
            $value = trim($subject); // Изначально только предмет
            if (!empty($office)) {
                $value .= " $office каб."; // Добавляем кабинет, только если он не пустой
            }

            // Пропускаем пустые значения
            if (empty($value)) {
                continue;
            }

            // Получаем имя столбца из массива заголовков
            $column = $headers[$index] ?? null;
            if (!$column) {
                continue; // Пропускаем, если имя столбца отсутствует
            }

            // Обновляем данные
            $query = "UPDATE `$tableName` SET `$column` = ? WHERE id = ?";
            $stmt = $link->prepare($query);
            if (!$stmt) {
                die(json_encode(['success' => false, 'message' => 'Ошибка при подготовке запроса']));
            }
            $stmt->bind_param('si', $value, $rowId);
            if (!$stmt->execute()) {
                die(json_encode(['success' => false, 'message' => 'Ошибка при обновлении данных']));
            }
        }
    } else {
        // Строка не существует, добавляем новую
        $columns = ['time'];
        $values = [$time];

        foreach ($rowData as $index => $cellData) {
            // Проверяем, что данные в ячейке корректны
            if (!isset($cellData['subject']) || !isset($cellData['office'])) {
                continue; // Пропускаем некорректные данные
            }

            $subject = $cellData['subject'];
            $office = $cellData['office'];

            // Формируем значение для вставки
            $value = trim($subject); // Изначально только предмет
            if (!empty($office)) {
                $value .= " $office каб."; // Добавляем кабинет, только если он не пустой
            }

            // Пропускаем пустые значения
            if (empty($value)) {
                continue;
            }

            // Получаем имя столбца из массива заголовков
            $column = $headers[$index] ?? null;
            if (!$column) {
                continue; // Пропускаем, если имя столбца отсутствует
            }

            // Добавляем столбец и значение
            $columns[] = $column;
            $values[] = $value;
        }

        // Формируем SQL-запрос для вставки
        $columnsStr = implode(', ', $columns);
        $placeholders = implode(', ', array_fill(0, count($values), '?'));

        $query = "INSERT INTO `$tableName` ($columnsStr) VALUES ($placeholders)";
        $stmt = $link->prepare($query);
        if (!$stmt) {
            die(json_encode(['success' => false, 'message' => 'Ошибка при подготовке запроса']));
        }

        $types = str_repeat('s', count($values));
        $stmt->bind_param($types, ...$values);

        if (!$stmt->execute()) {
            die(json_encode(['success' => false, 'message' => 'Ошибка при добавлении данных']));
        }
    }
}

echo json_encode(['success' => true, 'message' => 'Данные успешно сохранены']);
?>