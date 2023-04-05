<?php
$thirst = 19;
$hunger = 17;
$shape = 59;
$island = [
    'ZTTWF_WWTRA_', 'YRAFWWF', 'YWTYRYAWF', 'FZFAZWFA', 'WAFWTA_',
    'WRWZFYAYWEEF', 'TZYTZTEZF_R'
];

while (count($island) > 0) {

    if ($thirst == 0 || $hunger == 0 || $shape == 0) {
        echo "Game over" . " thirst: " . $thirst . " hunger: " . $hunger . " shape: " . $shape;
        exit;
    } else {

        $region = array_shift($island);
        $nombreCase = strlen($region);
        $water = substr_count($region, 'W');
        $food = substr_count($region, 'F');
        $form3 = substr_count($region, '_');

        $newThirst = $thirst + $water;
        $newHunger = $hunger + $food;
        $newShape = floor(($shape - ($form3 * 3 + ($nombreCase - $form3))) + (($newThirst + $newHunger) / 2));

        $thirst = $newThirst - 5;
        $hunger = $newHunger - 5;
        $shape = $newShape;
        echo "à la fin de la nuit voici les nouvelles thirt: " . $thirst . " hunger: " . $hunger . " shape: " . $shape . "<br>";
    }
}

echo "Bravo tu as terminé thirst:" . $thirst . " hunger: " . $hunger . " shape: " . $shape;
