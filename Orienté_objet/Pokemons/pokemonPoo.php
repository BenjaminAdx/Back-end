<?php

class Pokemon
{
    private $types;

    public function __construct($types)
    {
        $this->types = $types;
    }

    public function count()
    {
        return array_count_values($this->types);
    }

    public function getFeu()
    {
        /* $pokemons = $this->count(); */
        return $this->count()["Feu"];
    }
    public function getEau()
    {
        /* $pokemons = $this->count(); */
        return $this->count()["Eau"];
    }
    public function getHerbe()
    {
        /* $pokemons = $this->count(); */
        return $this->count()["Herbe"];
    }
    public function getRare()
    {
        /* $pokemons = $this->count();
        $feu = $this->getFeu();
        $eau = $this->getEau();
        $herbe = $this->getHerbe(); */
        return array_sum($this->count()) - ($this->getFeu() + $this->getEau() + $this->getHerbe());
    }
    public function getNombreTeam()
    {
        /* $feu = $this->getFeu();
        $eau = $this->getEau();
        $herbe = $this->getHerbe();
        $rare = $this->getRare(); */
        return min($this->getFeu(), $this->getEau(), $this->getHerbe(), $this->getRare());
    }
}
$types = [
    'Feu', 'Eau', 'Feu', 'Herbe', 'Feu', 'Eau', 'Feu', 'Glace', 'Feu', 'Eau', 'Eau', 'Herbe', 'Feu', 'Feu',
    'Insecte', 'Eau'
];
$pokemon = new Pokemon($types);

echo "Le nombre de team possible est " . $pokemon->getNombreTeam();
