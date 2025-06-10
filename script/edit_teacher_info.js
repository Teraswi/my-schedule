document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('teacherTable');
    const tbody = table.querySelector('tbody');

    // Добавление новой строки
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

        // Создаем ячейку для прикрепления групп
        const groupsCell = document.createElement('td');
        const groupsInput = document.createElement('input');
        groupsInput.setAttribute('type', 'text');
        groupsInput.setAttribute('placeholder', 'Введите группы');
        groupsInput.classList.add('teacher_edit_input', 'groups');
        groupsCell.appendChild(groupsInput);

        // Создаем ячейку для почты
        const EmailCell = document.createElement('td');
        const EmailInput = document.createElement('input');
        EmailInput.setAttribute('type', 'text');
        EmailInput.setAttribute('placeholder', 'Введите почту преподавателя');
        EmailInput.classList.add('teacher_edit_input', 'email');
        EmailCell.appendChild(EmailInput);

        // Создаем ячейку для кнопки "Удалить"
        const actionsCell = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Удалить';
        deleteButton.classList.add('delete-row-btn');
        deleteButton.style.cursor = 'pointer';
        actionsCell.appendChild(deleteButton);

        // Добавляем ячейки в строку
        newRow.appendChild(nameCell);
        newRow.appendChild(itemsCell);
        newRow.appendChild(groupsCell);
        newRow.appendChild(EmailCell);
        newRow.appendChild(actionsCell);

        // Добавляем строку в таблицу
        tbody.appendChild(newRow);
    });

    // Удаление последней строки
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

    // Делегирование событий для кнопок "Удалить"
    tbody.addEventListener('click', function (e) {
        if (e.target.classList.contains('deleteTeacherBtn')) {
            const rowElement = e.target.closest('tr');
            const teacherId = rowElement.dataset.id;

            if (!teacherId) {
                alert('Ошибка: ID преподавателя не найден.');
                return;
            }

            if (confirm('Вы уверены, что хотите удалить этого преподавателя?')) {
                deleteTeacher(teacherId, rowElement);
            }
        }
    });

    // Функция для отправки запроса на удаление преподавателя
    function deleteTeacher(teacherId, rowElement) {
        $.ajax({
            url: 'block/function/delete_teacher.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id: teacherId }),
            dataType: 'json',
        })
            .done(function (result) {
                if (result.success) {
                    rowElement.remove();
                    alert('Преподаватель успешно удален.');
                } else {
                    alert('Ошибка при удалении преподавателя: ' + result.message);
                }
            })
            .fail(function (error) {
                console.error('Ошибка при отправке запроса:', error);
                alert('Произошла ошибка при удалении преподавателя.');
            });
    }

    // Отправка данных на сервер
    document.getElementById('submitDataBtn_teacher').addEventListener('click', function () {
        const rows = tbody.querySelectorAll('tr');
        const dataToSend = [];

        rows.forEach(row => {
            const nameInput = row.querySelector('.name');
            const itemsInput = row.querySelector('.textarea_edit');
            const groupsInput = row.querySelector('.groups');
            const emailInput = row.querySelector('.email');
            const id = row.dataset.id || null;
            if (nameInput && itemsInput) {
                const name = nameInput.value.trim();
                const items = itemsInput.value.trim();
                const groups = groupsInput ? groupsInput.value.trim() : '';

                const email = emailInput ? emailInput.value.trim() : '';
                const isValidEmail = emailInput 
                    ? /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) || email === ''
                    : true;

                if (!isValidEmail) {
                    alert('Пожалуйста, введите корректный email.');
                    return;
                }


                if (name || items) {
                    dataToSend.push({
                        id: id,
                        name: name,
                        items: items,
                        groups: groups,
                        email: email
                    });
                }
            }
        });

        if (dataToSend.length === 0) {
            alert('Нет данных для отправки.');
            return;
        }


        $.ajax({
            url: 'block/function/edit_teacher.php',
            method: 'POST',
            data: {
                teachers: dataToSend,
            },
            dataType: 'json',
        })
            .done(function (response) {
                // alert('Данные успешно отправлены!');
                // location.reload(true);
                 if (response.success) {
                    alert('Данные успешно сохранены!');
                    location.reload(true);
                } else {
                    alert('Ошибка при сохранении данных: ' + response.message);
                    if (response.errors && response.errors.length > 0) {
                        console.error('Ошибки:', response.errors);
                    }
                }
            })
            .fail(function (xhr, status, error) {
                alert('Ошибка при отправке данных.');
                console.error(error);
            });
    });
});