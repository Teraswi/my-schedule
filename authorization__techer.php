<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/authorization.css">
  <link rel="stylesheet" href="style/normalize.css">
  <link rel="stylesheet" title="theme" href="#">
  <link rel="shortcut icon" href="img/logo-icon.svg" type="image/svg+xml">
  <script src="script/authorization.js" defer></script>
  <script src="script/theme.js" defer></script>
  <title>Моё расписание</title>
</head>

<body>
  <main>
    <section>
  <div class="authorization">
    <div class="logo_and_name">
      <span class="logo"></span>
      <span class="name">Моё расписание</span>
    </div>
    <div class="forma">
      <form action="authorization__techer.php" method='post'>
        <div class="input_box">
          <input type="text" name='login' placeholder="Введите логин" maxlength="30">
          <i class="login"></i>
        </div>
        <div class="input_box" style="margin-top: 38px;">
          <input type="password"  name='password' placeholder="Введите пароль" maxlength="30">
          <i class="password"></i>
          <i class="pw_hide"></i>
        </div>
        <div class="button">
          <button type="submit" class="back" name="back">Назад</button>
          <button type="submit" class="sign_up" name="sign_up"  >Войти</button>
        </div>
      </form>
      <?php

  require_once 'login/login.php';
  if (isset($_POST['sign_up']))
  {
 if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password']; // Пароль, введенный пользователем

    // Подключение к базе данных
    $link = mysqli_connect($hn, $un, $pw, $db) or die('Невозможно подключиться к MySQL');

    // Защита от SQL-инъекций: используем подготовленные запросы
    $query = "SELECT id_u, login, password, status FROM users WHERE login = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $login); // Привязываем параметр
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) { // Получаем строку пользователя
        // Проверяем пароль с помощью password_verify
        if (password_verify($password, $row['password'])) {
            // Проверяем статус пользователя
            if ($row['status'] === null) {
                // Успешная авторизация
                session_start();
                $_SESSION['user_id'] = $row['id_u'];
                $_SESSION['user'] = 'Teacher';
                header('Location: index.php');
                exit(); // Завершаем выполнение скрипта после редиректа
            } else {
                echo "<span class='error'>Учетная запись не активна</span>";
            }
        } else {
            echo "<span class='error'>Неверный логин или пароль</span>";
        }
    } else {
        echo "<span class='error'>Такого пользователя не существует</span>";
    }

    // Закрываем соединение
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
  elseif (empty($_POST['login']) or empty($_POST['password']))
  {
    echo "<span class='error'>Введите логин и пароль</span>";
  }
}
    if (isset($_POST['back']))
      {
        session_destroy();
        header('Location: registration.php');;
      }

?>
    </div>
  </div>
  </section>
  </main>
</body>
</html>
