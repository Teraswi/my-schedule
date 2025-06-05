<?php
$bell_select = "SELECT * FROM  time";
$result = mysqli_query($link, $bell_select);
$rows = mysqli_num_rows($result);
?>
<div class="succes"></div>
<section style="margin-top: 80px">
  <form action="" method="post" id="ed_bel">
  <table class="bell__table">
    <thead>
      <tr><th>Расписание звонков РПК</th></tr>
    </thead>
    <tbody>
      <?php 
      $arr_bell = [];
        for ($i=0; $i<$rows; $i++)
      {
        $edit_bell = mysqli_fetch_assoc($result);
        $a = $edit_bell['Time'];
        $bell = 'bell'.$i;
        echo "<tr><td><input type='text' class='bell' id='bell' name='$bell' placeholder='$edit_bell[Time]'></td></tr>";
        array_push($arr_bell, $bell);
      }
      ?>
    </tbody>
  </table>
  <div class="button_center">
    <div class="button_edit_bell">
      <button class="edit_add" type="submit" name="edit_add">Сохранить</button>
    </div>
  </div>
</section>
  </form>
  <script src="script/edit_bell.js" defer></script>

  