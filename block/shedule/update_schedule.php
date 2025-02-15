<h1 class='dekstop'>Выберите, какую группу хотите отредактировать</h1>
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
          echo "<button class='link-pagination' name='group_update' value='$row[0]' type='submit'>$row[0]</button>";
        }
        ?>
      </form>
    </div>
</section>
<?php
if(isset($_POST['group_update']))
{
  $gr_up = $_POST['group_update']; 
  $select_up = "SELECT 
      schedule.id as id,
      d.name as day, 
      s.name as subject, 
      g.name as groups, 
      o.number as office 
    FROM schedule

    INNER JOIN day d ON d.id_d = schedule.id_d
    INNER JOIN subject s ON s.id_sub = schedule.id_sub
    INNER JOIN groups g ON g.id_group = schedule.id_group
    INNER JOIN office o ON o.id_of = schedule.id_of

    WHERE schedule.id_group IN (SELECT id_group FROM groups WHERE name = '$gr_up') ";

    $query_up = mysqli_query($link, $select_up);
    $result_up = mysqli_num_rows($query_up);

    if ($result_up == 0)
    {
      echo "
      <div class='existing'>
        <h2 style = 'margin-bottom: 40px;'>Для данной группы отсутствует расписание. Хотите добавить расписание для $gr_up группы? </h2>
        <div>
          <a href='index.php?page=add_schedule' class='update_data'>Добавить расписание</a>
        </div>
      </div>
      ";
    }
    else
    {
     
      ?>

 <section>
  <form action="" method="post">
    <?php
       $gr_sb = [];
       $gr_sb_reg = [];
       $all_rows_off = [];
       $row_gl = [];
   
       $group_tm = "SELECT * FROM time ORDER BY id_time"; 
       $query_time= mysqli_query($link, $group_tm) or die(mysqli_error());
       $rows = mysqli_num_rows($query_time); // Выводим время 
   
       $office = "SELECT * FROM office ORDER by id_of";
       $query_off= mysqli_query($link, $office) or die(mysqli_error());
       $rows_off = mysqli_num_rows($query_off); // Выводим кабинеты 
   
       $group_sb = "SELECT subject.name as sub, 
           GROUP_CONCAT(groups.name) as gr
           FROM  groups_subject
         INNER JOIN subject 
           ON groups_subject.id_sub = subject.id_sub
         INNER JOIN groups 
           ON groups_subject.id_group = groups.id_group
           GROUP BY subject.name";
       $query_group= mysqli_query($link, $group_sb) or die(mysqli_error());
       $rows_gr = mysqli_num_rows($query_group); // Выводим предметы и группы
   
       $gr = "SELECT * FROM groups";
       $query_gr= mysqli_query($link, $gr) or die(mysqli_error());
   
       while ($row_gr = mysqli_fetch_array($query_group)) // Заносим значения таблицы в массив
       {
         $gr_sb[$row_gr['sub']] = $row_gr['gr'];
       }

       while ($row_sch = mysqli_fetch_array($query_up)) // Заносим значения таблицы в массив главного расписания
       {
         $row_gl[$row_sch['id']] = $row_sch['subject'];
       }
   
       foreach ($gr_sb as $k => $v) // удаляем запятые и записываем как новый элемент массива
       {
         $v = explode(",", $v);
         $gr_sb_reg[$k] = $v;
       }
   
       
       while ($row_off = mysqli_fetch_array($query_off)) {
       $all_rows_off[] = $row_off;
   }

   echo "<pre>";
   var_dump($row_gl);
   echo "</pre>";
    ?>
    <table>
      <thead>
        <tr>
        <th>Расписание звонков РПК</th>
          <th class='day'>Понедельник</th>
          <th class='day'>Вторник</th>
          <th class='day'>Среда</th>
          <th class='day'>Четверг</th>
          <th class='day'>Пятница</th>
          <th class='day'>Суббота</th>
        </tr>
      </thead>
      <tbody>
        <?php
        for ($i = 0; $i < $rows; $i++)
        {
          $row  = mysqli_fetch_array($query_time);
          $row_of = mysqli_fetch_array($query_off); 
        ?>
        <tr>
          <td class='time'><?php echo $row['Time'] ?></td>
        
        <?php 
          for ($j = 0; $j < 6; $j++)
          {
            $row_of = $all_rows_off[$j] ?? ['number' => ''];
            echo "<td class='choice_admin'>
              <div class='td_ob'> 
              <select name='sub_name' class='admin_select' >";
              echo "<option>";
              foreach ($gr_sb_reg as $key => $value) 
              {
                    foreach ($value as $gr)
                    {
                      if ($gr == $gr_up) {
                      echo "<option value='$key'>$key";
                    }
                }
            }
            echo "</select>
            <select name='off_name' class='admin_select_off'>
            <option>";
            foreach ($all_rows_off as $key=>$value) 
            {
              if ($value['number'] == '&nbsp;')
              {
                continue;
              }
              echo "<option value=".$value['number'].">".$value['number']."";
            }
            echo "</select>
            </div></td>";
          }
          ?>
          </tr>
        <?php 
        }
        ?>
      </tbody>
    </table>
  </form>
 </section>
    <?php 
  }

}


?>