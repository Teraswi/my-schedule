<div class="tech"></div>
<h1>Вы редактируете информацию о преподавателях на больничном</h1>
<div class="buttom_column">
    <button id="addRowBtn_teacher_medical" class="add_column">Добавить строку</button>
    <button id="removeRowBtn_teacher_medical" class="delete_column">Удалить строку</button>
</div>
<section class='techer_results'>
    <?php 
        // Запрос на получение всех преподавателей
        $medical = "SELECT `id_tech`, `id_user`, `Surname`, `Name`, `Patronymic`, `medical`, `exit_medical` FROM `techer`";
        $result_medical = mysqli_query($link, $medical);
        $rows = mysqli_num_rows($result_medical);

        if ($rows > 0) {
            // Разделяем преподавателей на два массива: на больничном и остальные
            
            echo "<table id='teacherTable_medical'>
                <thead>
                    <tr>
                        <th>ФИО Преподавателя</th>
                        <th>На больничном...</th>
                        <th>Выход с больничного...</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>";

             for ($i = 0; $i < $rows; $i++) {
                 $row = mysqli_fetch_assoc($result_medical);
                 if (!empty($row['medical']))
                 {
                    echo "
                    <tr data-original='true' data-id='{$row['id_tech']}'>
                        <td class='teachers_td'>
                        <input name='name_teacher' class='teacher_edit_input name' value='{$row["Surname"]} {$row["Name"]} {$row["Patronymic"]}'>
                        </td>
                        <td><input name='name_teacher' class='teacher_edit_input start_date' value='{$row['medical']}'></td>
                        <td>
                            <input name='group_teacher' class='teacher_edit_input end_date' placeholder='Введите дату выхода, если известна' value='";
                                if (!empty($row['exit_medical'])) {
                                    echo $row['exit_medical'];
                                }
                            echo "'>
                        </td>
                        <td>
                            <button class='clearMedicalBtn' data-id='{$row['id_tech']}'>Удалить</button>
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
    <button class="admin_add" name="edit" id="submitDataBtn_teacher_medical">Сохранить</button>
</div>