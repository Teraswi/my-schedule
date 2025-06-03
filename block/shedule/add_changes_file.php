<div class="modal fade" id="add_changes_file" tabindex="-1" aria-labelledby="add_changes_file" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="add_changes_file">Выберите excel фалй с изменениями в расписании</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
      <form  method="post" id="uploadForm_changes" enctype="multipart/form-data">
        <div class="file">
          <input class="form-control form-control-lg" id="formFileLg" type="file" name="file" accept=".xlsx, .xls" required>
        </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Закрыть</button>
          <button type="button" class="btn btn-primary add_file_changes" name="add_file">Загрузить</button>
        </div>
      </form>
    </div>
  </div>
</div> 