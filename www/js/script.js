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