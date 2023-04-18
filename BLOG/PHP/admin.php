<?php
session_start();

require_once("bdd.php");

if (!isset($_SESSION["ID"]) || $_SESSION["ID_Role"] !== 3) {

    header("Location: deconnexion.php");
}

$select = $pdo->prepare("SELECT * FROM User");
$select->execute();
$data = $select->fetchAll();

$select2 = $pdo->prepare("SELECT * FROM Article");
$select2->execute();
$data2 = $select2->fetchAll();

$select3 = $pdo->prepare("SELECT * FROM Article_temp");
$select3->execute();
$data3 = $select3->fetchAll();

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

    <h1>Page Administrateur</h1>
    <p>Bienvenue</p>


</body>

</html>