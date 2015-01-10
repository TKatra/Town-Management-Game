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

if($request["commandLine"] == "preGameBuild")
{
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

	echo "(".$request["playerSettings"]["playerName"].")";
	echo "(".$request["playerSettings"]["townName"].")";
	echo "(".$request["playerSettings"]["townIndex"].")";

	// $tempPlayer = new Player($request["playerSettings"]["name"], $townArray);
	$ds->players[] = new Player($request["playerSettings"]["name"], $townArray);

	echo "(".$ds->players[0]->getName().")";

	unset($ds->towns[$request["playerSettings"]["townIndex"]]);
	$ds->towns = array_values($ds->towns);

	createComputerPlayers();

	startNewGame();
}

///////////////////////////////////////////////////////

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
		$randomNameIndex = mt_rand(0, count($DBPlayerNames) -1);
		$randomTownIndex = mt_rand(0, count($ds->towns) -1);

		$tempTown = $ds->towns[$randomTownIndex];
		$tempPlayer = new ComputerPlayer($DBPlayerNames[$randomNameIndex]["name"], $tempTown);
		$ds->players[] = $tempPlayer;

		echo "(".$tempPlayer->getName().")";

		unset($DBPlayerNames[$randomNameIndex]);
		$DBPlayerNames = array_values($DBPlayerNames);
		unset($ds->towns[$randomTownIndex]);
		$ds->towns = array_values($ds->towns);
	}
}

function createToolCards()
{
	global $PDOHelper, $ds, $result;
	$toolCards = array();

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

function startNewGame()
{
	global $PDOHelper, $ds, $result;

	$toolDeck = createToolCards();
	$eventDeck = createEventCards();

	// echo "(".$toolDeck[0]->getTitle().")";
	// echo "(".$eventDeck[0]->getTitle().")";

	$ds->world = new World($ds->players, $toolDeck, $eventDeck);

	startNewRound();
}

function startNewRound()
{
	global $PDOHelper, $ds, $result;

	$ds->world->dealToolCards();
	$ds->world->takeAnEventCard();

	for ($i = 0; $i < count($ds->world->getPlayerQueue()); $i++)
	{
		$ds->world->activateEffect($ds->world->getCurrentEventCard()->getStartupEffect(), $ds->world->getplayer()[$i]);
	}

	$ds->world->resetCurrentPlayerTurn();

	echo "(".$ds->world->getPlayers()[0]->getName().")";

	$result["players"] = $ds->world->getPlayers();
	echo(json_encode($result));
	exit();
}

function endTurn()
{
	global $PDOHelper, $ds, $result;

	$ds->world->fetchDiscardedCards($ds->world->getcurrentPlayerTurn());
	$ds->world->nextPlayerTurn();

	if(!($ds->world->getCurrentPlayerTurn() < count($ds->world->getPlayerQueue())))
	{
		$ds->world->endRound();
	}
}

function endRound()
{
	global $PDOHelper, $ds, $result;

	for ($i = 0; $i < count($ds->world->getPlayerQueue()); $i++)
	{
		if($ds->world->hasPassedCondition($ds->world->getCurrentEventCard()->getWinCondition(),$ds->world->getPlayerQueue()[$i]) == true)
		{
			$ds->world->activateEffect($ds->world->getCurrentEventCard()->getWinEffect(), $ds->world->getPlayerQueue()[$i]);
		}
		else if($ds->world->hasPassedCondition($ds->world->getCurrentEventCard()->getLoseCondition(),$ds->world->getPlayerQueue()[$i]) == true)
		{
			$ds->world->activateEffect($ds->world->getCurrentEventCard()->getLoseEffect(), $ds->world->getPlayerQueue()[$i]);
		}
	}

	if($ds->world->checkForWinners() == true)
	{
		$ds->world->gameOver();
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

?>