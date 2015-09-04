<?php

class Morpion{
	private $grille;
	
	public function __construct($etatInitial){
		$this->grille = $etatInitial;
	}
 var $column = 0;	
	public function getColumn($a, $b){	
		global $column;
		$column = 0;
		$x = 0;
		$o = 0;
		for($i = 0; $i <= 2; $i++){

			if ($this->grille[$i][$b] == 'X'){
				$x = 1;
				if ($o == 1){
				$column = $column - 10;
				}
				else{
					$column = $column + 10;
				}
			}
			if ($this->grille[$i][$b] == 'O') {
				$o = 1;
				if ($x == 1){
				$column = $column - 10;
				}
				else {
				$column = $column + 15;
				}
			}
		}
	}	
var $line = 0;
	public function getLine($a, $b){
		global $line;
		$line = 0;
		$x = 0;
		$o = 0;
		for($i = 0; $i <= 2; $i++){
			if ($this->grille[$a][$i] == 'X'){
				$x = 1;
				if ($o == 1){
				$line = $line - 10;
				}
				else{
					$line = $line + 10;
				}
			}
			if ($this->grille[$a][$i] == 'O') {
				$o = 1;
				if ($x == 1){
				$line = $line - 10;
			}
			else {
				$line = $line + 15;
			}
			}

		}
	}
var $bestmove = -20;
var $c = 0;
var $l = 0;

		public function choix($a, $b){
			global $bestmove;
			global $line;
			global $column;
			global $c;
			global $l;
			global $n;
			global $diag;
			if (($line + $column + $diag) > $bestmove) {
				$bestmove = $line + $column + $diag;

				$c = $a;
				$l = $b;

			 	/* echo $c;
				echo $l;
				echo "</br>";
				echo $bestmove;
				echo "</br>";
				echo $line;
				echo "</br>";
				echo $column;
				echo "</br>";
				echo $diag;
				echo "</br>";
				echo "</br>"; */
		

			}
			if ($n >= 8) {
 		    $this->grille[$c][$l] = 'O';
			}
	}
	
var $diag = 0;	
	public function getDiag($x, $y){
		global $diag;
		$diag = 0;
		$diag1 = array(array(0,2), array(1,1), array(2,0));
		$diag2 = array(array(0,0), array(1,1), array(2,2));
		$diagone = array(
			'2/0' => array($diag1),
			'0/2' => array($diag1),
			'1/1' => array($diag1, $diag2)
		);
		$diagtwo = array(
			'0/0' => array($diag2),
			'2/2' => array($diag2),
			'1/1' => array($diag1, $diag2)
		);
		
		if(isset($diagone[$x.'/'.$y])){

			$n = 2;	
			$x = 0;
			$o = 0;
			if (isset($diagone[$x.'/'.$y])){
			for($i = 0; $i <= 2; $i++){			
			if ($this->grille[$i][$n] == 'X'){
				$x = 1;
				if ($o == 1){
				$diag = $diag - 10;
				}
				else{
					$diag = $diag + 10;
				}
			}
			if ($this->grille[$i][$n] == 'O') {
				$o = 1;
				if ($x == 1){
				$diag = $diag - 10;
			}
			else {
				$diag = $diag + 15;
			}

			}
			$n = $n - 1;
		}
		}
		if (isset($diagtwo[$x.'/'.$y])){
			$n = 0;	
			for($i = 0; $i <= 2; $i++){			
			if ($this->grille[$i][$n] == 'X'){
				$x = 1;
					if ($o == 1){
						$diag = $diag - 10;
					}
					else{
						$diag = $diag + 15;
					}
				}
			if ($this->grille[$i][$n] == 'O') {
				$o = 1;
					if ($x == 1){
						$diag = $diag - 10;
					}
					else {
						$diag = $diag + 15;
					}
				}
			$n++;
		}
		}
	}
}

	public function display(){
    echo "</br>";
for($i = 0; $i < 3; $i++){
	echo '<div class="line">';
		for($j = 0; $j < 3; $j++){
			$addedClass = '';
			if ($this->grille[$i][$j] !== null) {
				$addedClass = 'case'.$this->grille[$i][$j];
			}
			echo '<div class="cell '.$addedClass.'" id="'.$i.'-'.$j.'" onclick="javascript:play('.$i.','.$j.');">';
			if ($this->grille[$i][$j] == 'X') {
				echo "</br>";
				echo '<img src="ajax/img/X.png" >';
			}
			elseif ($this->grille[$i][$j] == 'O') {
				echo "</br>";
				echo '<img src="ajax/img/O.png" >';
			}
			echo '</div>';
			}

	echo '</div>';
}

	}
	
