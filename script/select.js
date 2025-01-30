$(document).ready(function() {
  // Восстанавливаем значение, если оно сохранено
  if (localStorage.getItem('selectVal')) {
    var savedValue = localStorage.getItem('selectVal');
    $('.js-group').val(savedValue); // Устанавливаем сохранённое значение //
  }
});

const gr = document.querySelector(".js-group");
const choice = new Choices(gr, {
  searchEnabled: false,
  itemSelectText: "",
  shouldSort: false
})

let savedValue = localStorage.getItem('selectVal'); // Получаем сохранённое значение
  if (savedValue) {
      choice.setChoiceByValue(savedValue); // Выбираем сохранённый вариант
  }
  // Сохраняем выбранное значение при изменении
  gr.addEventListener('change', function() {
      localStorage.setItem('selectVal', gr.value);
  });

$(function(){ //Для кнопок
  $('.link-pagination').click(function(){
    var btnvalue = $(this).val();
    
      $.post('block/function/table_ajax.php', {value: btnvalue}, function(data){
          $("#table_results").html(data);
      });

      return false;
  });
});

var title_mobile = document.querySelector(".mobile");

$(function(){ //Для выпадающего списка
  $('.js-group').on('change', function(evt, params){

    var selectedVal = $(this).val(); // Получаем выбранное значение
    localStorage.setItem('selectVal', selectedVal);

      $.post('block/function/table_ajax.php', {value: selectedVal}, function(data){
          $("#table_results_mobile").html(data);
        });

      title_mobile.innerHTML = "Основное расписание " + selectedVal + " группы"
      return false;
  });
});

$('.exit_mobile').on('click', (e) => { localStorage.removeItem('selectVal') }); // Очищения localStorage при нажатии кнопки выйти


