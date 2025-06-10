<?php
  require_once '../../login/login.php';
  $link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');
  
  if (isset($_POST['value']))
    {
      $group = $_POST['value'];
      $query = "DELETE FROM `schedule` WHERE `id_group` = (SELECT `id_group` FROM `groups` WHERE `name` = '".$group."')";
      mysqli_query($link, $query);
    }

  if (isset($_POST['delete_all']))
    {
      $query = "DELETE FROM `schedule`";
      mysqli_query($link, $query);
    }
?>