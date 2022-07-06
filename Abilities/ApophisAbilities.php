<?php

class ApophisAbilities extends CharacterAbilities {
	public function rage($warriors, $normalDamagePoints){
		$newDamagePoints = $normalDamagePoints * 2;
		//dublam valoarea damage si o aplicam la toti luptatorii
		foreach($warriors as $warrior){
			$warriorDamage = $newDamagePoints - $warrior->getDefensePoints();
			if($warriorDamage < 0)
			{
				$warriorDamage = 0;
			}
			$warriorNewLifePoints = $warrior->getLifePoints() - $warriorDamage;

			if($warriorNewLifePoints < 0){
				$warriorNewLifePoints = 0;
			}

			$warrior->setLifePoints($warriorNewLifePoints);
			if($warrior->getLifePoints() <= 0){
				$warrior->setIsDead(true);
			}
		}
	}
	public function hide(){
		return true;
	}
	public function heal($apophis){
		//apophis se vindeca cu 25% din viata curenta
		$apophisCurrentHealthPoints = $apophis->getLifePoints();
		$newLifePoints = $apophisCurrentHealthPoints + ($apophisCurrentHealthPoints / 100) * 25;
		if($newLifePoints >= $apophis->getMaxLifePoints()){
			$apophis->setLifePoints($apophis->getMaxLifePoints());
		}
		else {
			$apophis->setLifePoints($newLifePoints);
		}
	}
}