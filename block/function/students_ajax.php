<?php
session_start();
require_once '../../login/login.php';
$link = mysqli_connect("$hn", "$un", "$pw", "$db") or die('Невозможно запустить mysql');

$user_id = $_SESSION['user_id'];
$role = $_SESSION['user'];

$has_access = false; // Переменная доступа

if (empty($_POST['students_value'])) {
    $st_group = '11/16';
} else {
    $_SESSION['st_gr'] = $_POST['students_value'];
    $st_group = $_SESSION['st_gr'];
}

if (isset($_POST['sort_value'])) {
    $_SESSION['sort_value'] = $_POST['sort_value'];
    $sort = $_SESSION['sort_value'];
    $query = "SELECT `Surname`, `Name`, `Patronymic`, `date_receipts` as `date_receipts` 
              FROM `students` 
              WHERE `id_group` IN (SELECT `id_group` FROM `groups` WHERE `name` = '$st_group') 
              ORDER BY `$sort`";
} else {
    $query = "SELECT `Surname`, `Name`, `Patronymic`, `date_receipts` as `date_receipts` 
              FROM `students` 
              WHERE `id_group` IN (SELECT `id_group` FROM `groups` WHERE `name` = '$st_group') 
              ORDER BY `Surname`";
}

$result = mysqli_query($link, $query) or die("Невозможно выполнить запрос");
$rows = mysqli_num_rows($result);

if ($rows > 0) {
?>
<table class="students">
    <thead>
        <tr>
            <th>№</th>
            <th>ФИО Студента</th>
            <th>Дата Зачисления</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 1; $i <= $rows; $i++) {
            $row = mysqli_fetch_assoc($result);
        ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= htmlspecialchars("$row[Surname] $row[Name] $row[Patronymic]") ?></td>
            <td><?= htmlspecialchars("$row[date_receipts]") ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<aside class="form_sort">
  <span class="sort">Сортировка по</span>
  <form action="" method="post" name="sort">
      <button name="surname" class="btn_sort" value = "surname" >По алфавиту</button>
      <button name="data" class="btn_sort" value = "date_receipts">По дате</button>
  </form>
</aside>
<?php
    if ($role === 'Admin_Dispatcher') {
        $has_access = true;
    } elseif ($role === 'Teacher') {
        $stmt = mysqli_prepare($link, "SELECT `id_tech` FROM `techer` WHERE `id_user` = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $rowT = mysqli_fetch_assoc($res);

        if ($rowT) {
            $teacher_id = $rowT['id_tech'];
            $stmt = mysqli_prepare($link, "SELECT `id_group` FROM `groups` WHERE `name` = ?");
            mysqli_stmt_bind_param($stmt, "s", $st_group);
            mysqli_stmt_execute($stmt);
            $resG = mysqli_stmt_get_result($stmt);
            $rowG = mysqli_fetch_assoc($resG);

            if ($rowG) {
                $group_id = $rowG['id_group'];
                $stmt = mysqli_prepare($link, "
                    SELECT 1 
                    FROM `techer_groop` 
                    WHERE `techer_id` = ? AND `groop_id` = ?
                    LIMIT 1
                ");
                mysqli_stmt_bind_param($stmt, "ii", $teacher_id, $group_id);
                mysqli_stmt_execute($stmt);
                $resTG = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($resTG) > 0) {
                    $has_access = true;
                }
            }
        }
    }

    if ($has_access): ?>
        <div class="button_center_edit">
          <form method="post">
            <input type="hidden" name="group_id" value="<?= htmlspecialchars($group_ajax ) ?>">
            <button formaction="index.php?page=edit_student" class="btn_edit">Редактировать студентов</button>
          </form>
        </div>
    <?php endif; ?>
<?php
} else { ?>
<div class="form_upload_file students_file">
    <h1 class ='empty_data'>Список данной группы пока не заполнен</h1>
    <button class="upload_file" data-bs-toggle="modal" data-bs-target="#add_students_file"> Добавить список студентов файлом</button>
</div>
<?php
}
?>