<?php

require_once "Unit.php";

class Soldier extends Unit
{
	public function __construct()
	{
		$this->setSpeed(2);
		echo "Prêt à combattre!";
	}

	public function attack() : void
	{
		echo "A l'attaque!";	
	}
}