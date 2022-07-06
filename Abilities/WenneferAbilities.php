<?php

class WenneferAbilities extends CharacterAbilities{
	public function heal($nameChosenToHeal, $warriors){
		foreach($warriors as $warrior){
			if($warrior->getName() == $nameChosenToHeal){
				$warriorCurrentHealthPoints = $warrior->getLifePoints();
				//crestem cu 25% viata curenta pentru un warrior random
				$newLifePoints = $warriorCurrentHealthPoints + ($warriorCurrentHealthPoints / 100) * 25;
				if($newLifePoints >= $warrior->getMaxLifePoints()){
					$warrior->setLifePoints($warrior->getMaxLifePoints());
				}
				else {
					$warrior->setLifePoints($newLifePoints);
				}
				return;
			}
		}
	}

	public function superHeal($warriors){
		foreach($warriors as $warrior){
				$warriorCurrentHealthPoints = $warrior->getLifePoints();
				//crestem cu 20% viata curenta
				$newLifePoints = $warriorCurrentHealthPoints + ($warriorCurrentHealthPoints / 100) * 20;
				if($newLifePoints >= $warrior->getMaxLifePoints()){
					$warrior->setLifePoints($warrior->getMaxLifePoints());
				}
				else {
					$warrior->setLifePoints($newLifePoints);
				}
		}
	}
}