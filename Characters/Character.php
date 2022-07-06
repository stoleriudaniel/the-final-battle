<?php

interface Character{
	public function setLifePoints($lifePoints);
	public function setDefensePoints($defensePoints);
	public function setAttackPoints($attackPoints);
	public function setAbilities($abilities);

	public function attack(Character $character, $damagePoints);

	public function getName();
	public function getRandomAbility();

	public function getLifePoints();
	public function getDefensePoints();

	public function getIsDead();
	public function setIsDead($value);
}