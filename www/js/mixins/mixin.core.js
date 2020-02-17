/* global config */

/**
 * Создать/обновить объект компонентныйм функционалом.
 * @param {HTMLElement} obj (optional) Созданный объект.
 * @return {Component} Объект с новыми свойствами и функционалом.
 */
function mixinCore(obj) {
    // Если объект не передан - создаем пустой объект.
    obj = obj || {};

    /**
     * @private
     * Создает объект свойств с обработчиками.
     *
     * @typedef {Object} PropertyNode Объект свойств.
     * @property {String} key Ключ.
     * @property {*} value Значение.
     * @property {Function} isValid Функция валидатор.
     * @property {Object} validatorScope Окружение.
     * @property {Function} onUpdate Обработчик обновления.
     * @property {Object} updateScope Окружение обработчика обновления.
     * @property {Function} onError Обработчик ошибки.
     * @property {Object} errorScope Окружение обработчика ошибок.
     */

    /**
     * @static
     * @private
     *
     * Проверка объекта на Null или Undefined.
     * @param {*} value Проверяемая переменная.
     * @return {Boolean} Результат проверки.
     */
    var isNullOrUndefined = function(value) {
        return (typeof value === 'undefined' || value === null);
    };

    /**
     * @static
     * @private
     *
     * Создаем объект свойств.
     * @param {String} key Название свойства.
     * @param {*} value (optional) Значение свойства.
     * @return {PropertyNode} Объект свойств.
     */
    var createPropertyNode = function(key, value) {
        return {
            // Ключ.
            key: key,
            // Значение.
            value: value || null,
            // Валидатор значения.
            isValid: function(newValue, oldValue) {
                var result = true;
                this.handlers.forEach((handler) => {
                    if (result && "validator" === handler.type) {
                        result = handler.func(newValue, oldValue, handler.scope);
                    }
                });
                return result;
            },
            // Обработчик на обновление.
            onUpdate: function(newValue, oldValue) {
                this.handlers.forEach((handler) => {
                    if ("onUpdate" === handler.type) {
                        handler.func(newValue, oldValue, handler.scope);
                    }
                });
            },
            // Обработчик на ошибку.
            onError: function(newValue, oldValue) {
                this.handlers.forEach((handler) => {
                    if ("onError" === handler.type) {
                        handler.func(newValue, oldValue, handler.scope);
                    }
                });
            },
            handlers: []
        };
    };

    /**
     * @static
     * @private
     *
     * Возвращает объект свойств.
     * @param {String} key Название свойства.
     * @param {Object} scope Окружение которое будет использоваться,
     * 					как this в обработчике.
     * @return {PropertyNode} Объект свойств.
     */
    var getPropertyNode = function(key, scope) {
        return scope.properties.find(item => item.key === key);
    };

    /**
     * @static
     * @private
     *
     * Возвращает объект свойств.
     * @param {String} key Название свойства.
     * @param {*} value Значение свойства.
     * @param {Object} scope Окружение которое будет использоваться,
     * 					как this в обработчике.
     * @return {PropertyNode} Объект свойств.
     */
    var updatePropertyNode = function(key, value, scope) {
        var len = scope.propertiesCount();
        for (var i = 0; i < len; i++) {
            if (key !== scope.properties[i].key) {
                continue;
            }
            scope.properties[i].value = value;
            break;
        }
    };

    /**
     * @public
     * Задаем ХТМЛ элемент в котором будет отображаться результат работы компонента.
     * @param {HTMLElement} htmlElement ХТМЛ элемент.
     */
    var setElMethod = function(htmlElement) {
        this.__private__.thisEl = htmlElement;
        this.__private__.id = htmlElement.id;
    };

    /**
     * Получить ХТМЛ элемент компонента.
     * @return {HTMLElement} ХТМЛ элемент.
     */
    var getElMethod = function() {
        return this.__private__.thisEl;
    };

    /**
     * Сохранить название компонента.
     * @param {String} componentName Название компонента.
     */
    var setNameMethod = function(componentName) {
        this.__private__.name = componentName;
    };

    /**
     * Получить название компонента.
     * @return {String} Название компонента.
     */
    var getNameMethod = function() {
        return this.__private__.name;
    };

    /**
     * Получить ID компонента.
     * @return {String} ID компонента.
     */
    var getIdMethod = function() {
        return this.__private__.id;
    };

    /**
     * Задать ХТМЛ элемент, куда будет отрендерен компонент.
     * @param {HTMLElement|String} htmlElement  ХТМЛ элемент.
     */
    var setRenderToMethod = function(htmlElement) {
        var element = ("string" === typeof(htmlElement)) ?
            document.querySelector(htmlElement) : htmlElement;

        this.__private__.parentEl = element;
    };

    /**
     * Получить ХТМЛ элемент родителя.
     * @return {HTMLElement} ХТМЛ элемент.
     */
    var getRenderToMethod = function() {
        return this.__private__.parentEl;
    };

    /**
     * Проверка виден ли компонент.
     * @return {Boolean} Результат операции.
     */
    var isVisibleMethod = function() {
        return this.__private__.visible;
    };

    /**
     * Проверка виден ли компонент.
     * @param {Boolean} val Результат операции.
     */
    var setVisibleMethod = function(val) {
        this.__private__.visible = val;
    };

    /**
     * Скрыть компонент.
     */
    var hideMethod = function() {
        this.__private__.visible = false;
        this.render();
    };

    /**
     * Отобразить компонент.
     */
    var showMethod = function() {
        this.__private__.visible = true;
        this.render();
    };

    /**
     * Проверка отрендерен ли компонент в родителя.
     * @return {Boolean} Результат проверки.
     */
    var isRenderedMethod = function() {
        return this.__private__.rendered;
    };

    /**
     * Отрендерить компонент.
     */
    var renderMethod = function() {
        this.renderToParent();
        this.reRender();
    };

    /**
     * Добавить компонент к родителю.
     */
    var renderToParentMethod = function() {
        var el = this.htmlElement;
        if (this.isVisible) {
            if (!this.isRendered) {
                var parent = this.renderTo;
                parent.appendChild(el);
                this.__private__.rendered = true;
            }
            this.forEachComponent(this.onRenderComponent, this);
        } else {
            if (this.isRendered) {
                el.remove();
                this.__private__.rendered = false;
            }
        }
    };

    /**
     * Обработчик отрисовки связанного компонента.
     * @param {String} name
     * @param {Component} component Компонент.
     */
    var onRenderComponentMethod = function(name, component) {
        component.render();
    };

    /**
     * Добавить компонент.
     * @param {String} key Имя компонента.
     * @param {Component} component Компонент.
     */
    var appendComponentMethod = function(key, component) {
        component.renderTo = this.htmlElement;
        this.components.push({key: key, value: component});
    };

    /**
     * Получить компонент по имени.
     * @param {String} key Имя компонента.
     * @return {Component} Компонент.
     */
    var getComponentMethod = function(key) {
        var found = this.components.find(item => item.key === key);
        return (isNullOrUndefined(found) ? null : found);
    };

    /**
     * Удалить компонент по имени.
     * @param {String} key Имя компонента.
     * @return {Component|null} Удаленный компонент для дальнейшей обработки.
     */
    var removeComponentMethod = function(key) {
        var found = this.getComponent(key);
        if (!isNullOrUndefined(found)) {
            found.hide();
            found.renderTo(null);
        }
        return (found);
    };

    /**
     * Общее количество компонентов.
     * @return {Number} Количество.
     */
    var componentsCountMethod = function() {
        return this.components.length;
    };

    /**
     * Обработать компоненты в цикле.
     * @param {Function} func Обработчик для найденых элементов
     * @param {Object} scope (optional) Окружение которое будет использоваться,
     * 					как this в обработчике.
     */
    var forEachComponentMethod = function(func, scope) {
        this.components
            .forEach((component) => func(component.key, component.value),
                scope || this);
    };

    /**
     * Получить все компоненты.
     * @return {Array} Массив компонентов.
     */
    var getComponentsMethod = function() {
        return this.__children__;
    };

    /**
     * Задать конфигурацию компонента.
     * @param {Object} config Конфигурационный объект.
     */
    var setConfigMethod = function(config) {
        this.__config__ = config || {};
    };

    /**
     * Получить конфигурацию компонента.
     * @returns {Object} Конфигурационный объект.
     */
    var getConfigMethod = function() {
        return (this.__config__);
    };

    /**
     * Получить занчение параметра конфигурации компонента.
     * @param {String} name Название параметра конфигурации компонента.
     * @param {*} defValue (optional) Значение по умолчанию, если конфиг не найден.
     * @returns {*|null} - Значение конфигурации.
     */
    var getConfigValueMethod = function(name, defValue) {
        defValue = defValue || null;
        var config = this.config;
        if (!isNullOrUndefined(config) && ({} !== config) && config.hasOwnProperty(name)) {
            return config[name];
        } else {
            return defValue;
        }
    };

    /**
     * Задать параметр компонента.
     * @param {String} key Название параметра.
     * @param {*} value Значение параметра.
     */
    var setPropertyMethod = function(key, value) {
        /**
         * @type PropertyNode
         */
        var propertyNode;
        // Если уже параметр есть, то установим новое значение, если можем.
        if(this.isPropertyExists(key)) {
            propertyNode = getPropertyNode(key, this);
            // Если прошли валидацию.
            if (propertyNode.isValid(value, propertyNode.value,
                propertyNode.validatorScope)) {
                // Обрабатываем обновление и сохраняем.
                propertyNode.onUpdate(value, propertyNode.value,
                    propertyNode.updateScope);
                updatePropertyNode(key, value, this);
            } else {
                // Кидаем ошибку валидации.
                propertyNode.onError(value, propertyNode.value,
                    propertyNode.errorScope);
            }
        } else {
            // создаем новый объект параметра.
            propertyNode = createPropertyNode(key, null);
            // Обрабатываем обновление и сохраняем.
            propertyNode.onUpdate(value, null, propertyNode.updateScope);
            propertyNode.value = value;
            this.properties.push(propertyNode);
        }
    };

    /**
     * Получить параметр компонента.
     * @param {String} key Название параметра.
     * @returns {*|null} Значение параметра.
     */
    var getPropertyMethod = function(key) {
        var found = getPropertyNode(key, this);
        return (isNullOrUndefined(found) ? null : found.value);
    };

    /**
     * Количество параметров.
     * @returns {Number} Количество.
     */
    var propertiesCountMethod = function () {
        return this.properties.length;
    };

    var addPropertyValidatorMethod = function(key, func, scope) { };

    var addPropertyOnUpdateListenerMethod = function(key, func, scope) { };

    var addPropertyOnErrorListenerMethod = function(key, func, scope) { };

    /**
     * Проверить, есть ли такой параметр.
     * @param {String} key Название параметра.
     * @returns {Boolean} Результат проверки.
     */
    var isPropertyExistsMethod = function(key) {
        var found = getPropertyNode(key, this);
        return !isNullOrUndefined(found);
    };

    /**
     * Получить все параметры.
     * @returns {Array} Массив параметров.
     */
    var getPropertiesMethod = function() {
        return this.__properties__;
    };

    /**
     * Добавить обработчик ХТМЛ элемента.
     * @param {String} eventName Имя события.
     * @param {Function} func Обработчик.
     * @param {Object} scope Окружение которое будет использоваться,
     *				как this в обработчике.
     */
    var onElementEventHandlerMethod = function(eventName, func, scope) {
        scope = scope || this;
        var self = this;
        this.htmlElement["on"+eventName] = function(event) {
            func(self, event, scope);
        };
    };

    /***************************************************************************
     *
     **************************************************************************/

    // Установим приватные переменные компонента.
    obj.__private__ = {
        id: null,
        thisEl: null,
        parentEl: null,
        visible: false,
        rendered: false,
        name: ""
    };

    // Хранилище дочерних компонентов.
    obj.__children__ = [];

    // Хранилище параметров компонента.
    obj.__properties__ = [];

    // Конфигурация компонента.
    obj.__config__ = {};

    /**********************************************************************
     * Добавим свойства объекта
     **********************************************************************/

    Object.defineProperty(obj, "htmlElement", {
        set: setElMethod,
        get: getElMethod
    });

    Object.defineProperty(obj, "renderTo", {
        set: setRenderToMethod,
        get: getRenderToMethod
    });

    Object.defineProperty(obj, "isVisible", {
        get: isVisibleMethod,
        write: false
    });

    Object.defineProperty(obj, "isRendered", {
        get: isRenderedMethod,
        write: false
    });

    Object.defineProperty(obj, "properties", {
        get: getPropertiesMethod,
        write: false
    });

    Object.defineProperty(obj, "components", {
        get: getComponentsMethod,
        write: false
    });

    Object.defineProperty(obj, "config", {
        set: setConfigMethod,
        get: getConfigMethod
    });

    Object.defineProperty(obj, "name", {
        set: setNameMethod,
        get: getNameMethod
    });

    Object.defineProperty(obj, "id", {
        get: getIdMethod,
        write: false
    });

    /**********************************************************************
     * Добавим методы объекта
     **********************************************************************/

    obj.init = function(){};
    obj.show = showMethod;
    obj.hide = hideMethod;
    obj.render = renderMethod;
    obj.reRender = function(){};
    obj.renderToParent = renderToParentMethod;
    obj.appendComponent = appendComponentMethod;
    obj.removeComponent = removeComponentMethod;
    obj.getComponent = getComponentMethod;
    obj.componentsCount = componentsCountMethod;
    obj.forEachComponent = forEachComponentMethod;
    obj.onRenderComponent = onRenderComponentMethod;
    obj.getConfigValue = getConfigValueMethod;
    obj.getProperty = getPropertyMethod;
    obj.setProperty = setPropertyMethod;
    obj.propertiesCount = propertiesCountMethod;
    obj.addPropertyValidator = addPropertyValidatorMethod;
    obj.addPropertyOnUpdateListener = addPropertyOnUpdateListenerMethod;
    obj.addPropertyOnErrorListener = addPropertyOnErrorListenerMethod;
    obj.isPropertyExists = isPropertyExistsMethod;
    obj.onElement = onElementEventHandlerMethod;
    obj.setVisible = setVisibleMethod;

    return (obj);
}
