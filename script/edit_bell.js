var time = 5000;
var fightBtn = $('.edit_add');
var fightCheck = true;
var input1 = document.querySelectorAll('.bell');
var array_bell = []


$('.edit_add').on('click', (e) => {
  if (fightCheck == true) {
    e.preventDefault();
    input1.forEach(element => {
      array_bell.push(element.value)}
    )
    $.ajax({
      url: 'block/function/add__bell.php',
      method: 'post',
      dataType: 'html',
      data: {bell : JSON.stringify(array_bell)},
      success: function(data){
        $('.succes-2').css('display', 'block');
        setTimeout("$('.succes-2').css('display', 'none')", 5000);
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        console.log(errorThrown);
      }
    });
    fightCheck = false;
    array_bell = [];
    timeOut();
  }
  else {
    e.preventDefault();
  }
})

function timeOut() {
  setTimeout(function() {
    fightCheck = true;
}, time)
}

