<?php
session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID = (int)substr($_GET['id'], 1, -1);
    $select = $pdo->prepare("SELECT * FROM User WHERE ID = ?");
    $select->execute(array($ID));
    $data = $select->fetch();
    $select2 = $pdo->prepare("Select r.nom FROM User u Join Role r ON u.ID_Role = r.ID WHERE u.ID = ?;");
    $select2->execute(array($ID));
    $data2 = $select2->fetch();
    if ($_SESSION["ID"] !== $data["ID"] && $_SESSION["ID_Role"] < 3) {

        header("Location: deconnexion.php");
    }
}



/* Pseudo */

if (isset($_POST["pseudoupdate"])) {
    if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"])) {
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $reqpseudo = $pdo->prepare('SELECT * FROM User WHERE username = ?');
        $reqpseudo->execute(array($pseudo));
        $pseudoexist = $reqpseudo->rowCount();
        if ($pseudoexist == 0) {
            $reqpseudoupdate = $pdo->prepare("UPDATE User SET username = ? WHERE ID = ?");
            $reqpseudoupdate->execute(array($pseudo, $ID));
            header("Location: updateuser.php?id='$ID'");
        } else {
            $error = "Votre pseudo est déjà utilisé.";
        }
    }
}

/* Email */

if (isset($_POST["emailupdate"])) {
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = htmlspecialchars($_POST["email"]);
        $reqemail = $pdo->prepare('SELECT * FROM User WHERE email = ?');
        $reqemail->execute(array($email));
        $emailexist = $reqemail->rowCount();
        if ($emailexist == 0) {
            $reqemailupdate = $pdo->prepare("UPDATE User SET email = ? WHERE ID = ?");
            $reqemailupdate->execute(array($email, $ID));
            header("Location: updateuser.php?id='$ID'");
        } else {
            $error = "Votre email est déjà utilisé.";
        }
    }
}

/* Password */

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
                    $reqpasswordupdate = $pdo->prepare("UPDATE User SET password = ? WHERE ID = ?");
                    $reqpasswordupdate->execute(array($passwordhash, $ID));
                    header("Location: updateuser.php?id='$ID'");
                }
            } else {
                $error = "Vos mots de passes sont différents";
            }
        } else {
            $error = "Votre mot de passe doit contenir au minimum 1 lettre, 1 chiffre, 1 caractère spécial et doit être composé de 8 à 12 caractères.";
        }
    }
}

/* Avatar */

if (isset($_POST["avatarupdate"]) && !empty($_FILES["avatar"]["tmp_name"])) {
    $tmpName = $_FILES["avatar"]["tmp_name"];
    $name = $_FILES["avatar"]["name"];
    $size = $_FILES["avatar"]["size"];
    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));
    $extensions = ["jpg", "png", "jpeg"];
    $maxSize = 4000000;
    if (in_array($extension, $extensions) && $size <= $maxSize) {
        if (!empty($data["avatar"])) {
            unlink('upload/' . $data["avatar"]);
        }
        $uniqueName = uniqid("", true);
        $avatar = $uniqueName . "." . $extension;
        move_uploaded_file($tmpName, 'upload/' . $avatar);
        $reqavatarupdate = $pdo->prepare("UPDATE User SET avatar = ? WHERE ID = ?");
        $reqavatarupdate->execute(array($avatar, $ID));
        header("Location: updateuser.php?id='$ID'");
    } else {
        $error = "Mauvaise extension d'image (.jpg, .png, .jpeg) ou taille trop volumineuse";
    }
}

/* Role */

if (isset($_POST["roleupdate"])) {
    $role = $_POST["role"];
    $reqroleupdate = $pdo->prepare("UPDATE User SET ID_Role = ? WHERE ID = ?");
    $reqroleupdate->execute(array($role, $ID));
    header("Location: updateuser.php?id='$ID'");
}


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
        <h2>Pseudo : <?= $data["username"] ?></h2><button id="update_pseudo">Modifier</button>
        <dialog id="pseudomodal">
            <form action="" method="POST">
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required><br>
                <input type="submit" value="Valider" name="pseudoupdate">
                <button id="close_pseudo">Annuler</button>
            </form>
            <?php
            if (isset($error)) {
                echo "<p style='color:red'>$error</p>";
            }
            ?>
        </dialog>
        <h2>Email : <?= $data["email"] ?></h2><button id="update_email">Modifier</button>
        <dialog id="emailmodal">
            <form action="" method="POST">
                <input type="email" name="email" id="email" placeholder="Email" required><br>
                <input type="submit" value="Valider" name="emailupdate">
                <button id="close_email">Annuler</button>
            </form>
            <?php
            if (isset($error)) {
                echo "<p style='color:red'>$error</p>";
            }
            ?>
        </dialog>
        <h2>Password :</h2><button id="update_password">Modifier</button><br>
        <dialog id="passwordmodal">
            <form action="" method="POST">
                <input type="password" name="password" id="password" placeholder="Mot de passe" required><br>
                <input type="password" name="password2" id="password2" placeholder="Confirmer votre mot de passe" required><br>
                <input type="submit" value="Valider" name="passwordupdate">
                <button id="close_password">Annuler</button>
            </form>
            <?php
            if (isset($error)) {
                echo "<p style='color:red'>$error</p>";
            }
            ?>
        </dialog>
        <h2>Avatar :</h2>
        <img src="./upload/<?= $data["avatar"]; ?>" alt="Photo profil de <?= $data["username"]; ?>"><br>
        <button id="update_avatar">Modifier</button>
        <dialog id="avatarmodal">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="avatar" id="avatar" placeholder="Upload de votre avatar"><br>
                <input type="submit" value="Valider" name="avatarupdate">
                <button id="close_avatar">Annuler</button>
            </form>
            <?php
            if (isset($error)) {
                echo "<p style='color:red'>$error</p>";
            }
            ?>

        </dialog>
        <?php if ($_SESSION["ID_Role"] === 3) : ?>
            <h2>Role : <?= $data2["nom"] ?></h2>
            <button id="update_role">Modifier</button><br>
            <dialog id="rolemodal">
                <form action="" method="POST">
                    <input type="radio" name="role" id="role1" value="1" <?php if ($data["ID_Role"] === 1) : ?> checked="checked" <?php endif; ?>>Utilisateur
                    <input type="radio" name="role" id="role2" value="2" <?php if ($data["ID_Role"] === 2) : ?> checked="checked" <?php endif; ?>>Moderateur
                    <input type="radio" name="role" id="role3" value="3" <?php if ($data["ID_Role"] === 3) : ?> checked="checked" <?php endif; ?>>Admin
                    <input type="radio" name="role" id="role4" value="4" <?php if ($data["ID_Role"] === 4) : ?> checked="checked" <?php endif; ?>>Ban
                    <input type="submit" value="Valider" name="roleupdate">
                    <button id="close_role">Annuler</button>
                </form>
                <?php
                if (isset($error)) {
                    echo "<p style='color:red'>$error</p>";
                }
                ?>
            </dialog>
        <?php endif; ?>
    </div>
    <?php if ($_SESSION["ID"] === $ID) : ?>
        <a href="user.php">Retour à mon profil</a>
    <?php endif; ?>
    <?php if ($_SESSION["ID_Role"] === 3) : ?>
        <a href="admin.php">Retour page admin</a>
    <?php endif; ?>
    <script src="script.js"></script>
</body>

</html>