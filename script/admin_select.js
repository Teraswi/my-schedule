const multiSelect = () => {
  const elements = document.querySelectorAll('.admin_select');
  elements.forEach(el => {
  const choices = new Choices(el, {
  searchEnabled: true,
  itemSelectText: '',
  shouldSort: true,
  searchResultLimit: 5,
  noResultsText: 'Предмет не найден ',
  // renderChoiceLimit: 5,
  })
  });
  };
  
  multiSelect();

  array_select = []
  $(function() {
    $('.admin_add').on('click', function() {
      let array_select = [];
      
      // Получаем все строки таблицы (исключая заголовок)
      let rows = document.querySelectorAll('#schedule tbody tr');
      
      // Получаем дни недели из заголовка таблицы (начиная со второго столбца)
      let days = Array.from(document.querySelectorAll('#schedule thead th')).slice(1).map(th => th.textContent.trim());

      rows.forEach((row, rowIndex) => {
        // Находим элемент времени в текущей строке
        let timeElement = row.querySelector('.time');
        
        if (timeElement) {
          let time = timeElement.textContent.trim();
          
          // Проходим по всем ячейкам строки (исключая первую ячейку с временем)
          let choiceElements = Array.from(row.querySelectorAll('.choice_admin'));
          
          choiceElements.forEach((choiceElement, colIndex) => {
            let selectElement = choiceElement.querySelector('.admin_select');
            
            if (selectElement) {
              array_select.push({
                'day': days[colIndex], // Извлекаем день недели по индексу столбца
                'time': time, // Извлекаем время
                'subject': selectElement.value // Извлекаем выбранный предмет
              });
            }
          });
        }
      });

      $.post('block/function/add_schedule.php', {array_select: array_select}, function(data){
          $("#cl").html(data);
        });

      console.log(array_select);
      return false;
    });
  });
  