<?php

class kohLanta
{
    private $thirst;
    private $hunger;
    private $shape;
    private $island;
    private $region;

    function __construct($thirst, $hunger, $shape, $island)
    {
        $this->thirst = $thirst;
        $this->hunger = $hunger;
        $this->shape = $shape;
        $this->island = $island;
    }

    public function getCutTab()
    {
        $this->region = array_shift($this->island);
    }
    public function getNombreCase()
    {
        return strlen($this->region);
    }
    public function getWater()
    {
        return substr_count($this->region, 'W');
    }
    public function getFood()
    {
        return substr_count($this->region, 'F');
    }
    public function getForm3()
    {
        return substr_count($this->region, '_');
    }
    public function getNewThirst()
    {
        return $this->thirst + $this->getWater();
    }
    public function getNewHunger()
    {
        return $this->hunger + $this->getFood();
    }
    public function getNewShape()
    {
        return floor(($this->shape - ($this->getForm3() * 3 + ($this->getNombreCase() - $this->getForm3()))) + (($this->getNewThirst() + $this->getNewHunger()) / 2));
    }

    public function survivorGame()
    {
        while (count($this->island) > 0) {
            if ($this->thirst == 0 || $this->hunger == 0 || $this->shape == 0) {
                echo "Game over" . " thirst: " . $this->thirst . " hunger: " . $this->hunger . " shape: " . $this->shape;
                exit;
            } else {
                $this->getCutTab();
                $this->getWater();
                $this->getFood();
                $this->getForm3();
                $this->getNewThirst();
                $this->getNewHunger();
                $this->getNewShape();
                $this->shape = $this->getNewShape();
                $this->thirst = $this->getNewThirst() - 5;
                $this->hunger = $this->getNewHunger() - 5;

                echo "à la fin de la nuit voici les nouvelles thirt: " . $this->thirst . " hunger: " . $this->hunger . " shape: " . $this->shape . "<br>";
            }
        }
        echo "Bravo tu as terminé thirst:" . $this->thirst . " hunger: " . $this->hunger . " shape: " . $this->shape;
    }
}

$thirst = 19;
$hunger = 17;
$shape = 59;
$island = [
    'ZTTWF_WWTRA_', 'YRAFWWF', 'YWTYRYAWF', 'FZFAZWFA', 'WAFWTA_',
    'WRWZFYAYWEEF', 'TZYTZTEZF_R'
];

$kohLanta = new kohLanta($thirst, $hunger, $shape, $island);

$kohLanta->survivorGame();
