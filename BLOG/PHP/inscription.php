<?php

require_once("bdd.php");

if (isset($_POST["inscription"])) {
    if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"] && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"]) && isset($_POST["password2"]) && !empty($_POST["password2"]))) {
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $password2 = htmlspecialchars($_POST["password2"]);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
                $reqpseudo = $pdo->prepare('SELECT * FROM User WHERE username = ?');
                $reqpseudo->execute(array($pseudo));
                $pseudoexist = $reqpseudo->rowCount();
                if ($pseudoexist == 0) {
                    $reqemail = $pdo->prepare('SELECT * FROM User WHERE email = ?');
                    $reqemail->execute(array($email));
                    $emailexist = $reqemail->rowCount();
                    if ($emailexist == 0) {
                        if ($password == $password2) {
                            if (!empty($_FILES["avatar"]["tmp_name"])) {
                                $tmpName = $_FILES["avatar"]["tmp_name"];
                                $name = $_FILES["avatar"]["name"];
                                $size = $_FILES["avatar"]["size"];
                                $tabExtension = explode('.', $name);
                                $extension = strtolower(end($tabExtension));
                                $extensions = ["jpg", "png", "jpeg"];
                                $maxSize = 4000000;
                                if (in_array($extension, $extensions) && $size <= $maxSize) {
                                    $uniqueName = uniqid("", true);
                                    $avatar = $uniqueName . "." . $extension;
                                    move_uploaded_file($tmpName, 'upload/' . $avatar);
                                    $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                                    $reqinsert = $pdo->prepare('INSERT INTO User (username, password, email, avatar) VALUES (?,?,?,?)');
                                    $reqinsert->execute(array($pseudo, $passwordhash, $email, $avatar));
                                    header("Location: connexion.php");
                                } else {
                                    $error =  "Mauvaise extension d'image (.jpg, .png, .jpeg) ou taille trop volumineuse";
                                }
                            } else {
                                $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                                $reqinsert = $pdo->prepare('INSERT INTO User (username, password, email, avatar) VALUES (?,?,?,?)');
                                $reqinsert->execute(array($pseudo, $passwordhash, $email, "avatar.jpg"));
                                header("Location: connexion.php");
                            }
                        } else {
                            $error = "Vos mots de passes sont différents";
                        }
                    } else {
                        $error = "Votre email est déjà utilisé.";
                    }
                } else {
                    $error = "Votre pseudo est déjà utilisé.";
                }
            } else {
                $error = "Votre mot de passe doit contenir au minimum 1 lettre et 1 chiffre et doit être composé de 8 à 12 caractères.";
            }
        } else {
            $error = "Votre adresse mail n'est pas valide";
        }
    } else {
        $error = "Tous les champs doivent être complétés!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <h1>Inscription</h1>
    <div>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required><br>
            <input type="email" name="email" id="email" placeholder="Email" required><br>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required><br>
            <input type="password" name="password2" id="password2" placeholder="Confirmer votre mot de passe" required><br>
            <input type="file" name="avatar" id="avatar" placeholder="Upload de votre avatar"><br>
            <input type="submit" value="Valider" name="inscription">

        </form>
    </div>
    <?php
    if (isset($error)) {
        echo "<p style='color:red'>$error</p>";
    }
    ?>

</body>

</html>