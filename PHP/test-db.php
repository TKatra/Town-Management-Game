<?php
include_once("../libs/nodebite-swiss-army-oop.php");

$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "test",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "saves"
));

if (!isset($ds->players))
{
  $ds->players = array();
}

if (!isset($ds->world))
{
  $ds->world = array();
}



?>