
    <h1>Информация о преподавателях</h1>
    <form action="" method="POST">
    <div class="all-button">
      <button class="techer" name="all">Преподавательский состав</button>
      <button class="techer" name="medical">Преподаватели на больничном</button>
      <button class="techer" name="session">Преподаватели на сессии</button>
    </div>
  </form>
    <?php 
      if (isset($_POST["all"])) {
        $techer_all = "SELECT * FROM techer";
        $result = mysqli_query($link, $techer_all);
        $rows = mysqli_num_rows($result);
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
              <td data-label='ФИО Преподавтеля'>{$row["surname"]} {$row["name"]} {$row["patronymic"]}</td>
              <td data-label='Предметы'><span style='word-break: break-all;'>{$row["items"]}</span></td>
            </tr>";
        }
        echo "</tbody>
        </table>";
      }
      if (isset($_POST["medical"]))
      {
        $techer_medical = "SELECT `surname`,`name`, `patronymic`, `medical`, `exit_medical` FROM techer WHERE `medical` IS NOT NULL";
        $result = mysqli_query($link, $techer_medical);
        $rows = mysqli_num_rows($result);
        echo "<table class='media__table'>
        <thead>
            <tr>
              <th>ФИО Преподавтеля</th>
              <th>На больничном...</th>
              <th>Выход с больничного...</th>
              </tr>
          </thead>
          <tbody>";
        for ($i = 0; $i < $rows; $i++) {
          $row = mysqli_fetch_assoc($result);
          echo "
            <tr>
              <td data-label='ФИО Преподавтеля'>{$row["surname"]} {$row["name"]} {$row["patronymic"]}</td>
              <td data-label='На больничном...'>{$row["medical"]}</td>
              <td data-label='Выход с больничного...' style='height: 13px;'>{$row["exit_medical"]}</td>
            </tr>";
        }
        echo "</tbody>
        </table>";
      }

      if (isset($_POST["session"]))
      {
        $techer_session = "SELECT `surname`,`name`, `patronymic`, `session`, `exit_session` FROM techer WHERE `session` IS NOT NULL";
        $result = mysqli_query($link, $techer_session);
        $rows = mysqli_num_rows($result);
        echo "<table class='media__table'>
        <thead>
            <tr>
              <th>ФИО Преподавтеля</th>
              <th>Сессия с...</th>
              <th>До...</th>
            </tr>
          </thead>
          <tbody>";
        for ($i = 0; $i < $rows; $i++) {
          $row = mysqli_fetch_assoc($result);
          echo "
            <tr>
              <td data-label='ФИО Преподавтеля'>{$row["surname"]} {$row["name"]} {$row["patronymic"]}</td>
              <td data-label='Сессия с...'>{$row["session"]}</td>
              <td data-label='До...'>{$row["exit_session"]}</td>
            </tr>";
        }
        echo "</tbody>
        </table>";
      }
      
      elseif (empty($_POST)){
        $all = "SELECT * FROM techer";
        $result = mysqli_query($link, $all);
        $rows = mysqli_num_rows($result);
        echo "<table class='media__table'>
        <thead>
            <tr>
              <th>ФИО Преподавтеля</th>
              <th>Предметы</th>
            </tr>
          </thead>
          <tbody>";
        for ($i = 0; $i < $rows; $i++) {
          $row = mysqli_fetch_assoc($result);
          echo "
            <tr>
              <td data-label='ФИО Преподавтеля'>{$row["surname"]} {$row["name"]} {$row["patronymic"]}</td>
              <td data-label='Предметы'>{$row["items"]}</td>
            </tr>";
        }
        echo "</tbody>
        </table>";
      }
    ?>