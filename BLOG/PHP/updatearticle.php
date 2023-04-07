<?php

session_start();

require_once("bdd.php");


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID = $_GET['id'];
    if (isset($_POST["article"])) {
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
                $maxSize = 400000;
                if (in_array($extension, $extensions) && $size <= $maxSize) {
                    $uniqueName = uniqid("", true);
                    $image = $uniqueName . "." . $extension;
                    move_uploaded_file($tmpName, 'imgarticle/' . $image);
                    $reqinsert = $pdo->prepare('UPDATE Article title = ?, content = ?, image = ?, date = NOW() WHERE ID = $ID');
                    $reqinsert->execute(array($title, $content, $image));
                    header("Location: user.php");
                } else {
                    $error = "Mauvaise extension d'image (.jpg, .png, .jpeg) ou taille trop volumineuse";
                }
            } else {

                $reqinsert = $pdo->prepare('UPDATE Article title = ?, content = ?, date = NOW() WHERE ID = $ID');
                $reqinsert->execute(array($title, $content));
                header("Location: user.php");
            }
        } else {
            $error = "Veuillez remplir les champs";
        }
    }
}

$select = $pdo->prepare("SELECT * FROM Article WHERE ID = $ID");
$select->execute();
$data = $select->fetch();

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
    </div>
    <?php
    if (isset($error)) {
        echo "<p style='color:red'>$error</p>";
    }
    ?>

</body>

</html>