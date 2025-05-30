<h1>Введите дату вместе с днем недели, на которые хотите создать изменения<br> (например 22.11 (среда) )</h1>
<div class="div__changes">
  <input type="text" name="input__changes" id="" class="input__changes">  
</div>
<h2>Заполните таблицу</h2>
<div class="buttom_column">
  <button id="addColumnBtn" class="add_column">Добавить столбец</button>
  <button id="removeColumnBtn" class="delete_column">Удалить столбец</button>
</div>
<form action="" method="post">
  <?php
    $group_tm = "SELECT * FROM `time` ORDER BY `id_time`"; 
    $query_time= mysqli_query($link, $group_tm) or die(mysqli_error());
    $rows = mysqli_num_rows($query_time); // Выводим время 

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
  ?>
  <section class = "changes">
    <table id='schedule' class="changes_add" 
    data-subjects='<?php echo htmlspecialchars(json_encode($subjects), ENT_QUOTES, "UTF-8"); ?>'
    data-offices='<?php echo htmlspecialchars(json_encode($offices), ENT_QUOTES, "UTF-8"); ?>'>
      <thead>
        <tr>
            <th>Расписание звонков РПК</th>
            <th class='day'><input type="text" name="" id="" class="th_changes_input"></th>
            <th class='day'><input type="text" name="" id="" class="th_changes_input"></th>
            <th class='day'><input type="text" name="" id="" class="th_changes_input"></th>
            <th class='day'><input type="text" name="" id="" class="th_changes_input"></th>
            <th class='day'><input type="text" name="" id="" class="th_changes_input"></th>
            <th class='day'><input type="text" name="" id="" class="th_changes_input"></th>
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
                foreach ($subjects as $subject) {
                  if ($subject['name'] == '&nbsp;') continue;
                      echo "<option value='" . htmlspecialchars($subject['name']) . "'>" . htmlspecialchars($subject['name']) . "</option>";
                  }
          
                  echo "</select>
                  <select name='off_name' class='admin_select_off'>
                  <option>";
                  foreach ($offices as $office) {
                          if ($office['number'] == '&nbsp;') {
                              continue;
                          }
                          echo "<option value='" . htmlspecialchars($office['number']) . "'>" . htmlspecialchars($office['number']) . "</option>";
                      }
                  echo "</select>
                  </div></td>";
            }
            ?>
          </tr>
          <?php } ?>
      </tbody>
    </table>
  </section>
  <div class="button_center">
    <button class="admin_add" name="add_sh" id="submitDataBtn">Сохранить</button>
  </div>
</form>
<br><br>  
