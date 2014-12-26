<?php
class FarmingVillage extends Town
{
	public function __construct($name)
	{
		$this->name = $name;
		$this->food = 50;
		$this->happiness = 40;
		$this->money = 30;
		$this->education = 10;
		$this->military = 20;
		$this->population = 0;
	}
}