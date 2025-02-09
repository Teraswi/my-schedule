<?php
  session_start();
  require_once '../../login/login.php';
  $link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');
  if (!$_POST['value'])
  {
    $group = '11/16';
  }
  else{
    $_SESSION['gr'] = $_POST['value'];
    $group = $_SESSION['gr'];
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

 WHERE schedule.id_group IN (SELECT id_group FROM groups WHERE name = '$group')";

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
<section class="table"> 
     <?php echo "<h1 class='dekstop'>Основное расписание ".$group." группы</h1>";?>
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
        echo "<h1 class = 'empty_data'>Для данной группы расписание еще не составлено</h1>";
    }
 ?>
</section>
<section class="mobile_table">
  <table class= "media__table">
        <?php 
        $result1 = mysqli_query($link, $query);
        $schedule1 = [
          'Понедельник' => [],
          'Вторник' => [],
          'Среда' => [],
          'Четверг' => [],
          'Пятница' => [],
          'Суббота' => []
      ];
      $empty = 0;
      // Заполняем массив данными из запроса
      while ($row = mysqli_fetch_assoc($result1)) {
          $schedule1[$row['day']][] = $row;
          $empty++;
      }

        if ($empty != 0)
        {
         $day = ['Time', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
      
         for ($i = 1; $i < count($day); $i++) { 
          echo "<tr>";
          echo "<td data-label='Расписание звонков РПК'>".$day[$i]."</td>";

          // Цикл по временным интервалам
          for ($j = 0; $j < $maxRows; $j++) {
              $time = str_replace(" ", '&nbsp;',$times[$j]);
              echo "<td data-label=".$time.">";

              // Получаем данные из массива $schedule1 для текущего дня и времени
              $data = $schedule1[$day[$i]][$j] ?? null; 

              if ($data) {
                // Если данные найдены, выводим их
                echo $data['subject']; // 
              } 
              else { echo "&nbsp;"; }

              echo "</td>";
          }
          echo "</tr>";
      }}
      else {
        echo "<h1 class = 'empty_data'>Для данной группы расписание еще не составлено</h1>";
      } ?>
    </table>
  </section>


