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
    $group_ajax = $_SESSION['gr'];
  }
 
  $query = "SELECT 
    `d`.`name` AS `day`,
    `s`.`name` AS `subject`, 
    `g`.`name` AS `groups`, 
    `o`.`number` AS `office`,
    `t`.`Time` AS `time`
FROM `schedule`
INNER JOIN `day` AS `d` ON `d`.`id_d` = `schedule`.`id_d`
INNER JOIN `subject` AS `s` ON `s`.`id_sub` = `schedule`.`id_sub`
INNER JOIN `groups` AS `g` ON `g`.`id_group` = `schedule`.`id_group`
INNER JOIN `office` AS `o` ON `o`.`id_of` = `schedule`.`id_of`
INNER JOIN `time` AS `t` ON `t`.`id_time` = `schedule`.`id_time`
WHERE `schedule`.`id_group` IN (SELECT `id_group` FROM `groups` WHERE `name` = '$group_ajax')
ORDER BY `t`.`id_time`;"; // Сортируем по времени

$result = mysqli_query($link, $query);

$schedule = [
  'Понедельник' => [],
  'Вторник' => [],
  'Среда' => [],
  'Четверг' => [],
  'Пятница' => [],
  'Суббота' => []
];

// Массив для временных интервалов
$times = [];

// Заполняем массивы $schedule и $times
while ($row = mysqli_fetch_assoc($result)) {
  if (!isset($schedule[$row['day']])) {
      $schedule[$row['day']] = []; // Убеждаемся, что день существует как массив
  }
  $schedule[$row['day']][] = [
      'subject' => $row['subject'],
      'office' => $row['office'],
      'time' => $row['time']
  ];

  if (!in_array($row['time'], $times)) {
      $times[] = $row['time']; // Добавляем уникальные временные интервалы
  }
}

// Найдём максимальное количество занятий в один день
$maxRows = 0;
foreach ($schedule as $classes) {
  $maxRows = max($maxRows, count($classes));
}

// Убедимся, что каждый день имеет ровно $maxRows записей
foreach ($schedule as $day) {
  for ($i = 0; $i < $maxRows; $i++) {
      if (!isset($day[$i]) || !is_array($day[$i])) {
          $day[$i] = null; // Добавляем пустую запись, если данных нет
      }
  }
}
?>

<section id="table_results">
  <div class="table">
      <?php echo "<h1 class='dekstop'>Основное расписание " . htmlspecialchars($group_ajax) . " группы</h1>"; ?>
      <?php if ($maxRows != 0) { ?>
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
              <tbody>
                  <?php for ($i = 0; $i < $maxRows; $i++) { ?>
                      <tr>
                          <td><?php 
                          if (isset($times[$i]))
                          {
                            echo htmlspecialchars($times[$i]); 
                          } 
                          ?>
                          </td>
                          <?php foreach ($schedule as $day => $classes) { ?>
                              <td>
                                  <?php
                                  if (isset($classes[$i]) && is_array($classes[$i])) {
                                      echo $classes[$i]['subject'].' '; 
                                      if ($classes[$i]['office'] != '&nbsp;')
                                      {
                                        echo $classes[$i]['office']. " каб.";
                                      }
                                      else {
                                        echo "&nbsp;";
                                      }
                                     
                                  }
                                  ?>
                              </td>
                          <?php } ?>
                      </tr>
                  <?php } ?>
              </tbody>
          </table>
      <?php } else { ?>
          <!-- <h1 class="empty_data">Для данной группы расписание еще не составлено</h1> -->
      <?php } ?>
      </div>
</section>
        <?php 
        $result1 = mysqli_query($link, $query);
        $rows_r = mysqli_num_rows($result1);
      if ($rows_r != 0) {
        $days = ['Time', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
        echo "<section class='mobile_table'>
                <table class= 'media__table'>";
        for ($i = 1; $i < count($days); $i++) {
            echo "<tr>";
            echo "<td data-label='Расписание звонков РПК'>" . htmlspecialchars($days[$i]) . "</td>";

            for ($j = 0; $j < $maxRows; $j++) {
                $time = str_replace(" ", "&nbsp;", htmlspecialchars($times[$j]));
                echo "<td data-label=" . $time . ">";

                if (isset($schedule[$days[$i]][$j]) && is_array($schedule[$days[$i]][$j])) {
                    echo $schedule[$days[$i]][$j]['subject'] . ' ';
                        if ($schedule[$days[$i]][$j]['office'] != '&nbsp;')
                        {
                            echo $schedule[$days[$i]][$j]['office']. " каб.";
                        }
                        else {
                            echo "&nbsp;";
                        }
                } else {
                    echo "&nbsp;";
                }

                echo "</td>";
            }
            echo "</tr>";
        }
    } else { ?>
        <h1 class="empty_data">Для данной группы расписание еще не составлено</h1>
    <?php } ?>
    </table>
  </section>


