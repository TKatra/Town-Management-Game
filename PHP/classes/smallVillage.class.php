<?php
class SmallVillage extends Town
{
	public function __construct($name)
	{
		$this->name = $name;
		$this->food = 40;
		$this->happiness = 50;
		$this->money = 20;
		$this->education = 30;
		$this->military = 10;
		$this->population = 0;
	}
}