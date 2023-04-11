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
    <title>Modifier mon profil</title>
</head>

<body>
    <h1>Modifier mon profil</h1>
    <div>
        <h2>Pseudo : <?= $data["username"] ?></h2><a href="updateusername.php">Modifier</a>
        <h2>Email : <?= $data["email"] ?></h2><a href="updateemail.php">Modifier</a>
        <h2>Password :</h2><a href="updatepassword.php">Modifier</a><br>
        <img src="./upload/<?= $data["avatar"]; ?>" alt="Photo profil de <?= $data["username"]; ?>"><a href="updateavatar.php">Modifier</a>

    </div>
    <?php
    if (isset($error)) {
        echo "<p style='color:red'>$error</p>";
    }
    ?>

</body>

</html>