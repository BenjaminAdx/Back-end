<?php
class Produit {
	// Propriétés
	public $var1;
	protected $var2;
	private $var3;
	
	// Méthodes magiques Construct
	public function __construct($var01, $var02, $var03) {
		//echo 'Objet produit construit<br>';
		$this->var1 = $var01;
		$this->var2 = $var02;
		$this->var3 = $var03;
	}
	
	// Méthode Getter
	public function getVar3() {
		return $this->var3;
	}
	
	// Méthodes magiques Destruct
	public function __destruct() {
		echo 'Objet produit détruit';
	}
}

class Produit2 extends Produit {
	
	public $var4;
	
	public function __construct($var01, $var02, $var03, $var04) {
		parent::__construct($var01, $var02, $var03);
		
		echo '<hr>' . $this->var2 . '<hr>';
		
		$this->var4 = $var04;
	}
	
	static public function hello() {
		echo '<h2>CLASS: '.__CLASS__.'</h2>';
		echo '<h2>DIR: '.__DIR__.'</h2>';
		echo '<h2>FUNCTION: '.__FUNCTION__.'</h2>';
		echo '<h2>FILE: '.__FILE__.'</h2>';
		echo '<h2>LINE: '.__LINE__.'</h2>';
		echo '<h2>METHOD: '.__METHOD__.'</h2>';
		
	}
	
	public function test() {
		self::hello();
	}
	
	
}

class Produit3 extends Produit2 {

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Programmation Orientée Objet</title>
</head>
<body>
	<h1>Programmation Orientée Objet</h1>
	
	<?php
		
		Produit2::hello();
		
		
		
		$produit = new Produit2(10,20,30,40);
		
		$produit->test();
		
		echo gettype($produit) . '<hr>';
		echo '<pre>';
		print_r($produit);
		echo '</pre>';
		echo $produit->var1 . '<br>';
		//echo $produit->var2 . '<br>';
		echo $produit->getVar3() . '<br>';
		echo $produit->var4 . '<br>';
	?>
	
	
	<p>Ceci est un <br>paragraphe</p>
	<p>Ceci est un autre paragraphe</p>

</body>
</html>