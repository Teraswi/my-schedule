<?php
require_once '../../login/login.php';

// Подключение к базе данных
$link = mysqli_connect("$hn", "$un", "$pw", "$db") or die('Невозможно подключиться к MySQL');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);

  $students = $data['students'];
  $errors = [];

  foreach ($students as $student) {
    $id = $student['id'];
    $fio = trim($student['fio']); // Полное ФИО
    $dateReceipts = trim($student['date_receipts']);
    $groopName = $student['groopName'];

    // Разделяем ФИО на фамилию, имя и отчество
    $fioParts = explode(' ', $fio);
    var_dump($fioParts);
    $surname = $fioParts[0] ?? ''; // Фамилия
    $name = $fioParts[1] ?? '';    // Имя
    $patronymic = $fioParts[2] ?? ''; // Отчество
    echo $surname."<br>".$name."<br>".$patronymic;
    // Находим ID группы по имени
    $stmtFindGroupId = $link->prepare("SELECT `id_group` FROM `groups` WHERE `name` = ?");
    if (!$stmtFindGroupId) {
      die('Ошибка при подготовке запроса: ' . $link->error);
    }
    $stmtFindGroupId->bind_param('s', $groopName); // Привязываем параметр
    $stmtFindGroupId->execute();
    $stmtFindGroupId->bind_result($idGroup); // Привязываем результат
    $stmtFindGroupId->fetch();
    $stmtFindGroupId->close();

    if ($id) {
      // Обновление существующей записи
      $query = "UPDATE students SET `Surname` = ?, `Name` = ?, `Patronymic` = ?, `date_receipts` = ? WHERE `id_student` = ?";
      $stmt = $link->prepare($query);
      if (!$stmt) {
        die('Ошибка при подготовке запроса: ' . $link->error);
      }
      $stmt->bind_param('ssssi', $surname, $name, $patronymic, $dateReceipts, $id);
    } else {
      // Добавление новой записи
      $query = "INSERT INTO students (`Surname`, `Name`, `Patronymic`, `date_receipts`, `id_group`) VALUES (?, ?, ?, ?, ?)";
      $stmt = $link->prepare($query);
      if (!$stmt) {
        die('Ошибка при подготовке запроса: ' . $link->error);
      }
      $stmt->bind_param('sssss', $surname, $name, $patronymic, $dateReceipts, $idGroup);
    }

    if (!$stmt->execute()) {
      $errors[] = "Ошибка при сохранении записи: $fio";
    }
    $stmt->close();
  }

  if (empty($errors)) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'message' => implode('; ', $errors)]);
  }
}
?>