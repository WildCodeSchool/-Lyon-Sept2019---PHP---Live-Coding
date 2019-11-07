<?php

require_once "AbstractUnit.php";

class Elf extends AbstractUnit
{
	public function __construct()
	{
		$this->setSpeed(5);
	}

	public function attack()
	{
		echo "A l'attaque!";
	}
}