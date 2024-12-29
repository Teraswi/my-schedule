<?php
  $group = $_POST['groups'];
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
  <script src="script/select.js"></script>
  <!--////////////////////////////////////////////// -->
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
        echo "Для данной группы расписание еще не составлено";
      } ?>
    </table>
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
            echo "<button class='link-pagination' name='groups' value='$row[0]' type='submit'>$row[0]</button> ";
          }
          ?>
    </form>
  </div>
</section>
<!-- <?php
  //  $input = null;
  //  if (isset($_POST['press_button']))
  //  {
  //   $_SESSION['groups'] = $_POST['press_button'];
  //  }
  //  if (isset($_SESSION['groups'])) {
  //    $qeury = "SELECT t.`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday` FROM `time` t, `$_SESSION[groups]` g WHERE t.`id_T` = g.`Time`;";
  //    $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
  //    $rows=mysqli_num_rows($result);
  //    echo "<h1 class='dekstop'>Основное расписание ".$_SESSION['groups']." группы</h1>";
  ?>
    <section class="table">
      <div>
        <table class="media__table">
          <thead>
            <tr>
              <th >Расписание звонков РПК</th>
              <th scope="col">Понедельник</th>
              <th scope="col">Вторник</th>
              <th scope="col">Среда</th>
              <th scope="col">Четверг</th>
              <th scope="col">Пятница</th>
              <th scope="col">Суббота</th>
            </tr>
          </thead>
          <tbody>
          <?php
              for ($i=0; $i<$rows; $i++)
              {
                $row = mysqli_fetch_assoc($result);
            ?>
                <tr>
                  <td data-label="Расписание звонков РПК"><?=$row['Time']?></td>
                  <td data-label="Понедельник"><?=$row['Monday']?></td>
                  <td data-label="Вторник"><?=$row['Tuesday']?></td>
                  <td data-label="Среда"><?=$row['Wednesday']?></td>
                  <td data-label="Четверг"><?=$row['Thursday']?></td>
                  <td data-label="Пятница"><?=$row['Friday']?></td>
                  <td data-label="Суббота"><?=$row['Saturday']?></td>
                </tr>
          <?php
              } 
            // }
            // else {
            //   echo "<h1 class='dekstop'>Основное расписание 1116 группы</h1>";
            //   $qeury = "SELECT t.`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday` FROM `time` t, `1116` g WHERE t.`id_T` = g.`Time`;";
            //   $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
            //   $rows=mysqli_num_rows($result);
              ?>
            <section class="table">
              <div>
                <table class="media__table">
                  <thead>
                    <tr>
                      <th scope="col">Расписание звонков РПК</th>
                      <th scope="col">Понеделньик</th>
                      <th scope="col">Вторник</th>
                      <th scope="col">Среда</th>
                      <th scope="col">Четверг</th>
                      <th scope="col">Пятница</th>
                      <th scope="col">Суббота</th>
                    </tr>
                  </thead>
                   <tbody>
                    <?php
                    // for ($i=0; $i<$rows; $i++)
                    // {
                    //   $row = mysqli_fetch_assoc($result);
                    ?>
                    <tr>
                      <td data-label="Time"><?=$row['Time']?></td>
                      <td data-label="Monday"><?=$row['Monday']?></td>
                      <td data-label="Tuesday"><?=$row['Tuesday']?></td>
                      <td data-label="Wednesday"><?=$row['Wednesday']?></td>
                      <td data-label="Thursday"><?=$row['Thursday']?></td>
                      <td data-label="Friday"><?=$row['Friday']?></td>
                      <td data-label="Saturday"><?=$row['Saturday']?></td>
                    </tr>
            <?php
            //  }
            // }?>
                  </tbody>
                </table>
              </div>
            </section>
          </tbody>
        </table>
      </div>
    </section>

    <section class="dekstop_form">
      <form action="" method="post">
        <input type="hidden" name="press_button" value='' id="press_button">
        <div class="pagination">
          <button class="link-pagination" onclick="send.call(this, 1116)" name="11/16">11/16</button>
          <button class="link-pagination" onclick="send.call(this, 12)" name="12">12</button>
          <button class="link-pagination" onclick="send.call(this, 13)" name="13">13</button>
          <button class="link-pagination" onclick="send.call(this, 14)" name="14">14</button>
          <button class="link-pagination" onclick="send.call(this, 15)" name="15">15</button>
          <button class="link-pagination" onclick="send.call(this, 21)" name="21">21</button>
          <button class="link-pagination" onclick="send.call(this, 22)" name="22">22</button>
          <button class="link-pagination" onclick="send.call(this, 23)" name="23">23</button>
          <button class="link-pagination" onclick="send.call(this, 24)" name="24">24</button>
          <button class="link-pagination" onclick="send.call(this, 25)" name="25">25</button>
          <button class="link-pagination" onclick="send.call(this, 26)" name="26">26</button>
          <button class="link-pagination" onclick="send.call(this, 31)" name="31">31</button>
          <button class="link-pagination" onclick="send.call(this, 32)" name="32">32</button>
          <button class="link-pagination" onclick="send.call(this, 33)" name="33">33</button>
          <button class="link-pagination" onclick="send.call(this, 34)" name="34">34</button>
          <button class="link-pagination" onclick="send.call(this, 35)" name="35">35</button>
          <button class="link-pagination" onclick="send.call(this, 36)" name="36">36</button>
          <button class="link-pagination" onclick="send.call(this, 41)" name="41">41</button>
          <button class="link-pagination" onclick="send.call(this, 42)" name="42">42</button>
          <button class="link-pagination" onclick="send.call(this, 43)" name="43">43</button>
          <button class="link-pagination" onclick="send.call(this, 44)" name="44">44</button>
          <button class="link-pagination" onclick="send.call(this, 45)" name="45">45</button>
          <button class="link-pagination" onclick="send.call(this, 46)" name="46">46</button>
        </div>
      </form>
      <script>
        function send(press_value){
          this.form['press_button'].value = press_value;
          this.form.submit();
        }
      </script>
    </section>
