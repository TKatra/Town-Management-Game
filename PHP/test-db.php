<?php
include_once("../libs/nodebite-swiss-army-oop.php");

$connectInfo =array(
  "host" => "127.0.0.1",
  "dbname" => "wu14oop2",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "saves"
  );

$PDOHelper = new PDOHelper($connectInfo["host"], $connectInfo["dbname"], $connectInfo["username"], $connectInfo["password"]);
$ds = new DBObjectSaver($connectInfo);

if (!isset($ds->players))
{
  $ds->players = array();
}

if (!isset($ds->world))
{
  $ds->world = array();
}

echo"<hr/>";
echo "TEST GETTING TOWNS FROM DB";
echo"<hr/>";

$query = "SELECT * FROM Towns ";
$DBData = $PDOHelper->query($query);
var_dump($DBData);

echo "<hr/>";
echo "ASSOCIATIVE ARRAY";
echo "<hr/>";

foreach ($DBData as $key => $value)
{
	echo("[".$key."] = ".$value["type"]);
	echo "<br/>";
}
echo"<hr/>";
echo "STANDARD ARRAY";
echo"<hr/>";

for ($i = 0; $i < count($DBData); $i ++) 
{
	echo("[".$i."] = ".$DBData[$i]["type"]);
	echo "<br/>";
}

echo"<hr/>";
echo"TEST CREATING TOWNS";
echo"<hr/>";

$DBTownData = $PDOHelper->query("SELECT * FROM Towns");
$DBTownNames = $PDOHelper->query("SELECT * FROM TownNames");


$towns = array();
$tempTown;
for ($i = 0; $i < count($DBTownData); $i ++) 
{
	$randomIndex = mt_rand(0, count($DBTownNames) -1);
	$DBTownData[$i]["name"] = $DBTownNames[$randomIndex]["name"];
	unset($DBTownNames[$randomIndex]);
	$DBTownNames = array_values($DBTownNames);

	// $tempTown = new Town($DBTownData[$i]);
	$towns[] = new Town($DBTownData[$i]);
}
var_dump($towns);
echo "<hr/>";
for ($i = 0; $i < count($towns); $i ++) 
{
	echo("[".$i."] = ".$towns[$i]->getName()." the ".$towns[$i]->getType());
	echo "<br/>";
}



echo"<hr/>";
echo"TEST CREATING PLAYERS";
echo"<hr/>";

$DBPlayerNames = $PDOHelper->query("SELECT * FROM PlayerNames");

$players = array();

$randomTownIndex = mt_rand(0, count($towns) -1);

$tempPlayer = new Player("Hiero", $towns[$randomTownIndex]);
$players[] = $tempPlayer;

unset($towns[$randomTownIndex]);
$towns = array_values($towns);

for ($i = 0; $i < 2; $i++) 
{
	$randomNameIndex = mt_rand(0, count($DBPlayerNames) -1);
	$randomTownIndex = mt_rand(0, count($towns) -1);

	$tempTown = $towns[$randomTownIndex];
	$tempPlayer = new ComputerPlayer($DBPlayerNames[$randomNameIndex]["name"], $tempTown);
	$players[] = $tempPlayer;

	unset($DBPlayerNames[$randomNameIndex]);
	$DBPlayerNames = array_values($DBPlayerNames);
	unset($towns[$randomTownIndex]);
	$towns = array_values($towns);
}

var_dump($players);

echo"<hr/>";


for ($i = 0; $i < count($players); $i ++) 
{
	echo("[".$i."] = ".$players[$i]->getName()." the mayor of ".$players[$i]->getTown()->getName()." the ".$players[$i]->getTown()->getType());
	echo "<br/>";
}

echo "<hr/>";
echo "TEST CREATING TOOL CARDS";
echo "<hr/>";

$DBToolCards = $PDOHelper->query("SELECT * FROM ToolCards");
var_dump($DBToolCards);

echo "<hr/>";

