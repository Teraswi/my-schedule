<?php
$bell_select = "SELECT * FROM  time";
$result = mysqli_query($link, $bell_select);
$rows = mysqli_num_rows($result);
?>
<section>
  <form action="" method="post">
  <table>
    <thead>
      <tr><th>Расписание звонков РПК</th</tr>
    </thead>
    <tbody>
      <?php
      $arr_bell = [];
        for ($i=0; $i<$rows; $i++)
      {
        $edit_bell = mysqli_fetch_assoc($result);
        $a = $edit_bell['Time'];
        $bell = 'bell'.$i;
        echo "<tr><td><input type='text' class='bell' value='$edit_bell[Time]' name='$bell'></td><tr>";
        array_push($arr_bell, $bell);
      }
      
      ?>
    </tbody>
  </table>
  <div class="button_edit_bell">
    <button class="edit_add" type="submit" name="edit_add">Сохранить</button>
  </div>
</section>

<?php
  $bell_select1 = "SELECT * FROM  time";
  $result1 = mysqli_query($link, $bell_select1);
  $rows1 = mysqli_num_rows($result1);
  $id = 1;
  if (isset($_POST['edit_add']))
  {
    foreach ($arr_bell as $bell_value){
    $edit_bell = mysqli_fetch_assoc($result1);
    if ( $_POST[$bell_value] == $edit_bell['Time'])
    {
      $id ++;
      continue;
    }
    else
        {
          $update = "UPDATE `time` SET `Time` = '$_POST[$bell_value]' WHERE `id_T` = '$id';";
          mysqli_query($link, $update);
          $id ++;
        }
      }
    } 
  ?>
  </form>