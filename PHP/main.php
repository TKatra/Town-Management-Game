<?php
include_once("../libs/nodebite-swiss-army-oop.php");

$connectInfo =array(
  "host" => "127.0.0.1",
  "dbname" => "wu14oop2",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "saves"
  );

$request = $_REQUEST;
$PDOHelper = new PDOHelper($connectInfo["host"], $connectInfo["dbname"], $connectInfo["username"], $connectInfo["password"]);
$ds = new DBObjectSaver($connectInfo);
$result = array();

// var_dump($ds->world[0]);
// die();

if($request["commandLine"] == "preGameBuild")
{
	resetValues();
	$ds->towns = getTownsData();
	$result["towns"] = $ds->towns;



	echo(json_encode($result));
	exit();
}
else if($request["commandLine"] == "startNewGame")
{
	// $request["playerSettings"]["playerName"];
	// $request["playerSettings"]["townName"];
	// $request["playerSettings"]["townIndex"];
	$townArray = $ds->towns[$request["playerSettings"]["townIndex"]];
	$townArray["name"] = $request["playerSettings"]["townName"];
	$newTown = new Town($townArray);

	// var_dump($newTown->toArray());
	// die();

	// $tempPlayer = new Player($request["playerSettings"]["name"], $townArray);
	$ds->players[] = new Player($request["playerSettings"]["playerName"], $newTown);

	unset($ds->towns[$request["playerSettings"]["townIndex"]]);
	$ds->towns = array_values($ds->towns);

	createComputerPlayers();

	startNewGame();
}
else if($request["commandLine"] == "useToolCard")
{
	// var_dump($request);
	// die();
	for ($i = 0; $i < count($ds->world[0]->getplayers()); $i++)
	{
		if(is_a($ds->world[0]->getplayers()[$i], "Player"))
		{
			var_dump($ds->world[0]->getplayers()[$i]->getToolCards()[$request["cardIndex"]]);
			die();
		}
	}
}

///////////////////////////////////////////////////////

function startNewGame()
{
	global $PDOHelper, $ds, $result;

	$toolDeck = createToolCards();
	$eventDeck = createEventCards();

	

	$ds->world[0] = new World($ds->players, $toolDeck, $eventDeck);



	startNewRound();
}

function startNewRound()
{
	global $PDOHelper, $ds, $result;

	$ds->world[0]->dealToolCards();
	$ds->world[0]->takeAnEventCard();

	// var_dump($ds->world[0]->toArray());
	// die();

	for ($i = 0; $i < count($ds->world[0]->getPlayerQueue()); $i++)
	{
		$ds->world[0]->activateEffect($ds->world[0]->getCurrentEventCard()->getStartupEffect(), $ds->world[0]->getplayers()[$i]);
	}

	$ds->world[0]->resetCurrentPlayerTurn();


	$result["world"] = $ds->world[0]->toArray();

	// var_dump($result);
	// die();

	echo(json_encode($result));
	exit();
}

function endTurn()
{
	global $PDOHelper, $ds, $result;

	$ds->world[0]->fetchDiscardedCards($ds->world[0]->getcurrentPlayerTurn());
	$ds->world[0]->nextPlayerTurn();

	if(!($ds->world[0]->getCurrentPlayerTurn() < count($ds->world[0]->getPlayerQueue())))
	{
		$ds->world[0]->endRound();
	}
}

function endRound()
{
	global $PDOHelper, $ds, $result;

	for ($i = 0; $i < count($ds->world[0]->getPlayerQueue()); $i++)
	{
		if($ds->world[0]->hasPassedCondition($ds->world[0]->getCurrentEventCard()->getWinCondition(),$ds->world[0]->getPlayerQueue()[$i]) == true)
		{
			$ds->world[0]->activateEffect($ds->world[0]->getCurrentEventCard()->getWinEffect(), $ds->world[0]->getPlayerQueue()[$i]);
		}
		else if($ds->world[0]->hasPassedCondition($ds->world[0]->getCurrentEventCard()->getLoseCondition(),$ds->world[0]->getPlayerQueue()[$i]) == true)
		{
			$ds->world[0]->activateEffect($ds->world[0]->getCurrentEventCard()->getLoseEffect(), $ds->world[0]->getPlayerQueue()[$i]);
		}
	}

	if($ds->world[0]->checkForWinners() == true)
	{
		$ds->world[0]->gameOver();
	}
	else
	{
		startNewRound();
	}
}

function gameOver()
{
	global $PDOHelper, $ds, $result;


}

///////////////////////////////////////////////////////

function resetValues()
{
	global $PDOHelper, $ds, $result;
	if(count($ds->players))
	{
		unset($ds->players);
	}
	
	if(count($ds->towns))
	{
		unset($ds->towns);
	}

	if(count($ds->world[0]))
	{
		unset($ds->world[0]);
	}
}

function getTownsData()
{
	global $PDOHelper, $ds, $result;

	$DBData = $PDOHelper->query("SELECT * FROM Towns");
	return $DBData;
}

function createComputerPlayers()
{
	global $PDOHelper, $ds, $result;

	$DBTownNames = $PDOHelper->query("SELECT * FROM TownNames");
	$DBPlayerNames = $PDOHelper->query("SELECT * FROM PlayerNames");

	for ($i = 0; $i < 2; $i++) 
	{
		$randomPlayerNameIndex = mt_rand(0, count($DBPlayerNames) -1);
		$randomTownNameIndex = mt_rand(0, count($DBTownNames) -1);
		$randomTownIndex = mt_rand(0, count($ds->towns) -1);

		$townArray = $ds->towns[$randomTownIndex];
		$townArray["name"] = $DBTownNames[$randomTownNameIndex]["name"];
		$newTown = new Town($townArray);

		$tempPlayer = new ComputerPlayer($DBPlayerNames[$randomPlayerNameIndex]["name"], $newTown, $i);
		$ds->players[] = $tempPlayer;

		unset($DBPlayerNames[$randomPlayerNameIndex]);
		$DBPlayerNames = array_values($DBPlayerNames);

		unset($DBTownNames[$randomTownNameIndex]);
		$DBTownNames = array_values($DBTownNames);

		unset($ds->towns[$randomTownIndex]);
		$ds->towns = array_values($ds->towns);
	}
}

function createToolCards()
{
	global $PDOHelper, $ds, $result;
	$toolCards = array();

	$DBToolCards = $PDOHelper->query("SELECT * FROM ToolCards");
	for ($i = 0; $i < count($DBToolCards); $i++)
	{
		$query = "SELECT Effects.* 
		FROM ToolCards, Effects 
		WHERE ToolCards.costEffectID = Effects.ID AND ToolCards.ID = ".($i + 1).";";
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

		$tempToolCard = new ToolCard($DBToolCards[$i]);

		$toolCards[] = $tempToolCard;
		$toolCards[] = $tempToolCard;
	}
	return $toolCards;
}

function createEventCards()
{
	global $PDOHelper, $ds, $result;
	$eventCards = array();
	$DBEventCards = $PDOHelper->query("SELECT * FROM EventCards");

	for ($i = 0; $i < count($DBEventCards); $i++)
	{
		$query = "SELECT Conditions.* 
		FROM EventCards, Conditions 
		WHERE EventCards.winConditionID = Conditions.ID AND EventCards.ID = ".($i + 1).";";
		$DBTempArray = $PDOHelper->query($query);
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

		$tempEventCard = new EventCard($DBEventCards[$i]);
		$eventCards[] = $tempEventCard;
	}
	return $eventCards;
}

?>