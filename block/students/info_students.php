
<h1>Список студентов</h1>
<form action="" method="post">
        <input type="hidden" name="press" value='' id="press">
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
          this.form['press'].value = press_value;
          this.form.submit();
        }
      </script>

    <?php 
       $input = null;
       if (isset($_POST['press']))
       {
        $_SESSION['groups_info'] = $_POST['press'];
       }
       if (isset($_SESSION['groups_info'])) {
        if (isset($_POST['data'])) {
          $qeury = "SELECT `surname`, `name`, `patronymic` FROM `students` WHERE `groups` = '$_SESSION[groups_info]' ORDER BY `date_receipts`";
          $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
          $rows=mysqli_num_rows($result);
        }
        else
        {
          $qeury = "SELECT `surname`, `name`, `patronymic` FROM `students` WHERE `groups` = '$_SESSION[groups_info]' ORDER BY `surname`";
          $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
          $rows=mysqli_num_rows($result);}
    ?>
     <section class="table">
      <div class="responsive-table">
        <table class="students">
          <thead>
            <tr>
              <th>№</th>
              <th>ФИО Студента</th>
            </tr>
          </thead>
          <tbody>
          <?php
              for ($i=1; $i<$rows+1; $i++)
              {
                $row = mysqli_fetch_assoc($result);
            ?>
                <tr>
                  <td><?=$i?></td>
                  <td><?php echo "$row[surname] $row[name] $row[patronymic]"?></td>
                </tr>
          <?php
              } 
            } 
            else {
              $qeury = "SELECT `surname`, `name`, `patronymic` FROM `students` WHERE `groups` = '1116' ORDER BY `surname`";
              $result = mysqli_query($link, $qeury) or die("Невозможно выполнить запрос");
              $rows=mysqli_num_rows($result);
            ?>
            <div class="responsive-table">
                <table class="students">
                  <thead>
                    <tr>
                      <th>№</th>
                      <th>ФИО Студента</th>
                    </tr>
                 </thead>
                  <tbody>
                  <?php
              for ($j=1; $j<$rows+1; $j++)
              {
                $row_2 = mysqli_fetch_assoc($result);
              ?>
                <tr>
                  <td><?=$j?></td>
                  <td><?php echo "$row_2[surname] $row_2[name] $row_2[patronymic]"?></td>
                </tr>
                
                <?php } }?>
                 </tbody>
                </table>
            </table>
          <aside>
            <span class="sort">Сортировка по</span>
            <form action="" method="post" name="sort">
              <button name="abc" class="btn_sort">По алфавиту</button><br>
              <button name="data" class="btn_sort_data">По дате</button>
            </form>
          </aside>
        </div>
      </section>
            
  