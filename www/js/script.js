// Обработчик кннопки "Контакты".
var btnOpenContact = document.querySelector("#btn_opencontact");
btnOpenContact.onclick = function() {
    var modal = document.querySelector("#contacts_modal");
    modal.style.display = "block";
};
// Обработчик кнопки закрытия окна "Контакты".
var btnCloseContact = document.querySelector("#contacts_modal .cancel");
btnCloseContact.onclick = function() {
    var modal = document.querySelector("#contacts_modal");
    modal.style.display = "none";
};
// Обработчик кнопки "Войти".
var btnOpenLogin= document.querySelector("#btn_openlogin");
btnOpenLogin.onclick = function() {
    var modal = document.querySelector("#login_modal");
    modal.style.display = "block";
};
// Обработчик кнопки закрытия окна "Вход".
var btnCloseLogin = document.querySelector("#login_modal .cancel");
btnCloseLogin.onclick = function() {
    var modal = document.querySelector("#login_modal");
    modal.style.display = "none";
};
// Обработчик кнопки закрытия окна "Пользователь".
var btnCloseUser = document.querySelector("#user_modal .cancel");
// Если кнопка есть, то цепляем обработчик.
if (null !== btnCloseUser) {
    btnCloseUser.onclick = function() {
        var modal = document.querySelector("#user_modal");
        modal.style.display = "none";
    };
}
// Получаем список контактов.
var contacts = document.querySelectorAll("#messages .icon");
// Обновляем событие на клик.
contacts.forEach(function(contact){
    //Если кликнули.
    contact.onclick = function(event) {
        // Получаем ИД пользователя.
        var userId = event.currentTarget.dataset.id;

        // Создаем элемент Линк.
        var link = document.createElement("a");
        link.id = "User_" + userId;
        link.href = "/?user_id=" + userId;

        // Эмулируем нажатие на элемент.
        link.click();
    };
});