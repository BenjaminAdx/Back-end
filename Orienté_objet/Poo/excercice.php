<?php

class Civil
{
    protected int $argent;
    protected string $prenom;
    protected int $age;
    protected string $genre;

    public function __construct($argent, $prenom, $age, $genre)
    {
        $this->argent = $argent;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->genre = $genre;
    }

    public function direBonjour(Civil $civil)
    {
        echo $this->prenom . " dit Bonjour à " . $civil->prenom . "<br>";
    }

    public function marche()
    {
        echo $this->prenom . " marche <br>";
    }
}

class Employé extends Civil
{
    public function travaille()
    {
        echo $this->prenom . " travaille <br>";
    }

    public function rale()
    {
        echo $this->prenom . " rale <br>";
    }
}

class Patron extends Civil
{
    public function crier(Employé $employé)
    {
        echo $this->prenom . " crie sur " . $employé->prenom . "<br>";
    }
    public function donnerArgent(Employé $employé, $argent)
    {
        $this->argent -= $argent;
        $employé->argent += $argent;
        echo $this->prenom . " donne " . $argent . " à " . $employé->prenom . "<br>" . $employé->prenom . " à sur son compte " . $employé->argent;
    }
}

$mathieu = new Civil(100, "Mathieu", 25, "homme");
$wissem = new Employé(500, "Wissem", 23, "homme");
$zaid = new Patron(2500, "Zaid", 42, "homme");

$mathieu->marche();
$mathieu->direBonjour($wissem);
$wissem->travaille();
$wissem->rale();
$zaid->crier($wissem);
$zaid->donnerArgent($wissem, 200);
