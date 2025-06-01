<?php
   if(isset($_POST['changes_edit']))
   {
    $title__groop = $_SESSION['changes_edit'];
    echo "<h1 class='dekstop'>Вы редактируете изменениня на $title__groop</h1>";
   }
   else{
      echo "<h1>Выберите изменения, которые хотите отредактировать</h1>";
   }
?>

<div class="pagination">
  <form action="" method="POST">
      <?php
        $show = "SHOW TABLES LIKE 'ch_%'"; // Вытаскиваем все таблицы, которые начинаются с "ch_"
        $result = mysqli_query($link, $show) or die("Не возможно выполнить запрос");
        $rows = mysqli_num_rows($result);

        if ($rows > 0) {
        while ($row = mysqli_fetch_row($result)) {
            $table_name = $row[0]; // Полное имя таблицы

            // Формируем читаемое название таблицы
            $table_str = ''; // Инициализация переменной
            if (strpos($table_name, 'ch_') === 0) { // Проверяем, начинается ли строка с "ch_"
                $tableWithoutPrefix = substr($table_name, 3); // Убираем "ch_"
                $tableParts = explode('__', $tableWithoutPrefix); // Разделяем по "__"

                if (count($tableParts) === 2) {
                    $datePart = str_replace('_', '.', $tableParts[0]); // Заменяем "_" на "."
                    $dayPart = $tableParts[1]; // День недели
                    $table_str = "$datePart ($dayPart)"; // Формируем строку в формате "23.11 (среда)"
                } else {
                    $table_str = $tableWithoutPrefix; // Если нет "__", просто берем остаток строки
                }
            } else {
                $table_str = $table_name; // Если строка не начинается с "ch_", оставляем её как есть
            }

            // Выводим <option> с отформатированным названием таблицы
            echo "<button value='" . htmlspecialchars($table_name, ENT_QUOTES, 'UTF-8') . 
            "' class='link-pagination' name='changes_edit'>" .
                htmlspecialchars($table_str, ENT_QUOTES, 'UTF-8') . "</button>";
        }
    } else {
        echo "<h2>Изменения отсуствуют</h2>";
    }
      ?>
  </form>
</div>
<?php
if(isset($_POST['changes_edit']))
   {
    $hidden_column = "0";
    $office = "SELECT * FROM `office` ORDER by `id_of`";
    $query_off= mysqli_query($link, $office) or die(mysqli_error());
    $rows_off = mysqli_num_rows($query_off); // Выводим кабинеты 

    $subjectsQuery = "SELECT id_sub, name FROM subject";
    $querySubjects = mysqli_query($link, $subjectsQuery);

    $subjects = [];
    $offices = [];

    while ($subjectRow = mysqli_fetch_assoc($querySubjects)) {
        $subjects[] = $subjectRow;
    }

    while ($officeRow = mysqli_fetch_assoc($query_off)) {
        $offices[] = $officeRow;
    }

    $_SESSION['changes_edit'] = $table_str;
    $tableName = $_POST['changes_edit'];
    $query_ch = "SELECT * FROM `$table_name`";
    $result_ch = mysqli_query($link, $query_ch);
      echo "<section class='table changes'>
      <table class='media__table'>";
      echo "<thead><tr>";
    $arr = [];
    $show_collumn = "SHOW COLUMNS FROM `$tableName`"; //Выносим названия столбцов
    $show_res_coll = mysqli_query($link, $show_collumn);
    while($row = mysqli_fetch_assoc($show_res_coll)) {
        if ($row['Field'] != 'id') { // Пропускаем скрытый столбец
          $columnName = $row['Field'];
          if ($columnName === 'time') 
            {
              $columnName = 'Группа';
            }
            if ($columnName != 'Группа')
            {
              echo "<th class='day'><input type='text' name='' id='' value='".$columnName."' class='th_changes_input'></th>";
            }
            else
            {
              echo "<th class='day'>$columnName</th>";
            }
            array_push($arr, $row['Field']);
        }
    }
    echo "</tr></thead>";
    echo "<tbody>";
    while ($table_data = mysqli_fetch_row($result_ch)) {
          echo "<tr>";
          foreach ($table_data as $key => $data) {
              if ($key != $hidden_column) { // Пропускаем скрытый столбец
                if ($key == '1')
                  {
                    echo "<td>$data</td>";
                  }
                elseif ($key > 1)
                  {?>
                <td class='choice_admin'>
                  <div class='td_ob'>
                      <?php
                      // Разделяем данные на предмет и кабинет
                      $subjectValue = '';
                      $officeValue = '';
                      if (!empty($data) && preg_match('/^(.+?)\s+(\d+)\s+каб.$/', $data, $matches)) {
                          $subjectValue = trim($matches[1]); // Название предмета
                          $officeValue = trim($matches[2]); // Номер кабинета
                      }
                      ?>

                      <!-- Выпадающий список для предметов -->
                      <select name="edit_changes_select" class="admin_select">
                          <?php
                          // Добавляем разделенный предмет как первую опцию (если он есть)
                          if (!empty($subjectValue)) {
                              echo "<option value='" . htmlspecialchars($subjectValue, ENT_QUOTES, "UTF-8") . "' selected>" .
                                  htmlspecialchars($subjectValue, ENT_QUOTES, "UTF-8") . "</option>";
                          }

                          // Добавляем остальные предметы из массива $subjects
                          foreach ($subjects as $subject) {
                              if (!empty($subject['name']) && $subject['name'] !== $subjectValue && $subject['name'] !== '&nbsp;') {
                                  echo "<option value='" . htmlspecialchars($subject['name'], ENT_QUOTES, "UTF-8") . "'>" .
                                      htmlspecialchars($subject['name'], ENT_QUOTES, "UTF-8") . "</option>";
                              }
                          }
                          ?>
                      </select>

                      <!-- Выпадающий список для кабинетов -->
                      <select name="off_name" class="admin_select_off">
                          <?php
                          // Добавляем разделенный кабинет как первую опцию (если он есть)
                          if (!empty($officeValue)) {
                              echo "<option value='" . htmlspecialchars($officeValue, ENT_QUOTES, "UTF-8") . "' selected>" .
                                  htmlspecialchars($officeValue, ENT_QUOTES, "UTF-8") . "</option>";
                          }

                          // Добавляем остальные кабинеты из массива $offices
                          foreach ($offices as $office) {
                              if (!empty($office['number']) && $office['number'] !== $officeValue && $office['number'] !== '&nbsp;') {
                                  echo "<option value='" . htmlspecialchars($office['number'], ENT_QUOTES, "UTF-8") . "'>" .
                                      htmlspecialchars($office['number'], ENT_QUOTES, "UTF-8") . "</option>";
                              }
                          }
                          ?>
                      </select>
                  </div>
              </td>
                  <?php
                  }
                  
              }
          }
          echo "</tr>";
      }
    echo "</tbody>";
    echo "</table>";
   }
   else
   {

   }

?>