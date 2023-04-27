<?php
session_start();

require_once("bdd.php");

if (isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}


if (isset($_POST["email"])) {

    $email = htmlspecialchars(trim($_POST["email"]));

    if (!empty($email)) {

        $select = $pdo->prepare("SELECT * FROM User WHERE email = ?");
        $select->execute([$email]);
        $data = $select->fetch();
        $row = $select->rowCount();

        if ($row) {
            if (empty($data["code"])) {
                $token = bin2hex(openssl_random_pseudo_bytes(24));
                $dateExpiration = time() + 600;
                var_dump(time());
                $insert = $pdo->prepare("UPDATE User SET code = ?, expiration_time = ? WHERE email = ?");
                $insert->execute(array($token, $dateExpiration, $email));

                $link = 'recover.php?to=' . $token;
                $subject = "Réinitialisation de votre mot de passe";
                $message = '<h1>Réinitialisation de votre mot de passe</h1><p>Pour réinitialiser votre mot de passe, veuillez suivre ce lien <a href="' . $link . '">Par ici</a><br>Attention valable uniquement pendant 10 minutes.</p>';

                $headers = "From: Mon blog.com\n";
                $headers .= "Content-type: text/html; charset=utf-8\n";



                mail($email, $subject, $message, $headers);
                header("Location: index.php");
            } else {
                $error = "Un lien valide pour réinitialiser votre mot de passe a déjà été envoyé sur votre adresse email.";
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

    <h1>Mot de passe oublié</h1>


    <form action="" method="POST">
        <input type="text" placeholder="Email" name="email"><br>
        <input type="submit">

    </form>

    <?php
    if (isset($error)) {
        echo "<p style='color:red'>$error</p>";
    }
    ?>

</body>

</html>