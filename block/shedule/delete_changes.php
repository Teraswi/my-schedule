<div class="modal fade" id="delete_changes" tabindex="-1" aria-labelledby="delete_changes" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="delete_changes">Выберите изменения, которые хотите удалить</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
      <form  method="post" id="uploadForm">
          <select class="select__delete_ch" name="changes_delete">
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
                  echo "<option value='" . htmlspecialchars($table_name, ENT_QUOTES, 'UTF-8') . "'>" .
                      htmlspecialchars($table_str, ENT_QUOTES, 'UTF-8') . "</option>";
              }
          } else {
              echo "<option value=''>Нет доступных таблиц</option>";
          }
            ?>
          </select>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Закрыть</button>
          <button type="button" class="btn btn-primary delete_changes" name="delete_changes">Удалить</button>
        </div>
      </form>
    </div>
  </div>
</div> 