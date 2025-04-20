<?php
  $show = "SHOW TABLES LIKE '!%'"; // Вытаскиваем все таблицы, которые наинаются с !
  $result = mysqli_query($link, $show) or die("Не возможно выполнить запрос");
  $rows=mysqli_num_rows($result);
  $hidden_collumn = "0";
  if ($rows == 0) 
  {
    echo "<h1 class = 'empty_data'>На данный момент изменения в расписания отсутствуют</h1>";
  }
  else
  {
      for ($q = 0; $q < $rows; $q++) {
      $row = mysqli_fetch_row($result);
      $table = $row[0]; // Заносим название таблицы
      $tablesql = "SELECT  * FROM  `$table`";
      $tableRes = mysqli_query($link, $tablesql) or die("Ошибка"); // Выносим данные каждой таблицы
      $rows_1=mysqli_num_rows($tableRes);
      $table_str = mb_substr($table, 1); // Отсекаем знак !

      echo "<h1 class='dekstop'>Изменения в расписании на $table_str 2023/2024 учебного года</h1>";
      echo "<section class='table changes'>
        <table class='media__table'>";
      echo "<thead><tr>";
      $arr = [];
      $show_collumn = "SHOW COLUMNS FROM `$table`"; //Выносим названия столбцов
      $show_res_coll = mysqli_query($link, $show_collumn);
      while($row = mysqli_fetch_assoc($show_res_coll)) {
          if ($row['Field'] != 'id_ch') { // Пропускаем скрытый столбец
              echo "<th class='choices_th'>{$row['Field']}</th>";
              array_push($arr, $row['Field']);
          }
      }
      echo "</tr></thead>";
      echo "<tbody>";
      while ($table_data = mysqli_fetch_row($tableRes)) {
          echo "<tr>";
          foreach ($table_data as $key => $data) {
              if ($key != $hidden_collumn) { // Пропускаем скрытый столбец
                  echo "<td>$data</td>";
              }
          }
          echo "</tr>";   
  }
      echo "</tbody>";
      echo "</table></section>";

  }

  $show_mobile = "SHOW TABLES LIKE '!%'"; // Вытаскиваем все таблицы, которые наинаются с !
  $result_mobile = mysqli_query($link, $show_mobile) or die("Не возможно выполнить запрос");
  $rows_mobile=mysqli_num_rows($result_mobile);
  $hidden_collumn = "0";
  for ($w = 0; $w < $rows_mobile; $w++)
  {
      $row = mysqli_fetch_row($result_mobile);
      $table = $row[0]; // Заносим название таблицы
      $tablesql = "SELECT  * FROM  `$table`";
      $tableRes = mysqli_query($link, $tablesql) or die("Ошибка"); // Выносим данные каждой таблицы
      $rows_1=mysqli_num_rows($tableRes);
      $table_str = mb_substr($table, 1); // Отсекаем знак !
      
      echo "<h1 class='mobile'>Изменения в расписании на $table_str 2023/2024 учебного года</h1>";
      echo "<section class='mobile_table'><table class='media__table'>";

      $row_arr=[];
      for ($i=0; $i<$rows_1; $i++)
      {
        $row = mysqli_fetch_row($tableRes);
        array_push($row_arr, $row); // заносим все ячейки в массив
      }
      for($i=0; $i<count($arr); $i++){
        if($i == 0 or $i == 1){continue;} // пропускаем первый столбец Time
        echo "<tr>";
        for($j=0; $j<count($row_arr); $j++){ // Идем по массиву 
          $time = str_replace(" ", '&nbsp;',$row_arr[$j][1]); // Обрезаем пробелы для корректного вывода времени
          if($j == 0){
            echo "<td data-label='Расписание звонков РПК'>".$arr[$i]."</td>"; 
            echo "<td data-label=".$time.">".$row_arr[$j][$i]."</td>";
            continue;
          }
          echo "<td data-label=".$time.">".$row_arr[$j][$i]."</td>";
        }
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table></section>";
}
}
?>