<h1 class='dekstop'>Выберите, для какой группы хотите добавить расписание</h1>
<section class="dekstop_form">
    <div class="pagination">
      <form method="post">    
        <?php
        $group = "SELECT name FROM groups";
        $query_group = mysqli_query($link, $group) or die(mysqli_error());

        $rows = mysqli_num_rows($query_group);

        for ($i = 0; $i < $rows; $i++)
        {
          $row = mysqli_fetch_row($query_group);
          echo "<button class='link-pagination' name='group_add' value='$row[0]' type='submit'>$row[0]</button>";
        }
        ?>
      </form>
    </div>
</section>
<?php
  if(isset($_POST['group_add']))
  {
?>
<section>
  <?php
    $gr_sb = [];
    $gr_post = $_POST['group_add'];

    $group_tm = "SELECT * FROM time ORDER BY id_time";
    $query_time= mysqli_query($link, $group_tm) or die(mysqli_error());
    $rows = mysqli_num_rows($query_time);

    $group_sb = "SELECT subject.name as sub, 
        groups.name as gr
        FROM  groups_subject
      INNER JOIN subject 
        ON groups_subject.id_sub = subject.id_sub
      INNER JOIN groups 
        ON groups_subject.id_group = groups.id_group";
    $query_group= mysqli_query($link, $group_sb) or die(mysqli_error());
    $rows_gr = mysqli_num_rows($query_group);

    $gr = "SELECT * FROM groups";
    $query_gr= mysqli_query($link, $gr) or die(mysqli_error());

    while ($row_gr = mysqli_fetch_array($query_group))
    {
      if (!isset($gr_sb[$row_gr['gr']])) {
        $gr_sb[$row_gr['gr']] = []; // Создаем новый массив для ключа
    }
      $gr_sb[$row_gr['gr']][] = $row_gr['sub'];
    }
  ?>
  <table>
    <thead>
      <tr>
          <th>Расписание звонков РПК</th>
          <th>Понедельник</th>
          <th>Вторник</th>
          <th>Среда</th>
          <th>Четверг</th>
          <th>Пятница</th>
          <th>Суббота</th>
      </tr>
    </thead>
    <tbody>
      
      <?php for ($i = 0; $i < $rows; $i++)
      {
        $row  = mysqli_fetch_array($query_time);
        ?>
        <tr>
          <td><?php echo $row['Time'] ?></td>
          <?php
            for ($j = 0; $j < $rows_gr; $j++) {
              echo "<td>
              <select name='sub_name'>";
              foreach ($gr_sb as $key => $value) 
              {
                if ($key == $gr_post) {
                    foreach ($value as $sub)
                    {
                      echo "<option value='$sub'>$sub";
                    }
                }
            }
            echo "</select></td>";
          }
           ?>
        </tr>
        <?php } ?>
    </tbody>
  </table>
</section>
<?php
}
?>