<?php
include_once("../libs/nodebite-swiss-army-oop.php");
//////////////////////////////////////////////////////
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
//////////////////////////////////////////////////////
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
//////////////////////////////////////////////////////
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
//////////////////////////////////////////////////////
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
//////////////////////////////////////////////////////
echo "TEST EVENT CARD CLASS";
echo "<hr/>";

$testArray = array(
	"title" => "Event Card that will shatter the world and stuff",
	"description" => "Another card sdsduyfgsuyfgsuyfgsusdfuygsdf.",
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
//////////////////////////////////////////////////////
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
//////////////////////////////////////////////////////
echo "TEST PLAYER CLASS";
echo "<hr/>";

$testArray = array(
	"name" => "Hiero's Town",
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

$testArray = array(
	"title" => "Unleash bookie monster",
	"description" => "Our hunters have captured a bookie monster. We can unleash it on one of our neighbours and have it eat their books.",
	"targetSelf" => false,
	"costEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => 0,
		"education" => 0,
		"military" => 0,
		"population" => 0
		),
	"selfEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => 0,
		"education" => 0,
		"military" => 0,
		"population" => 0
		),
	"opponentEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => 0,
		"education" => -30,
		"military" => 0,
		"population" => 0
		)
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testToolCard = new ToolCard($testArray);

$toolCardsArray = array();
$toolCardsArray[] = $testToolCard;

$testArray = array(
	"title" => "Sell food for money",
	"description" => "A merchant visiting our town want to buy some food from us and give us money in return.",
	"targetSelf" => true,
	"costEffect" => array(
		"food" => -20,
		"happiness" => 0,
		"money" => 0,
		"education" => 0,
		"military" => 0,
		"population" => 0
		),
	"selfEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => 20,
		"education" => 0,
		"military" => 0,
		"population" => 0
		),
	"opponentEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => 0,
		"education" => 0,
		"military" => 0,
		"population" => 0
		)
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testToolCard = new ToolCard($testArray);
$toolCardsArray[] = $testToolCard;

$testArray = array(
	"title" => "Burglar for hire",
	"description" => "There is a burglar that say he can steal money from one of our neighbours and bring some of it to you.",
	"targetSelf" => false,
	"costEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => -10,
		"education" => 0,
		"military" => 0,
		"population" => 0
		),
	"selfEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => 30,
		"education" => 0,
		"military" => 0,
		"population" => 0
		),
	"opponentEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => -30,
		"education" => 0,
		"military" => 0,
		"population" => 0
		)
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testToolCard = new ToolCard($testArray);
$toolCardsArray[] = $testToolCard;

$testArray = array(
	"title" => "Saboteur",
	"description" => "A man says that he can break things in a neighbouring town for you, if the pay is right.",
	"targetSelf" => false,
	"costEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => -40,
		"education" => 0,
		"military" => 0,
		"population" => 0
		),
	"selfEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => 0,
		"education" => 0,
		"military" => 0,
		"population" => 0
		),
	"opponentEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => 0,
		"education" => 0,
		"military" => 0,
		"population" => 0
		)
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testToolCard = new ToolCard($testArray);
$toolCardsArray[] = $testToolCard;

$testArray = array(
	"title" => "Festival",
	"description" => "We have the possibility to have a festival in our town. That should make the citizens happier.",
	"targetSelf" => true,
	"costEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => -30,
		"education" => 0,
		"military" => 0,
		"population" => 0
		),
	"selfEffect" => array(
		"food" => 0,
		"happiness" => 40,
		"money" => 0,
		"education" => 0,
		"military" => 0,
		"population" => 0
		),
	"opponentEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => 0,
		"education" => 0,
		"military" => 0,
		"population" => 0
		)
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testToolCard = new ToolCard($testArray);
$toolCardsArray[] = $testToolCard;

