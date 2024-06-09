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
  <link rel="stylesheet" href="style/my-schedule.css">
  <link rel="stylesheet" href="style/normalize.min.css">
  <link rel="stylesheet" href="style/uikit.min.css">
  <link rel="shortcut icon" href="img/logo-icon.svg" type="image/svg+xml">
  <link rel="stylesheet" title="theme" href="#">
  <link rel="stylesheet" title="theme1" href="#">
  <script src="script/uikit.min.js" defer></script>
  <script src="script/jquery-3.7.1.min.js" ></script>
</head>
<body>
  <main>
  <?php
    require_once 'login/login.php';
    $link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');
    
    
    
    if ($_SESSION['user']=='Student')
    {
      require_once('header/header__student.php');
      if (isset($_GET['page']))
      {
        if ($_GET['page'] == 'changes')
          {
            require_once('block/shedule/changes.php');
          }
          if ($_GET['page'] == 'techer')
          {
            require_once('block/techer/info_techer.php');
          }
      }
      else
      {
        require_once('block/shedule/schedule-section.php');
      }
    }





    elseif ($_SESSION['user']=='Teacher')
    {
      require_once('header/header__techer.php');

      if (isset($_GET['page']))
      {
        if ($_GET['page'] == 'changes')
          {
            require_once('block/shedule/changes.php');
          }
          if ($_GET['page'] == 'students')
          {
            require_once('block/students/info_students.php');
          }
      }
      else
      {
        require_once('block/shedule/schedule-section.php');
      }
    }





    elseif ($_SESSION['user']=='Admin_Dispatcher')
    {
      require_once('header/header__admin.php');

      if (isset($_GET['page']))
      {
        if ($_GET['page'] == 'changes')
          {
            require_once('block/shedule/changes.php');
          }
          if ($_GET['page'] == 'techer')
          {
            require_once('block/techer/info_techer.php');
          }
          if ($_GET['page'] == 'students')
          {
            require_once('block/students/info_students.php');
          }
          if ($_GET['page'] == 'edit_bell')
          {
            require_once('block/shedule/edit_bell.php');
          }
      }
      else
      {
        require_once('block/shedule/schedule-section.php');
        require_once('block/shedule/table-manipulation.php');
      }
    }

    else {
      header("location:registration.php");
    }
  ?>
  </main>

</body>
</html>