<?php
$ennemis = ['x:14 pv:18', 'x:26 pv:33', 'x:9 pv:13', 'x:16 pv:33', 'x:29 pv:20'];

$ennemisBis = [];

foreach ($ennemis as $ennemi) {
    [$position, $pv] = sscanf($ennemi, 'x:%d pv:%d');
    $ennemisBis[$position] = $pv;
};

ksort($ennemisBis);

$positionBatMobile = 0;

foreach ($ennemisBis as $position => $pv) {
    $nombreDéplacements = $position - $positionBatMobile;
    $déplacementD = str_repeat('D', $nombreDéplacements);

    $positionBatMobile = $position;

    $nombreCoup = ceil($pv / 10);
    $coupF = str_repeat('F', $nombreCoup);

    $reponse .= $déplacementD . $coupF;
}
echo ($reponse);
