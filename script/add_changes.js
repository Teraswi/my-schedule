document.addEventListener('DOMContentLoaded', function () {
    // Получаем данные предметов и кабинетов из data-атрибутов
    const scheduleTable = document.getElementById('schedule');
    const subjects = JSON.parse(scheduleTable.getAttribute('data-subjects'));
    const offices = JSON.parse(scheduleTable.getAttribute('data-offices'));

    let columnCounter = 7; // Начинаем с 7, так как уже есть 6 дней недели

     function initializeChoices() {
        // Инициализируем Choices.js для всех <select> с классом admin_select
        document.querySelectorAll('.admin_select').forEach(select => {
            if (!select.classList.contains('choices-initialized')) { // Проверяем, чтобы не инициализировать дважды
                new Choices(select, {
                    searchEnabled: true,
                    placeholder: false,
                    itemSelectText: '',
                    shouldSort: true,
                    searchResultLimit: 5,
                    noResultsText: 'N/A',
                });
                select.classList.add('choices-initialized'); // Помечаем как инициализированный
            }
        });

        // Инициализируем Choices.js для всех <select> с классом admin_select_off
        document.querySelectorAll('.admin_select_off').forEach(select => {
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
    document.getElementById('addColumnBtn').addEventListener('click', function (e) {
        e.preventDefault(); // Предотвращаем отправку формы

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
                                .filter(subject => subject.name.trim() !== '&nbsp;') // Пропускаем &nbsp;
                                .map(subject => `
                                    <option value="${subject.id}">${subject.name}</option>
                                `).join('')} //Создаем новый массив и объединяем всё
                        </select>
                        <select name="off_name" class="admin_select_off">
                            <option value=""></option>
                             ${subjects
                                .filter(subject => subject.name.trim() !== '&nbsp;') // Пропускаем &nbsp;
                                .map(subject => `
                                    <option value="${subject.id}">${subject.name}</option>
                                `).join('')}
                        </select>
                    </div>
                </td>
            `;
            row.insertAdjacentHTML('beforeend', newCell);
        });

        initializeChoices();

        columnCounter++;
    });

    // Удаление столбца
    document.getElementById('removeColumnBtn').addEventListener('click', function () {
        const theadRow = document.querySelector('#schedule thead tr');
        const tbodyRows = document.querySelectorAll('#schedule tbody tr');

        if (theadRow.children.length > 2 && columnCounter > 7) { // Минимум 1 столбец + время
            theadRow.removeChild(theadRow.lastElementChild); // Удаляем последний заголовок
            tbodyRows.forEach(row => {
                row.removeChild(row.lastElementChild); // Удаляем последнюю ячейку
            });
            columnCounter--;
        } else {
            alert('Нельзя удалить все столбцы.');
        }
    });

    initializeChoices();


 document.getElementById('submitDataBtn').addEventListener('click', function (e) {
        e.preventDefault();

        const inputChanges = document.querySelector('.div__changes .input__changes');
        const inputValue = inputChanges ? inputChanges.value.trim() : '';

        if (!inputValue) {
            alert('Ошибка: Поле даты не заполнено.');
            return;
        }

        // Собираем данные из таблицы
        const tableData = collectTableData();
        // console.log(tableData)
        // Проверяем на дубликаты в заголовках (дни недели)
        if (hasDuplicateDays()) {
            alert('Ошибка: Введены две одинаковые группы. Пожалуйста, исправьте.');
            return;
        }

    // Отправляем данные на сервер через AJAX
        fetch('block/function/add_changes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json; charset=UTF-8',
            },
            body: JSON.stringify({ 
                date: inputValue,
                schedule: tableData 
            }),
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                 alert (result.message)
                 
                } else {
                    console.log('Ошибка при сохранении данных: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Ошибка при отправке данных:', error);
                console.log('Отправляемые данные:', {
                     date: inputValue,
                     schedule: tableData,
                 });
                alert('Произошла ошибка при отправке данных на сервер.');
                    
            });
     });

    // Функция для сбора данных из таблицы
  function collectTableData() {
    const tableData = [];
    const rows = document.querySelectorAll('#schedule tbody tr');
    rows.forEach(row => {
        const rowData = {};
        const timeCell = row.querySelector('.time'); // Получаем ячейку с временем
        const cells = row.querySelectorAll('.choice_admin');

        // Время урока
        const timeValue = timeCell ? timeCell.textContent.trim() : '';
        if (!timeValue) return; // Пропускаем строки без времени

        rowData.time = timeValue; // Добавляем время в объект

        // Пары для каждой группы
        cells.forEach((cell, index) => {
            const groopInput = document.querySelectorAll('#schedule thead th .th_changes_input')[index];
            const groopValue = groopInput ? groopInput.value.trim() : '';

            const subjectSelect = cell.querySelector('.admin_select');
            const officeSelect = cell.querySelector('.admin_select_off');

            const subjectValue = subjectSelect ? subjectSelect.value.trim() : '';
            const officeValue = officeSelect ? officeSelect.value.trim() : '';

            if (groopValue && subjectValue && officeValue) {
                rowData[groopValue] = {
                    subject: subjectValue || '',
                    office: officeValue || '',
                };
            }
        });

        // Добавляем строку в массив данных
        tableData.push(rowData);
    });
    return tableData;
}

    // Функция для проверки дубликатов в заголовках (дни недели)
    function hasDuplicateDays() {
        const days = [];
        const dayInputs = document.querySelectorAll('#schedule thead th .th_changes_input');

        for (const input of dayInputs) {
            const dayValue = input.value.trim();
            if (dayValue && days.includes(dayValue)) {
                return true; // Найден дубликат
            }
            if (dayValue) {
                days.push(dayValue);
            }
        }

        return false; // Дубликатов нет
    }

    // Инициализация Choices.js для существующих элементов
    initializeChoices();
});
