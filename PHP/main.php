<?php
include_once("../libs/nodebite-swiss-army-oop.php");

// $town = new SmallVillage("Small Town");

// var_dump($town);
// echo "<br>Set too high values<br>";
// $town->setFood(256);
// $town->setHappiness(1452);
// $town->setMoney(55555);
// $town->setEducation(1342342);
// $town->setMilitary(32498);
// $town->setPopulation(2344);
// var_dump($town);
// echo "<br>Set too low values<br>";
// $town->setFood(-256);
// $town->setHappiness(-1452);
// $town->setMoney(-55555);
// $town->setEducation(-1342342);
// $town->setMilitary(-32498);
// $town->setPopulation(-2344);
// var_dump($town);
// echo "<br>";

$testArray = array(
	1 => "dfgrdse",
	"super" => "Man",
	45 => 648,
	404 => "Not found. DERP!",
	"QWERTY" => 1234567
	);
var_dump($testArray);
echo "<br/>";
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}
echo "<hr/>";

$testArray = array(
	"food" => 30,
	"happiness" => 20,
	"money" => 10,
	"education" => 40,
	"military" => 50,
	"population" => 20
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testEffect = new Effect($testArray);
var_dump($testEffect);
echo "<hr/>";

?>