<?php


var_dump($_GET);

if (isset($_GET["url"])) {
    $url = htmlspecialchars($_GET["url"]);

    if ($url == "") {
        require_once "home.php";
    } elseif ($url == "articles" && $_SERVER["REQUEST_METHOD"] === "GET") {
        require_once "article.php";
    } elseif ($url == "article" && $_SERVER["REQUEST_METHOD"] === "POST") {
        require_once "formArticle.php";
    } else {
        echo "erreur 404";
    }
} else {
    "erreur 404!";
}
