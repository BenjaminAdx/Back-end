<?php
session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"]) || $_SESSION["ID_Role"] >= 2) {

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

    <h1>Page Moderateur</h1>
    <p>Bienvenue <?= $data["username"]; ?></p>
    <a href="article.php">Créer un article</a>
    <a href="deconnexion.php">Se déconnecter</a>

</body>

</html>