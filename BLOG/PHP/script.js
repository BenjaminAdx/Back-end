/* Modal mise à jour Pseudo */
let pseudoUpdateButton = document.querySelector("#update_pseudo");
let pseudoDialog = document.querySelector("#pseudomodal");
let pseudoClose = document.querySelector("#close_pseudo");

pseudoUpdateButton.addEventListener("click", function onOpen() {
    if (typeof pseudoDialog.showModal === "function") {
        pseudoDialog.showModal();
    }
    else {
        console.error("L'API <dialog> n'est pas prise en charge par ce navigateur.");
    }
})

pseudoClose.addEventListener("click", function onClose() {
    pseudoDialog.close();
})

/* Modal mise à jour Email */

let emailUpdateButton = document.querySelector("#update_email");
let emailDialog = document.querySelector("#emailmodal");
let emailClose = document.querySelector("#close_email");

emailUpdateButton.addEventListener("click", function onOpen() {
    if (typeof emailDialog.showModal === "function") {
        emailDialog.showModal();
    }
    else {
        console.error("L'API <dialog> n'est pas prise en charge par ce navigateur.");
    }
})

emailClose.addEventListener("click", function onClose() {
    emailDialog.close();
})

/* Modal mise à jour Password */

let passwordUpdateButton = document.querySelector("#update_password");
let passwordDialog = document.querySelector("#passwordmodal");
let passwordClose = document.querySelector("#close_password");

passwordUpdateButton.addEventListener("click", function onOpen() {
    if (typeof passwordDialog.showModal === "function") {
        passwordDialog.showModal();
    }
    else {
        console.error("L'API <dialog> n'est pas prise en charge par ce navigateur.");
    }
})

passwordClose.addEventListener("click", function onClose() {
    passwordDialog.close();
})

/* Modal mise à jour Avatar */

let avatarUpdateButton = document.querySelector("#update_avatar");
let avatarDialog = document.querySelector("#avatarmodal");
let avatarClose = document.querySelector("#close_avatar");

avatarUpdateButton.addEventListener("click", function onOpen() {
    if (typeof avatarDialog.showModal === "function") {
        avatarDialog.showModal();
    }
    else {
        console.error("L'API <dialog> n'est pas prise en charge par ce navigateur.");
    }
})

avatarClose.addEventListener("click", function onClose() {
    avatarDialog.close();
})

/* Modal mise à jour Role */

let roleUpdateButton = document.querySelector("#update_role");
let roleDialog = document.querySelector("#rolemodal");
let roleClose = document.querySelector("#close_role");

roleUpdateButton.addEventListener("click", function onOpen() {
    if (typeof roleDialog.showModal === "function") {
        roleDialog.showModal();
    }
    else {
        console.error("L'API <dialog> n'est pas prise en charge par ce navigateur.");
    }
})

roleClose.addEventListener("click", function onClose() {
    roleDialog.close();
})
