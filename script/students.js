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

$(function(){ 
  function updateStudentList() {
    var btnvalue_st = $('.group-pagination:focus').val();
    var sortValue = $('.btn_sort:focus').val() ;
    var title_student = document.querySelector(".title_students")

    var dataToSend = {};

    if (btnvalue_st !== undefined) {
      dataToSend.students_value = btnvalue_st;
      title_student.innerHTML = "Список студентов "+ btnvalue_st +" группы"
    }
    
    if (sortValue !== undefined) {
      dataToSend.sort_value = sortValue;
    }

    $.post('block/function/students_ajax.php', dataToSend, function(data){
      $(".responsive-table").html(data);
    });
    
  }

  // При клике на группу студентов
  $('.group-pagination').click(function(){
    updateStudentList(); // Вызываем обновление
    return false;
  });

  // При клике на сортировку
  $('.btn_sort').click(function(){
    updateStudentList(); // Вызываем обновление
    return false;
  });
});