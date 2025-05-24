
const groop_admin = document.querySelector("#groop_admin_select");
const groop_admin_choices = new Choices(groop_admin, {
  searchEnabled: false,
  itemSelectText: "",
  shouldSort: false
})
$(function(){ 
  let choicesInstance;
  $('.groop_admin_select').on('change', function(evt, params){
    const inputContainer = document.querySelector('.input__data');
    var input = document.querySelector('.input__groop');
    var input_edit = document.querySelector('.input__groop_edit');
    var input_save = document.querySelector('.save-button');

    
    function createInputElement(placeholderText, className, name) 
    {
      const newInput = document.createElement('input');
      newInput.type = 'text';
      newInput.placeholder = placeholderText;
      newInput.classList.add(className); // Добавляем класс для стилизации
      newInput.name = name; // Устанавливаем имя для отправки данных
      newInput.required = true; 
      inputContainer.appendChild(newInput); // Добавляем созданный input в контейнер
      input_save.classList.remove('none'); // Показываем кнопку
    }

    // Обработчик изменения значения в выпадающем списке
    const selectedVal = this.value;

    // Очищаем контейнер перед добавлением нового элемента
    inputContainer.innerHTML = '';

    // Выполняем действие в зависимости от выбранного значения
  if (selectedVal === 'create') {
      createInputElement('Введите номер новой группы', 'input__groop', 'group_number');
    } else if (selectedVal === 'edit') {
      createInputElement('Введите интересующую группу', 'input__groop', 'group_number');
      createInputElement('Введите новый номер группы', 'input__groop_edit', 'group_number_edit');
    } else if (selectedVal === 'delete') {
      createInputElement('Введите номер группы для удаления', 'input__groop', 'group_number');
    } else {
      input_save.classList.add('none'); // Скрываем кнопку, если выбрано пустое значение
    }
  
  });
  
  // Отправка данных при нажатии на кнопку
  $('.save-button').on('click', function () {
      const inputs = document.querySelectorAll('.input__data input'); // Получаем все созданные input'ы
      const selectElement = document.querySelector('.groop_admin_select');
      let array_input = [];
      let array_select = [];
      let isValid = true; // Флаг для проверки валидности всех полей

      array_select.push({ name: 'select', value_select: selectElement.value });
      // Собираем данные из всех input'ов и проверяем их на валидность
      inputs.forEach(input => {
        if (!input.checkValidity()) {
          isValid = false; // Если хотя бы одно поле не прошло валидацию
        }
        if (input.value.trim() !== '') {
          array_input.push({ name: input.name, value: input.value });
        }
      });
  
      // Если все поля валидны, отправляем данные на сервер
      if (isValid) {
        $.post('block/function/groop__data.php', { array_groop: array_input, array_select: array_select }, function (response) {

          if (response.success) 
          {
            alert(response.message);

            // Очищаем контейнер и скрываем кнопку после отправки
            document.querySelector('.input__data').innerHTML = '';
            document.querySelector('.save-button').classList.add('none');

            // Сбрасываем значение выпадающего списка на пустое
            groop_admin_choices.setChoiceByValue('');

            // Обновляем страницу
            location.reload(true);
          }
          else
          {
            alert(response.message); //Ошибка
          }
        });
      } else {
        alert('Пожалуйста, заполните все обязательные поля.'); // Показываем сообщение об ошибке
      }
    });
});
