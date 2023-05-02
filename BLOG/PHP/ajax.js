var likes = document.querySelectorAll(".like");

function addLike() {
    var like = this;
    var idArticle = like.getAttribute("idArticle");
    var idUser = like.getAttribute("idUser");
    var source = like.getAttribute("src");
    if (source === "./assets/thumbs-up-regular.svg") {
        fetch("like.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "idArticle=" + idArticle + "&idUser=" + idUser
        }).then(function (response) {

            console.log(response);
            return response.text();

        }).then(function (response) {
            /* JSON.parse(response); */
            like.setAttribute("src", "./assets/thumbs-up-solid.svg");
        })
    }
    else {
        fetch("unlike.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "idArticle=" + idArticle + "&idUser=" + idUser
        }).then(function (response) {
            return response.text();
        }).then(function (response) {
            /* JSON.parse(response); */
            like.setAttribute("src", "./assets/thumbs-up-regular.svg");
        })

    }
}

likes.forEach(function (like) {
    like.addEventListener("click", addLike);
});


