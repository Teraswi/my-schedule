<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Моё расписание</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/my-schedule-changes.css">
  <link rel="stylesheet" href="style/my-schedule-info-student.css">
  <link rel="stylesheet" href="style/my-schedule-info-techer.css">
  <link rel="stylesheet" href="style/my-schedule-student.css">
  <link rel="stylesheet" href="style/my-schedule-techer.css">
  <link rel="stylesheet" href="style/my-schedule-Admin_Dispatcher.css">
  <link rel="stylesheet" href="style/normalize.min.css">
  <link rel="shortcut icon" href="img/logo-icon.svg" type="image/svg+xml">
  <link rel="stylesheet" title="theme" href="#">
  <link rel="stylesheet" title="theme1" href="#">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <script src="script/adaptiv.js" defer></script>
</head>
<body>
  <main>
  <?php
    require_once 'login/login.php';
    $link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');
    
    if ($_SESSION['user']=='Student')
    {
      require_once('header/header__student.php');
      require_once('block/shedule/schedule-section.php');
    }
    elseif ($_SESSION['user']=='Teacher')
    {
      require_once('header/header__techer.php');
    }
    elseif ($_SESSION['user']=='Admin_Dispatcher')
    {
      require_once('header/header__admin.php');
    }
    else {
      header("location:registration.php");
    }
  ?>
  </main>
</body>
</html>