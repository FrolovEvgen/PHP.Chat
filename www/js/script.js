// Обработчик кннопки "Контакты".
var btnOpenContactList = document.querySelector("#btnOpenContactList");
// Если кнопка есть, то цепляем обработчик.
if (null !== btnOpenContactList) {
    btnOpenContactList.onclick = function() {
        var modal = document.querySelector("#contacts_modal");
        modal.style.display = "block";
    };  
}
// Обработчик кнопки закрытия окна "Контакты".
var btnCloseContact = document.querySelector("#contacts_modal .cancel");
// Если кнопка есть, то цепляем обработчик.
if (null !== btnCloseContact) {
    btnCloseContact.onclick = function() {
        var modal = document.querySelector("#contacts_modal");
        modal.style.display = "none";
    };
}
// Обработчик кнопки "Войти".
var btnOpenLogin= document.querySelector("#btn_openlogin");
// Если кнопка есть, то цепляем обработчик.
if (null !== btnOpenLogin) {
    btnOpenLogin.onclick = function() {
        var modal = document.querySelector("#login_modal");
        modal.style.display = "block";
    };
}
// Обработчик кнопки закрытия окна "Вход".
var btnCloseLogin = document.querySelector("#login_modal .cancel");
// Если кнопка есть, то цепляем обработчик.
if (null !== btnCloseLogin) {
    btnCloseLogin.onclick = function() {
        var modal = document.querySelector("#login_modal");
        modal.style.display = "none";
    };
}
// Обработчик кнопки закрытия окна "Пользователь".
var btnCloseUser = document.querySelector("#user_modal .cancel");
// Если кнопка есть, то цепляем обработчик.
if (null !== btnCloseUser) {
    btnCloseUser.onclick = function() {
        var modal = document.querySelector("#user_modal");
        modal.style.display = "none";
    };
}

// Получаем список сообщений.
var userPics = document.querySelectorAll("#messages .icon");
// Обновляем событие на клик.
if (null !== userPics && userPics.length > 0) {
    userPics.forEach(function(userPic){
        //Если кликнули.
        userPic.onclick = function(event) {
            // Получаем ИД пользователя которого выбрали.
            var currentEl = event.currentTarget;
            var userId = currentEl.dataset.id;

            // Получаем ИД уже выбраного пользователя.
            var selectedEl = document.querySelector("#contact_list .selected");
            var selectedId = selectedEl.dataset.id;

            // Создаем элемент Линк.
            var link = document.createElement("a");
            link.id = "User_" + userId;
            link.href = "/?user_id=" + selectedId;
            link.href += "&info_id=" + userId;

            // Эмулируем нажатие на элемент.
            link.click();
        };
    });
}

// Получаем список контактов.
var contacts = document.querySelectorAll("#contact_list .contact");
// Обновляем событие на клик.
if (null !== contacts && contacts.length > 0) {
    contacts.forEach(function(contact){
        //Если кликнули.
        contact.onclick = function(event) {
            // Получаем ИД уже выбраного пользователя.
            var selectedEl = document.querySelector("#contact_list .selected");
            var selectedId = selectedEl === null ? -1 : selectedEl.dataset.id;

            // Получаем ИД пользователя которого выбрали.
            var currentEl = event.currentTarget;
            var userId = currentEl.dataset.id;

            // Если не совпадают.
            if (userId !== selectedId) {
                // Снимаем выделение старого и выбираем нового пользователя.
                if (selectedEl !== null) {
                    selectedEl.classList.remove("selected");
                }
                currentEl.classList.add("selected");

                // Создаем элемент Линк.
                var link = document.createElement("a");
                link.id = "User_" + userId;
                link.href = "/?user_id=" + userId;

                // Эмулируем нажатие на элемент.
                link.click();

            }
        };
    });
}

var searchBlock = document.querySelector("#search");
if (null !== searchBlock) {
    // добавляем поисковый компонент.
    var searchField = createSearchField();
    searchField.renderTo = searchBlock;
    searchField.show();
}
var controlsBlock = document.querySelector("#controls");
if (null !== controlsBlock) {
    var messageField = createChatMessage();
    messageField.renderTo = controlsBlock;
    messageField.show();
}

