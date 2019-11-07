<?php

require_once "src/Elf.php";
require_once "src/Soldier.php";

$elf = new Elf();
$soldier = new Soldier();


echo $soldier;
$soldier->walk('top', 5)->walk('right', 2);
echo $soldier;
