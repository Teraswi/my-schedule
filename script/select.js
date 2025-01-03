function submitForm() {
  $('.select').submit();
}

const gr = document.querySelector(".js-group");
const choice = new Choices(gr, {
  searchEnabled: false,
  itemSelectText: "",
  shouldSort: false
})

$(function(){
  $('.link-pagination').click(function(){
      $.post('block/shedule/table_ajax.php', {value:$(this).val()}, function(data){
          $("#table_results").html(data);
      });
      return false;
  });
});