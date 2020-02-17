/**
 * Утилиты приложения.
 * @type Utils
 */
var Utils = {
    // Общее количество сгенерированных элементов.
    _totalEl: 0,

    /**
     * Сгенерировать ИД
     * @param {String} id  - Базовый ИД.
     * @returns {String} - Сгенерированный ИД со счетчиком.;
     */
    generateId: function(id) {
        return (id + '_' + this._totalEl++);
    },

    /**
     * Создать элемент с ИД..
     * @param {String} className - Тэг элемента;
     * @param {String} id - (optional) ИД объекта;
     * @returns {HTMLElement} - Созданный элемент.
     */
    createEl: function(className, id) {
        // Прописываем умолчания, если не определено.
        id = id || null;
        className = className || "div";
        // Создаем элемент.
        var element = document.createElement(className);
        // Назначаем ИД.
        element.id = (null !== id ? id : this.generateId(className));
        // Возвращаем элемент.
        return element;
    },

    /**
     * Генерируем случайное значение в диапазоне.
     * @param {Number} min - Минимальное значение.
     * @param {Number} max - (optional) Максимальное значение.
     * @returns {Number} Сгенерированное число.
     */
    random: function (min, max) {
        var _max = max || min;
        // Если задано одно число, то генерировать от 0 и до значения.
        if (_max === min) {
            return Math.floor(Math.random() * (_max + 1));
        } else if ( min > max) {
            // Поменять Мин и Макс если надо.
            _max = min + 0;
            min = max + 0;
            max = _max;
        }
        return (min + Math.floor(Math.random() * (max + 1 - min)));
    }
};

