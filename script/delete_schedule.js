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

$(function(){ 
  $('.delete_all_schedule').click(function(){
    var delete_all = true;
    
      $.post('block/function/delete_schedule.php', {delete_all: delete_all}, function(data){
        alert(data)
        location.reload(true);
      });
      return false;
  });
});