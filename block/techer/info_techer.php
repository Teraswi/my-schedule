<h1>Информация о преподавателях</h1>
  <form action="" method="POST">
    <div class="all-button">
      <button class="techer" name="all" value="all">Преподавательский состав</button>
      <button class="techer" name="medical" value="medical">Преподаватели на больничном</button>
      <button class="techer" name="session" value="session">Преподаватели на сессии</button>
    </div>
    <div class="select__techer">
    <select name="groups" class="techer_select">
        <option value="all">Преподавательский состав</option>
        <option value="medical">Преподаватели на больничном</option>
        <option value="session">Преподаватели на сессии</option>
    </select>
    </div>
  </form>
  <section class='techer_results'>
    <?php 
        $all = "SELECT * FROM `techer`";
        $result = mysqli_query($link, $all);
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
        echo "<table class='media__table'>
        <thead>
            <tr>
              <th>ФИО Преподавателя</th>
              <th>Предметы</th>
            </tr>
          </thead>
          <tbody>";
        for ($i = 0; $i < $rows; $i++) {
          $row = mysqli_fetch_assoc($result);
          echo "
            <tr>
              <td data-label='ФИО Преподавтеля'>{$row["Surname"]} {$row["Name"]} {$row["Patronymic"]}</td>
              <td data-label='Предметы'>{$row["items"]}</td>
            </tr>";
        }
        echo "</tbody>
        </table>";
      }
      else echo "<h1 class = 'empty_data'>На данный момент информация о преподавателях не заполнена</h1>";
    ?>
    <div class="button_center">
       <form method="post">
            <button formaction="index.php?page=edit_teacher_info" class="btn_edit">Редактировать</button>
        </form>
    </div>
    </section>
    