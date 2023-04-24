<?php

session_start();

require_once("bdd.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID = (int)substr($_GET['id'], 1, -1);
    $select = $pdo->prepare("SELECT a.title, a.content, a.image, a.date, u.username FROM Article a JOIN User u ON a.ID_User = u.ID WHERE a.ID = ?");
    $select->execute(array($ID));
    $data = $select->fetch();
    $select2 = $pdo->prepare("SELECT c.commentaire, u.username FROM Commentaires c JOIN User u ON c.ID_User = u.ID WHERE c.ID_Article = ?");
    $select2->execute(array($ID));
    $data2 = $select2->fetchAll();
}

if (isset($_POST["commentaire"])) {
    if (!isset($_SESSION["ID"])) {
        $error = "Veuillez vous connecter pour commenter l'article";
    } else {
        if (!empty($_POST["comtxt"])) {
            $com = $_POST["comtxt"];
            $IDU = $_SESSION["ID"];
            $req = $pdo->prepare("INSERT INTO Commentaires (commentaire, ID_User, ID_Article, date) VALUES (?,?,?,NOW())");
            $req->execute(array($com, $IDU, $ID));
            header("Location: articlepublicate.php?id='$ID'");
        } else {
            $error = "Veuillez remplir les champs";
        }
    }
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
</head>

<body>
    <div>
        <h1><?= $data["title"] ?></h1>
        <img src="./imgarticle/<?= $data["image"]; ?>" alt="Photo de l'article">
        <p><?= $data["content"] ?></p>
        <p>Ecrit par : <?= $data["username"] ?></p>
        <p><?= $data["date"] ?></p>
        <?php foreach ($data2 as $fetch) : ?>
            <p><?= $fetch["commentaire"] ?></p>
            <p>Ecrit par : <?= $fetch["username"] ?></p>
        <?php endforeach; ?>
        <form action="" method="POST">
            <textarea name="comtxt" id="comtxt" cols="30" rows="10">Ecrire un commentaire</textarea><br>
            <input type="submit" value="Enregistrer" name="commentaire">
        </form>
        <?php
        if (isset($error)) {
            echo "<p style='color:red'>$error</p>";
        }
        ?>

        <a href="index.php">Retour page acceuil</a>

    </div>

</body>

</html>