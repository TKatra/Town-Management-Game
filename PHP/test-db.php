<?php
include_once("../libs/nodebite-swiss-army-oop.php");

$connectInfo =array(
  "host" => "127.0.0.1",
  "dbname" => "test",
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
	$randomIndex = rand(0, count($DBTownNames) -1);
	$DBTownData[$i]["name"] = $DBTownNames[$randomIndex]["name"];
	unset($DBTownNames[$randomIndex]);
	$DBTownNames = array_values($DBTownNames);

	$tempTown = new Town($DBTownData[$i]);
	$towns[] = $tempTown;
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

$DBPlayers = $PDOHelper->query("SELECT * FROM Players");
$DBPlayerNames = $PDOHelper->query("SELECT * FROM PlayerNames");

$players = array();
$tempPlayer;
for ($i = 0; $i < 4; $i++) 
{
	$randomNameIndex = rand(0, count($DBPlayerNames) -1);
	$randomTownIndex = rand(0, count($towns) -1);

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
	// var_dump($players[$i]->getName());

	echo("[".$i."] = ".$players[$i]->getName()." the mayor of ".$players[$i]->getTown()->getName()." the ".$players[$i]->getTown()->getType());
	echo "<br/>";
}

echo "<hr/>";
?>