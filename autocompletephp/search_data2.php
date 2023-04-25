<?php

try {

    $pdo = new PDO("mysql:host=localhost;dbname=country", "root", "root");
} catch (PDOException $e) {

    echo $e->getMessage();
}

$search = $_POST["search"];
$select = $pdo->prepare("SELECT country_name FROM apps_countries WHERE country_name LIKE ? LIMIT 10");
$select->execute(array("%$search%"));
$responses = $select->fetchAll();
$data = array();
foreach ($responses as $response) {
    $data[] = $response["country_name"];
}

$json = json_encode($data, JSON_PRETTY_PRINT);
echo $json;
