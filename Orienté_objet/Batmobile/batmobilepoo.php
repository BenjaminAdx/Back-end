<?php

// La classe Ennemi représente un ennemi avec sa position et ses points de vie
class Ennemi
{
    private $position;
    private $pv;

    // Le constructeur prend en paramètres la position et les points de vie de l'ennemi, et initialise les propriétés correspondantes
    public function __construct($position, $pv)
    {
        $this->position = $position;
        $this->pv = $pv;
    }

    // Cette méthode permet de récupérer la position de l'ennemi
    public function getPosition()
    {
        return $this->position;
    }

    // Cette méthode permet de récupérer les points de vie de l'ennemi
    public function getPv()
    {
        return $this->pv;
    }
}

// La classe BatMobile représente le véhicule du héros avec sa position
class BatMobile
{
    private $position;

    // Le constructeur prend en paramètre la position initiale du BatMobile et initialise la propriété $position correspondante
    public function __construct($position)
    {
        $this->position = $position;
    }

    // Cette méthode permet de déplacer le BatMobile à une nouvelle position donnée, et retourne la chaîne de déplacements nécessaires pour y arriver
    public function deplacer($nouvellePosition)
    {
        $nombreDeplacements = abs($nouvellePosition - $this->position);
        $deplacement = str_repeat('D', $nombreDeplacements);
        $this->position = $nouvellePosition;
        return $deplacement;
    }

    // Cette méthode permet d'attaquer un ennemi avec un nombre de coups calculé en fonction de ses points de vie, et retourne la chaîne de coups nécessaires pour le vaincre
    public function attaquer($ennemi)
    {
        $nombreCoup = ceil($ennemi->getPv() / 10);
        $coup = str_repeat('F', $nombreCoup);
        return $coup;
    }
}

$ennemis = ['x:14 pv:18', 'x:26 pv:33', 'x:9 pv:13', 'x:16 pv:33', 'x:29 pv:20'];
$ennemisObj = [];

// On crée des objets Ennemi à partir des données du tableau $ennemis
foreach ($ennemis as $ennemi) {
    [$position, $pv] = sscanf($ennemi, 'x:%d pv:%d');
    $ennemisObj[] = new Ennemi($position, $pv);
}

// On trie les ennemis par position croissante
usort($ennemisObj, function ($a, $b) {
    return $a->getPosition() - $b->getPosition();
});

$batMobile = new BatMobile(0);

foreach ($ennemisObj as $ennemi) {
    $deplacement = $batMobile->deplacer($ennemi->getPosition());
    $coup = $batMobile->attaquer($ennemi);
    echo $deplacement . $coup;
}
