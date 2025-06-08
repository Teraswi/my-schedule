<?php
if (isset($_POST['group_id']))
{
 $group_id = $_POST['group_id'];

?>
<h1>Вы редактируете список студентов <?= $group_id ?> группы</h1>
<?php
  $qeury = "SELECT `id_student`, `Surname`, `Name`, `Patronymic`,  `date_receipts` as `date_receipts` FROM `students` WHERE `id_group` IN (SELECT `id_group` FROM `groups` WHERE `name` = '$group_id') ORDER BY `Surname`";
  $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
  $rows=mysqli_num_rows($result);
  ?>
<div class="buttom_column">
  <button id="addRowBtn" class="add_column">Добавить строку</button>
</div>
<table id="studentEditTable" class="student_edit" data-groop="<?= $group_id ?>">
<thead>
  <tr>
    <th>№</th>
    <th>ФИО Студента</th>
    <th>Дата Зачисления</th>
    <th>Действие</th>
  </tr>
</thead>
  <tbody>
    <?php
    for ($i=1; $i<$rows+1; $i++)
    {
      $row = mysqli_fetch_assoc($result);
    ?>
    <tr data-id="<?= htmlspecialchars($row['id_student']) ?>">
      <td class="row-number"><?=$i?></td>
      <td><input type="text" value="<?php echo "$row[Surname] $row[Name] $row[Patronymic]"?>" class="stednt_input_edit" id="fio"></td>
      <td><input type="text" value="<?php echo "$row[date_receipts]"?>" class="stednt_input_edit" id="date"></td>
      <td><button class="delete-row-btn">Удалить</button></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<div class="button_center">
  <button class="admin_add" name="add_sh" id="saveChangesBtn">Сохранить</button>
</div>
<div class="res_st">

</div>
<?php }
else {
  echo "<h1>Группа не найдена</h1>";
}
?>