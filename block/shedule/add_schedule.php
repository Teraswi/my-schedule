<?php
   if(isset($_POST['group_add']))
   {
    $title__groop = $_POST['group_add'];
    echo "<h1 class='dekstop'>Вы добавляете расписание для ". $title__groop." группы</h1>";
   }
   else{
      echo "<h1 class='dekstop'>Выберите, для какой группы хотите добавить расписание</h1>";
   }
?>
<div class='succes'></div>
<section class="dekstop_form">
    <div class="pagination">
      <form method="post">    
        <?php
        $group = "SELECT `name` FROM `groups`";
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
    $_SESSION['add_sch'] = $_POST['group_add'];
    $gr_post = $_POST['group_add'];
    $select = "SELECT `id_group` FROM `schedule` WHERE `id_group` IN (SELECT `id_group` FROM `groups` WHERE `name` = '$gr_post')";
    $query_pr = mysqli_query($link, $select);
    $result = mysqli_num_rows($query_pr);
    if ($result > 0)
    {
      echo "
      <div class='existing'>
        <h2 style = 'margin-bottom: 40px;'>Для данной группы уже есть расписание. Хотите отредактировать расписание $gr_post группы?</h2>
        <div>
          <a href='index.php?page=update_schedule' class='update_data'>Редактировать</a>
        </div>
      </div>
      ";
    }
    else{

    
?>

<section>
  <form action="" method="post">
  <?php
    $gr_sb = [];
    $gr_sb_reg = [];
    $all_rows_off = [];

    $group_tm = "SELECT * FROM `time` ORDER BY `id_time`"; 
    $query_time= mysqli_query($link, $group_tm) or die(mysqli_error());
    $rows = mysqli_num_rows($query_time); // Выводим время 

    $office = "SELECT * FROM `office` ORDER by `id_of`";
    $query_off= mysqli_query($link, $office) or die(mysqli_error());
    $rows_off = mysqli_num_rows($query_off); // Выводим кабинеты 

    $group_sb = "SELECT `subject`.`name` as `sub`, 
    GROUP_CONCAT(`groups`.`name`) as `gr`
    FROM  `groups_subject`
    INNER JOIN `subject` 
      ON `groups_subject`.`id_sub` = `subject`.`id_sub`
    INNER JOIN `groups`
      ON `groups_subject`.`id_group` = `groups`.`id_group`
    GROUP BY `subject`.`name`";
    $query_group= mysqli_query($link, $group_sb) or die(mysqli_error());
    $rows_gr = mysqli_num_rows($query_group); // Выводим предметы и группы

    $gr = "SELECT * FROM `groups`";
    $query_gr= mysqli_query($link, $gr) or die(mysqli_error());

    while ($row_gr = mysqli_fetch_array($query_group)) // Заносим значения таблицы в массив
    {
      $gr_sb[$row_gr['sub']] = $row_gr['gr'];
    }

    foreach ($gr_sb as $k => $v) // удаляем запятые и записываем как новый элемент массива
    {
      $v = explode(",", $v);
      $gr_sb_reg[$k] = $v;
    }

    
    while ($row_off = mysqli_fetch_array($query_off)) {
    $all_rows_off[] = $row_off;
}
  ?>
  <table id='schedule'>
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
            for ($j = 0; $j < 6; $j++) {
              $row_of = $all_rows_off[$j] ?? ['number' => ''];
              echo "<td class='choice_admin'>
              <div class='td_ob'> 
              <select name='sub_name' class='admin_select' >";
              echo "<option>";
              foreach ($gr_sb_reg as $key => $value) 
              {
                foreach ($value as $gr)
                {
                  if ($gr == $gr_post) 
                  {
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
        <?php } ?>
    </tbody>
  </table>
  <div class="button_center">
    <button class="admin_add add_schedule" name="add_sh">Сохранить</button>
  </div>
  </form>
</section>
<?php

}
}
else
{ ?>
<div class="form_upload_file">
  <h2 class="or_dekstop">или</h2>
  <button class="upload_file" data-bs-toggle="modal" data-bs-target="#add_schedule_file"> Добавить расписание файлом</button>
</div>
<?php 

}

?>

