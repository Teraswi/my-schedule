<?php
  $show = "SHOW TABLES LIKE '!%'"; // Вытаскиваем все таблицы, которые наинаются с !
  $result = mysqli_query($link, $show) or die("Не возможно выполнить запрос");
  $rows=mysqli_num_rows($result);

  for ($i = 0; $i < $rows; $i++) {
    $row = mysqli_fetch_row($result);
    $table = $row[0]; // Заносим название таблицы

    $tablesql = "SELECT * FROM `$table`";
    $tableRes = mysqli_query($link, $tablesql) or die("Ошибка"); // Выносим данные каждой таблицы

    echo "<h1>Изменения в расписании на $table 2023/2024 учебного года</h1>";
    echo "<table>";
    echo "<thead><tr>";
    
    $show_collumn = "SHOW COLUMNS FROM `$table`"; //Выносим названия столбцов
    $show_res_coll = mysqli_query($link, $show_collumn);

    while($row = mysqli_fetch_assoc($show_res_coll)) {
        echo "<td>{$row['Field']}</td>";
    }
    
    echo "</tr></thead>";
    echo "<tbody>";

    while ($table_data = mysqli_fetch_row($tableRes)) {
        echo "<tr>";
        foreach ($table_data as $data) {
            echo "<td>$data</td>";
        }
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}
?>