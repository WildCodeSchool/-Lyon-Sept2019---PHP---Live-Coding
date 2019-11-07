<?php

require_once "AbstractUnit.php";
require_once "AttackInterface.php";

class Soldier extends AbstractUnit implements AttackInterface
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