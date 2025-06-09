document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('teacherTable_session');
    const tbody = table.querySelector('tbody');

    // Добавление новой строки
    document.getElementById('addRowBtn_teacher_session').addEventListener('click', function () {
        const newRow = document.createElement('tr');

        // 1. Поле для ФИО
        const nameCell = document.createElement('td');
        const nameInput = document.createElement('input');
        nameInput.setAttribute('type', 'text');
        nameInput.setAttribute('placeholder', 'Введите ФИО');
        nameInput.classList.add('teacher_edit_input', 'name');
        nameCell.appendChild(nameInput);
        newRow.appendChild(nameCell);

        // 2. Поле для даты начала больничного
        const startDateCell = document.createElement('td');
        const startDateInput = document.createElement('input');
        startDateInput.setAttribute('type', 'text');
        startDateInput.setAttribute('placeholder', 'Введите дату начала сессии');
        startDateInput.classList.add('teacher_edit_input', 'start_date');
        startDateCell.appendChild(startDateInput);
        newRow.appendChild(startDateCell);

        // 3. Поле для даты окончания больничного
        const endDateCell = document.createElement('td');
        const endDateInput = document.createElement('input');
        endDateInput.setAttribute('type', 'text');
        endDateInput.classList.add('teacher_edit_input', 'end_date');
        endDateInput.placeholder = 'Введите дату конца, если известна';
        endDateCell.appendChild(endDateInput);
        newRow.appendChild(endDateCell);

        // 4. Кнопка "Удалить"
        const actionsCell = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Удалить';
        deleteButton.classList.add('clearSessionBtn');
        actionsCell.appendChild(deleteButton);
        newRow.appendChild(actionsCell);

        // Добавляем строку в таблицу
        tbody.appendChild(newRow);
    });

    // Удаление строки
    document.getElementById('removeRowBtn_teacher_session').addEventListener('click', function () {
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

    // Удаление преподавателя на больичном
      tbody.addEventListener('click', function (e) {
    if (e.target.classList.contains('clearSessionBtn')) {
        const rowElement = e.target.closest('tr');
        const teacherId = rowElement.dataset.id;

        if (!teacherId) {
            alert('Эта строка не связана с базой данных и не может быть изменена.');
            return;
        }

        // Отправляем запрос на сервер для очистки medical и exit_medical
        if (confirm('Вы уверены, что хотите очистить данные о сессии для этого преподавателя?')) {
            $.ajax({
            url: 'block/function/delete_teacher_session.php', // URL для отправки запроса
            method: 'POST', // Метод запроса
            contentType: 'application/json', // Тип данных, отправляемых на сервер
            data: JSON.stringify({ id: teacherId }), // Данные для отправки
            dataType: 'json', // Ожидаемый тип ответа от сервера
             })
            .done(function (response) {
                if (response.success) {
                    // Обновляем интерфейс
                    alert('Данные успешно очищены.');
                    location.reload(true);  
                } else {
                    alert('Ошибка при очистке данных: ' + response.message);
                }
            })
            .fail(function (xhr, status, error) {
                console.error('Ошибка при отправке запроса:', error);
                alert('Произошла ошибка при очистке данных.');
            });
        }
    }
});


    // Отправка данных на сервер
    document.getElementById('submitDataBtn_teacher_session').addEventListener('click', function () {
        const rows = tbody.querySelectorAll('tr');
        const dataToSend = [];
        let hasErrors = false; // Флаг для отслеживания ошибок

        rows.forEach(row => {
            // Извлекаем значения из полей ввода
            const nameInput = row.querySelector('.name');
            const startDateInput = row.querySelector('.start_date');
            const endDateInput = row.querySelector('.end_date');

            const name = nameInput ? nameInput.value.trim() : '';
            const startDate = startDateInput ? startDateInput.value.trim() : '';
            const endDate = endDateInput ? endDateInput.value.trim() : '';

            // Проверяем обязательные поля
            if (!name || !startDate) {
                alert(`Ошибка: В строке не заполнены обязательные поля (ФИО или дата начала больничного).`);
                hasErrors = true;
                return; // Прерываем выполнение для текущей строки
            }

            // Определяем ID строки
            const rowId = row.dataset.id ? parseInt(row.dataset.id, 10) : null;

            // Добавляем данные в массив
            dataToSend.push({
                id: rowId, // ID строки (null для новых строк)
                name: name,
                start_date: startDate,
                end_date: endDate,
            });
        });

        // Если есть ошибки, прекращаем отправку данных
        if (hasErrors) {
            return;
        }

        // Проверяем, есть ли данные для отправки
        if (dataToSend.length === 0) {
            alert('Нет данных для отправки.');
            return;
        }

        // Отправляем данные на сервер через AJAX
        $.ajax({
            url: 'block/function/edit_teacher_session.php', // URL для отправки данных
            method: 'POST', // Метод запроса
            contentType: 'aplication/json', // Тип данных, отправляемых на сервер
            data: JSON.stringify({ teachers: dataToSend }), // Данные для отправки
            dataType: 'json', // Ожидаемый тип ответа от сервера
            })
            .done(function (result) {
                // Обработка успешного ответа
                if (result.success) {
                    alert('Данные успешно сохранены!');
                    location.reload(true);
                } else {
                    alert('Ошибка при сохранении данных: ' + result.message);
                    if (result.errors && result.errors.length > 0) {
                        console.error('Ошибки:', result.errors);
                    }
                }
            })
            .fail(function (xhr, status, error) {
                // Обработка ошибок
                console.error('Ошибка при отправке данных:', error);
                alert('Произошла ошибка при отправке данных на сервер.');
            });
    });
});