$testArray = array(
	"title" => "Stupid card",
	"description" => "This card is supposed to be broken to test if players can afford this, wich they should not.",
	"targetSelf" => true,
	"costEffect" => array(
		"food" => -100,
		"happiness" => -100,
		"money" => -300,
		"education" => -670,
		"military" => -430,
		"population" => -570
		),
	"selfEffect" => array(
		"food" => 0,
		"happiness" => 40,
		"money" => 0,
		"education" => 0,
		"military" => 0,
		"population" => 0
		),
	"opponentEffect" => array(
		"food" => 0,
		"happiness" => 0,
		"money" => 0,
		"education" => 0,
		"military" => 0,
		"population" => 0
		)
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testToolCard = new ToolCard($testArray);
$toolCardsArray[] = $testToolCard;

$testPlayer = new Player("Hiero", $testTown);
var_dump($testPlayer);
var_dump($toolCardsArray);
$testPlayer->addToolCards($toolCardsArray);
var_dump($testPlayer);

echo "<hr/>";
//////////////////////////////////////////////////////
echo "TEST USING TOOL CARDS";
echo "<hr/>";
$testArray = $testPlayer->getToolCards();

echo "On hand";
echo "<br/>";
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Discard pile";
echo "<br/>";
$testArray = $testPlayer->getDiscardPile();
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}
echo($testPlayer->useToolCard(4));
echo "<br/>";
var_dump($testPlayer->getTown());
echo "<hr/>";

$testArray = $testPlayer->getToolCards();

echo "On hand";
echo "<br/>";
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Discard pile";
echo "<br/>";
$testArray = $testPlayer->getDiscardPile();
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo($testPlayer->useToolCard(1));
echo "<br/>";
var_dump($testPlayer->getTown());
echo "<hr/>";
//////////////////////////////////////////////////////
echo "TEST REMOVING TOOL CARDS";
echo "<hr/>";

$testArray = $testPlayer->getToolCards();

echo "On hand";
echo "<br/>";
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Discard pile";
echo "<br/>";
$testArray = $testPlayer->getDiscardPile();
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";

$testPlayer->discardCard(1);
$testArray = $testPlayer->getToolCards();

echo "On hand";
echo "<br/>";
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Discard pile";
echo "<br/>";
$testArray = $testPlayer->getDiscardPile();
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";


$testPlayer->discardCard(1);
$testArray = $testPlayer->getToolCards();

echo "On hand";
echo "<br/>";
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Discard pile";
echo "<br/>";
$testArray = $testPlayer->getDiscardPile();
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";

$testPlayer->discardCard(0);
$testArray = $testPlayer->getToolCards();

echo "On hand";
echo "<br/>";
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Discard pile";
echo "<br/>";
$testArray = $testPlayer->getDiscardPile();
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";
echo "TEST CLEARING DISCARD PILE";
echo "<hr/>";
$testPlayer->clearDiscardPile();

$testArray = $testPlayer->getToolCards();

echo "On hand";
echo "<br/>";
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Discard pile";
echo "<br/>";
$testArray = $testPlayer->getDiscardPile();
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";
echo "TEST TARGETING OTHER PLAYER";
echo "<hr/>";

$testArray = array(
	"name" => "University of doom",
	"type" => "University town",
	"food" => 20,
	"happiness" => 30,
	"money" => 10,
	"education" => 50,
	"military" => 40
	);
foreach ($testArray as $key => $value)
{
	echo("[".$key."] = ".$value);
	echo "<br/>";
}

$testTown = new Town($testArray);

$otherPlayer = new Player("That Guy", $testTown);

$testPlayer->addToolCards($toolCardsArray);
$otherPlayer->addToolCards($toolCardsArray);

$testArray = $testPlayer->getToolCards();

echo ($testPlayer->getName()."On hand");
echo "<br/>";
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo ($testPlayer->getName()."Discard pile");
echo "<br/>";
$testArray = $testPlayer->getDiscardPile();
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

$testArray = $otherPlayer->getToolCards();

echo ($otherPlayer->getName()."On hand");
echo "<br/>";
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo ($otherPlayer->getName()."Discard pile");
echo "<br/>";
$testArray = $otherPlayer->getDiscardPile();
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

var_dump($testPlayer->getTown());
var_dump($otherPlayer->getTown());

echo "<hr/>";

$testPlayer->useToolCard(1, $otherPlayer);

$testArray = $testPlayer->getToolCards();

echo ($testPlayer->getName()."On hand");
echo "<br/>";
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo ($testPlayer->getName()."Discard pile");
echo "<br/>";
$testArray = $testPlayer->getDiscardPile();
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

$testArray = $otherPlayer->getToolCards();

echo ($otherPlayer->getName()."On hand");
echo "<br/>";
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo ($otherPlayer->getName()."Discard pile");
echo "<br/>";
$testArray = $otherPlayer->getDiscardPile();
for($i = 0; $i < count($testArray); $i++)
{
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

var_dump($testPlayer->getTown());
var_dump($otherPlayer->getTown());

echo "<hr/>";
echo "TEST REMOTE CARD REMOVING";
echo "<hr/>";



echo "<hr/>";

?>