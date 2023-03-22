
var visibleEl = document.querySelector("#visible");
var invisibleEl = document.querySelector("#invisible");

function visible() {
    var password = document.querySelector("#password");
    password.type = "text";
    visibleEl.style.display = "none";
    invisibleEl.style.display = "flex";
}
visibleEl.addEventListener("click", visible);

function invisible() {
    var password = document.querySelector("#password");
    password.type = "password";
    visibleEl.style.display = "flex";
    invisibleEl.style.display = "none";
}
invisibleEl.addEventListener("click", invisible);