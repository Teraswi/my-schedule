<?php
require_once '../../login/login.php';
$link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);

  $id = $data['id'];

  // Удаление записи из базы данных
  $query = "DELETE FROM students WHERE id_student = ?";
  $stmt = $link->prepare($query);
  $stmt->bind_param('i', $id);
  $success = $stmt->execute();

  if ($success) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'message' => 'Ошибка при удалении записи']);
  }
}
?>