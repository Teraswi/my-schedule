<h1>Вы редактируете информацию о преподавателях</h1>
  <div class="buttom_column">
    <button id="addRowBtn_teacher" class="add_column">Добавить строку</button>
    <button id="removeRowBtn_teacher" class="delete_column">Удалить строку</button>
  </div>
  <section class='techer_results'>
    <?php 
        $all = "SELECT * FROM `techer`";
        $group_techer = "SELECT * FROM `techer_groop`";
        $result_all = mysqli_query($link, $all);
        $result_group_techer=mysqli_query($link, $group_techer);
        $rows = mysqli_num_rows($result_all);
        if ($rows > 0) {
        echo "<table id='teacherTable'>
        <thead>
            <tr>
              <th>ФИО Преподавателя</th>
              <th>Предметы</th>
              <th>Закрепленная группа</th>
              <th>Электронная почта</th>
              <th>Действия</th>
            </tr>
          </thead>
          <tbody>";
        for ($i = 0; $i < $rows; $i++) {
          $row = mysqli_fetch_assoc($result_all);
          $row_group_techer = mysqli_fetch_assoc($result_group_techer);
          echo "
            <tr data-original='true'  data-id='{$row['id_tech']}' >
              <td> <input name='name_teacher' class='teacher_edit_input name' value='{$row["Surname"]} {$row["Name"]} {$row["Patronymic"]}'> </td>
              <td> <textarea class='textarea_edit'>{$row['items']}</textarea></td>
              <td> <input name='group_teacher' class='teacher_edit_input groups' value='";
               if ($row_group_techer && $row_group_techer['techer_id'] == $row['id_tech']) {
                  // Получаем название группы
                  $query_group = "SELECT `name` FROM `groups` WHERE `id_group` = {$row_group_techer['groop_id']}";
                  $res_gr = mysqli_query($link, $query_group);

                  if ($res_gr && mysqli_num_rows($res_gr) > 0) {
                      $group = mysqli_fetch_assoc($res_gr);
                      echo htmlspecialchars($group['name']); // Выводим название группы
                  } else {
                      echo "Группа не найдена"; // Если группа не найдена
                  }
              } else {
                  echo "Нет группы"; // Если связь не существует
              }
              echo "'>
              </td>
              <td>Не тебуется</td>
              <td>
                    <button class='delete-row-btn deleteTeacherBtn' data-id='{$row['id_tech']}'>Удалить</button>
                </td>
            </tr>";
        }
        echo "</tbody>
        </table>";
      }
      else echo "<h1 class = 'empty_data'>На данный момент информация о преподавателях не заполнена</h1>";
    ?>
    </section>
    <input type="hidden" name="selected_group" id="selected_group" value="all">
    <div class="button_center">
      <button class="admin_add" name="edit" id="submitDataBtn_teacher">Сохранить</button>
    </div>
   