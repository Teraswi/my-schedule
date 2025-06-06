$(document).ready(function() {
  // Восстанавливаем значение, если оно сохранено
  if (localStorage.getItem('selectVal')) {
    var savedValue = localStorage.getItem('selectVal');
    $('.change_group').val(savedValue); // Устанавливаем сохранённое значение //
  }
});
const gr_st = document.querySelector(".change_group");
const choice_student = new Choices(gr_st, {
  searchEnabled: false,
  itemSelectText: "",
  shouldSort: false
})
let savedValue_st = localStorage.getItem('selectVal_st'); // Получаем сохранённое значение
  if (savedValue_st) {
    choice_student.setChoiceByValue(savedValue_st); // Выбираем сохранённый вариант
  }
  // Сохраняем выбранное значение при изменении
  gr_st.addEventListener('change', function() {
      localStorage.setItem('selectVal_st', gr_st.value);
  });

$(function(){ //Для выпадающего списка
  $('.change_group').on('change', function(evt, params){

    var selectedVal_st = $(this).val(); // Получаем выбранное значение
    var title_student = document.querySelector(".title_students")

    localStorage.setItem('selectVal_st', selectedVal_st);

      $.post('block/function/students_ajax.php', {students_value: selectedVal_st}, function(data){
          $(".responsive-table").html(data);
        });

      title_student.innerHTML = "Список студентов " + selectedVal_st + " группы"
      return false;
  });
});

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

 $('.add_file_students').on('click', function(e) {
    e.preventDefault();
    var form = document.getElementById('uploadForm_students');
    var formData = new FormData(form);

      $.ajax({
        url: 'block/function/file_students.php', // Путь к PHP-скрипту для обработки файла
        type: 'POST',
        data: formData,
        dataType: 'html',
        processData: false, // Не обрабатывать данные
        contentType: false, // Не устанавливать тип контента
        success: function (response) {
            console.log(response)
        },
        error: function (xhr, status, error) {
            console.error('Ошибка при отправке данных:', error);
            alert('Произошла ошибка при отправке данных на сервер.');
        }
      });
    });