</section>

<?php
   $input = null;
   if (isset($_POST['press_button']))
   {
    $_SESSION['groups'] = $_POST['press_button'];
   }
   if (isset($_SESSION['groups'])) {
     $qeury = "SELECT t.`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday` FROM `time` t, `$_SESSION[groups]` g WHERE t.`id_T` = g.`Time`;";
     $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
     $rows=mysqli_num_rows($result);
     echo "<h1 class='mobile'>Основное расписание ".$_SESSION['groups']." группы</h1>";
  ?>

      <section class="mobile_table">
              <table class="media__table">
                <tbody>
          <?php
          $row_arr=[];
              for ($i=0; $i<$rows; $i++)
              {
                $row = mysqli_fetch_row($result);
                array_push($row_arr, $row); // заносим все ячейки в массив
              }
              $day = ['Time', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
              for($i=0; $i<7; $i++){
                if($i == 0){continue;} // пропускаем первый столбец Time
                echo "<tr>";
                for($j=0; $j<count($row_arr); $j++){ // Идем по массиву 
                  $time = str_replace(" ", '&nbsp;',$row_arr[$j][0]); // Обрезаем пробелы для корректного вывода времени
                  if($j == 0){
                    echo "<td data-label='Расписание звонков РПК'>".$day[$i]."</td>"; 
                    echo "<td data-label=".$time.">".$row_arr[$j][$i]."</td>";
                    continue;
                  }
                  echo "<td data-label=".$time.">".$row_arr[$j][$i]."</td>";
                }
                echo "</tr>";
              }
            ?>
  
            </tbody>
            </table>
          <?php
              } 
            else {
              echo "<h1 class='mobile'>Основное расписание 1116 группы</h1>";
              $qeury = "SELECT t.`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday` FROM `time` t, `1116` g WHERE t.`id_T` = g.`Time`;";
              $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
              $rows=mysqli_num_rows($result);
              ?>
            <section class="mobile_table">
              <div>
                <table class="media__table">
                   <tbody>
                  <?php
                            $row_arr=[];
                            for ($i=0; $i<$rows; $i++)
                            {
                              $row = mysqli_fetch_row($result);
                              array_push($row_arr, $row); // заносим все ячейки в массив
                            }
                            $day = ['Time', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
                            for($i=0; $i<7; $i++){
                              if($i == 0){continue;} // пропускаем первый столбец Time
                              echo "<tr>";
                              for($j=0; $j<count($row_arr); $j++){ // Идем по массиву 
                                $time = str_replace(" ", '&nbsp;',$row_arr[$j][0]); // Обрезаем пробелы для корректного вывода времени
                                if($j == 0){
                                  echo "<td data-label='Расписание звонков РПК'>".$day[$i]."</td>"; 
                                  echo "<td data-label=".$time.">".$row_arr[$j][$i]."</td>";
                                  continue;
                                }
                                echo "<td data-label=".$time.">".$row_arr[$j][$i]."</td>";
                              }
                              echo "</tr>";
                            }
                  
                  ?>
                  </tbody>
                </table>
              </div>
            </section>
            <?php
             }?>
      </div>
    </section>
    <section class="mobile_form">
      <form action="" method="post">
        <input type="hidden" name="press_button" value='' id="press_button">
        <div class="pagination">
          <button class="link-pagination" onclick="send.call(this, 1116)" name="11/16">11/16</button>
          <button class="link-pagination" onclick="send.call(this, 12)" name="12">12</button>
          <button class="link-pagination" onclick="send.call(this, 13)" name="13">13</button>
          <button class="link-pagination" onclick="send.call(this, 14)" name="14">14</button>
          <button class="link-pagination" onclick="send.call(this, 15)" name="15">15</button>
          <button class="link-pagination" onclick="send.call(this, 21)" name="21">21</button>
          <button class="link-pagination" onclick="send.call(this, 22)" name="22">22</button>
          <button class="link-pagination" onclick="send.call(this, 23)" name="23">23</button>
          <button class="link-pagination" onclick="send.call(this, 24)" name="24">24</button>
          <button class="link-pagination" onclick="send.call(this, 25)" name="25">25</button>
          <button class="link-pagination" onclick="send.call(this, 26)" name="26">26</button>
          <button class="link-pagination" onclick="send.call(this, 31)" name="31">31</button>
          <button class="link-pagination" onclick="send.call(this, 32)" name="32">32</button>
          <button class="link-pagination" onclick="send.call(this, 33)" name="33">33</button>
          <button class="link-pagination" onclick="send.call(this, 34)" name="34">34</button>
          <button class="link-pagination" onclick="send.call(this, 35)" name="35">35</button>
          <button class="link-pagination" onclick="send.call(this, 36)" name="36">36</button>
          <button class="link-pagination" onclick="send.call(this, 41)" name="41">41</button>
          <button class="link-pagination" onclick="send.call(this, 42)" name="42">42</button>
          <button class="link-pagination" onclick="send.call(this, 43)" name="43">43</button>
          <button class="link-pagination" onclick="send.call(this, 44)" name="44">44</button>
          <button class="link-pagination" onclick="send.call(this, 45)" name="45">45</button>
          <button class="link-pagination" onclick="send.call(this, 46)" name="46">46</button>
        </div>
      </form>
      <script>
        function send(press_value){
          this.form['press_button'].value = press_value;
          this.form.submit();
        }
      </script>
    </section>
 -->
