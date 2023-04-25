<?php
session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"]) || $_SESSION["ID_Role"] !== 3) {

    header("Location: deconnexion.php");
}

$select = $pdo->prepare("Select u.ID, u.username, u.email, r.nom FROM User u Join Role r ON u.ID_Role = r.ID ORDER BY u.ID;");
$select->execute();
$data = $select->fetchAll();

$select2 = $pdo->prepare("SELECT * FROM Article WHERE ID_Moderation = 1 ORDER BY ID");
$select2->execute();
$data2 = $select2->fetchAll();

$select3 = $pdo->prepare("SELECT * FROM Article WHERE ID_Moderation = 2 ORDER BY ID");
$select3->execute();
$data3 = $select3->fetchAll();

$select4 = $pdo->prepare("SELECT * FROM Article WHERE ID_Moderation = 3 ORDER BY ID");
$select4->execute();
$data4 = $select4->fetchAll();

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
    <title>Administrateur</title>
</head>

<body>

    <h1>Page Administrateur</h1>

    <h2>Utilisateurs</h2>
    <table>
        <tr>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Rôle</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($data as $data) : ?>
            <tr>
                <td><?= $data["username"] ?></td>
                <td><?= $data["email"] ?></td>
                <td><?= $data["nom"] ?></td>
                <td><a href="updateuser.php?id='<?= $data["ID"] ?>'">Modifier</a></td>
                <td><a href="deleteuser.php?id='<?= $data["ID"] ?>'" onclick="return confirm('Vous confirmez la suppresion de cet utilisateur ?');">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Article enregistrer</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($data2 as $data2) : ?>
            <tr>
                <td><?= $data2["title"] ?></td>
                <td><a href="article.php?id='<?= $data2["ID"] ?>'">Aperçu article</a></td>
                <td><a href="deletearticle.php?id='<?= $data2["ID"] ?>'" onclick="return confirm('Vous confirmez la suppresion de cet article ?');">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

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

    <h2>Article valider</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($data4 as $data4) : ?>
            <tr>
                <td><?= $data4["title"] ?></td>
                <td><a href="articlepublicate.php?id='<?= $data4["ID"] ?>'">Voir article</a></td>
                <td><a href="deletearticle.php?id='<?= $data4["ID"] ?>'" onclick="return confirm('Vous confirmez la suppresion de cet article ?');">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="user.php">Retour profil</a>
</body>

</html>