$toolCards = array();

for ($i = 0; $i < count($DBToolCards); $i++)
{
	// $tempToolCard;

	$query = "SELECT Effects.* 
	FROM ToolCards, Effects 
	WHERE ToolCards.costEffectID = Effects.ID AND ToolCards.ID = ".($i + 1).";";
	// var_dump($query);

	$DBTempArray = $PDOHelper->query($query);
	$DBToolCards[$i]["costEffect"] = $DBTempArray[0];

	$query = "SELECT Effects.* 
	FROM ToolCards, Effects 
	WHERE ToolCards.selfEffectID = Effects.ID AND ToolCards.ID = ".($i + 1).";";

	$DBTempArray = $PDOHelper->query($query);
	$DBToolCards[$i]["selfEffect"] = $DBTempArray[0];

	$query = "SELECT Effects.* 
	FROM ToolCards, Effects 
	WHERE ToolCards.opponentEffectID = Effects.ID AND ToolCards.ID = ".($i + 1).";";

	$DBTempArray = $PDOHelper->query($query);
	$DBToolCards[$i]["opponentEffect"] = $DBTempArray[0];

	// var_dump($DBToolCards[$i]);

	$tempToolCard = new ToolCard($DBToolCards[$i]);
	// var_dump($tempToolCard);

	$toolCards[] = $tempToolCard;
	$toolCards[] = $tempToolCard;
}

var_dump($toolCards);

echo "<hr/>";
echo "TEST CREATING EVENT CARDS";
echo "<hr/>";

$DBEventCards = $PDOHelper->query("SELECT * FROM EventCards");
var_dump($DBEventCards);

echo "<hr/>";



$eventCards = array();
// var_dump($DBEventCards[0]["title"]);
for ($i = 0; $i < count($DBEventCards); $i++)
{

	// $tempToolCard;

	$query = "SELECT Conditions.* 
	FROM EventCards, Conditions 
	WHERE EventCards.winConditionID = Conditions.ID AND EventCards.ID = ".($i + 1).";";
	// var_dump($query);

	$DBTempArray = $PDOHelper->query($query);
	// var_dump($DBTempArray[0]);
	$DBEventCards[$i]["winCondition"] = $DBTempArray[0];

	$query = "SELECT Conditions.* 
	FROM EventCards, Conditions 
	WHERE EventCards.loseConditionID = Conditions.ID AND EventCards.ID = ".($i + 1).";";

	$DBTempArray = $PDOHelper->query($query);
	$DBEventCards[$i]["loseCondition"] = $DBTempArray[0];

	$query = "SELECT Effects.* 
	FROM EventCards, Effects 
	WHERE EventCards.winEffectID = Effects.ID AND EventCards.ID = ".($i + 1).";";

	$DBTempArray = $PDOHelper->query($query);
	$DBEventCards[$i]["winEffect"] = $DBTempArray[0];


	$query = "SELECT Effects.* 
	FROM EventCards, Effects 
	WHERE EventCards.loseEffectID = Effects.ID AND EventCards.ID = ".($i + 1).";";

	$DBTempArray = $PDOHelper->query($query);
	$DBEventCards[$i]["loseEffect"] = $DBTempArray[0];


	$query = "SELECT Effects.* 
	FROM EventCards, Effects 
	WHERE EventCards.startupEffectID = Effects.ID AND EventCards.ID = ".($i + 1).";";

	$DBTempArray = $PDOHelper->query($query);
	$DBEventCards[$i]["startupEffect"] = $DBTempArray[0];

	// var_dump($DBToolCards[$i]);

	
	// var_dump($tempToolCard);

	$tempEventCard = new EventCard($DBEventCards[$i]);
	$eventCards[] = $tempEventCard;
}

var_dump($eventCards);
echo "<hr/>";
echo "TEST TO CREATE WORLD";
echo "<hr/>";

$world = new World($players, $toolCards, $eventCards);
var_dump($world);

