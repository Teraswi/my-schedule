<header>
  <div class="logotip">
      <a href="index.php" class="link-main"><i class="logo"></i>
        <span class="name-site">Моё расписание</span></a>
    </div>

    <nav class="navigation">
      <ul class="links">
        <li><a href="index.php?page=changes" class="links-li">Изменения</a></li>
        <li><a href="index.php?page=techer" class="links-li">Преподаватели</a></li>
        <li><a href="index.php?page=students" class="links-li">Студенты</a></li>
        <li><form action="" method="post"><button type="submit" class="exit" name="exit">Выйти</button></form></li>
        <li><i class="sun icon" data-theme="light"></i></li>
        <li><i class="moons icon" data-theme="dark"></i></li>
      </ul>
      <script src="script/theme.js"></script>
    </nav>
  </header>

  <div class="hamburger-menu">
    <input id="menu__toggle" type="checkbox" />
    <label class="menu__btn" for="menu__toggle">
      <span></span>
    </label>
    <ul class="menu__box">
      <li><a href="index.php?page=changes" class="menu__item">Изменения</a></li>
      <li><a href="index.php?page=techer" class="menu__item">Преподаватели</a></li>
      <li><a href="index.php?page=students" class="menu__item">Студенты</a></li>
      <li><form action="" method="post" class="menu__item"><button type="submit" class="exit_mobile" name="exit" >Выйти</button></form></li>
    </ul>
  </div>
  <?php
  if (isset($_POST['exit']))
  {
    session_destroy();
    echo "<script>window.location.href = 'registration.php'</script>";
  }
  ?>