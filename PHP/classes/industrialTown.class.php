<?php
class IndustrialTown extends Town
{
	public function __construct($name)
	{
		$this->name = $name;
		$this->food = 10;
		$this->happiness = 20;
		$this->money = 50;
		$this->education = 40;
		$this->military = 30;
		$this->population = 0;
	}
}