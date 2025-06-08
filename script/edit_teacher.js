document.addEventListener('DOMContentLoaded', function () {
  const table = document.getElementById('teacherTable');
  const tbody = table.querySelector('tbody');
  // Скрытый input для хранения выбранного значения
  const hiddenInput = document.getElementById('selected_group');

  // Кнопки и выпадающий список
  const buttons = document.querySelectorAll('.techer');
  const select = document.querySelector('.techer_select');

  // Обработка выбора через кнопки
  buttons.forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault(); // Предотвращаем отправку формы
      hiddenInput.value = this.value; // Устанавливаем значение в скрытое поле
    });
  });

  // Обработка выбора через выпадающий список
  select.addEventListener('change', function () {
    hiddenInput.value = this.value; // Устанавливаем значение в скрытое поле
  });
  // Функция для добавления новой строки
  document.getElementById('addRowBtn_teacher').addEventListener('click', function () {
    const newRow = document.createElement('tr');

    // Создаем ячейку для ФИО
    const nameCell = document.createElement('td');
    const nameInput = document.createElement('input');
    nameInput.setAttribute('type', 'text');
    nameInput.setAttribute('placeholder', 'Введите ФИО');
    nameInput.classList.add('teacher_edit_input', 'name');
    nameCell.appendChild(nameInput);

    // Создаем ячейку для предметов
    const itemsCell = document.createElement('td');
    const itemsInput = document.createElement('textarea');
    itemsInput.setAttribute('placeholder', 'Введите предметы');
    itemsInput.classList.add('textarea_edit');
    itemsCell.appendChild(itemsInput);

    //Создаем ячеку для прикрепления групп
    const groupsCell = document.createElement('td');
    const groupsInput = document.createElement('input');
    groupsInput.setAttribute('type', 'text');
    groupsInput.setAttribute('placeholder', 'Введите группы');
    groupsInput.classList.add('teacher_edit_input', 'groups');
    groupsCell.appendChild(groupsInput);

    // Добавляем ячейки в строку
    newRow.appendChild(nameCell);
    newRow.appendChild(itemsCell);
    newRow.appendChild(groupsCell);

    // Добавляем строку в таблицу
    tbody.appendChild(newRow);
  });

  // Функция для удаления последней строки
  document.getElementById('removeRowBtn_teacher').addEventListener('click', function () {
    const rows = tbody.querySelectorAll('tr');

    if (rows.length === 0) {
        alert('Нет строк для удаления.');
        return;
    }

    const lastRow = rows[rows.length - 1];

    if (lastRow.hasAttribute('data-original')) {
        alert('Нельзя удалить строки, загруженные из базы данных.');
    } else {
        tbody.removeChild(lastRow);
    }
  }); 


document.getElementById('submitDataBtn_teacher').addEventListener('click', function () {
    const rows = tbody.querySelectorAll('tr');
    const dataToSend = [];

    rows.forEach(row => {
      const nameInput = row.querySelector('.name');
      const itemsInput = row.querySelector('.textarea_edit');
      const groupsInput = row.querySelector('.groups');
      const id = row.dataset.id || null;
      // Проверяем, что все поля заполнены
      if (nameInput && itemsInput && groupsInput) {
        const name = nameInput.value.trim();
        const items = itemsInput.value.trim();
        const groups = groupsInput.value.trim();

        if (name || items || groups) {
          dataToSend.push({
            id: id,
            name: name,
            items: items,
            groups: groups,
          });
        }
      }
    });

    if (dataToSend.length === 0) {
      alert('Нет данных для отправки.');
      return;
    }

    // Добавляем значение из скрытого поля к данным
    const selectedGroup = hiddenInput.value;
    console.log(dataToSend)
    // Отправляем данные через AJAX
    $.ajax({
      url: 'block/function/edit_teacher.php', // URL, куда отправляются данные
      method: 'POST',
      data: { 
        teachers: dataToSend,
        selected_group: selectedGroup // Добавляем выбранное значение
      },
      dataType: 'html',
      success: function (response) {
        console.log(dataToSend)
        $('.tech').html(response);
        // alert('Данные успешно отправлены!');
      },
      error: function (xhr, status, error) {
        alert('Ошибка при отправке данных.');
        console.error(error); // Логируем ошибку
      },
    });


  });
});
