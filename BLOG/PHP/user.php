<?php
session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

$select = $pdo->prepare("SELECT * FROM User WHERE ID = ?");
$select->execute([$_SESSION["ID"]]);
$data = $select->fetch();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Bienvenue</p>

    <h1>Page de <?= $data["username"]; ?></h1>
    <img src="./upload/<?= $data["avatar"]; ?>" alt="Photo profil de <?= $data["username"]; ?>">

    <a href="article.php">Créer un article</a>
    <a href="deconnexion.php">Se déconnecter</a>

</body>

</html>