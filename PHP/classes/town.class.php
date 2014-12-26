<?php
class town
{
	$townName;
	$food;
	$happiness;
	$money;
	$education;
	$military;
	$populaiton;

	public function getTownName()
	{
		return $this->townName;
	}
	public function getFood()
	{
		return $this->food;
	}
	public function getHappiness()
	{
		return $this->happiness;
	}
	public function getMoney()
	{
		return $this->money;
	}
	public function getEducation()
	{
		return $this->education;
	}
	public function getMilitary()
	{
		return $this->military;
	}
	public function getPopulation()
	{
		return $this->populaiton;
	}
}