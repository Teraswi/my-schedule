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
  function updateStudentList(group = null, sort = null) {
    var title_student = document.querySelector(".title_students");
    var dataToSend = {};

    // Если выбрана группа, обновляем переменную
    if (group !== null) {
      dataToSend.students_value = group;
      title_student.innerHTML = "Список студентов " + group + " группы";
    } else {
      dataToSend.students_value = $('.group-pagination.active').val() || $('.group-pagination:checked').val();
    }

    // Если выбрана сортировка, добавляем в объект
    if (sort !== null) {
      dataToSend.sort_value = sort;
    } else {
      dataToSend.sort_value = $('.btn_sort.active').val() || $('.btn_sort:checked').val();
    }

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
});