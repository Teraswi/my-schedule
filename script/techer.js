const techer = document.querySelector(".techer_select");
const choice_techer = new Choices(techer, {
  searchEnabled: false,
  itemSelectText: "",
  shouldSort: false
})


$(function(){ //Для страницы перподаватели
  $('.techer').click(function(){
    var btnvalue = $(this).val();
    
      $.post('block/function/techer_ajax.php', {techer_value: btnvalue}, function(data){
        $(".techer_results").html(data);
      });

      return false;
  });
});

$(function(){ //Для страницы перподаватели select
  $('.techer_select').on('change', function(evt, params){
    var btnval_sel = $(this).val();
    
      $.post('block/function/techer_ajax.php', {techer_value: btnval_sel}, function(data){
        $(".techer_results").html(data);
      });

      return false;
  });
});