echo "<hr/>";
echo "TEST SORTING DIFFERENT CARDS";
echo "<hr/>";
echo "TOOL CARDS: NOT SORTED";
echo "<hr/>";

echo "Tool Deck";
echo "<br/>";

$testArray = $world->getToolDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Tool Discard Deck";
echo "<br/>";

$testArray = $world->getToolDiscardPile();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";
echo "TOOL CARDS: SORTED";
echo "<hr/>";

$world->sortToolDeck();

echo "Tool Deck";
echo "<br/>";

$testArray = $world->getToolDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Tool Discard Deck";
echo "<br/>";

$testArray = $world->getToolDiscardPile();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";
echo "EVENT CARDS: NOT SORTED";
echo "<hr/>";

echo "Event Deck";
echo "<br/>";

$testArray = $world->getEventDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Event Discard Deck";
echo "<br/>";

$testArray = $world->getEventDiscardPile();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";
echo "EVENT CARDS: SORTED";
echo "<hr/>";

echo "Event Deck";
echo "<br/>";

$world->sortEventDeck();

$testArray = $world->getEventDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Event Discard Deck";
echo "<br/>";

$testArray = $world->getEventDiscardPile();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";
echo "TEST DEALING TOOL CARDS";
echo "<hr/>";

echo "Tool Deck";
echo "<br/>";

$testArray = $world->getToolDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Tool Discard Deck";
echo "<br/>";

$testArray = $world->getToolDiscardPile();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";
echo "BEFORE DEAL";
echo "<hr/>";

echo "Tool Deck";
echo "<br/>";

$testArray = $world->getToolDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Tool Discard Deck";
echo "<br/>";

$testArray = $world->getToolDiscardPile();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

$testArray = $world->getPlayers();
for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getName());
	echo "<br/>";
	echo "Tool Cards";
	echo "<br/>";
	$tempToolCards = $testArray[$i]->getToolCards();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "Discard Pile";
	echo "<br/>";
	$tempToolCards = $testArray[$i]->getDiscardPile();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
}

echo "<hr/>";
echo "AFTER DEAL";
echo "<hr/>";

$world->dealToolCards();

echo "Tool Deck";
echo "<br/>";

$testArray = $world->getToolDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Tool Discard Deck";
echo "<br/>";

$testArray = $world->getToolDiscardPile();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";

$testPlayerArray = $world->getPlayers();
for ($i = 0; $i < count($testPlayerArray); $i++)
{ 
	echo("[".$i."] = ".$testPlayerArray[$i]->getName());
	echo "<br/>";
	echo "Tool Cards";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getToolCards();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "Discard Pile";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getDiscardPile();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getName());
		echo "<br/>";
	}
	echo "<hr/>";
}

// echo "<hr/>";
echo "DISCARD FROM PLAYERS";
echo "<hr/>";

$testPlayerArray = $world->getPlayers();
for ($i = 0; $i < count($testPlayerArray); $i++)
{
	$tempToolCards = $testPlayerArray[$i]->getToolCards();

	if($i == 0)
	{
		$testPlayerArray[$i]->discardCard(0);
	}
	else if($i == 1)
	{
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
	}
	else if($i == 2)
	{
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
	}
}

echo "Tool Deck";
echo "<br/>";

$testArray = $world->getToolDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Tool Discard Deck";
echo "<br/>";

$testArray = $world->getToolDiscardPile();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";

$testPlayerArray = $world->getPlayers();
for ($i = 0; $i < count($testPlayerArray); $i++)
{ 
	echo("[".$i."] = ".$testPlayerArray[$i]->getName());
	echo "<br/>";
	echo "Tool Cards";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getToolCards();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "Discard Pile";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getDiscardPile();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "<hr/>";
}
 // echo "<hr/>";



