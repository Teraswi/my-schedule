<section>
  <form action="" method="post">
      <div class="manipulations_table">
        <button class="add" value="add" type="submit" >Добавить расписание</button>
        <button class="edit" value="edit" type="submit" >Редактировать расписание</button>
        <button class="delete" value="delete" type="submit" >Удалить расписание</button>
        <button class="delete_all" value="delete_all" type="submit" >Удалить расписание всех групп</button>
        <button class="edit_bell" value="edit_bell">Изменить расписание звонков</button>
      </div>  
    </form>
</section>
<script>
  var edit_bell = document.querySelector('.edit_bell');
  edit_bell.addEventListener('click', (e) => {
    e.preventDefault();
    window.location.href = 'index.php?page=edit_bell';
  })
</script>