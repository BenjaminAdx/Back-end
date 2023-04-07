<?php

require_once("bdd.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID = $_GET['id'];
    $req = $pdo->prepare("UPDATE Article SET ID_Moderation = 2 WHERE ID = $ID");
    $req->execute();
    header('Location: user.php');
}
