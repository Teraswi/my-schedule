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

        // Очищаем столбцы medical и exit_medical
        $stmtClearMedical = $pdo->prepare("
            UPDATE `techer` 
            SET `medical` = NULL, `exit_medical` = NULL 
            WHERE `id_tech` = ?
        ");
        $stmtClearMedical->execute([$teacherId]);

        // Проверяем, было ли выполнено обновление
        if ($stmtClearMedical->rowCount() === 0) {
            $pdo->rollBack();
            die(json_encode(['success' => false, 'message' => 'Преподаватель не найден или данные уже очищены.']));
        }

        // Фиксируем транзакцию
        $pdo->commit();

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Откатываем транзакцию в случае ошибки
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Ошибка при очистке данных: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неверный метод запроса.']);
}
?>