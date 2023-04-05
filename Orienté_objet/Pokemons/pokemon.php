<?php
$types = [
    'Feu', 'Eau', 'Feu', 'Herbe', 'Feu', 'Eau', 'Feu', 'Glace', 'Feu', 'Eau', 'Eau', 'Herbe', 'Feu', 'Feu',
    'Insecte', 'Eau'
];

$pokemons = array_count_values($types);

$feu = $pokemons["Feu"];
$eau = $pokemons["Eau"];
$herbe = $pokemons["Herbe"];
$rare = array_sum($pokemons) - ($feu + $eau + $herbe);

echo "Le nombre de team possible est " . min($feu, $eau, $herbe, $rare);
