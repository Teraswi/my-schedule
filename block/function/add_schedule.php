<?php
session_start();
require_once '../../login/login.php';
$link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');

if (isset($_POST['array_select']))
{
  $group_number = $_SESSION['add_sch'];
  $array_sch = $_POST['array_select'];
  foreach ($array_sch as $key => $data_sch)
  {
    $data_sch['group'] =  $group_number;
    if (empty($data_sch['subject']))
    {
      $data_sch['subject'] = '&nbsp;';
    }
    if (empty($data_sch['office']))
    {
      $data_sch['office'] = '&nbsp;';
    }
    $query = "INSERT INTO schedule (id_d, id_time, id_sub, id_group, id_of) VALUES
    ( 
      (SELECT id_d FROM day WHERE name = '".$data_sch['day']."'),
      (SELECT id_time FROM time WHERE Time = '".$data_sch['time']."'),
      (SELECT id_sub FROM subject WHERE name = '".$data_sch['subject']."'),
      (SELECT id_group FROM groups WHERE name = '".$data_sch['group']."'),
      (SELECT id_of FROM office WHERE number = '".$data_sch['office'] ."')  
    )";
    $result = mysqli_query($link, $query);
    // echo "<pre>";
    // echo $query."<br>";
    // echo "</pre>";
    echo "
    <div class='succes-2'>
      <span>Данные успешно сохранены</span>
    </div>";
  }
}

?>