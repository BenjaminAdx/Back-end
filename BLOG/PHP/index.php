<?php
session_start();

require_once("bdd.php");

$select = $pdo->prepare("SELECT a.title, a.content, a.image, a.date, a.ID, u.username FROM Article a JOIN User u ON a.ID_User = u.ID WHERE a.ID_Moderation = 3 ORDER BY a.date DESC");
$select->execute();
$data = $select->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>

<body>
    <?php if (!isset($_SESSION["ID"])) : ?>
        <a href="inscription.php">S'inscrire</a>
        <a href="connexion.php">Se connecter</a>
    <?php endif; ?>
    <?php if (isset($_SESSION["ID"])) : ?>
        <a href="user.php">Profil</a>
    <?php endif; ?>


    <h1>Bienvenue</h1>
    <?php foreach ($data as $fetch) :
        $selectCom = $pdo->prepare("SELECT COUNT(ID) AS 'total com' FROM Commentaires WHERE ID_Article = ?");
        $selectCom->execute(array($fetch["ID"]));
        $dataCom = $selectCom->fetch(); ?>

        <div>
            <h2><?= $fetch["title"] ?></h2>
            <img src="./imgarticle/<?= $fetch["image"]; ?>" alt="Photo de l'article">
            <p><?= substr($fetch["content"], 0, 10) . '...' ?></p>
            <p>Ecrit par : <?= $fetch["username"] ?></p>
            <p>Nombre de commentaires : <?= $dataCom["total com"] ?></p>
            <a href="articlepublicate.php?id='<?= $fetch["ID"] ?>'">Voir l'article</a>
            <img src="./assets/thumbs-up-regular.svg" class="like" idArticle="<?= $fetch["ID"] ?>" idUser="<?= $_SESSION["ID"] ?>" alt="image pouce like"></img>
        </div>
    <?php endforeach; ?>

    <script src="ajax.js"></script>
</body>

</html>