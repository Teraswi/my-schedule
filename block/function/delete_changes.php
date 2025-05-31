<?php
  require_once '../../login/login.php';
  $link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');
  
  if (isset($_POST['delete_ch']))
    {
      $changes = $_POST['delete_ch'];
      $query = "DROP TABLE `$changes`";
      mysqli_query($link, $query);
    }
?>