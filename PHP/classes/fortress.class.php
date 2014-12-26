<?php
class Fortress extends Town
{
	public function __construct($name)
	{
		$this->name = $name;
		$this->food = 30;
		$this->happiness = 10;
		$this->money = 40;
		$this->education = 20;
		$this->military = 50;
		$this->population = 0;
	}
}