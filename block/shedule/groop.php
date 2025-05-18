<div class="modal fade" id="groop" tabindex="-1" aria-labelledby="groop" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="groop">Выберите из выпадающего списка, что хотите сделать</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
      <form action="" method="post" class="select">
        <select class="groop_admin_select" name="groups">
          <option value=""></option>
          <option value="create">Добавить номер группу</option>
          <option value="edit">Редактировать номер группы</option>
          <option value="delete">Удалить номер группы</option>
        </select>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
          <button type="button" class="btn btn-primary delete_gr" name="delete__gr">Удалить расписание</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<script>
$(function(){ 
  $('.delete_gr').click(function(){
    var select = document.querySelector('.select__delete'); 
    var selectvalue = select.value;
    
      $.post('block/function/delete_schedule.php', {value: selectvalue}, function(data){
        location.reload(true);
      });
      return false;
  });
});

</script>