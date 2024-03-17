<header>
    <div class="logotip">
      <a href="#" class="link-main"><i class="logo"></i>
        <span class="name-site">Моё расписание</span></a>
    </div>
    <nav class="navigation">
      <ul class="links">
        <li><a href="index.php?page=changes" class="links-li">Изменения</a></li>
        <li><a href="#" class="links-li">Преподаватели</a></li>
        <li><a href="#" class="links-li">Студенты</a></li>
        <li><form action="" method="post"><button type="submit" class="exit" name="exit">Выйти</button></form></li>
        <li><i class="sun icon" data-theme="light"></i></li>
        <li><i class="moons icon" data-theme="dark"></i></li>
      </ul>
      <script src="script/theme.js"></script>
    </nav>
    <i class="sun-2 icon-2" data-theme="light"></i>
    <i class="moons-2 icon-2" data-theme="dark"></i>
    <script src="script/theme-2.js"></script>
    <div class="bx bx-menu" id="menu-icon">
    </div>
  </header>
  <?php
  if (isset($_POST['exit']))
  {
    session_destroy();
    header("location:registration.php");
  }
  ?>