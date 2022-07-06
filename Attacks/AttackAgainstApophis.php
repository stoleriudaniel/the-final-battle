<?php

class AttackAgainstApophis extends AttackAgainst{
	public function attack($attackerName, $warriors, $apophis, $playersAbilities, $warriorsKeys, &$warriorAvoidTheNextAttack, &$apophisAvoidTheNextAttack, $protectedWarriors){
		$damagePoints = 0;
		$warriorObj = NULL;
		foreach($warriors as $warrior){
			if(strcmp($warrior->getName(), $attackerName)==0){
				$warriorObj = $warrior;
			}
		}
		$randomAbilityName = $warriorObj->getRandomAbility();
		//var_dump("Warrior Ability:", $randomAbilityName);
		if($randomAbilityName != ''){
			if($randomAbilityName == 'criticalHit'){
				$damagePoints = $playersAbilities[$attackerName]->criticalHit($warriorObj->getAttackPoints());
				if($apophisAvoidTheNextAttack){
					$apophisAvoidTheNextAttack = false;
				}
				else {
					$warriorObj->attack($apophis, $damagePoints);
				}
				return;
			}
			else if($randomAbilityName == 'stun'){
				$warriorAvoidTheNextAttack = $playersAbilities[$attackerName]->stun();
				if($apophisAvoidTheNextAttack){
					$apophisAvoidTheNextAttack = false;
				}
				else {
					$warriorObj->attack($apophis);
				}
			}
			else if($randomAbilityName == 'heal'){
				$randomCharacterIndex = array_rand($warriorsKeys);
				$nameChosenToHeal = $warriorsKeys[$randomCharacterIndex];
				if($apophisAvoidTheNextAttack){
					$apophisAvoidTheNextAttack = false;
				}
				else {
					$warriorObj->attack($apophis);
				}
				$playersAbilities[$attackerName]->heal($nameChosenToHeal, $warriors);
			}
			else if($randomAbilityName == 'superHeal'){
				$playersAbilities[$attackerName]->superHeal($warriors);
				if($apophisAvoidTheNextAttack){
					$apophisAvoidTheNextAttack = false;
				}
				else {
					$warriorObj->attack($apophis);
				}
			}
			else if($randomAbilityName == 'dodge'){
				$warriorAvoidTheNextAttack = $playersAbilities[$attackerName]->dodge();
				if($apophisAvoidTheNextAttack){
					$apophisAvoidTheNextAttack = false;
				}
				else {
					$warriorObj->attack($apophis);
				}
			}
			else if($randomAbilityName == 'protect'){
				$protectedWarriors = $playersAbilities[$attackerName]->protect();
				if($apophisAvoidTheNextAttack){
					$apophisAvoidTheNextAttack = false;
				}
				else {
					$warriorObj->attack($apophis);
				}
			}
		}
		else {
			if($apophisAvoidTheNextAttack){
				$apophisAvoidTheNextAttack = false;
			}
			else {
				$warriorObj->attack($apophis);
			}
		}
	}
}