<?php
// Подключаемся к базе данных
require_once '../../login/login.php';

try {
    // Подключаемся к базе данных через PDO с кодировкой UTF-8
    $pdo = new PDO("mysql:host=$hn;dbname=$db;charset=utf8mb4", $un, $pw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Ошибка подключения к базе данных.']));
}

// Получаем данные из POST-запроса
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['teachers']) || !is_array($data['teachers'])) {
    die(json_encode(['success' => false, 'message' => 'Неверный формат данных']));
}

$response = ['success' => true, 'message' => 'Данные успешно сохранены', 'errors' => []];

foreach ($data['teachers'] as $teacher) {
    $id = isset($teacher['id']) ? intval($teacher['id']) : null;
    $name = trim($teacher['name']);
    $start_date = trim($teacher['start_date']);
    $end_date = isset($teacher['end_date']) ? trim($teacher['end_date']) : null;

    // Проверка ФИО
    if (empty($name)) {
        $response['success'] = false;
        $response['message'] = "Ошибка: Пустое ФИО для записи с ID: $id";
        echo json_encode($response);
        return; // Прекращаем выполнение скрипта
    }

    // Проверка даты начала больничного
    if (!preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $start_date)) {
        $response['success'] = false;
        $response['message'] = "Ошибка: Некорректная дата начала больничного ($start_date)";
        echo json_encode($response);
        return; // Прекращаем выполнение скрипта
    }

    // Проверка даты окончания больничного (если она указана)
    if ($end_date && !preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $end_date)) {
        $response['success'] = false;
        $response['message'] = "Ошибка: Некорректная дата окончания больничного ($end_date)";
        echo json_encode($response);
        return; // Прекращаем выполнение скрипта
    }

    // Проверяем, существует ли преподаватель в базе данных
    $stmt = $pdo->prepare("SELECT `id_tech`, `id_user` FROM techer WHERE TRIM(CONCAT(`Surname`, ' ', `Name`, ' ', `Patronymic`)) = :name");
    $stmt->execute(['name' => $name]);
    $teacher_row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$teacher_row) {
        $response['success'] = false;
        $response['message'] = "Ошибка: Преподаватель '$name' не найден в базе данных.";
        echo json_encode($response);
        return; // Прекращаем выполнение скрипта
    }

    $teacher_id = $teacher_row['id_tech'];
    $id_user = $teacher_row['id_user'];

    // Проверяем, существует ли id_user в таблице users
    $stmt = $pdo->prepare("SELECT `id_u` FROM `users` WHERE `id_u` = :id_user");
    $stmt->execute(['id_user' => $id_user]);
    $user_row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user_row) {
        $response['errors'][] = "Ошибка: Преподаватель с id_user = $id_user не найден в таблице users.";
        echo json_encode($response);
        return; // Прекращаем выполнение скрипта
    }

    // Обновляем данные в таблице
    $stmt = $pdo->prepare("
        UPDATE `techer` 
        SET `medical` = :start_date, `exit_medical` = :end_date 
        WHERE `id_tech` = :id
    ");
    $stmt->execute([
        'start_date' => $start_date,
        'end_date' => $end_date,
        'id' => $teacher_id
    ]);
}  

$response['message'] = 'Данные успешно сохранены.';
echo json_encode($response);
?>