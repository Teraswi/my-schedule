<?php
require_once '../../login/login.php';
require __DIR__ . '/../../vendor/autoload.php'; // Путь относительно текущего файла

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    // Подключаемся к базе данных через PDO с кодировкой UTF-8
    $pdo = new PDO("mysql:host=$hn;dbname=$db;charset=utf8mb4", $un, $pw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Ошибка подключения к базе данных.']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teachers = $_POST['teachers'] ?? [];

    if (empty($teachers)) {
        die('Данные преподавателей не получены.');
    }

    foreach ($teachers as $teacher) {
        $id = $teacher['id'];
        $fio = explode(' ', $teacher['name']);
        $surname = $fio[0] ?? '';
        $name = $fio[1] ?? '';
        $patronymic = $fio[2] ?? '';
        $items = $teacher['items'];
        $group = trim($teacher['groups']); // Убираем лишние пробелы
        $email = trim($teacher['email']); // Убираем лишние пробелы

        // Флаг для отслеживания изменений
        $isUpdated = false;

        if ($id) {
            // Обновление существующего преподавателя
            $stmtCheck = $pdo->prepare("
                SELECT `Surname`, `Name`, `Patronymic`, `items` 
                FROM `techer` 
                WHERE `id_tech` = ?
            ");
            $stmtCheck->execute([$id]);
            $existingTeacher = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if (
                $existingTeacher['Surname'] !== $surname ||
                $existingTeacher['Name'] !== $name ||
                $existingTeacher['Patronymic'] !== $patronymic ||
                $existingTeacher['items'] !== $items
            ) {
                $stmt = $pdo->prepare("
                    UPDATE techer 
                    SET `Surname` = ?, `Name` = ?, `Patronymic` = ?, `items` = ? 
                    WHERE `id_tech` = ?
                ");
                $stmt->execute([$surname, $name, $patronymic, $items, $id]);
                $isUpdated = true;
            }
        } else {
            // Создание нового преподавателя
            $username = strtolower($surname . '_' . $name); // Генерируем логин
            $passwordBase =bin2hex(random_bytes(6)); // Генерация пароля
            $password = password_hash($passwordBase, PASSWORD_BCRYPT); // Хэшируем пароль

            $stmtUser = $pdo->prepare("
                INSERT INTO `users` (`login`, `password`) 
                VALUES (?, ?)
            ");
            $stmtUser->execute([$username, $password]);
            $user_id = $pdo->lastInsertId(); // Получаем ID созданного пользователя

            $stmt = $pdo->prepare("
                INSERT INTO `techer` (`Surname`, `Name`, `Patronymic`, `items`, `id_user`) 
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$surname, $name, $patronymic, $items, $user_id]);
            $id = $pdo->lastInsertId(); // Получаем ID нового преподавателя
            $isUpdated = true;

            // Отправляем email с данными для входа
            if (!empty($email)) {
                $mail = new PHPMailer(true);

                try {
                    // Настройки SMTP
                    $mail->isSMTP();
                    $mail->Host = 'smtp.yandex.ru'; // SMTP-сервер Yandex
                    $mail->SMTPAuth = true;
                    $mail->Username = 'v4mpyr-x@yandex.ru'; // Ваш email
                    $mail->Password = 'xhcxdyshomefwwdu'; // Пароль приложения
                    $mail->Port = 587; // Порт для TLS
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Используем TLS

                    // Отправитель и получатель
                    $mail->setFrom('v4mpyr-x@yandex.ru', 'Администрация');
                    $mail->addAddress($email, "$surname $name");

                    // Содержимое письма
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->Subject = 'Ваши учетные данные для входа';
                    $mail->Body = "
                        <html>
                        <head>
                            <meta charset='UTF-8'>
                            <title>Учетные данные</title>
                        </head>
                        <body>
                            <h1>Здравствуйте, $surname $name!</h1>
                            <p>Ваши учетные данные для входа:</p>
                            <ul>
                                <li><strong>Логин:</strong> $username</li>
                                <li><strong>Пароль:</strong> $passwordBase</li>
                            </ul>
                            <p>Пожалуйста, сохраните эти данные в надежном месте.</p>
                            <p><strong>С уважением,</strong><br>Администрация.</p>
                        </body>
                        </html>
                    ";
                    $mail->AltBody = "Ваши учетные данные: Логин - $username, Пароль - $passwordBase";

                    $mail->send();
                    echo "Email успешно отправлен на адрес $email.";
                } catch (Exception $e) {
                    echo "Ошибка при отправке email на адрес $email: {$mail->ErrorInfo}";
                }
            } else {
                echo "Email для преподавателя $surname $name не указан.";
            }
        }

        // Проверяем, существует ли группа в таблице `groups`
        if (!empty($group)) {
            // Если группа указана, проверяем её существование в таблице `groups`
            $stmtGroup = $pdo->prepare("SELECT `id_group` FROM `groups` WHERE `name` = ?");
            $stmtGroup->execute([$group]);
            $groupData = $stmtGroup->fetch(PDO::FETCH_ASSOC);

            if ($groupData) {
                $groupId = $groupData['id_group'];

                // Проверяем, существует ли связь в таблице `techer_groop`
                $stmtCheckRelation = $pdo->prepare("
                    SELECT `groop_id` 
                    FROM `techer_groop` 
                    WHERE `techer_id` = ?
                ");
                $stmtCheckRelation->execute([$id]);
                $existingRelation = $stmtCheckRelation->fetch(PDO::FETCH_ASSOC);

                if ($existingRelation) {
                    // Если связь существует, проверяем, изменился ли `groop_id`
                    if ($existingRelation['groop_id'] != $groupId) {
                        // Обновляем связь
                        $stmtUpdateRelation = $pdo->prepare("
                            UPDATE `techer_groop` 
                            SET `groop_id` = ? 
                            WHERE `techer_id` = ?
                        ");
                        $stmtUpdateRelation->execute([$groupId, $id]);
                        $isUpdated = true;
                    }
                } else {
                    // Если связи нет, создаем новую
                    $stmtInsertRelation = $pdo->prepare("
                        INSERT INTO `techer_groop` (`techer_id`, `groop_id`) 
                        VALUES (?, ?)
                    ");
                    $stmtInsertRelation->execute([$id, $groupId]);
                    $isUpdated = true;
                }
            }
        } else {
            // Если группа не указана, удаляем связь из таблицы `techer_groop`, если она существует
            $stmtDeleteRelation = $pdo->prepare("
                DELETE FROM `techer_groop` 
                WHERE `techer_id` = ?
            ");
            $stmtDeleteRelation->execute([$id]);

            if ($stmtDeleteRelation->rowCount() > 0) {
                error_log("Связь с группой для преподавателя с ID $id успешно удалена.");
            } else {
                error_log("Связь с группой для преподавателя с ID $id не найдена, удаление не требуется.");
            }
        }
    }

    echo 'Данные успешно сохранены и сообщение отправлено преподавателю.';
}
?>