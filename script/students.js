$(document).ready(function () {
  let currentGroup = null; // Переменная для хранения текущей выбранной группы

  function updateStudentList(group = null, sort = null) {
    var title_student = document.querySelector(".title_students");
    var dataToSend = {};

    // Если группа передана явно, обновляем переменную
    if (group !== null) {
      currentGroup = group; // Сохраняем текущую группу
    }

    // Если текущая группа не определена, пытаемся получить её из DOM
    if (currentGroup === null) {
      currentGroup = $('.group-pagination.active').val() || $('.group-pagination:checked').val();
    }

    // Устанавливаем заголовок для текущей группы
    title_student.innerHTML = "Список студентов " + currentGroup + " группы";

    // Добавляем выбранную группу в объект данных
    dataToSend.students_value = currentGroup;

    // Если выбрана сортировка, добавляем её в объект данных
    if (sort !== null) {
      dataToSend.sort_value = sort;
    } else {
      dataToSend.sort_value = $('.btn_sort.active').val() || $('.btn_sort:checked').val();
    }

    // Отправляем запрос на сервер
    $.post('block/function/students_ajax.php', dataToSend, function (data) {
      $(".responsive-table").html(data);
    });
  }

  // При клике на группу студентов
  $(document).on('click', '.group-pagination', function () {
    var group = $(this).val();
    updateStudentList(group, null); // Передаём только группу
    return false;
  });

  // При клике на сортировку
  $(document).on('click', '.btn_sort', function () {
    var sort = $(this).val();
    updateStudentList(null, sort); // Передаём только сортировку
    return false;
  });

  // Инициализация текущей группы при загрузке страницы
  const initialGroup = $('.group-pagination.active').val() || $('.group-pagination:checked').val();
  if (initialGroup) {
    currentGroup = initialGroup; // Устанавливаем начальную группу
    updateStudentList(currentGroup, null); // Обновляем список студентов
  }
});