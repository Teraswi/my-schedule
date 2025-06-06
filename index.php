<?php
  session_start();
  ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Моё расписание</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/bootstrap-5.3.0-dist/css/bootstrap.css">
  <link rel="stylesheet" href="style/choices.min.css">
  <link rel="stylesheet" href="style/my-schedule.css">
  <link rel="stylesheet" href="style/normalize.min.css">
  <link rel="shortcut icon" href="img/logo-icon.svg" type="image/svg+xml">
  <link rel="stylesheet" title="theme" href="#">
  <link rel="stylesheet" title="theme1" href="#">
  <script src="script/jquery-3.7.1.min.js" ></script>
  <script src="script/choices.min.js"></script>
  <script src="script/choice.js"></script>
  <script src="script/techer.js" defer></script>
  <script src="script/select.js" defer></script>
  <script src="script/students.js" defer></script>
  <script src="script/admin_select.js" defer></script>
  <script src="script/admin_update.js" defer></script>
  <script src="script/delete_schedule.js" defer></script>
  <script src="script/groop.js" defer></script>
  <script src="script/close__menu.js" defer></script>
  <script src="script/add_changes.js" defer></script>
  <script src="script/edit_changes.js" defer></script>
  <script src="script/delete_changes.js" defer></script>
  <script src="script/edit_student.js" defer></script>
  <script src="style/bootstrap-5.3.0-dist/js/bootstrap.js"></script>

</head>
<body>
  <main>
  <?php
    require_once 'login/login.php';
    $link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');
    
    
    
    if ($_SESSION['user'] == 'Student')
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


    elseif ($_SESSION['user'] == 'Teacher')
    {
      require_once('header/header__techer.php');
      // echo $_SESSION['user_id'];
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
          if ($_GET['page'] == 'edit_student')
          {
            require_once('block/students/edit_student.php');
          }
      }
      else
      {
        require_once('block/shedule/schedule-section.php');
      }
    }





    elseif ($_SESSION['user'] == 'Admin_Dispatcher')
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
          if ($_GET['page'] == 'add_schedule')
            {
              require_once('block/shedule/add_schedule.php');
            }
          if ($_GET['page'] == 'update_schedule')
            {
              require_once('block/shedule/update_schedule.php');
            }
          if ($_GET['page'] == 'add_changes')
            {
              require_once('block/shedule/add_changes.php');
            }
          if ($_GET['page'] == 'edit_changes')
            {
              require_once('block/shedule/edit_changes.php');
            }
          if ($_GET['page'] == 'edit_student')
            {
              require_once('block/students/edit_student.php');
            }
      }
      else
      {
        require_once('block/shedule/schedule-section.php');
      }
    }

    else {
      header('Location: registration.php');
    }
  ?>
  </main>
  <?php
   require_once ('block/shedule/delete_schedule.php'); 
   require_once ('block/shedule/groop.php'); 
   require_once ('block/shedule/add_schedule_file.php'); 
   require_once ('block/shedule/add_changes_file.php'); 
   require_once ('block/shedule/delete_changes.php');
   require_once ('block/shedule/delete_changes.php');
   require_once ('block/students/add_studenst_file.php');

  ?>