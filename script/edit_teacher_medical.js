document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('teacherTable_medical');
    const tbody = table.querySelector('tbody');

    // Добавление новой строки
    document.getElementById('addRowBtn_teacher_medical').addEventListener('click', function () {
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
        startDateInput.setAttribute('placeholder', 'Введите дату начала больничного');
        startDateInput.classList.add('teacher_edit_input', 'start_date');
        startDateCell.appendChild(startDateInput);
        newRow.appendChild(startDateCell);

        // 3. Поле для даты окончания больничного
        const endDateCell = document.createElement('td');
        const endDateInput = document.createElement('input');
        endDateInput.setAttribute('type', 'text');
        endDateInput.setAttribute('placeholder', 'Введите дату конца больничного, если она известна');
        endDateInput.classList.add('teacher_edit_input', 'end_date');
        endDateInput.placeholder = 'Введите, если преподаватель вышел с больничного';
        endDateCell.appendChild(endDateInput);
        newRow.appendChild(endDateCell);

        // 4. Кнопка "Удалить"
        const actionsCell = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Удалить';
        deleteButton.classList.add('deleteTeacherBtn');
        deleteButton.style.cursor = 'pointer';
        actionsCell.appendChild(deleteButton);
        newRow.appendChild(actionsCell);

        // Добавляем строку в таблицу
        tbody.appendChild(newRow);
    });

    document.getElementById('removeRowBtn_teacher_medical').addEventListener('click', function () {
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

    // Удаление строки
       tbody.addEventListener('click', function (e) {
        if (e.target.classList.contains('deleteTeacherBtn')) {
            const rowElement = e.target.closest('tr');
            const rowId = rowElement.dataset.id;

            if (!rowId) {
                alert('Эта строка не связана с базой данных и не может быть удалена.');
                return;
            }

            // Отправляем запрос на сервер для удаления данных
            if (confirm('Вы уверены, что хотите удалить эту запись из базы данных?')) {
                // $.ajax({
                //     url: 'block/function/delete_teacher.php', // Путь к скрипту удаления
                //     method: 'POST',
                //     data: { id: rowId },
                //     dataType: 'json',
                // })
                //     .done(function (response) {
                //         if (response.success) {
                //             // Удаляем строку из интерфейса
                //             tbody.removeChild(rowElement);
                //             alert('Запись успешно удалена из базы данных.');
                //         } else {
                //             alert('Ошибка при удалении записи: ' + response.message);
                //         }
                //     })
                //     .fail(function (xhr, status, error) {
                //         console.error('Ошибка при отправке запроса:', error);
                //         alert('Произошла ошибка при удалении записи.');
                //     });
            }
        }
    });


    // Отправка данных на сервер
    document.getElementById('submitDataBtn_teacher_medical').addEventListener('click', function () {
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

        console.log(dataToSend);

        // Отправляем данные на сервер через AJAX
        // $.ajax({
        //     url: 'block/function/edit_teacher.php',
        //     method: 'POST',
        //     data: { teachers: dataToSend },
        //     dataType: 'html',
        // })
        //     .done(function (response) {
        //         $('.tech').html(response);
        //         alert('Данные успешно отправлены!');
        //     })
        //     .fail(function (xhr, status, error) {
        //         alert('Ошибка при отправке данных.');
        //         console.error(error);
        //     });
    });
});