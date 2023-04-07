<?php

session_start();

require_once("bdd.php");

if (isset($_POST["article"])) {
    if (!empty($_POST["title"]) && !empty($_POST["content"])) {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $ID = $_SESSION["ID"];
        var_dump($_FILES["image"]);
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
                $reqinsert = $pdo->prepare('INSERT INTO Article (title, content, image, ID_User, date) VALUES (?,?,?,?,NOW())');
                $reqinsert->execute(array($title, $content, $image, $ID));
                header("Location: index.php");
            } else {
                $error = "Mauvaise extension d'image (.jpg, .png, .jpeg) ou taille trop volumineuse";
            }
        } else {

            $reqinsert = $pdo->prepare('INSERT INTO Article (title, content, ID_User, date) VALUES (?,?,?,NOW())');
            $reqinsert->execute(array($title, $content, $ID));
            header("Location: index.php");
        }
    } else {
        $error = "Veuillez remplir les champs";
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
    <h1>Créer votre article</h1>
    <div>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" id="title" placeholder="Titre" required><br>
            <textarea name="content" id="content" cols="30" rows="10"></textarea><br>
            <input type="file" name="image" id="image" placeholder="Upload de l'image de votre article"><br>
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