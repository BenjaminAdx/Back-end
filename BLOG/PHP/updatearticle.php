<?php

session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"])) {

    header("Location: deconnexion.php");
}


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID = (int)substr($_GET['id'], 1, -1);
    $select = $pdo->prepare("SELECT * FROM Article WHERE ID = ?");
    $select->execute(array($ID));
    $data = $select->fetch();
    if ($_SESSION["ID"] !== $data["ID_User"] && $_SESSION["ID_Role"] !== 3) {

        header("Location: deconnexion.php");
    } else {
        if (isset($_POST["article"])) {
            if ($data["ID_Moderation"] === 3) {
                $selectTempTable = $pdo->prepare("SELECT * FROM Article_temp WHERE ID_ARTICLE = ?");
                $selectTempTable->execute(array($ID));
                $updateExist = $selectTempTable->rowCount();
                if ($updateExist == 0) {
                    if ((!empty($_POST["title"]) && $_POST["title"] !== $data["title"]) || (!empty($_POST["content"]) && $_POST["content"] !== $data["content"]) || (!empty($_FILES["image"]["tmp_name"])) && $data["ID_User"]) {
                        $title = $_POST["title"];
                        $content = $_POST["content"];
                        if (!empty($_FILES["image"]["tmp_name"])) {
                            $tmpName = $_FILES["image"]["tmp_name"];
                            $name = $_FILES["image"]["name"];
                            $size = $_FILES["image"]["size"];
                            $tabExtension = explode('.', $name);
                            $extension = strtolower(end($tabExtension));
                            $extensions = ["jpg", "png", "jpeg"];
                            $maxSize = 4000000;
                            if (in_array($extension, $extensions) && $size <= $maxSize) {
                                $uniqueName = uniqid("", true);
                                $image = $uniqueName . "." . $extension;
                                move_uploaded_file($tmpName, 'imgarticle/' . $image);
                                $reqinsertTempTable = $pdo->prepare("INSERT INTO Article_temp (title, content, image, ID_ARTICLE) VALUES (?,?,?,?)");
                                $reqinsertTempTable->execute(array($title, $content, $image, $ID));
                                header("Location: article.php?id='$ID'");
                            } else {
                                $error = "Mauvaise extension d'image (.jpg, .png, .jpeg) ou taille trop volumineuse";
                            }
                        } else {
                            $reqinsertTempTable = $pdo->prepare("INSERT INTO Article_temp (title, content, ID_ARTICLE) VALUES (?,?,?)");
                            $reqinsertTempTable->execute(array($title, $content, $ID));
                            header("Location: article.php?id='$ID'");
                        }
                    } else {
                        $error = "Veuillez remplir les champs";
                    }
                } else {
                    $error = "Modification déjà enregistrer, veuillez attendre la validation du modérateur.";
                }
            } else {
                if (!empty($_POST["title"]) && !empty($_POST["content"])) {
                    $title = $_POST["title"];
                    $content = $_POST["content"];
                    if (!empty($_FILES["image"]["tmp_name"])) {
                        $tmpName = $_FILES["image"]["tmp_name"];
                        $name = $_FILES["image"]["name"];
                        $size = $_FILES["image"]["size"];
                        $tabExtension = explode('.', $name);
                        $extension = strtolower(end($tabExtension));
                        $extensions = ["jpg", "png", "jpeg"];
                        $maxSize = 4000000;
                        if (in_array($extension, $extensions) && $size <= $maxSize) {
                            if (!empty($data["image"])) {
                                unlink('imgarticle/' . $data["image"]);
                            }
                            $uniqueName = uniqid("", true);
                            $image = $uniqueName . "." . $extension;
                            move_uploaded_file($tmpName, 'imgarticle/' . $image);
                            $reqinsert = $pdo->prepare("UPDATE Article SET title = ?, content = ?, image = ? WHERE ID = ?");
                            $reqinsert->execute(array($title, $content, $image, $ID));
                            header("Location: article.php?id='$ID'");
                        } else {
                            $error = "Mauvaise extension d'image (.jpg, .png, .jpeg) ou taille trop volumineuse";
                        }
                    } else {
                        $reqinsert = $pdo->prepare("UPDATE Article SET title = ?, content = ? WHERE ID = ?");
                        $reqinsert->execute(array($title, $content, $ID));
                        header("Location: article.php?id='$ID'");
                    }
                } else {
                    $error = "Veuillez modifier les champs";
                }
            }
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
    <h1>Modifier votre article</h1>
    <div>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" id="title" placeholder="Titre" required value="<?= $data["title"] ?>"><br>
            <textarea name="content" id="content" cols="30" rows="10"><?= $data["content"] ?></textarea><br>
            <input type="file" name="image" id="image"><br>
            <input type="submit" value="Enregistrer" name="article">

        </form>
        <a href="article.php?id='<?= $data["ID"] ?>'">Annuler</a>
    </div>
    <?php
    if (isset($error)) {
        echo "<p style='color:red'>$error</p>";
    }
    ?>

</body>

</html>