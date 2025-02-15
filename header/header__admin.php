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
        <li class='ico'><i class="sun icon" data-theme="light"></i></li>
        <li class='ico'><i class="moons icon" data-theme="dark"></i></li>
      </ul>
      <script src="script/theme.js"></script>
    </nav>
  </header>

  <div class="hamburger-menu-admin">
    <input id="menu__toggle" type="checkbox" />
    <label class="menu__btn" for="menu__toggle">
      <span></span>
    </label>
    <ul class="menu__box">
      <li class="menu__item"><a href="index.php?page=add_schedule" class="links-li">Добавить расписание</a></li>
      <li class="menu__item"><a href="index.php?page=update_schedule" class="links-li">Редактировать расписание</a></li>
      <li class="menu__item"><a href="" class="links-li">Удалить расписание</a></li>
      <li class="menu__item"><a href="" class="links-li">Удалить расписание всех групп</a></li>
      <li class="menu__item"><a href="index.php?page=edit_bell" class="links-li">Изменить расписание звонков</a></li>
      <li><a href="index.php?page=changes" class="menu__item__mobile links-li">Изменения</a></li>
      <li><a href="index.php?page=techer" class="menu__item__mobile links-li">Преподаватели</a></li>
      <li><a href="index.php?page=students" class="menu__item__mobile links-li">Студенты</a></li>
      <li><form action="" method="post" class="menu__item__mobile links-li"><button type="submit" class="exit_mobile" name="exit" >Выйти</button></form></li>
    </ul>
  </div>
  <?php
  if (isset($_POST['exit']))
  {
    session_destroy();
    header('Location: registration.php');
  }
  ?>