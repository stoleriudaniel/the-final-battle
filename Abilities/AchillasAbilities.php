<?php

class AchillasAbilities extends CharacterAbilities{
	public function criticalHit($currentAttackPoints){
		return $currentAttackPoints + $currentAttackPoints / 2;
	}

	public function stun(){
		return true;
	}

}