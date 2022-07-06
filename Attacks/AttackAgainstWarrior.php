<?php

class AttackAgainstWarrior extends AttackAgainst{
	public function attack($warriorAttackedName, $warriors, $apophis, $playersAbilities, &$warriorAvoidTheNextAttack, &$apophisAvoidTheNextAttack){
		$warriorObj = NULL;
		foreach($warriors as $warrior){
			if(strcmp($warrior->getName(), $warriorAttackedName)==0){
				$warriorObj = $warrior;
			}
		}
		$randomAbilityName = $apophis->getRandomAbility();
		//var_dump("Apophis Ability:", $randomAbilityName);
		if($randomAbilityName != ''){
			if($randomAbilityName == 'heal'){
				$playersAbilities['Apophis']->heal($apophis);
				if($warriorAvoidTheNextAttack){
					$warriorAvoidTheNextAttack = false;
				}
				else {
					$apophis->attack($warriorObj);
				}
			}
			else if($randomAbilityName == 'hide'){
				$apophisAvoidTheNextAttack = $playersAbilities['Apophis']->hide();
				if($warriorAvoidTheNextAttack){
					$warriorAvoidTheNextAttack = false;
				}
				else {
					$apophis->attack($warriorObj);
				}
			}
			else if($randomAbilityName == 'rage'){
				$playersAbilities['Apophis']->rage($warriors, $apophis->getAttackPoints());
			}
		}
		else {
			if($warriorAvoidTheNextAttack){
				$warriorAvoidTheNextAttack = false;
			}
			else {
				$apophis->attack($warriorObj);
			}
		}
	}
}