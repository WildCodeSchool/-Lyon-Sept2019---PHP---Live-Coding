<?php

require_once "AbstractUnit.php";
require_once "WorkerInterface.php";
require_once "AttackInterface.php";

class Worker extends AbstractUnit implements WorkerInterface, AttackInterface
{
	public function __construct()
	{
		echo "Oui Monseigneur!";
	}

	public function work() : void
	{
		echo "Je travaille...";
	}

	public function attack() : void
	{
		echo "j'essaie d attaquer...";
	}
}