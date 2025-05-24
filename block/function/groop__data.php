<?php
header('Content-Type: application/json'); // Устанавливаем заголовок для JSON
require_once '../../login/login.php';

// Подключение к базе данных
$link = mysqli_connect("$hn", "$un", "$pw", "$db") or die(json_encode(['success' => false, 'message' => 'Невозможно подключиться к базе данных.']));

$response = ['success' => false, 'message' => 'Неизвестная ошибка']; // Инициализация ответа

if (isset($_POST['array_groop']) && isset($_POST['array_select'])) {
    $array_gr = $_POST['array_groop'];
    $array_sel = $_POST['array_select'];

    // Экранируем все входные данные для защиты от SQL-инъекций
    $array_gr = array_map(function ($item) use ($link) { // Анонимная функция которая принимает один элемент массива ($item) и выполняет его обработку. Она также использует переменную $link через ключевое слово use, чтобы иметь доступ к подключению к базе данных.
        if (is_array($item)) { //Проверка, является ли текущий элемент массивом.
            return array_map(function ($value) use ($link) { //Рекурсивная обработка вложенных массивов
                return is_string($value) ? mysqli_real_escape_string($link, $value) : $value;
            }, $item);
        }
        return $item;
    }, $array_gr);

    $array_sel_value = $array_sel[0]['value_select'];

    // Получаем все группы из базы данных
    $group_query = "SELECT `id_group`, `name` FROM groups";
    $query_group = mysqli_query($link, $group_query) or die(json_encode(['success' => false, 'message' => 'Ошибка при получении данных из базы.']));

    $existing_groups = [];
    while ($row = mysqli_fetch_assoc($query_group)) {
        $existing_groups[$row['name']] = $row['id_group']; // Сохраняем id для каждой группы
    }

    // Обработка действий
    switch ($array_sel_value) {
        case 'create':
            $response = handleCreate($array_gr, $existing_groups, $link);
            break;

        case 'edit':
            $response = handleEdit($array_gr, $existing_groups, $link);
            break;

        case 'delete':
            $response = handleDelete($array_gr, $existing_groups, $link);
            break;

        default:
            $response = ['success' => false, 'message' => 'Неверное действие.'];
            break;
    }
} else {
    $response = ['success' => false, 'message' => 'Недостаточно данных для обработки.'];
}

// Возвращаем ответ в формате JSON
echo json_encode($response);
exit;

// Функция для добавления новой группы
function handleCreate($array_gr, $existing_groups, $link) {
    foreach ($array_gr as $group) {
        $group_name = $group['value'];

        // Проверяем, существует ли группа
        if (in_array($group_name, array_keys($existing_groups))) {
            return ['success' => false, 'message' => "Группа '{$group_name}' уже существует."];
        }

        // Добавляем группу
        $query = "INSERT INTO `groups` (`name`) VALUES ('{$group_name}')";
        $result = mysqli_query($link, $query);

        if ($result) {
            return ['success' => true, 'message' => "Группа '{$group_name}' успешно добавлена."];
        } else {
            return ['success' => false, 'message' => "Ошибка при добавлении группы {$group_name}. " . mysqli_error($link)];
        }
    }
}

// Функция для редактирования существующей группы
function handleEdit($array_gr, $existing_groups, $link) {
    $old_group = $array_gr[0]['value']; // Старая группа
    $new_group = $array_gr[1]['value']; // Новая группа

    // Проверяем, существует ли группа с новым номером
    if (isset($existing_groups[$new_group])) {
        return ['success' => false, 'message' => "Группа с номером {$new_group} уже существует. Редактирование невозможно."];
    }

    // Проверяем, существует ли старая группа
    if (!isset($existing_groups[$old_group])) {
        return ['success' => false, 'message' => "Группа с номером {$old_group} не найдена для редактирования."];
    }

    $group_id = $existing_groups[$old_group];
    $query = "UPDATE `groups` SET `name` = '{$new_group}' WHERE `id_group` = '{$group_id}'";
    $result = mysqli_query($link, $query);

    if ($result) {
        return ['success' => true, 'message' => "Группа {$old_group} успешно отредактирована на {$new_group}."];
    } else {
        return ['success' => false, 'message' => "Ошибка при редактировании группы. " . mysqli_error($link)];
    }
}

// Функция для удаления группы
function handleDelete($array_gr, $existing_groups, $link) {
    $input = $array_gr[0]['value'];

    // Проверяем, существует ли группа
    if (!isset($existing_groups[$input])) {
        return ['success' => false, 'message' => "Группа {$input} не найдена для удаления."];
    }

    $group_del = $existing_groups[$input];
    $query = "DELETE FROM `groups` WHERE `id_group` = '{$group_del}'";
    $result = mysqli_query($link, $query);

    if ($result) {
        return ['success' => true, 'message' => "Группа {$input} успешно удалена."];
    } else {
        return ['success' => false, 'message' => "Ошибка при удалении группы. " . mysqli_error($link)];
    }
}
?>