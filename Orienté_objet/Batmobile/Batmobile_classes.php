<?php

/*
On construit 3 classes : une classe Enemy pour récupérer la position et le nombre de vies 
d'un ennemi donné,
une classe Enemies pour récupérer le tableau des données initiales, et une classe Batmobile 
pour la déplacer et faire feu
*/


final class Enemy
{
	private int $position;
	private int $pv;

	//on ne traie pas un tableau, mais le string issu à un tout du tableau
	public function __construct(string $informations)
	{
		[$this->position, $this->pv] = sscanf($informations, 'x:%d pv:%d');
	}

	public function getPosition(): int
	{
		return $this->position;
	}

	public function getPv(): int
	{
		return $this->pv;
	}
}

final class Enemies
{
	private array $enemies;

	public function __construct(array $informations)
	{
		foreach ($informations as $enemy) {
			$this->enemies[] = new Enemy($enemy);
		}

		usort($this->enemies, [$this, 'sortEnemis']);
	}

	public function sortEnemis(Enemy $e1, Enemy $e2): int
	{
		return ($e1->getPosition() < $e2->getPosition()) ? -1 : 1;
	}

	public function getEnemies(): array
	{
		return $this->enemies;
	}
}

final class Batmobile
{
	// on crée une abstraction du problémé, ce qui permet par exemple d'avoir une batmobile 
	// qui enlèverait 5 ou 15 vies à chaque salve....

	private const INSTRUCTION_MOVE = 'D';
	private const INSTRUCTION_FIRE = 'F';
	private const POWER_FIRE = 10;

	private $position = 0;

	public function getInstructionsToMove(int $position): string
	{
		$distance = $position - $this->position;
		$this->move($distance);

		return str_repeat(
			self::INSTRUCTION_MOVE,
			$distance
		);
	}

	private function move(int $distance): void
	{
		$this->position += $distance;
	}

	public function getInstructionsToFire(int $pv): string
	{
		return str_repeat(
			self::INSTRUCTION_FIRE,
			ceil($pv / self::POWER_FIRE)
		);
	}
}



/*
Le code principal après avoir bati les classes....
*/

$ennemis = ['x:14 pv:18', 'x:26 pv:33', 'x:9 pv:13', 'x:16 pv:33', 'x:29 pv:20'];
$reponse = '';

$batmobile = new Batmobile;
$enemies = new Enemies($ennemis);

foreach ($enemies->getEnemies() as $enemy) {
	$reponse .= $batmobile->getInstructionsToMove($enemy->getPosition());
	$reponse .= $batmobile->getInstructionsToFire($enemy->getPv());
}

echo $reponse;
