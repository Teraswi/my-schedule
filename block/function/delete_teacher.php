<?php
require_once '../../login/login.php';

try {
    // Подключаемся к базе данных через PDO с кодировкой UTF-8
    $pdo = new PDO("mysql:host=$hn;dbname=$db;charset=utf8mb4", $un, $pw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Ошибка подключения к базе данных.']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);
    $teacherId = $requestData['id'] ?? null;

    if (!$teacherId) {
        die(json_encode(['success' => false, 'message' => 'ID преподавателя не указан.']));
    }

    try {
        // Начинаем транзакцию
        $pdo->beginTransaction();

        // Удаляем преподавателя
        $stmtDeleteTeacher = $pdo->prepare("
            DELETE FROM `techer` 
            WHERE `id_tech` = ?
        ");
        $stmtDeleteTeacher->execute([$teacherId]);

        // Фиксируем транзакцию
        $pdo->commit();

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Откатываем транзакцию в случае ошибки
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Ошибка при удалении преподавателя: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неверный метод запроса.']);
}
?>