<?php
if (empty($_SESSION['gr']))
{
  $group_ajax = '11/16';
}
else
{
  $group_ajax =  $_SESSION['gr'];
} 

      $query="SELECT 
      d.name as day, 
      s.name as subject, 
      g.name as groups, 
      o.number as office 
    FROM schedule

    INNER JOIN day d ON d.id_d = schedule.id_d
    INNER JOIN subject s ON s.id_sub = schedule.id_sub
    INNER JOIN groups g ON g.id_group = schedule.id_group
    INNER JOIN office o ON o.id_of = schedule.id_of

    WHERE schedule.id_group IN (SELECT id_group FROM groups WHERE name = '$group_ajax')";

    $result = mysqli_query($link, $query);
   
    $schedule = [
        'Понедельник' => [],
        'Вторник' => [],
        'Среда' => [],
        'Четверг' => [],
        'Пятница' => [],
        'Суббота' => []
    ];
    // Заполняем массив данными из запроса
    while ($row = mysqli_fetch_assoc($result)) {
        $schedule[$row['day']][] = $row;
    }
    // Найдём максимальное количество занятий в один день
    $maxRows = 0;
    foreach ($schedule as $classes) {
        $maxRows = max($maxRows, count($classes));
    }
    
    // Собираем все уникальные времена занятий для отображения в первом столбце
    $times = [];
    $query_times = "SELECT DISTINCT t.Time FROM time t
                    INNER JOIN schedule s ON t.id_time = s.id_time
                    ORDER BY t.id_time";  // Сортируем по порядку времени
    $result_times = mysqli_query($link, $query_times);
    
    while ($time_row = mysqli_fetch_assoc($result_times)) {
        $times[] = $time_row['Time'];
    }
    ?>
  
<section id = "table_results"> 
<section class="table"> 
     <?php echo "<h1 class='dekstop'>Основное расписание ".$group_ajax." группы</h1>";?>
    <?php
    if ($maxRows != 0)
    {
    ?>
    <table class="media__table">
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
        <?php for ($i = 0; $i < $maxRows; $i++){ ?>
            <tr>
                <td>
                    <!-- Выводим время занятия для каждой строки-->
                    <?php if (isset($times[$i])) echo $times[$i]; ?>
                </td>
                <?php foreach ($schedule as $day => $classes){ ?>
                    <td>
                        <?php if (isset($classes[$i])){ ?>
                            <?= $classes[$i]['subject'] . ' ' . $classes[$i]['office'] . ' каб' ?>
                        <?php } else ?>
                            <!-- Если для этого дня и времени нет занятия -->
                            &nbsp;
                    </td>
                <?php }?>
            </tr>
        <?php } ?>
    </table>
    <?php }
    else {
        echo "<span>Для данной группы расписание еще не составлено</span>";
    }
 ?>
</section>
      <section class="mobile_table">
        <?php echo "<h1 class='mobile'>Основное расписание ".$group." группы</h1>";?>
        <form action="" method="post" class="select">
          <select class="js-group" name="groups" onchange="submitForm()">
          <option hidden>
            <?php
                $group = "SELECT name FROM groups";
                $query_group = mysqli_query($link, $group) or die(mysqli_error());

                $rows = mysqli_num_rows($query_group);

                for ($i = 0; $i < $rows; $i++)
                {
                  $row = mysqli_fetch_row($query_group);
                  echo "<option>$row[0] ";
                }
                ?>
          </select>
        </form>
        
        <!--////////////////////////////////////////////// -->
      </section>
</section>
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
          echo "<button class='link-pagination' name='group' value='$row[0]' type='submit'>$row[0]</button>";
        }
        ?>
      </form>
    </div>
</section>