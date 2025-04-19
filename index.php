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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="exampleModalLabel">Выберите группу, для которой хотите удалить расписание</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
      <form action="" method="post" class="select">
        <select class="select__delete" name="groups">
        <?php
            $group = "SELECT name FROM groups";
            $query_group = mysqli_query($link, $group) or die(mysqli_error());
            $rows = mysqli_num_rows($query_group);
            for ($i = 0; $i < $rows; $i++) {
                $row = mysqli_fetch_row($query_group);
                echo "<option value='" . htmlspecialchars($row[0]) . "'>" . htmlspecialchars($row[0]) . "</option>";
            }
            ?>
        </select>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
          <button type="submit" class="btn btn-primary" name="delete__gr" onClick="window.location.reload();">Удалить расписание</button>
        </div>
      </form>
    </div>
  </div>
</div> 
  <?php
  if (isset($_POST['delete__gr']))
    {
      $group = $_POST['groups'];
      $query = "DELETE FROM `schedule` WHERE `id_group` = (SELECT `id_group` FROM `groups` WHERE `name` = '".$group."')";
      mysqli_query($link, $query);
    }
  ?>
<script>
  const delete__data = document.querySelector('.select__delete');

  const del__sel = new Choices(delete__data, {
  searchEnabled: false,
  itemSelectText: "",
  shouldSort: false
})
</script>
</body>
</html>