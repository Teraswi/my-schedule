<?php
session_start();
require_once '../../login/login.php';
$link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');

if (isset($_POST['array_select']))
{
  $group_number = $_SESSION['add_sch'];
  $array_sch = $_POST['array_select'];
  $q = 0;
  foreach ($array_sch as $key => $data_sch)
  {
    $data_sch['group'] =  $group_number;
    if (empty($data_sch['subject']))
    {
      $data_sch['subject'] = '&nbsp;';
    }
    $query = "INSERT INTO schedule (id_d, id_time, id_sub, id_group, id_of) VALUES
    ( 
      (SELECT id_d FROM day WHERE name = '".$data_sch['day']."'),
      (SELECT id_time FROM time WHERE Time = '".$data_sch['time']."'),
      (SELECT id_sub FROM subject WHERE name = '".$data_sch['subject']."'),
      (SELECT id_group FROM groups WHERE name = '".$data_sch['group']."'),
      (SELECT id_of FROM office WHERE number = '1')
    )";
    $result = mysqli_query($link, $query);
    echo "<pre>";
    echo $query."<br>";
    echo "</pre>";
  }
}

//INSERT INTO `schedule` (`id`, `id_d`, `id_time`, `id_sub`, `id_group`, `id_of`) VALUES (NULL, '5', '7', '4', '1', '2');
//$data_sch['day']." ".$data_sch['time']." ".$data_sch['subject']." ". $data_sch['group']
?>