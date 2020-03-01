/**
 * Создать экземпляр компонента 'ChatMessage'.
 * @param {Object} config (optional) Конфигурация компонента.
 * @returns {Component}
 */
function createChatMessage(config) {

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
     * Компонент.
     * @type Component
     */
    var component = mixinCore();

    /***************************************************************************
     * Свойства
     **************************************************************************/

    /***************************************************************************
     * Методы
     **************************************************************************/

    /**
     * Инициализация компонента.
     * @param {Object} config Конфигурация компонента.
     */
    component.init = function (config) {
        this.config = config;
        this.htmlElement = Utils.createEl("div");

        this.initTextControls();
        this.initFormatControls();

        this.setVisible(this.getConfigValue("visible", false));
    };

    component.initTextControls = function() {
        var el = Utils.createEl("div", "textControls");
        el.classList.add("textinput");
        el.appendChild(this.initClearButton());
        el.appendChild(this.initInputField());
        el.appendChild(this.initSendButton());
        this.htmlElement.appendChild(el);
    };

    /**
     * Инициализация кнопки "Очистить".
     * @returns {HTMLElement}
     */
    component.initClearButton = function() {
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
        return el;
    };

    /**
     * Обработчик нажатия кнопки "Очистить".
     * @param event
     */
    component.onClearButtonClick = function(event) {
        // Очищаем текстовое поле.
        this.clear();
    };

    /**
     * Скрыть кнопку "Очистить".
     */
    component.hideClearButton = function() {
        var buttonEl =  this.getProperty("ClearButton");

        // Если кнопка видима, то скрыть.
        if (!buttonEl.classList.contains("hidden")) {
            buttonEl.classList.add("hidden");
        }
    };

    /**
     * Показать кнопку "Очистить".
     */
    component.showClearButton = function() {
        var buttonEl =  this.getProperty("ClearButton");

        // Если кнопка ранее скрыта, то отобразить.
        if (buttonEl.classList.contains("hidden")) {
            buttonEl.classList.remove("hidden");
        }
    };

    /**
     * Инициализация текстового поля.
     * @returns {HTMLElement}
     */
    component.initInputField = function() {
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
        return el;
    };

    /**
     * Событие на ввод текста.
     * @param event
     */
    component.onEnterText = function(event) {
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
     * @returns {HTMLElement}
     */
    component.initSendButton = function() {
        var self, el = Utils.createEl("button");

        // Добавляем стили к кнопке.
        el.classList.add("squarebutton");
        el.classList.add("iconbutton");
        el.classList.add("send");

        // Сохраняем ссылку на себя.
        self = this;

        // Вешаем событие на нажатие.
        el.onclick = function(event) {
            self.onSendButtonClick(event);
        };

        // Сохраняем кнопку и добавляем к себе.
        this.setProperty("SendButton", el);
        return el;
    };

    /**
     * Обработчик нажатия кнопки "Поиск".
     * @param event
     */
    component.onSendButtonClick = function(event) {

        var url = new URL(window.location.href);
        var userId =  url.searchParams.get("user_id");

        // Делаем псевдо инпут.
        var messageEl = Utils.createEl("input", "message");
        messageEl.name = messageEl.id;

        // передаем ему значение поиска.
        messageEl.value = this.getValue();

        var userIdEl = Utils.createEl("input", "userid");
        userIdEl.name = userIdEl.id;

        // передаем ему значение поиска.
        userIdEl.value = userId;

        // Создаем псевдо форму.
        var sendForm =  Utils.createEl("form");

        // Добавляем точку отправки.
        sendForm.action = "/index.php?user_id=" + userId;

        // Добавляем метод отправки.
        sendForm.method = "post";

        // Добавляем к нему данные.
        sendForm.appendChild(messageEl);
        sendForm.appendChild(userIdEl);

        // Отправляем
        document.body.appendChild(sendForm);
        sendForm.submit();
    };

    /**
     * Очистить поле.
     */
    component.clear = function() {
        this.setValue('');
        this.hideClearButton();
    };

    /**
     * Получить значение поля.
     * @returns {String}
     */
    component.getValue = function() {
        var inputEl = this.getProperty("InputField");
        return (inputEl.value + '');
    };

    /**
     * Задать значение поля.
     * @param {String} text вводимый текст.
     */
    component.setValue = function(text) {
        if (isNullOrEmpty(text)) {
            this.hideClearButton();
            text = ''
        }  else {
            this.showClearButton();
        }

        var inputEl = this.getProperty("InputField");
        inputEl.value = (text + '');

    };

    component.initFormatControls = function() {
        var el = Utils.createEl("div", "formatControls");
    };

    /***************************************************************************
     * Настройка/инициализация
     **************************************************************************/

    component.init(config || {});

    return component;
}