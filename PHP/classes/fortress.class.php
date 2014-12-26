<?php
class Fortress extends Town
{
	public function __construct($townName)
	{
		$this->townName = $townName;
		$this->food = 30;
		$this->happiness = 10;
		$this->money = 40;
		$this->education = 20;
		$this->military = 50;
	}
}