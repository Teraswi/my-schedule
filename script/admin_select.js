const multiSelect = () => {
  const elements = document.querySelectorAll('.admin_select');
  const office = document.querySelectorAll('.admin_select_off');
  elements.forEach(el => {
  const choices = new Choices(el, {
    searchEnabled: true,
    itemSelectText: '',
    shouldSort: true,
    searchResultLimit: 5,
    noResultsText: 'N/A',
  // renderChoiceLimit: 5,
  })
  });
  
  office.forEach (off => {
    const choices_off = new Choices(off, {
      searchEnabled: true,
      itemSelectText: '',
      shouldSort: true,
      searchResultLimit: 5,
      noResultsText: 'N/A',
    })
  })
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
            let offSelectElement = choiceElement.querySelector('.admin_select_off');
            
            if (selectElement && offSelectElement) {
              array_select.push({
                'day': days[colIndex], // Извлекаем день недели по индексу столбца
                'time': time, // Извлекаем время
                'subject': selectElement.value, // Извлекаем выбранный предмет
                'group': '', //Извлекаем группу 
                'office': offSelectElement.value //Извлекаем кабинет
              });
            }
          });
        }
      });

      $.post('block/function/add_schedule.php', {array_select: array_select}, function(data){
          $(".succes").html(data);
          setTimeout("$('.succes-2').css('display', 'none')", 4800);
        });
      return false;
    });

    // Загрузка файла 
   $('.add_file').on('click', function(e) {
    e.preventDefault();
    var form = document.getElementById('uploadForm');
    var formData = new FormData(form);

      $.ajax({
        url: 'block/function/file_schedule.php', // Путь к PHP-скрипту для обработки файла
        type: 'POST',
        data: formData,
        processData: false, // Не обрабатывать данные
        contentType: false, // Не устанавливать тип контента
        success: function (response) {
          console.log("Ответ сервера:", response);
          if (response.success) 
          {
            alert(response.message);
          }
          else
          {
            alert(response.message || "Произошла неизвестная ошибка."); //Ошибка
          }
        },
        error: function (xhr, status, error) {
          alert("Произошла ошибка при загрузке файла.");
        }
      });
    });

  });

  