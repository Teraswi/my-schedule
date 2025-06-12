<?php
require_once '../../login/login.php';
$link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');
$bell_select1 = "SELECT * FROM  time";
$result1 = mysqli_query($link, $bell_select1);
$rows1 = mysqli_num_rows($result1);
$id = 1;
$i = 0;

if ($_POST["bell"])
{
  $data = json_decode($_POST["bell"], true);
  foreach($data as $bell)
  {
    $edit_bell = mysqli_fetch_assoc($result1);
    if (empty($bell))
    {
      $id++;
      $i++;
      continue;
    }
    else{
      $update = "UPDATE `time` SET `Time` ='".htmlspecialchars($bell)."' WHERE `id_time` = '$id';";
      mysqli_query($link, $update);
      $id++;
    }
  }
}
if($i == 13)
{
echo "
  <div class='danger'>
    <span>Заполните хотя бы одно поле</span>
  </div>
";
}
else 
{
echo "
  <div class='succes-2'>
    <span>Данные успешно сохранены</span>
  </div>
";}


?>