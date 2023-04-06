<?php

try {

    $pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "root");
} catch (PDOException $e) {

    echo $e->getMessage();
}
