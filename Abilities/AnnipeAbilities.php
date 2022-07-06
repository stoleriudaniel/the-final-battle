<?php

class AnnipeAbilities extends CharacterAbilities{
	public function dodge(){
		return true; //avoid the next attack
	}

	public function protect($warriorsKeys){
		$protectedWarriors = [];
		foreach($warriorsKeys as $warriorKey){
			$protectedWarriors[$warriorKey] = true;
		}
		return $protectedWarriors;
	}
}