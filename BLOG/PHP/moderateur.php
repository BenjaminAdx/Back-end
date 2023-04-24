<?php
session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"]) || $_SESSION["ID_Role"] !== 2) {

    header("Location: deconnexion.php");
}

$select3 = $pdo->prepare("SELECT * FROM Article WHERE ID_Moderation = 2 ORDER BY ID");
$select3->execute();
$data3 = $select3->fetchAll();

$select5 = $pdo->prepare("SELECT * FROM Article_temp ORDER BY ID");
$select5->execute();
$data5 = $select5->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderateur</title>
</head>

<body>

    <h1>Page Moderateur</h1>
    <h2>Article en attente de validation</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($data3 as $data3) : ?>
            <tr>
                <td><?= $data3["title"] ?></td>
                <td><a href="article.php?id='<?= $data3["ID"] ?>'">Aperçu article</a></td>
                <td><a href="deletearticle.php?id='<?= $data3["ID"] ?>'" onclick="return confirm('Vous confirmez la suppresion de cet article ?');">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Article modifier après publication</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($data5 as $data5) : ?>
            <tr>
                <td><?= $data5["title"] ?></td>
                <td><a href="articlepubmod.php?id='<?= $data5["ID"] ?>'">Aperçu article</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="user.php">Retour profil</a>

</body>

</html>