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

if (!isset($ds->players))
{
  $ds->players = array();
}
if (!isset($ds->towns))
{
	$ds->towns = array();
}
if (!isset($ds->world))
{
  $ds->world;
}

if($request["commandLine"] == "preGameBuild")
{
	$ds->towns = getTownsData();
	$result["towns"] = $ds->towns;

	echo(json_encode($result));
	exit();
}
else if($request["commandLine"] == "startNewGame")
{
	$request["playerSettings"]["name"];
	$request["playerSettings"]["townIndex"];
	$players[] = new Player($request["playerSettings"]["name"], $ds->towns[$request["playerSettings"]["townIndex"]]);

	unset($ds->towns[$index]);
	$ds->towns = array_values($ds->towns);

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
		$players[] = $tempPlayer;

		unset($DBPlayerNames[$randomNameIndex]);
		$DBPlayerNames = array_values($DBPlayerNames);
		unset($ds->towns[$randomTownIndex]);
		$ds->towns = array_values($ds->towns);
	}
}


function startNewGame()
{
	global $PDOHelper, $ds, $result;

	$ds->world = new World($players, $toolDeck, $eventDeck);

	startNewRound();
}

function startNewRound()
{
	global $PDOHelper, $ds, $result;

	$ds->world->dealToolCards();
	$ds->world->takeAnEventCard();

	for ($i = 0; $i < count($ds->world->getPlayerQueue()); $i++)
	{
		$ds->world->activateEffect($ds->world->getCurrentEventCard()->getStartupEffect(), $ds->world->getplayerQueue()[$i]);
	}

	$ds->world->resetCurrentPlayerTurn();
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