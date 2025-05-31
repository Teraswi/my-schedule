 const delete__ch = document.querySelector('.select__delete_ch');

  const del__ch = new Choices(delete__ch, {
  searchEnabled: false,
  itemSelectText: "",
  shouldSort: false,
  noChoicesText: 'N/A',
})

$(function(){ 
  $('.delete_changes').click(function(){
    var select = document.querySelector('.select__delete_ch'); 
    var selectvalue = select.value;
    console.log(selectvalue)
      $.post('block/function/delete_changes.php', {delete_ch: selectvalue}, function(data){
        alert('Изменения успешно удалены')
        location.reload(true);
      });
      return false;
  });
});