	public function win() {

		//Diagonale
		if ($this->grille[0][0] == 'O' && $this->grille[1][1] == 'O' && $this->grille[2][2] == 'O'){
			return true;
		}

		elseif ($this->grille[2][0] == 'O' && $this->grille[1][1] == 'O' && $this->grille[0][2] == 'O'){
			return true;
		}

		//Horizontale et verticale

		else {

			for ($a=0 ; $a<3 ; $a++){
				if ($this->grille[0][$a] == 'O' && $this->grille[1][$a] == 'O' && $this->grille[2][$a] == 'O'){
					return true;
				}
				elseif ($this->grille[$a][0] == 'O' && $this->grille[$a][1] == 'O' && $this->grille[$a][2] == 'O'){
					return true;
				}

			}
		}
	}


	public function defend() {
		if ($this->grille[0][0] == 'X' && $this->grille[1][1] == 'X' && $this->grille[2][2] == 'X'){
			return true;
		}
		elseif ($this->grille[2][0] == 'X' && $this->grille[1][1] == 'X' && $this->grille[0][2] == 'X'){
			return true;
		}
		else {
			for ($a=0 ; $a<3 ; $a++){
				if ($this->grille[0][$a] == 'X' && $this->grille[1][$a] == 'X' && $this->grille[2][$a] == 'X'){
					return true;
				}
				elseif ($this->grille[$a][0] == 'X' && $this->grille[$a][1] == 'X' && $this->grille[$a][2] == 'X'){
					return true;
				}
			}
		}
	}

	public function loose() {

		//Diagonale
		if ($this->grille[0][0] == 'X' && $this->grille[1][1] == 'X' && $this->grille[2][2] == 'X'){
			return true;
		}

		elseif ($this->grille[2][0] == 'X' && $this->grille[1][1] == 'X' && $this->grille[0][2] == 'X'){
			return true;
		}

		//Horizontale et verticale

		else {

			for ($a=0 ; $a<3 ; $a++){
				if ($this->grille[0][$a] == 'X' && $this->grille[1][$a] == 'X' && $this->grille[2][$a] == 'X'){
					return true;
				}
				elseif ($this->grille[$a][0] == 'X' && $this->grille[$a][1] == 'X' && $this->grille[$a][2] == 'X'){
					return true;
				}

			}
		}
	}

		public function tie() {

		//Diagonale
		if ($this->grille[0][0] != null && $this->grille[1][1] != null && $this->grille[2][2] != null &&
			 $this->grille[0][1] != null && $this->grille[0][2] != null && $this->grille[1][2] != null &&
			  $this->grille[1][0] != null && $this->grille[2][1] != null && $this->grille[2][0] != null){
			return true;
		}
	}

var $n = 0;
	public function getNextStep(){
		global $n;
		global $compteur;
      	$a = 0;
      	$b = -1;
      for ($n=0 ; $n<9 ; $n++) {
      	$b++;
      	if ($b > 2){
      		$a++;
      		$b = 0;
      	}

      	if ($this->loose() == true && $this->win() == false){
        echo "<h2>Victoire !</h2></br>";
        break;
        }
        if ($this->grille[$a][$b]== null) {
          $save = $this->grille[$a][$b];
          $this->grille[$a][$b] = 'O';
          	if ($this->win() == true){
          		$this->grille[$a][$b] = 'O';
          		echo "<h2>Défaite !</h2></br>";
          		break;
          	}
          	$this->grille[$a][$b] = 'X';
          	if ($this->defend() == true) {
          		$this->grille[$a][$b] = 'O';
          		break;
          	}

          	$this->grille[$a][$b] = null;
            $this->getLine($a, $b);
          	$this->getColumn($a, $b);
          	$this->getDiag($a, $b);
          	$this->choix($a, $b);
          }
          $this->choix($a, $b);
      }
        if (($this->win() == false && $this->loose() == false) && $this->tie() == true){
        echo "<h2>Egalité !</h2></br>";
        }


}

	public function game(){ 
	
			$this->getNextStep();
			$this->display();
		}
}
