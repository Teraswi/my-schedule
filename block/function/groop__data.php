<?php
require_once '../../login/login.php';
$link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');
  
if (isset($_POST['array_groop']) && isset($_POST['array_select'])) {
    $array_gr = $_POST['array_groop'];
    $array_sel = $_POST['array_select'];
    $array_sel_value = $array_sel[0]['value_select'];
    var_dump($array_gr);
    // Получаем все группы из базы данных
    $group_query = "SELECT `name` FROM `groups`";
    $query_group = mysqli_query($link, $group_query) or die(mysqli_error($link));
    $existing_groups = [];
    while ($row = mysqli_fetch_assoc($query_group)) {
        $existing_groups[] = $row['name'];
    }

    // Обработка действий
    switch ($array_sel_value) {
        case 'create':
            handleCreate($array_gr, $existing_groups, $link);
            break;

        case 'edit':
            handleEdit($array_gr, $existing_groups, $link);
            break;

        case 'delete':
            handleDelete($array_gr, $existing_groups, $link);
            break;

        default:
            echo "Неверное действие.";
            break;
    }
}

// Функция для добавления новой группы
function handleCreate($array_gr, $existing_groups, $link) {
  require_once '../../login/login.php';
    foreach ($array_gr as $group) {
        if (in_array($group['value'], $existing_groups)) {
            echo "Группа '{$group['value']}' уже существует.\n";
        } else {
            $query = "INSERT INTO `groups` (`name`) VALUES ('".$group['value']."')";
            $resilt = mysqli_query($link, $query);
            echo "Группа '{$group['value']}' успешно добавлена.\n";
        }
    }
}

// Функция для редактирования существующей группы
function handleEdit($array_gr, $existing_groups) {
    $old_group = $array_gr[0]['value']; // Номер группы, которую хотим отредактировать
    $new_group = $array_gr[1]['value']; // Новый номер группы

    // Проверяем, существует ли группа с новым номером
    if (in_array($new_group, $existing_groups)) {
        echo "Группа с номером '{$new_group}' уже существует. Редактирование невозможно.\n";
        return; // Прерываем выполнение функции
    }

    // Проверяем, существует ли старая группа
    if (!in_array($old_group, $existing_groups)) {
        echo "Группа с номером '{$old_group}' не найдена для редактирования.\n";
        return; // Прерываем выполнение функции
    }

    // Если проверки пройдены, выполняем обновление в базе данных
    echo "Группа '{$old_group}' успешно отредактирована на '{$new_group}'.\n";
}

// Функция для удаления группы
function handleDelete($array_gr, $existing_groups) {
    foreach ($array_gr as $group) {
        if (!in_array($group['value'], $existing_groups)) {
            echo "Группа '{$group['value']}' не найдена для удаления.\n";
        } else {
            // Здесь можно удалить группу из базы данных
            echo "Группа '{$group['value']}' успешно удалена.\n";
        }
    }
}

?>