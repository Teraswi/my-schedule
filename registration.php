<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Моё расписание</title>
  <link rel="stylesheet" type="text/css" href="style/normalize.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />

  <link rel="stylesheet" type="text/css" href="style/registration.css">
  <link title="theme" rel="stylesheet" href="#">
  <link rel="shortcut icon" href="img/logo-icon.svg" type="image/svg+xml">
</head>

<body>
  <main>
    <section>
  <div class="registration">
    <div class="logo_and_name">
      <span class="logo"></span>
      <span class="name">Моё расписание</span>
    </div>

    <p class="text_choice">Выберите, кем вы хотите войти</p>
    <form action="registration.php" method='post'>
      <select class="js-choice" name="choice">
        <option name='Student' value="Student">Студент</option>
        <option name='Teacher' value="Teacher">Преподаватель</option>
        <option name='Admin_Dispatcher' value="Admin_Dispatcher">Администратор/Диспетчер</option>
      </select>

    <button type="submit" class="further">Дальше</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>

  <script src="script/choice.js"></script>
  <script src="script/theme.js"></script>
  </section>
  </main>
  <?php
  if (isset( $_POST['choice']))
    {
      $selectOption = $_POST['choice'];
      if ($selectOption == 'Student')
        {
          $_SESSION['user'] = 'Student';
          header("location:index.php");
        }
      elseif ($selectOption == 'Teacher')
        {
          header("location:authorization__techer.php");
        }
      elseif ($selectOption == 'Admin_Dispatcher')
        {
          header("location:authorization__admin_disp.php");
        }
    }
  ?>
</body>

</html>