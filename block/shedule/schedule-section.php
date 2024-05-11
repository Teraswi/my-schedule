<?php
   $input = null;
   if (isset($_POST['press_button']))
   {
    $_SESSION['groups'] = $_POST['press_button'];
   }
   if (isset($_SESSION['groups'])) {
     $qeury = "SELECT t.`Time`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday` FROM `time` t, `$_SESSION[groups]` g WHERE t.`id_T` = g.`Time`;";
     $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
     $rows=mysqli_num_rows($result);
     echo "<h1>Основное расписание ".$_SESSION['groups']." группы</h1>";
  ?>
    <section class="table">
      <div>
        <table>
          <thead>
            <tr>
              <th >Раписание звонков РПК</th>
              <th scope="col">Понеделньик</th>
              <th scope="col">Вторник</th>
              <th scope="col">Среда</th>
              <th scope="col">Четверг</th>
              <th scope="col">Пятница</th>
              <th scope="col">Суббота</th>
            </tr>
          </thead>
          <tbody>
          <?php
              for ($i=0; $i<$rows; $i++)
              {
                $row = mysqli_fetch_assoc($result);
            ?>
                <tr>
                  <td data-label="Расписание звонков РПК"><?=$row['Time']?></td>
                  <td data-label="Понедельник"><?=$row['Monday']?></td>
                  <td data-label="Вторник"><?=$row['Tuesday']?></td>
                  <td data-label="Среда"><?=$row['Wednesday']?></td>
                  <td data-label="Четверг"><?=$row['Thursday']?></td>
                  <td data-label="Пятница"><?=$row['Friday']?></td>
                  <td data-label="Суббота"><?=$row['Saturday']?></td>
                </tr>
          <?php
              } 
            }
            else {
              echo "<h1>Основное расписание 1116 группы</h1>";
              $qeury = "SELECT * FROM `1116`";
              $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
              $rows=mysqli_num_rows($result);
              for ($i=0; $i<$rows; $i++)
              {
                $row = mysqli_fetch_assoc($result);?>
            <section class="table">
              <div>
                <table>
                  <thead>
                    <tr>
                      <th scope="col">Раписание звонков РПК</th>
                      <th scope="col">Понеделньик</th>
                      <th scope="col">Вторник</th>
                      <th scope="col">Среда</th>
                      <th scope="col">Четверг</th>
                      <th scope="col">Пятница</th>
                      <th scope="col">Суббота</th>
                    </tr>
                  </thead>
                   <tbody>
                    <tr>
                      <td data-label="Time"><?=$row['Time']?></td>
                      <td data-label="Monday"><?=$row['Monday']?></td>
                      <td data-label="Tuesday"><?=$row['Tuesday']?></td>
                      <td data-label="Wednesday"><?=$row['Wednesday']?></td>
                      <td data-label="Thursday"><?=$row['Thursday']?></td>
                      <td data-label="Friday"><?=$row['Friday']?></td>
                      <td data-label="Saturday"><?=$row['Saturday']?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </section>
            <?php
             }
            }?>
          </tbody>
        </table>
      </div>
    </section>
    <section>
      <form action="" method="post">
        <input type="hidden" name="press_button" value='' id="press_button">
        <div class="pagination">
          <button class="link-pagination" onclick="send.call(this, 1116)" name="11/16">11/16</button>
          <button class="link-pagination" onclick="send.call(this, 12)" name="12">12</button>
          <button class="link-pagination" onclick="send.call(this, 13)" name="13">13</button>
          <button class="link-pagination" onclick="send.call(this, 14)" name="14">14</button>
          <button class="link-pagination" onclick="send.call(this, 15)" name="15">15</button>
          <button class="link-pagination" onclick="send.call(this, 21)" name="21">21</button>
          <button class="link-pagination" onclick="send.call(this, 22)" name="22">22</button>
          <button class="link-pagination" onclick="send.call(this, 23)" name="23">23</button>
          <button class="link-pagination" onclick="send.call(this, 24)" name="24">24</button>
          <button class="link-pagination" onclick="send.call(this, 25)" name="25">25</button>
          <button class="link-pagination" onclick="send.call(this, 26)" name="26">26</button>
          <button class="link-pagination" onclick="send.call(this, 31)" name="31">31</button>
          <button class="link-pagination" onclick="send.call(this, 32)" name="32">32</button>
          <button class="link-pagination" onclick="send.call(this, 33)" name="33">33</button>
          <button class="link-pagination" onclick="send.call(this, 34)" name="34">34</button>
          <button class="link-pagination" onclick="send.call(this, 35)" name="35">35</button>
          <button class="link-pagination" onclick="send.call(this, 36)" name="36">36</button>
          <button class="link-pagination" onclick="send.call(this, 41)" name="41">41</button>
          <button class="link-pagination" onclick="send.call(this, 42)" name="42">42</button>
          <button class="link-pagination" onclick="send.call(this, 43)" name="43">43</button>
          <button class="link-pagination" onclick="send.call(this, 44)" name="44">44</button>
          <button class="link-pagination" onclick="send.call(this, 45)" name="45">45</button>
          <button class="link-pagination" onclick="send.call(this, 46)" name="46">46</button>
        </div>
      </form>
      <script>
        function send(press_value){
          this.form['press_button'].value = press_value;
          this.form.submit();
        }
      </script>
    </section>
</section>
