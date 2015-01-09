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
	echo(json_encode($ds->towns));
	exit();
}
else if($request["commandLine"] == "startNewGame")
{
	$players[] = new Player("Hiero", $towns[$index]);

	unset($towns[$index]);
	$towns = array_values($towns);

	startNewGame();
}

function getTownsData()
{
	global $PDOHelper, $ds;

	$DBData = $PDOHelper->query("SELECT * FROM Towns ");

	$towns = array();
	for ($i = 0; $i < count($DBData); $i ++) 
	{

		$towns[] = $DBData[$i];
	}
	return $towns;
}

function createComputerPlayers()
{
	global $PDOHelper, $ds;

	$DBTownNames = $PDOHelper->query("SELECT * FROM TownNames");
	$DBPlayerNames = $PDOHelper->query("SELECT * FROM PlayerNames");

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
}


function startNewGame()
{
	global $PDOHelper, $ds;

	$ds->world = new World($players, $toolDeck, $eventDeck);

	startNewRound();
}

function startNewRound()
{
	global $PDOHelper, $ds;

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
	global $PDOHelper, $ds;

	$ds->world->fetchDiscardedCards($ds->world->getcurrentPlayerTurn());
	$ds->world->nextPlayerTurn();

	if(!($ds->world->getCurrentPlayerTurn() < count($ds->world->getPlayerQueue())))
	{
		$ds->world->endRound();
	}
}

function endRound()
{
	global $PDOHelper, $ds;

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
	global $PDOHelper, $ds;


}

?>