<?php
session_start();
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
      <form action="authorization__admin_disp.php" method='post'>
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
          <button type="submit" class="sign_up" name="sign_up">Войти</button>
        </div>
      </form>
      <?php
      require_once 'login/login.php';
      if(isset($_POST['sign_up']))
      {
      if (!empty($_POST['login']) && !empty($_POST['password']))
    {
      $y = 0;
      $login=$_POST['login'];
      $pass=$_POST['password'];
      $pass=md5($pass);
      $link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');
      $query="select login, password, status from users";
      $result=mysqli_query($link, $query) or die ('Ресурс не найден');
      $rows=mysqli_num_rows($result);
   
      for ($i=0; $i<$rows; $i++)
      {
        $row = mysqli_fetch_row($result);
        if ($login==$row['0'] && $pass==$row['1'] && $row['2']==1)
        { 
         $y = 1;
        }
      }
      if ($y == 1) {
        $_SESSION['user'] = 'Admin_Dispatcher';
        header("location:index.php");
      }
      else {
        echo "<span class='error'>Такого пользвоателя не существует</span>";
    }
    }
  elseif (empty($_POST['login']) or empty($_POST['password']))
  {
    echo "<span class='error'>Введите логин и пароль</span>";
  }}
    if (isset($_POST['back']))
    {
      session_destroy();
      header("location:registration.php");
    }
?>
    </div>
  </div>
  </section>
  </main>
</body>
</html>