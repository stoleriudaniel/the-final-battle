<?php

class Apophis implements Character{
	private $lifePoints;
	private $maxLifePoints;
	private $defensePoints;
	private $attackPoints;
	private $abilities;
	private $isDead;
	function __construct($lifePoints = 0, $defensePoints = 0, $attackPoints = 0, $maxLifePoints, $abilities = []){
		$this->lifePoints = $lifePoints;
		$this->defensePoints = $defensePoints;
		$this->attackPoints = $attackPoints;
		$this->abilities = $abilities;
		$this->maxLifePoints=$maxLifePoints;
		$this->isDead = false;
	}

	public function attack(Character $character, $damagePoints = 0){
		if($damagePoints == 0){
			//damage = attack - defense
			$damagePoints = $this->attackPoints - $character->getDefensePoints();
		}

		//daca atacul este un numar negativ, ne intoarcem
		if($damagePoints<0){
			return;
		}
		$newLifePoints = $character->getLifePoints() - $damagePoints;
		//daca viata da un numar negativ, setam pe 0
		if($newLifePoints < 0){
			$newLifePoints = 0;
		}
		$character->setLifePoints($newLifePoints);
		//daca viata este 0, setam variabila isDead pe true
		if($character->getLifePoints() <= 0){
			$character->setIsDead(true);
		}
	}

	public function setLifePoints($lifePoints){
		$this->lifePoints = $lifePoints;
	}

	public function setDefensePoints($lifePoints){
		$this->lifePoints = $lifePoints;
	}

	public function setAttackPoints($attackPoints){
		$this->attackPoints = $attackPoints;
	}

	public function setAbilities($abilities){
		$this->abilities = $abilities;
	}

	public function getRandomAbility(){
				//alegem o abilitate random
		//e posibil sa nu fie aleasa nicio abilitate

		/*
			Pentru a alege abilitatea, procedam in felul urmator:
			Construim un Array arrProbabilities
				De exemplu, pentru luptatorul Wennefer, Array-ul va arata astfel:
				$arrProbabilities = [ 10, 15, 100 ]
				abilitatea Heal este intre 0 si 10 (10 - 0 - 10, deci Heal are procentul de probabilitate 10%)
				abilitatea superHeal este intre  10 si 15 (15 - 10 - 5, deci Heal are procentul de probabilitate 5%)
				intre 15 si 100 nu avem nicio probabilitate
				100 - 15 = 85% deci probabilitate 85% sa nu fie aleasa nicio abilitate
			alegem un numar random de la 0 la 99
			daca numarul random este < 10, atunci este Heal
			altfel, daca numarul random este intre 10 si < 15, atunci este superHeal
			altfel, daca numarul random este intre intre 15 si < 100, nu se alege abilitate
		*/
		$arrProbabilities = [];
		$firstIteration = true;
		$percentagesSum = 0;
		foreach($this->abilities as $abilityName => $percentage){
			$percentagesSum += $percentage;
			if($firstIteration){
				$arrProbabilities[] = $percentage;
				$firstIteration = false;
				continue;
			}
			$arrProbabilities[] = $percentage + $arrProbabilities[count($arrProbabilities) - 1];
		}
		$arrProbabilities[] = 100; //100%
		$randomNumber = rand(1,100);
		$chosenAbility = '';
		if($randomNumber > $percentagesSum){ // Daca nu a fost aleasa abilitatea,
			return $chosenAbility; // return ''; 
		}
		for($index=0; $index < count($arrProbabilities) - 2; $index++){
			if($randomNumber <= $arrProbabilities[$index]){
				$chosenAbility = array_keys($this->abilities)[$index];
				break;
			}
		}
		return $chosenAbility;
	}

	public function getLifePoints(){
		return $this->lifePoints;
	}

	public function getDefensePoints(){
		return $this->defensePoints;
	}

	public function getName(){
		return 'Apophis';
	}

	public function getMaxLifePoints(){
		return $this->maxLifePoints;
	}

	public function getAttackPoints(){
		return $this->attackPoints;
	}

	public function getIsDead(){
		return $this->isDead;
	}

	public function setIsDead($value){
		$this->isDead = $value;
	}
}