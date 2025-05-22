array_select = []
  $(function() {
    $('.admin_up').on('click', function() {
      let array_select = [];
      
      // Получаем все строки таблицы (исключая заголовок)
      let rows = document.querySelectorAll('#schedule_up tbody tr');
      
      // Получаем дни недели из заголовка таблицы (начиная со второго столбца)
      let days = Array.from(document.querySelectorAll('#schedule_up thead th')).slice(1).map(th => th.textContent.trim());

      rows.forEach((row, rowIndex) => {
        // Находим элемент времени в текущей строке
        let timeElement = row.querySelector('.time');
        
        if (timeElement) {
          let time = timeElement.textContent.trim();
          // Проходим по всем ячейкам строки (исключая первую ячейку с временем)
          let choiceElements = Array.from(row.querySelectorAll('.choice_admin'));
          
          choiceElements.forEach((choiceElement, colIndex) => {
            let selectElement = choiceElement.querySelector('.admin_select');
            let offSelectElement = choiceElement.querySelector('.admin_select_off');
            let input_id = choiceElement.querySelector('.hid');
            
            if (selectElement && offSelectElement) {
              array_select.push({
                'day': days[colIndex], // Извлекаем день недели по индексу столбца
                'time': time, // Извлекаем время
                'subject': selectElement.value, // Извлекаем выбранный предмет
                'group': '', //Извлекаем группу 
                'office': offSelectElement.value, //Извлекаем кабинет
                'id': input_id.value
              });
            }
          });
        }
      });

      $.post('block/function/update_schedule.php', {array_select: array_select}, function(data){
          $(".succes").html(data);
          setTimeout("$('.succes-2').css('display', 'none')", 4800);
        });

      return false;
    });
  });