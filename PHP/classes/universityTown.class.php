<?php
class UniversityTown extends Town
{
	public function __construct($townName)
	{
		$this->townName = $townName;
		$this->food = 20;
		$this->happiness = 30;
		$this->money = 10;
		$this->education = 50;
		$this->military = 40;
	}
}