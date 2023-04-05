<?php

// J'inclue mon fichier contant la classe Database
require 'database.php';

// Rend visible dans cette page ma classe Database
use SYRADEV\Utils\DB\Database;

// Je décalre une variable objet de type PDO : $db
$db = Database::getInstance();

// Je déclare un variable $resultat qui va stocker l'exécution de la requête SQL Select.
// On utilisera ici la méthde requête uniquement pour du Select.
$resultat = $db->requete('SELECT * FROM `technologies`');

// Affichage du résultat
echo '<pre>';
print_r($resultat);
echo '</pre>';