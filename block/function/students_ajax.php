<?php
session_start();
require_once '../../login/login.php';
$link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');

if (empty($_POST['students_value']))
{
  $st_group = '11/16';
}
else{
  $_SESSION['st_gr'] = $_POST['students_value'];
  $st_group = $_SESSION['st_gr'];
}
if (isset($_POST['sort_value'])) {
  $_SESSION['sort_value'] = $_POST['sort_value'];
  $sort = $_SESSION['sort_value'];
  $qeury = "SELECT surname, name, patronymic DATE_FORMAT(date_receipts, '%d/%m/%Y') as date_receipts FROM students WHERE id_group IN (SELECT id_group FROM groups WHERE name = '$st_group') ORDER BY $sort";
  $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
  $rows=mysqli_num_rows($result);
}
else
{
  $qeury = "SELECT surname, name, patronymic, DATE_FORMAT(date_receipts, '%d/%m/%Y') as date_receipts FROM students WHERE id_group  IN (SELECT id_group FROM groups WHERE name = '$st_group') ORDER BY surname";
  $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
  $rows=mysqli_num_rows($result);
}
if ($rows>0)
{
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
        for ($i=1; $i<$rows+1; $i++)
        {
          $row = mysqli_fetch_assoc($result);
      ?>
          <tr>
            <td><?=$i?></td>
            <td><?php echo "$row[surname] $row[name] $row[patronymic]"?></td>
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
<?php }
else echo "<h1 class ='empty_data'>Список данной группы пока не заполнен</h1>";
?>