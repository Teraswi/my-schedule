<?php
session_start();
require_once '../../login/login.php';
$link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');

if (isset($_POST['array_select']))
{
  $group_number = $_SESSION['group_update'];
  $array_up = $_POST['array_select'];
  foreach ($array_up as $key => $data_up)
  {
    $data_up['group'] =  $group_number;
    
    if (empty($data_up['subject']))
    {
      $data_up['subject'] = '&nbsp;';
    }
    if (empty($data_up['office']))
    {
      $data_up['office'] = '&nbsp;';
    }
    if (empty($data_up['id']))
    {
      continue;
    }
    // echo  $data_up['subject'];
    $query = "UPDATE `schedule` SET
    `id_d` = (SELECT `id_d` FROM `day` WHERE `name` = '".$data_up['day']."'),
    `id_time` = (SELECT `id_time` FROM `time` WHERE `Time` = '".$data_up['time']."'),
    `id_sub` = (SELECT `id_sub` FROM `subject` WHERE `name` = '".$data_up['subject']."'),
    `id_group` = (SELECT `id_group` FROM `groups` WHERE `name` = '".$data_up['group']."'),
    `id_of` = (SELECT `id_of` FROM `office` WHERE `number` = '".$data_up['office'] ."')
    WHERE `id` = '".$data_up['id']."'";
    $result = mysqli_query($link, $query);
    // echo "<pre>";
    // var_dump ($query);
    // echo "</pre>";
  }
  echo "Данные успешно сохранены";
}
?>