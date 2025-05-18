<div class="modal fade" id="delete_schedule" tabindex="-1" aria-labelledby="delete_schedule" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="delete_schedule">Выберите группу, для которой хотите удалить расписание</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
      <form action="" method="post" class="select">
        <select class="select__delete" name="groups">
        <?php
            $sch_gr = "SELECT DISTINCT `g`.`name` AS `groups` FROM schedule INNER JOIN `groups` `g` ON `g`.`id_group` = `schedule`.`id_group`";
            $query_sch = mysqli_query($link, $sch_gr) or die(mysqli_error());
            $rows= mysqli_num_rows($query_sch);
            if ($rows != 0)
            {
              for ($i = 0; $i < $rows; $i++) 
              {
                $row = mysqli_fetch_row($query_sch);
                echo "<option value='" . $row[0] . "'>" .$row[0] . "</option>";
              }
            }
            ?>
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