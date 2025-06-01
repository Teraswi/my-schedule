<?php
header('Content-Type: application/json');

// Настройки подключения
require_once '../../login/login.php';

try {
    // Создаем подключение
    $pdo = new PDO("mysql:host=$hn;dbname=$db;charset=utf8", $un, $pw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Ошибка подключения: ' . $e->getMessage()]));
}

// Получаем данные из POST-запроса
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['date']) || !isset($data['schedule'])) {
    echo json_encode(['success' => false, 'message' => 'Неверный формат данных.']);
    exit;
}

$date = $data['date'];
$schedule = $data['schedule'];

// Генерируем имя таблицы на основе даты
$dateParts = explode('(', $date); // Разделяем дату и день недели
if (count($dateParts) === 2) {
    $datePart = trim($dateParts[0]); // "22.11"
    $dayPart = trim($dateParts[1], ')'); // "среда"

    // Заменяем точки на подчеркивания и добавляем префикс
    $tableName = 'ch_' . str_replace('.', '_', $datePart) . '__' . $dayPart;
} else {
    echo json_encode(['success' => false, 'message' => 'Неверный формат даты.']);
    exit;
}

try {
    // Проверяем, существует ли таблица
    $checkTableQuery = "SHOW TABLES LIKE :tableName";
    $stmt = $pdo->prepare($checkTableQuery);
    $stmt->execute([':tableName' => $tableName]);
    $tableExists = $stmt->fetchColumn();

    if (!$tableExists) {
        // Создаем новую таблицу
        $createTableQuery = "
            CREATE TABLE {$tableName} (
                id INT AUTO_INCREMENT PRIMARY KEY,
                time VARCHAR(50) NOT NULL
            )
        ";
        $pdo->exec($createTableQuery);

        // Добавляем столбцы для групп
        foreach ($schedule as $row) {
            foreach ($row as $groupName => $details) {
                if ($groupName === 'time') continue;

                // Очищаем имя столбца от недопустимых символов
                $groupName = preg_replace('/[^a-zA-Z0-9_.() ]/', '', $groupName);

                $addColumnQuery = "
                    ALTER TABLE {$tableName}
                    ADD COLUMN `{$groupName}` VARCHAR(255)
                ";
                $pdo->exec($addColumnQuery);
            }
            break; // Достаточно добавить столбцы из первой строки
        }
    }

    // Вставляем данные в таблицу
    foreach ($schedule as $row) {
        $time = $row['time'] ?? ''; // Получаем время из строки

        // Формируем список столбцов и значений
        $columns = ['time']; // Начинаем с поля `time`
        $values = [':time'];
        $params = [':time' => $time]; // Значение времени

        foreach ($row as $groupName => $details) {
            if ($groupName === 'time') continue;

            // Очищаем имя столбца от недопустимых символов
            $groupName = preg_replace('/[^a-zA-Z0-9_]/', '', $groupName);

            $columns[] = "`{$groupName}`";
            $paramKey = ":{$groupName}";
            $values[] = $paramKey;
            error_log("Processing group: $groupName");
            error_log("Details: " . print_r($details, true));

            // Если предмет или кабинет отсутствуют, заменяем на &nbsp;
            $params[$paramKey] = (!empty($details['subject']) && !empty($details['office']))
                ? "{$details['subject']} каб. {$details['office']}"
                : ' ';

            error_log ("Параметры:". print_r($params, true));
        }

        // Генерируем SQL-запрос
        $insertQuery = "
            INSERT INTO {$tableName} (" . implode(', ', $columns) . ")
            VALUES (" . implode(', ', $values) . ")
        ";

        $stmt = $pdo->prepare($insertQuery);
        $stmt->execute($params);
    }

    echo json_encode(['success' => true, 'message' => 'Успех']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Ошибка выполнения запроса: ' . $e->getMessage()]);
}
?>