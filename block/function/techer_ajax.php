<?php
session_start();
require_once '../../login/login.php';
$link=mysqli_connect("$hn","$un","$pw","$db") or die ('Невозможно запустить mysql');
if (isset($_POST['techer_value']))
 {
  if ($_POST["techer_value"] == 'all') 
    {
      $techer_all = "SELECT * FROM techer";
      $result = mysqli_query($link, $techer_all);
      $rows = mysqli_num_rows($result);
      if ($rows > 0)
        {
          echo "
            <table class='media__table'>
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
                  <td data-label='ФИО Преподавателя'>{$row["surname"]} {$row["name"]} {$row["patronymic"]}</td>
                  <td data-label='Предметы'><span style='word-break: break-all;'>{$row["items"]}</span></td>
                </tr>";
            }
            echo "</tbody>
            </table>";
          }
        else echo "На данный момент информация о преподавателях не заполнена";
    }

  if ($_POST["techer_value"] == 'medical')
    {
        $techer_medical = "SELECT `surname`,`name`, `patronymic`, `medical`, `exit_medical` FROM techer WHERE `medical` IS NOT NULL";
        $result = mysqli_query($link, $techer_medical);
        $rows = mysqli_num_rows($result);
        if ($rows>0)
          {
          echo "<table class='media__table'>
          <thead>
              <tr>
                <th>ФИО Преподавателя</th>
                <th>На больничном...</th>
                <th>Выход с больничного...</th>
                </tr>
            </thead>
            <tbody>";
          for ($i = 0; $i < $rows; $i++) {
            $row = mysqli_fetch_assoc($result);
            echo "
              <tr>
                <td data-label='ФИО Преподавателя'>{$row["surname"]} {$row["name"]} {$row["patronymic"]}</td>
                <td data-label='На больничном...'>{$row["medical"]}</td>
                <td data-label='Выход с больничного...' style='height: 13px;'>{$row["exit_medical"]}</td>
              </tr>";
          }
          echo "</tbody>
          </table>";
        }
        else echo "На данный момент преподаватели на больничном отсуствуют";
    }
  if ($_POST["techer_value"] == 'session')
  {
      $techer_session = "SELECT `surname`,`name`, `patronymic`, `session`, `exit_session` FROM techer WHERE `session` IS NOT NULL";
      $result = mysqli_query($link, $techer_session);
      $rows = mysqli_num_rows($result);
      if ($rows>0)
        {
          echo "<table class='media__table'>
          <thead>
              <tr>
                <th>ФИО Преподавателя</th>
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
    else echo "<h1 class ='empty_data'>Список данной группы пока не заполнен</h1>";
  } 
}
?>