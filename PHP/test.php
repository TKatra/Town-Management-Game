<?php
include_once("../libs/nodebite-swiss-army-oop.php");

echo "TEST LOOPING THROUGH ACCOSIATIVE ARRAY";
echo "<hr/>";

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
echo "TEST EFFECT CLASS";
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

$testArray = array(
	"food" => 293,
	"happiness" => 234,
	"money" => 2310,
	"education" => 195436,
	"military" => 5760,
	"population" => 2347
	);
$testEffect = new Effect($testArray);

foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}
var_dump($testEffect);
echo "<hr/>";

$testArray = array(
	"food" => -293,
	"happiness" => -234,
	"money" => -2310,
	"education" => -195436,
	"military" => -5760,
	"population" => -2347
	);
$testEffect = new Effect($testArray);

foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}
var_dump($testEffect);
echo "<hr/>";
echo "TEST CONDITION CLASS";
echo "<hr/>";

$testArray = array(
	"conditionType" => "highestOfPlayers",
	"statsType" => "food",
	"value" => 25
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testCondition = new Condition($testArray);
var_dump($testCondition);
echo "<hr/>";

$testArray = array(
	"conditionType" => "lowestOfPlayers",
	"statsType" => "happiness",
	"value" => 23454423
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testCondition = new Condition($testArray);
var_dump($testCondition);
echo "<hr/>";

$testArray = array(
	"conditionType" => "moreThanValue",
	"statsType" => "money",
	"value" => -3467
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testCondition = new Condition($testArray);
var_dump($testCondition);
echo "<hr/>";

$testArray = array(
	"conditionType" => "lessThanValue",
	"statsType" => "education",
	"value" => 0
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testCondition = new Condition($testArray);
var_dump($testCondition);
echo "<hr/>";

$testArray = array(
	"conditionType" => "highestOfPlayers",
	"statsType" => "military",
	"value" => "65"
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testCondition = new Condition($testArray);
var_dump($testCondition);
echo "<hr/>";

$testArray = array(
	"conditionType" => "lowestOfPlayers",
	"statsType" => "food",
	"value" => -54
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testCondition = new Condition($testArray);
var_dump($testCondition);
echo "<hr/>";
echo "TEST TOOL CARD CLASS";
echo "<hr/>";

$testArray = array(
	"title" => "Tool Card of DOOM",
	"description" => "A card that tests the tests of testing tests in this test.",
	"targetSelf" => true,
	"costEffect" => array(
		"food" => 3,
		"happiness" => 54,
		"money" => 45676,
		"education" => -234,
		"military" => 26,
		"population" => 32
		),
	"selfEffect" => array(
		"food" => 67,
		"happiness" => 51,
		"money" => 76,
		"education" => -62,
		"military" => 12,
		"population" => 75
		),
	"opponentEffect" => array(
		"food" => -234,
		"happiness" => 1,
		"money" => 65,
		"education" => -3456,
		"military" => 23435,
		"population" => 9
		)
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testToolCard = new ToolCard($testArray);
var_dump($testToolCard);
echo "<hr/>";
echo "TEST EVENT CARD CLASS";
echo "<hr/>";

$testArray = array(
	"title" => "Event Card that will shatter the world and stuff",
	"description" => "Another card sdöoifsfanfseoifhnsfoisnhfpaosifd.",
	"winCondition" => array(
		"conditionType" => "highestOfPlayers",
		"statsType" => "food",
		"value" => 0
		),
	"loseCondition" => array(
		"conditionType" => "lowestOfPlayers",
		"statsType" => "food",
		"value" => 0
		),
	"winEffect" => array(
		"food" => 3,
		"happiness" => 54,
		"money" => 45676,
		"education" => -234,
		"military" => 26,
		"population" => 32
		),
	"loseEffect" => array(
		"food" => 67,
		"happiness" => 51,
		"money" => 76,
		"education" => -62,
		"military" => 12,
		"population" => 75
		),
	"startupEffect" => array(
		"food" => -234,
		"happiness" => 1,
		"money" => 65,
		"education" => -3456,
		"military" => 23435,
		"population" => 9
		)
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testEventCard = new EventCard($testArray);
var_dump($testEventCard);
echo "<hr/>";
echo "TEST TOWN CLASS";
echo "<hr/>";

$testArray = array(
	"name" => "Test Town",
	"type" => "Farming village",
	"food" => 50,
	"happiness" => 40,
	"money" => 30,
	"education" => 10,
	"military" => 20
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testTown = new Town($testArray);
var_dump($testTown);
echo "<hr/>";
$testTown->setFood(213789);
$testTown->setHappiness(555);
$testTown->setMoney(1235);
$testTown->setEducation(875);
$testTown->setMilitary(436);
$testTown->setPopulation(334);
var_dump($testTown);
echo "<hr/>";
$testTown->setFood(-213789);
$testTown->setHappiness(-555);
$testTown->setMoney(-1235);
$testTown->setEducation(-875);
$testTown->setMilitary(-436);
$testTown->setPopulation(-334);
var_dump($testTown);
echo "<hr/>";
?>