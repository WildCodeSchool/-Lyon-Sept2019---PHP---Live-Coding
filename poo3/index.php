<?php

require_once "src/Elf.php";
require_once "src/Worker.php";
require_once "src/Soldier.php";
require_once "src/Army.php";

$worker = new Worker();
$soldier = new Soldier();


echo $soldier;
$soldier->walk('top', 5)->walk('right', 2);
echo $soldier;



$army = new Army();
$army->join($soldier);
echo $army;
$army->join($worker);
echo $army;