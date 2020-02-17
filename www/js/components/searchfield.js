/* global Utils */
/**
 * Создать экщземпляр компонента.
 * @returns {Component}
 */
function createSearchField() {

    /**
     * @static
     * @private
     * Проверка на заполненость строки.
     *
     * @param {String} value Проверяемое значение.
     * @returns {Boolean} Результат проверки.
     */
    var isNullOrEmpty = function(value) {
        return typeof(value) === 'undefined' || null === value || '' === value;
    };

    /**
     * Компонент поиска.
     * @type {Component}
     */
    var element = mixinCore();

    /**********************************************************************
     * Добавим методы объекта
     **********************************************************************/

    /**
     * инициализация компонента.
     */
    element.init = function() {
        // Создаем элемент и добавляем классы..
        this.htmlElement = Utils.createEl("div", "searchfield" );
        this.htmlElement.classList.add("textinput");

        // Инициализируем связанные элементы.
        this.initClearButton();
        this.initInputField();
        this.initSearchButton();
    };

    /**
     * Инициализация кнопки "Очистить".
     */
    element.initClearButton = function() {
        var self, el = Utils.createEl("button");

        // добавляем классы к элементу.
        el.classList.add("squarebutton");
        el.classList.add("iconbutton");
        el.classList.add("cancel");
        el.classList.add("hidden");

        // делаем указатель на себя.
        self = this;

        // Создаем обработчик на нажатие.
        el.onclick = function(event) {
            self.onClearButtonClick(event);
        };

        // сохраняем элемент и добавляем к себе.
        this.setProperty("ClearButton", el);
        this.htmlElement.appendChild(el);
    };

    /**
     * Обработчик нажатия кнопки "Очистить".
     * @param event
     */
    element.onClearButtonClick = function(event) {
        // Очищаем текстовое поле.
        this.clear();
    };

    /**
     * Скрыть кнопку "Очистить".
     */
    element.hideClearButton = function() {
        var buttonEl =  this.getProperty("ClearButton");

        // Если кнопка видима, то скрыть.
        if (!buttonEl.classList.contains("hidden")) {
            buttonEl.classList.add("hidden");
        }
    };

    /**
     * Показать кнопку "Очистить".
     */
    element.showClearButton = function() {
        var buttonEl =  this.getProperty("ClearButton");

        // Если кнопка ранее скрыта, то отобразить.
        if (buttonEl.classList.contains("hidden")) {
            buttonEl.classList.remove("hidden");
        }
    };

    /**
     * Инициализация текстового поля.
     */
    element.initInputField = function() {
        var self, el = Utils.createEl("input");

        // Добавляем классы к текстовому полю.
        el.classList.add("textfield");

        // Сохраняем ссылку на себя.
        self = this;

        // Вешаем событие к полю.
        el.onkeydown = function(event) {
            self.onEnterText(event);
        };

        // Сохраняем элемент и добавляем к себе.
        this.setProperty("InputField", el);
        this.htmlElement.appendChild(el);
    };

    /**
     * Событие на ввод текста.
     * @param event
     */
    element.onEnterText = function(event) {
       // Если в поле есть значение.
       if (this.getValue() !== '') {
           // Показать кнопку "Очистить".
           this.showClearButton();
       }  else {
           // Скрыть кнопку "Очистить".
           this.hideClearButton();
       }
    };

    /**
     * Инициализация кнопки "Поиск".
     */
    element.initSearchButton = function() {
        var self, el = Utils.createEl("button");

        // Добавляем стили к кнопке.
        el.classList.add("squarebutton");
        el.classList.add("iconbutton");
        el.classList.add("search");

        // Сохраняем ссылку на себя.
        self = this;

        // Вешаем событие на нажатие.
        el.onclick = function(event) {
            self.onSearchButtonClick(event);
        };

        // Сохраняем кнопку и добавляем к себе.
        this.setProperty("SearchButton", el);
        this.htmlElement.appendChild(el);
    };

    /**
     * Обработчик нажатия кнопки "Поиск".
     * @param event
     */
    element.onSearchButtonClick = function(event) {

        // Делаем псевдо инпут.
        var inputEl = Utils.createEl("input", "search_text");
        inputEl.name = inputEl.id;

        // передаем ему значение поиска.
        inputEl.value = this.getValue();

        // Создаем псевдо форму.
        var sendForm =  Utils.createEl("form");

        // Добавляем точку отправки.
        sendForm.action = "/index.php";

        // Добавляем метод отправки.
        sendForm.method = "get";

        // Добавляем к нему данные.
        sendForm.appendChild(inputEl);

        // Отправляем
        document.body.appendChild(sendForm);
        sendForm.submit();
    };

    /**
     * Очистить поле.
     */
    element.clear = function() {
        this.setValue('');
        this.hideClearButton();

        var link = Utils.createEl("a");
        link.href = "/index.php";
        link.click();
     };

    /**
     * Получить значение поля.
     * @returns {String}
     */
    element.getValue = function() {
        var inputEl = this.getProperty("InputField");
        return (inputEl.value + '');
    };

    /**
     * Задать значение поля.
     * @param {String} text вводимый текст.
     */
    element.setValue = function(text) {
        if (isNullOrEmpty(text)) {
            this.hideClearButton();
            text = ''
        }  else {
            this.showClearButton();
        }

        var inputEl = this.getProperty("InputField");
        inputEl.value = (text + '');

    };

    // Инициируем компонент.
    element.init();

    // Заполняем поиск, если был запрос.
    var url = new URL(window.location.href);
    element.setValue(url.searchParams.get("search_text"));

    return (element)
}