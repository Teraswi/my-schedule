<?php
if (empty($_SESSION['st_gr'])) 
{
  $group_ajax = '11/16';
}
else
{
  $group_ajax =  $_SESSION['st_gr'];

} 
?>
<h1 class='title_students'><?php echo "Список студентов $group_ajax группы" ?></h1>
<form method="post">
  <div class="pagination">
    <?php
    $group = "SELECT name FROM groups";
    $query_group = mysqli_query($link, $group) or die(mysqli_error());

    $rows = mysqli_num_rows($query_group);

    for ($i = 0; $i < $rows; $i++)
    {
      $row = mysqli_fetch_row($query_group);
      echo "<button class='group-pagination' name='group' value='$row[0]'>$row[0]</button>";
    }
    ?>
  </div>
  <div class="select__groops">
    <select name="groups" class="change_group">
      <?php
          $group = "SELECT name FROM groups";
          $query_group = mysqli_query($link, $group) or die(mysqli_error());

          $rows = mysqli_num_rows($query_group);

          for ($i = 0; $i < $rows; $i++)
          {
            $row = mysqli_fetch_row($query_group);
            echo "<option value='$row[0]'>$row[0] ";
          }
          ?>
      </select>
    </div>
</form>
<section class = "students_result">
    <?php 
      $user_id = $_SESSION['user_id'];
      $role = $_SESSION['user'];

      $has_access = false; // Переменная доступа

      $qeury = "SELECT `Surname`, `Name`, `Patronymic`,  `date_receipts` as `date_receipts` FROM `students` WHERE `id_group` IN (SELECT `id_group` FROM `groups` WHERE `name` = '$group_ajax') ORDER BY `Surname`";
      $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
      $rows=mysqli_num_rows($result);
    ?>
      <div class="responsive-table">
        <?php
        if ($rows>0) 
          { 
      ?>
        <table class="students">
          <thead>
            <tr>
              <th>№</th>
              <th>ФИО Студента</th>
              <th>Дата <br>Зачисления</th>
            </tr>
          </thead>
          <tbody>
          <?php
              for ($i=1; $i<$rows+1; $i++)
              {
                $row = mysqli_fetch_assoc($result);
            ?>
                <tr>
                  <td><?=$i?></td>
                  <td><?php echo "$row[Surname] $row[Name] $row[Patronymic]"?></td>
                  <td><?php echo "$row[date_receipts]"?></td>
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
          // 2.1) Узнаём id_tech текущего преподавателя
          $stmt = mysqli_prepare($link, "SELECT id_tech FROM techer WHERE id_user = ?");
          mysqli_stmt_bind_param($stmt, "i", $user_id);
          mysqli_stmt_execute($stmt);
          $res  = mysqli_stmt_get_result($stmt);
          $rowT = mysqli_fetch_assoc($res);
          
          if ($rowT) {
            $teacher_id = $rowT['id_tech'];
            // echo $teacher_id;
            // 2.2) Узнаём id выбранной группы
            $stmt = mysqli_prepare($link, "SELECT id_group FROM groups WHERE name = ?");
            mysqli_stmt_bind_param($stmt, "s", $group_ajax);
            mysqli_stmt_execute($stmt);
            $resG = mysqli_stmt_get_result($stmt);
            $rowG = mysqli_fetch_assoc($resG);
            
            if ($rowG) {
              $group_id = $rowG['id_group'];
              
              // 2.3) Проверяем, есть ли связка (teacher_id, group_id) в teacher_group
              $stmt = mysqli_prepare($link, "
              SELECT 1 
              FROM techer_groop 
              WHERE techer_id = ? AND groop_id = ?
              LIMIT 1
              ");
              // var_dump ($stmt);
              mysqli_stmt_bind_param($stmt, "ii", $teacher_id, $group_id);
              mysqli_stmt_execute($stmt);
              $resTG = mysqli_stmt_get_result($stmt);
              
              if (mysqli_num_rows($resTG) > 0) {
                $has_access = true;
              }
            }
          }
        }
        ?>
      <?php if ($has_access): ?>
        <div class="button_center_edit">
          <form method="post">
            <input type="hidden" name="group_id" value="<?= htmlspecialchars($group_ajax ) ?>">
            <button formaction="index.php?page=edit_student" class="btn_edit">Редактировать студентов</button>
          </form>
        </div>
      <?php endif; ?>
          <?php
          }
          else 
          { ?>
          <div class="form_upload_file students_file">
            <h1 class ='empty_data'>Список данной группы пока не заполнен</h1>
              <form method="post">
                <input type="hidden" name="group_id" value="<?= htmlspecialchars($group_ajax) ?>">
                <button formaction="index.php?page=edit_student" class="btn_edit">Добавить студентов</button>
                <p class="or delete_or">или</p>
              </form>
              <button class="upload_file" data-bs-toggle="modal" data-bs-target="#add_students_file"> Добавить список студентов файлом</button>
          </div>
          <?php 
          }
          ?>
      </div>
      </section>
            
  