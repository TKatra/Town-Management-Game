<?php
class SmallVillage extends Town
{
	public function __construct($townName)
	{
		$this->townName = $townName;
		$this->food = 40;
		$this->happiness = 50;
		$this->money = 20;
		$this->education = 30;
		$this->military = 10;
	}
}