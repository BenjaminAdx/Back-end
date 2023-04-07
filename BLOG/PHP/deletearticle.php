<?php

require_once("bdd.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ID = $_GET['id'];
    $req = $pdo->prepare("DELETE FROM Article WHERE ID = $ID");
    $req->execute();
    header('Location: user.php');
}
