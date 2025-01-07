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
<form  method="post">
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
</form>
<section class = "students_result">
    <?php 
      $qeury = "SELECT `surname`, `name`, `patronymic` FROM `students` WHERE id_group IN (SELECT id_group FROM groups WHERE name = '$group_ajax') ORDER BY 'surname'";
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
                </tr>
          <?php } ?>
                 </tbody>
                </table>
                <?php
          }
          else echo "Список данной группы пока не заполнен";
          ?>
              </div>
          <aside class="form_sort">
            <span class="sort">Сортировка по</span>
            <form action="" method="post" name="sort">
                <button name="surname" class="btn_sort" value = "surname" >По алфавиту</button>
                <button name="data" class="btn_sort" value = "date_receipts">По дате</button>
            </form>
          </aside>
      </section>
            
  