$testPlayerArray = $world->getPlayers();
for ($i = 0; $i < count($testPlayerArray); $i++)
{ 
	$world->fetchDiscardedCards($i);
	echo("[".$i."] = ".$testPlayerArray[$i]->getName());
	echo "<br/>";
	echo "Tool Cards";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getToolCards();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "Discard Pile";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getDiscardPile();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "<hr/>";
}

echo "Tool Deck";
echo "<br/>";

$testArray = $world->getToolDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Tool Discard Deck";
echo "<br/>";

$testArray = $world->getToolDiscardPile();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";

$world->dealToolCards();

echo "Tool Deck";
echo "<br/>";

$testArray = $world->getToolDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Tool Discard Deck";
echo "<br/>";

$testArray = $world->getToolDiscardPile();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";

$testPlayerArray = $world->getPlayers();
for ($i = 0; $i < count($testPlayerArray); $i++)
{ 
	echo("[".$i."] = ".$testPlayerArray[$i]->getName());
	echo "<br/>";
	echo "Tool Cards";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getToolCards();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "Discard Pile";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getDiscardPile();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "<hr/>";
}


$testPlayerArray = $world->getPlayers();
for ($i = 0; $i < count($testPlayerArray); $i++)
{
	$tempToolCards = $testPlayerArray[$i]->getToolCards();

	if($i == 0)
	{
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
	}
	else if($i == 1)
	{
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
	}
	else if($i == 2)
	{
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
		$testPlayerArray[$i]->discardCard(0);
	}
}


echo "<hr/>";

$testPlayerArray = $world->getPlayers();
for ($i = 0; $i < count($testPlayerArray); $i++)
{ 
	echo("[".$i."] = ".$testPlayerArray[$i]->getName());
	echo "<br/>";
	echo "Tool Cards";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getToolCards();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "Discard Pile";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getDiscardPile();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}

	$world->fetchDiscardedCards($i);
	echo "<hr/>";
}



echo "Tool Deck";
echo "<br/>";

$testArray = $world->getToolDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Tool Discard Deck";
echo "<br/>";

$testArray = $world->getToolDiscardPile();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";

$testPlayerArray = $world->getPlayers();
for ($i = 0; $i < count($testPlayerArray); $i++)
{ 
	echo("[".$i."] = ".$testPlayerArray[$i]->getName());
	echo "<br/>";
	echo "Tool Cards";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getToolCards();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "Discard Pile";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getDiscardPile();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "<hr/>";
}

echo "Tool Deck";
echo "<br/>";

$testArray = $world->getToolDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";
echo "DEAL ANOTHER ONE";
echo "<hr/>";

$world->dealToolCards();

echo "Tool Deck";
echo "<br/>";

$testArray = $world->getToolDeck();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "Tool Discard Deck";
echo "<br/>";

$testArray = $world->getToolDiscardPile();

for ($i = 0; $i < count($testArray); $i++)
{ 
	echo("[".$i."] = ".$testArray[$i]->getTitle());
	echo "<br/>";
}

echo "<hr/>";

$testPlayerArray = $world->getPlayers();
for ($i = 0; $i < count($testPlayerArray); $i++)
{ 
	echo("[".$i."] = ".$testPlayerArray[$i]->getName());
	echo "<br/>";
	echo "Tool Cards";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getToolCards();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "Discard Pile";
	echo "<br/>";
	$tempToolCards = $testPlayerArray[$i]->getDiscardPile();
	for ($j = 0; $j < count($tempToolCards); $j++)
	{
		echo("[".$j."] = ".$tempToolCards[$j]->getTitle());
		echo "<br/>";
	}
	echo "<hr/>";
}

echo "TAKE AN EVENT CARD";
echo "<hr/>";

$world->takeAnEventCard();
echo($world->getCurrentEventCard()->getTitle());

echo "<hr/>";
echo "RESTART WORLD AND START A ROUND";
echo "<hr/>";

$world = new World($players, $toolCards, $eventCards);
// var_dump($world->getCurrentEventCard());
// $world->endRound();


?>