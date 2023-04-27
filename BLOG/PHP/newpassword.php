<?php

require_once("bdd.php");
session_start();

if (isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID = (int)substr($_GET['id'], 1, -1);
    $select = $pdo->prepare("SELECT * FROM User WHERE ID = ?");
    $select->execute(array($ID));
    $data = $select->fetch();
    if ($_SESSION["token"] !== $data["code"]) {
        header("Location: deconnexion.php");
    }
}

if (isset($_POST["passwordupdate"])) {
    if (isset($_POST["password"]) && !empty($_POST["password"])) {
        $password = htmlspecialchars($_POST["password"]);
        $password2 = htmlspecialchars($_POST["password2"]);
        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
            if ($password == $password2) {
                $bddPassword = $data["password"];
                if (password_verify($password, $bddPassword)) {
                    $error = "Vous utilisez déjà ce mot de passe";
                } else {
                    $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                    $reqpasswordupdate = $pdo->prepare("UPDATE User SET password = ?, code = NULL, expiration_time = NULL WHERE ID = ?");
                    $reqpasswordupdate->execute(array($passwordhash, $ID));
                    header("Location: deconnexion.php");
                }
            } else {
                $error = "Vos mots de passes sont différents";
            }
        } else {
            $error = "Votre mot de passe doit contenir au minimum 1 lettre, 1 chiffre, 1 caractère spécial et doit être composé de 8 à 12 caractères.";
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
    <title>Réinitialisation Mot de Passe</title>
</head>

<body>
    <h1>Réinitialiser votre mot de passe</h1>

    <form action="" method="POST">
        <input type="password" name="password" id="password" placeholder="Mot de passe" required><br>
        <input type="password" name="password2" id="password2" placeholder="Confirmer votre mot de passe" required><br>
        <input type="submit" value="Valider" name="passwordupdate">
    </form>
    <?php
    if (isset($error)) {
        echo "<p style='color:red'>$error</p>";
    }
    ?>

</body>

</html>