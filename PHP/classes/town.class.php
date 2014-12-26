<?php
class Town
{
	$townName;
	$food;
	$happiness;
	$money;
	$education;
	$military;
	$population = 0;

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

	public function setFood($food)
	{
		if($food > 100)
		{
			$food = 100;
		}
		else if($food < 0)
		{
			$food = 0;
		}
		$this->food = $food;
	}
	public function setHappiness($happiness)
	{
		if($happiness > 100)
		{
			$happiness = 100;
		}
		else if($happiness < 0)
		{
			$happiness = 0;
		}
		$this->happiness = $happiness;
	}
	public function setMoney($money)
	{
		if($money > 100)
		{
			$money = 100;
		}
		else if($money < 0)
		{
			$money = 0;
		}
		$this->money = $money;
	}
	public function setEducation($education)
	{
		if($education > 100)
		{
			$education = 100;
		}
		else if($education < 0)
		{
			$education = 0;
		}
		$this->education = $education;
	}
	public function setMilitary($military)
	{
		if($military > 100)
		{
			$military = 100;
		}
		else if($military < 0)
		{
			$military = 0;
		}
		$this->military = $military;
	}
	public function setPopulation($populaiton)
	{
		if($populaiton > 100)
		{
			$populaiton = 100;
		}
		else if($populaiton < 0)
		{
			$populaiton = 0;
		}
		$this->populaiton = $populaiton;
	}
}