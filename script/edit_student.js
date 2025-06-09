document.addEventListener('DOMContentLoaded', function () {
  const tableBody = document.querySelector('#studentEditTable tbody');
  const addRowBtn = document.getElementById('addRowBtn');
  const saveChangesBtn = document.getElementById('saveChangesBtn');
  const table = document.querySelector('.student_edit')
  const groopName = table.getAttribute('data-groop')
  
  // Функция для обновления нумерации строк
  function updateRowNumbers() {
    const rows = tableBody.querySelectorAll('tr');
    rows.forEach((row, index) => {
      row.querySelector('.row-number').textContent = index + 1;
    });
  }

  // Функция для создания новой строки
  function createNewRow() {
    const newRow = document.createElement('tr');

    // Номер строки
    const numberCell = document.createElement('td');
    numberCell.classList.add('row-number');
    numberCell.textContent = tableBody.children.length + 1;

    // Поле для ФИО
    const nameCell = document.createElement('td');
    const nameInput = document.createElement('input');
    nameInput.type = 'text';
    nameInput.placeholder = 'Введите ФИО';
    nameInput.classList.add('stednt_input_edit');
    nameCell.appendChild(nameInput);

    // Поле для даты зачисления
    const dateCell = document.createElement('td');
    const dateInput = document.createElement('input');
    dateInput.type = 'text';
    dateInput.placeholder = 'Введите дату зачисления';
    dateInput.classList.add('stednt_input_edit');
    dateCell.appendChild(dateInput);

    // Кнопка удаления
    const actionCell = document.createElement('td');
    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Удалить';
    deleteButton.classList.add('delete-row-btn');
    actionCell.appendChild(deleteButton);

    // Добавляем ячейки в строку
    newRow.appendChild(numberCell);
    newRow.appendChild(nameCell);
    newRow.appendChild(dateCell);
    newRow.appendChild(actionCell);

    return newRow;
  }

  // Добавление строки
  addRowBtn.addEventListener('click', function () {
    const newRow = createNewRow();
    tableBody.appendChild(newRow);
    updateRowNumbers(); // Обновляем нумерацию
  });

  // Удаление строки
 tableBody.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-row-btn')) {
        const row = e.target.closest('tr'); // Находим строку, содержащую кнопку
        const rowsCount = tableBody.querySelectorAll('tr').length; // Количество строк в таблице

        // Проверяем, что в таблице больше одной строки
        if (rowsCount <= 1) {
            alert('Нельзя удалить все строки. В таблице должна остаться хотя бы одна строка.');
            return;
        }

        const rowId = row.getAttribute('data-id'); // Получаем ID строки

        // Добавляем подтверждение удаления
        if (!confirm('Вы уверены, что хотите удалить эту строку?')) {
            return; // Если пользователь отменил, прекращаем выполнение
        }

        if (rowId) {
            // Если строка имеет ID, отправляем запрос на удаление с сервера
           $.ajax({
            url: 'block/function/delete_student.php', // URL обработчика на сервере
            type: 'POST', // Метод запроса
            contentType: 'application/json', // Тип данных, отправляемых на сервер
            data: JSON.stringify({ id: rowId }), // Данные для отправки
            dataType: 'json', // Ожидаемый формат ответа
            success: function (result) {
                if (result.success) {
                    alert("Данные о студенте успешно удалены");
                    row.remove(); // Удаляем строку из таблицы
                    updateRowNumbers(); // Обновляем нумерацию
                    // location.reload(true);
                } else {
                    alert('Ошибка при удалении строки: ' + result.message);
                    $('.res_st').html(result.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Ошибка при отправке данных:', error);
                alert('Произошла ошибка при удалении строки.');
            }
        });
        } else {
            row.remove(); // Удаляем строку без отправки запроса
            updateRowNumbers(); // Обновляем нумерацию
        }
    }
});
    saveChangesBtn.addEventListener('click', function () {
    const tableData = [];
    const rows = tableBody.querySelectorAll('tr');

    rows.forEach(row => { 
      const rowId = row.getAttribute('data-id');
      const fioInput = row.querySelector('.stednt_input_edit'); // Ищем по классу
      const dateInput = row.querySelectorAll('.stednt_input_edit')[1]; // Второе поле ввода

      const rowData = {
        id: rowId,
        fio: fioInput ? fioInput.value.trim() : '', // Проверяем, что элемент существует
        date_receipts: dateInput ? dateInput.value.trim() : '', // Проверяем, что элемент существует,
        groopName: groopName,
      };

      tableData.push(rowData);
    });

    // Отправляем данные на сервер
     $.ajax({
        url: 'block/function/save_student.php', // URL обработчика на сервере
        type: 'POST', // Метод запроса
        data: JSON.stringify({ students: tableData }), // Данные для отправки
        contentType: 'application/json', // Тип контента
        dataType: 'json', // Ожидаемый формат ответа
        success: function (result) {
            if (result.success) {
                alert('Данные успешно сохранены!');
            } else {
                alert('Ошибка при сохранении данных: ' + result.message);
                $('.res_st').html(result);
            }
        },
        error: function (xhr, status, error) {
            console.error('Ошибка при отправке данных:', error);
            alert('Произошла ошибка при отправке данных на сервер.');
        }
    });
})
})
