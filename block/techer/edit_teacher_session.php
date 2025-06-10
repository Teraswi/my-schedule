<div class="tech"></div>
<h1>Вы редактируете информацию о преподавателях на больничном</h1>
<div class="buttom_column">
    <button id="addRowBtn_teacher_session" class="add_column">Добавить строку</button>
    <button id="removeRowBtn_teacher_session" class="delete_column">Удалить строку</button>
</div>
<section class='techer_results'>
    <?php 
        // Запрос на получение всех преподавателей
        $session = "SELECT `id_tech`, `id_user`, `Surname`, `Name`, `Patronymic`, `session`, `exit_session` FROM `techer`";
        $result_session = mysqli_query($link, $session);
        $rows = mysqli_num_rows($result_session);

        if ($rows > 0) {
            // Разделяем преподавателей на два массива: на больничном и остальные
            
            echo "<table id='teacherTable_session'>
                <thead>
                    <tr>
                        <th>ФИО Преподавателя</th>
                        <th>Сессия с...</th>
                        <th>До...</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>";

             for ($i = 0; $i < $rows; $i++) {
                 $row = mysqli_fetch_assoc($result_session);
                 if (!empty($row['session']))
                 {
                    echo "
                    <tr data-original='true' data-id='{$row['id_tech']}'>
                        <td class='teachers_td'>
                        <input name='name_teacher' class='teacher_edit_input name' value='{$row["Surname"]} {$row["Name"]} {$row["Patronymic"]}'>
                        </td>
                        <td><input name='name_teacher' class='teacher_edit_input start_date' value='{$row['session']}'></td>
                        <td>
                            <input name='group_teacher' class='teacher_edit_input end_date' placeholder='Введите дату конца, если известна' value='";
                                if (!empty($row['exit_session'])) {
                                    echo $row['exit_session'];
                                }
                            echo "'>
                        </td>
                        <td>
                            <button class='delete-row-btn' data-id='{$row['id_tech']}'>Удалить</button>
                        </td>
                    </tr>";
                 }
            }

            echo "</tbody>
            </table>";
            }

         else {
            echo "<h1 class='empty_data'>На данный момент информация о преподавателях не заполнена</h1>";
        }
    ?>
</section>
<input type="hidden" name="selected_group" id="selected_group" value="all">
<div class="button_center">
    <button class="admin_add" name="edit" id="submitDataBtn_teacher_session">Сохранить</button>
</div>