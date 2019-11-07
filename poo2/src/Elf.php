<?php

require_once "Unit.php";

class Elf extends Unit
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