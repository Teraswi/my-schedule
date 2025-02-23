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
<div id='cl'></div>
<?php
if(isset($_POST['group_update']))
{
  $gr_up = $_POST['group_update']; 
  $_SESSION['group_update'] = $gr_up;
$query = "SELECT 
    schedule.id as id,
    d.name AS day,
    s.name AS subject, 
    g.name AS groups, 
    o.number AS office,
    t.Time AS time
FROM schedule
INNER JOIN day d ON d.id_d = schedule.id_d
INNER JOIN subject s ON s.id_sub = schedule.id_sub
INNER JOIN groups g ON g.id_group = schedule.id_group
INNER JOIN office o ON o.id_of = schedule.id_of
INNER JOIN time t ON t.id_time = schedule.id_time
WHERE schedule.id_group IN (SELECT id_group FROM groups WHERE name = '$gr_up')
ORDER BY t.id_time"; // Сортируем по времени

$result = mysqli_query($link, $query);
$result_up = mysqli_num_rows($result);

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
        'id' => $row['id'],
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
foreach ($schedule as &$day) {
    for ($i = 0; $i < $maxRows; $i++) {
        if (!isset($day[$i]) || !is_array($day[$i])) {
            $day[$i] = null; // Добавляем пустую запись, если данных нет
        }
    }
}
  

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

        // Запросы к БД
        $group_tm = "SELECT * FROM time ORDER BY id_time"; 
        $query_time = mysqli_query($link, $group_tm) or die(mysqli_error());
        $rows = mysqli_num_rows($query_time); // Время

        $office = "SELECT * FROM office ORDER BY id_of";
        $query_off = mysqli_query($link, $office) or die(mysqli_error());
        $rows_off = mysqli_num_rows($query_off); // Кабинеты

        $group_sb = "SELECT subject.name AS sub, 
                     GROUP_CONCAT(groups.name) AS gr
                     FROM groups_subject
                     INNER JOIN subject ON groups_subject.id_sub = subject.id_sub
                     INNER JOIN groups ON groups_subject.id_group = groups.id_group
                     GROUP BY subject.name";
        $query_group = mysqli_query($link, $group_sb) or die(mysqli_error());
        $rows_gr = mysqli_num_rows($query_group); // Предметы и группы

        $gr = "SELECT * FROM groups";
        $query_gr = mysqli_query($link, $gr) or die(mysqli_error());

        // Формирование массивов
        while ($row_gr = mysqli_fetch_array($query_group)) {
            $gr_sb[$row_gr['sub']] = $row_gr['gr'];
        }

        foreach ($gr_sb as $k => $v) {
            $v = explode(",", $v);
            $gr_sb_reg[$k] = $v;
        }

        while ($row_off = mysqli_fetch_array($query_off)) {
            $all_rows_off[] = $row_off;
        }

        ?>

        <table id = "schedule_up">
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
                <?php for ($i = 0; $i < $rows; $i++) { ?>
                    <?php 
                        $row_time = mysqli_fetch_array($query_time);
                        // $row = mysqli_fetch_assoc($query_up);
                    ?>
                    <tr>
                        <td class='time'><?php echo $row_time['Time']; ?></td>

                        <?php for ($j = 0; $j < 6; $j++) { ?>
                            <?php
                            $row_of = $all_rows_off[$j] ?? ['number' => ''];
                            // Текущий день недели
                            $currentDay = array_keys($schedule)[$j];

                            // Текущее занятие для этого дня и времени
                            $currentClass = isset($schedule[$currentDay][$i]) ? $schedule[$currentDay][$i] : null;

                            // Текущий предмет, кабинет и id
                            $currentSubject = $currentClass ? $currentClass['subject'] : '';
                            $currentOffice = $currentClass ? $currentClass['office'] : '';
                            $currentID = $currentClass ? $currentClass['id'] : '';
                           
                          
                          
                            ?>
                           <td class='choice_admin'>
                            <input type="hidden" name="hid" class="hid" value='<?php echo $currentID;?>'>
                                <div class='td_ob'> 
                                    <!-- Выпадающий список для предметов -->
                                    <select name='sub_name' class='admin_select'>
                                        <?php if ($currentSubject) { ?>
                                            <option value="<?php echo $currentSubject; ?>" selected><?php echo $currentSubject; ?></option>
                                        <?php } else { ?>
                                            <option value="" selected></option>
                                        <?php } ?>
                                        <?php foreach ($gr_sb_reg as $key => $value) 
                                            { 
                                                foreach ($value as $gr)
                                                    {
                                                        if ($gr == $gr_up && $key != $currentSubject)
                                                            {
                                                                echo "<option value='$key'>$key";
                                                            }
                                                    } 
                                             }  
                                            ?>  
                                    </select> 
                                    <!-- Выпадающий список для кабинетов -->
                                    <select name='off_name' class='admin_select_off'>
                                        <?php if ($currentOffice) { ?>
                                            <option value="<?php echo $currentOffice; ?>" selected><?php echo $currentOffice; ?></option>
                                        <?php } else { ?>
                                            <option value="" selected></option>
                                        <?php } ?>
                                        <?php foreach ($all_rows_off as $key=>$value) 
                                            {
                                                if ($value['number'] != $currentOffice)
                                                {
                                                    echo "<option value=".$value['number'].">".$value['number']."";
                                                }
                                            } 
                                            ?>
                                    </select>
                                </div>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="button_center">
            <button class="admin_up" name="add_sh">Сохранить</button>
        </div>
    </form>
</section>
    <?php 
  }

}


?>