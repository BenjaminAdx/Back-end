<?php
session_start();

require_once("bdd.php");


if (isset($_POST["email"])) {

    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars($_POST["password"]);

    if (!empty($email) && !empty($password)) {

        $select = $pdo->prepare("SELECT * FROM User WHERE email = ?");
        $select->execute([$email]);
        $data = $select->fetch();

        if ($data) {

            $bddPassword = $data["password"];
            if (password_verify($password, $bddPassword)) {
                var_dump($data);
                $_SESSION["ID"] = $data["ID"];
                $_SESSION["ID_Role"] = $data["ID_Role"];
                if ($_SESSION["ID_Role"] === 4) {
                    header("Location: deconnexion.php");
                } else {
                    header("Location: user.php");
                }
            } else {
                $error = "Le mot de passe est incorrect";
            }
        } else {

            $error = "L'email n'existe pas  <a href='inscription.php'>cliquez ici pour vous inscrire<a>";
        }
    } else {

        $error = "Veuillez remplir les champs !";
    }
}





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

    <h1>Connexion</h1>


    <form action="" method="POST">
        <input type="text" placeholder="Email" name="email"><br>
        <input type="password" placeholder="Mot de passe" name="password"><br>
        <input type="submit">

    </form>

    <?php
    if (isset($error)) {
        echo "<p style='color:red'>$error</p>";
    }
    ?>

</body>

</html>