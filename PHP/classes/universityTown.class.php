<?php
class UniversityTown extends Town
{
	public function __construct($name)
	{
		$this->name = $name;
		$this->food = 20;
		$this->happiness = 30;
		$this->money = 10;
		$this->education = 50;
		$this->military = 40;
		$this->population = 0;
	}
}