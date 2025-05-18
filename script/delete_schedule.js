 const delete__data = document.querySelector('.select__delete');

  const del__sel = new Choices(delete__data, {
  searchEnabled: false,
  itemSelectText: "",
  shouldSort: false,
  noChoicesText: 'N/A',
})

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