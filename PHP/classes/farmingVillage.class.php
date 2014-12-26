<?php
class FarmingVillage extends Town
{
	public function __construct($townName)
	{
		$this->townName = $townName;
		$this->food = 50;
		$this->happiness = 40;
		$this->money = 30;
		$this->education = 10;
		$this->military = 20;
	}
}