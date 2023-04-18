<?php

/* interface voiture
{
    public function rouler(): string;
    public function klaxonner(): string;
}

class Bmw implements voiture
{
    public function rouler(): string
    {
        return "la voiture roule";
    }
    public function klaxonner(): string
    {
        return "la voiture claxonne";
    }
} */

class Personnage
{
    public int $vie = 100;
    protected string $prenom;
    public int $atk = 20;

    public function __construct($prenom)
    {
        $this->prenom = $prenom;
    }

    public function coupdepoing(Personnage $personnage)
    {
        $personnage->vie -= $this->atk;
    }

    public function supersaiyan()
    {
        $this->atk += 60;
        echo "l'attaque est boosté à 80! <br>";
    }

    public function direBonjour(Personnage $personnage)
    {
        echo "Bonjour " . $personnage->prenom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom(string $param)
    {
        return $this->prenom = $param;
    }
}

class ennemy extends Personnage
{
    public string $pouvoir = "feu";

    public function getPrenomEnnemy()
    {
        echo $this->prenom;
    }

    public function direBonjour(Personnage $personnage)
    {
        echo "Hello " . $personnage->prenom;
    }
}

$vegeta = new Personnage("vegeta");
$goku = new Personnage("goku");
$freezer = new Ennemy("freezer");

$freezer->getPrenomEnnemy();

echo $vegeta->vie . "<br>";
$goku->coupdepoing($vegeta);
echo $vegeta->vie . "<br>";
$goku->supersaiyan();
$goku->coupdepoing($vegeta);
echo $vegeta->vie . "<br>";

// ---------------------------------------------------------------------------


// class static
// class Personnage {

//         public static int $vie = 100;
//         protected static string $prenom;
//         public static int $atk = 20;
//         const DBNAME = "database";

//         public static function getPrenom(){
            
//             echo self::$prenom;
//         }

// }


// echo Personnage::DBNAME;

// $vegeta = new Personnage();
// $vegeta::DBNAME;