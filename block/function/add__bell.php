<?php
require_once '../../login/login.php';
$link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');
$bell_select1 = "SELECT * FROM  time";
$result1 = mysqli_query($link, $bell_select1);
$rows1 = mysqli_num_rows($result1);
$id = 1;

if ($_POST["bell"])
{
  $data = json_decode($_POST["bell"], true);
  foreach($data as $bell)
  {
    $edit_bell = mysqli_fetch_assoc($result1);
    if (empty($bell))
    {
      $id++;
      continue;
    }
    else{
      $update = "UPDATE `time` SET `Time` = '$bell' WHERE `id_T` = '$id';";
      mysqli_query($link, $update);
      $id++;
    }
  }
}

?>