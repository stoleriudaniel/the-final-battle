<?php

require 'Characters/Character.php';
require 'Characters/Apophis.php';
require 'Characters/Warrior.php';

require 'Abilities/CharacterAbilities.php';
require 'Abilities/AchillasAbilities.php';
require 'Abilities/AnnipeAbilities.php';
require 'Abilities/ApophisAbilities.php';
require 'Abilities/WenneferAbilities.php';

require 'Attacks/AttackAgainst.php';
require 'Attacks/AttackAgainstApophis.php';
require 'Attacks/AttackAgainstWarrior.php';

require 'Game.php';

$game = new Game();

$game->start();

pr($game->getWarriors());

pr($game->getApophis());

var_dump("areAllWarriorsDead:  ", $game->areAllWarriorsDead());

var_dump("isApophisDead:  ", $game->isApophisDead());

function pr($data)
{
	echo "<pre>";
	print_r($data); // or var_dump($data);
	echo "</pre>";
}