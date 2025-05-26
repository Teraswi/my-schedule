<div class="modal fade" id="add_schedule_file" tabindex="-1" aria-labelledby="add_schedule_file" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="add_schedule_file">Выберите группу, для которой хотите удалить расписание</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
      <form  method="post" id="uploadForm" enctype="multipart/form-data">
        <div class="file">
          <input class="form-control form-control-lg" id="formFileLg" type="file" name="file" accept=".xlsx, .xls" required>
        </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Закрыть</button>
          <button type="button" class="btn btn-primary add_file" name="add_file">Загрузить</button>
        </div>
      </form>
    </div>
  </div>
</div> 