<?php
include_once("../libs/nodebite-swiss-army-oop.php");

$town = new SmallVillage("Small Town");

var_dump($town);
echo "<br>Set too high values<br>";
$town->setFood(256);
$town->setHappiness(1452);
$town->setMoney(55555);
$town->setEducation(1342342);
$town->setMilitary(32498);
$town->setPopulation(2344);
var_dump($town);
echo "<br>Set too low values<br>";
$town->setFood(-256);
$town->setHappiness(-1452);
$town->setMoney(-55555);
$town->setEducation(-1342342);
$town->setMilitary(-32498);
$town->setPopulation(-2344);
var_dump($town);
echo "<br>";
?>