document.addEventListener('DOMContentLoaded', function () {
    const scheduleTable = document.getElementById('schedule');
    const subjects = JSON.parse(scheduleTable.getAttribute('data-subjects'));
    const offices = JSON.parse(scheduleTable.getAttribute('data-offices'));
    const tableName = JSON.parse(scheduleTable.getAttribute('data-schedule'));

    // Функция для подсчета количества столбцов
    function getColumnCount() {
        const theadRow = document.querySelector('#schedule thead tr');
        return theadRow.children.length - 1; // Вычитаем первый столбец (время)
    }

    let columnCounter = getColumnCount(); // Инициализация счетчика столбцов

    // Инициализация Choices.js
    function initializeChoices() {
        document.querySelectorAll('.admin_select, .admin_select_off').forEach(select => {
            if (!select.classList.contains('choices-initialized')) {
                new Choices(select, {
                    searchEnabled: true,
                    placeholder: false,
                    itemSelectText: '',
                    shouldSort: true,
                    searchResultLimit: 5,
                    noResultsText: 'N/A',
                });
                select.classList.add('choices-initialized');
            }
        });
    }

    // Добавление столбца
    document.getElementById('addColumnBtn_edit').addEventListener('click', function (e) {
        e.preventDefault();

        // Генерируем новый заголовок с input
        const newHeader = `
            <th class="day">
                <input type="text" class="th_changes_input" value="">
            </th>
        `;
        const theadRow = document.querySelector('#schedule thead tr');
        theadRow.insertAdjacentHTML('beforeend', newHeader);

        // Добавляем ячейки в каждую строку tbody
        const tbodyRows = document.querySelectorAll('#schedule tbody tr');
        tbodyRows.forEach(row => {
            const newCell = `
                <td class="choice_admin">
                    <div class="td_ob">
                        <select name="sub_name" class="admin_select">
                            <option value=""></option>
                            ${subjects
                                .filter(subject => subject.name.trim() !== '&nbsp;')
                                .map(subject => `
                                    <option value="${subject.id}">${subject.name}</option>
                                `).join('')}
                        </select>
                        <select name="off_name" class="admin_select_off">
                            <option value=""></option>
                            ${offices
                                .filter(office => office.number.trim() !== '&nbsp;')
                                .map(office => `
                                    <option value="${office.id}">${office.number}</option>
                                `).join('')}
                        </select>
                    </div>
                </td>
            `;
            row.insertAdjacentHTML('beforeend', newCell);
        });

        initializeChoices(); // Инициализируем Choices.js для новых элементов
        columnCounter++;
    });

    // Удаление столбца
    document.getElementById('removeColumnBtn_edit').addEventListener('click', function () {
        const theadRow = document.querySelector('#schedule thead tr');
        const tbodyRows = document.querySelectorAll('#schedule tbody tr');

        if (theadRow.children.length > 2 && columnCounter > 7) {
            theadRow.removeChild(theadRow.lastElementChild); // Удаляем последний заголовок
            tbodyRows.forEach(row => {
                row.removeChild(row.lastElementChild); // Удаляем последнюю ячейку
            });
            columnCounter--;
        } else {
            alert('Нельзя удалить все столбцы.');
        }
    });

    // Сбор данных из таблицы
    function collectTableData() {
        const rows = [];
        const headerInputs = Array.from(document.querySelectorAll('#schedule thead th .th_changes_input'))
            .map(input => input.value.trim())
            .filter(value => value); // Собираем только непустые заголовки

        const tableRows = document.querySelectorAll('#schedule tbody tr');
        tableRows.forEach(row => {
            const timeCell = row.querySelector('.time'); // Ячейка с временем
            const cells = row.querySelectorAll('.choice_admin'); // Ячейки с данными

            const rowData = {
                id: null, // Можно добавить ID, если нужно
                time: timeCell ? timeCell.textContent.trim() : '',
                data: []
            };

            cells.forEach((cell, index) => {
                const subjectSelect = cell.querySelector('.admin_select');
                const officeSelect = cell.querySelector('.admin_select_off');
                const subjectValue = subjectSelect ? subjectSelect.value.trim() : '';
                const officeValue = officeSelect ? officeSelect.value.trim() : '';

                rowData.data.push({
                    subject: subjectValue,
                    office: officeValue
                });
            });

            rows.push(rowData);
        });

        return {
            headers: headerInputs,
            rows: rows
        };
    }

    // Проверка на дубликаты в заголовках
    function hasDuplicateGroops() {
        const groops = [];
        const groopInputs = document.querySelectorAll('#schedule thead th .th_changes_input');
        for (const input of groopInputs) {
            const dayValue = input.value.trim();
            if (dayValue && groops.includes(dayValue)) {
                return true; // Найден дубликат
            }
            if (dayValue) {
                groops.push(dayValue);
            }
        }
        return false; // Дубликатов нет
    }

    // Отправка данных через AJAX
    document.getElementById('submitEditBtn').addEventListener('click', function (e) {
        e.preventDefault();

        // Проверяем на дубликаты в заголовках
        if (hasDuplicateGroops()) {
            alert('Ошибка: Введены две одинаковые группы. Пожалуйста, исправьте.');
            return;
        }

        // Собираем данные из таблицы
        const tableData = collectTableData();
        console.log(tableData);

        // Отправляем данные через AJAX
        $.ajax({
            url: 'block/function/edit_changes.php', // URL обработчика
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                tableName: tableName,
                headers: tableData.headers,
                rows: tableData.rows
            }),
            dataType: 'html',
            success: function (response) {
                const resultDiv = document.createElement('div');
                resultDiv.innerHTML = response;
                document.body.appendChild(resultDiv);
            },
            error: function (xhr, status, error) {
                console.error('Ошибка при отправке данных:', error);
                alert('Произошла ошибка при отправке данных на сервер.');
            }
        });
    });

    // Инициализация Choices.js для существующих элементов
    initializeChoices();
});