<?php

class Game {
	private $warriorsKeys;
	private $warriors;
	private $apophis;
	private $playersAbilities = [];
	private $warriorAvoidTheNextAttack = false;
	private $apophisAvoidTheNextAttack = false;
	private $protectedWarriors = [];
	// private AttackAgainst $attackAgainstApophis;
	// private AttackAgainst $attackAgainstWarrior;
	public function init(){
		$this->warriorsKeys = ['Achillas', 'Wennefer', 'Anippe'];

		$this->warriors = [];
		//new Warrior($name, $lifePoints = 0, $defensePoints = 0, $attackPoints = 0, $maxLifePoints, $abilities = []);
		$this->warriors[] = new Warrior('Achillas', 4096, 128, 384, 4096, ['criticalHit' => 10, 'stun' => 5]);
		$this->warriors[] = new Warrior('Wennefer', 3072, 128, 128, 3072, ['heal' => 10, 'superHeal' => 5]);
		$this->warriors[] = new Warrior('Anippe', 2048, 64, 256, 2048, ['dodge' => 12, 'protect' => 5]);

		//new Apophis($lifePoints = 0, $defensePoints = 0, $attackPoints = 0, $maxLifePoints, $abilities = []);
		$this->apophis = new Apophis(9216, 256, 384, 9216, ['rage' => 10, 'hide' => 10, 'heal' => 5]);

		$this->playersAbilities = [];
		$this->playersAbilities['Achillas'] = new AchillasAbilities();
		$this->playersAbilities['Wennefer'] = new WenneferAbilities();
		$this->playersAbilities['Anippe'] = new AnnipeAbilities();
		$this->playersAbilities['Apophis'] = new ApophisAbilities();

		$this->attackAgainstApophis = new AttackAgainstApophis();
		$this->attackAgainstWarrior = new AttackAgainstWarrior();
	}

	function __construct(){
		$this->init();
	}

	public function getWarriors(){
		return $this->warriors;
	}

	public function getApophis(){
		return $this->apophis;
	}
	//start joc
	public function start(){
		$currentAtacker = rand(1,2); // Warrior = 1, Appophis = 2
			while(!$this->endGame()){ // daca Apophis nu e mort si nici luptatorii nu sunt morti
				$warriorWithLife = $this->getRandomWarriorWithLife(); //alegem un warrior random care sa atace sau sa fie atacat de Apophis
				if($currentAtacker == 1){ //ataca warrior;
					$this->attackApophis($warriorWithLife->getName());
				}
				else if($currentAtacker == 2){ // ataca Apophis
					$this->attackWarrior($warriorWithLife->getName());
				}
				$currentAtacker = 3 - $currentAtacker;
			}
	}

	public function getRandomWarriorWithLife(){
		//alegem un warrior care este in viata
		$foundWarriorWithLife = false;
		$warriorsCount = count($this->warriors);
		$warriorFound = null;
		while(!$foundWarriorWithLife){
			$randomIndex = rand(0, $warriorsCount - 1);
			if($this->warriors[$randomIndex]->getIsDead() == false){
				$warriorFound = $this->warriors[$randomIndex];
				$foundWarriorWithLife = true;
			}
		}
		return $warriorFound;
	}

	public function areAllWarriorsDead(){
		foreach($this->warriors as $warrior){
			if($warrior->getIsDead() == false){
				return false;
			}
		}
		return true;
	}

	public function isApophisDead(){
		return $this->apophis->getIsDead();
	}

	public function endGame(){
		return $this->areAllWarriorsDead() || $this->isApophisDead();
	}

	public function attackApophis($attackerName){ //parametrul este numele luptatorului care face atacul
		$this->attackAgainstApophis->attack($attackerName, $this->warriors, $this->apophis, $this->playersAbilities, $this->warriorsKeys, $this->warriorAvoidTheNextAttack, $this->apophisAvoidTheNextAttack, $this->protectedWarriors);
	}

	public function attackWarrior($warriorAttackedName){ //parametrul este numele luptatorului care sa fie atacat de Apophis
		$this->attackAgainstWarrior->attack($warriorAttackedName, $this->warriors, $this->apophis, $this->playersAbilities, $this->warriorAvoidTheNextAttack, $this->apophisAvoidTheNextAttack);
	}
}