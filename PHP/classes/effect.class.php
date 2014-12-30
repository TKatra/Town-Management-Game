<?php
class Effect 
{
	protected $food; //int
	protected $happiness; //int
	protected $money; //int
	protected $education; //int
	protected $military; //int
	protected $population; //int

	public function __construct()
	{
		$this->food = 0;
		$this->happiness = 0;
		$this->money = 0;
		$this->education = 0;
		$this->military = 0;
		$this->population = 0;
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
		return $this->population;
	}

	public function setFood($food)
	{
		if($food > 100)
		{
			$food = 100;
		}
		else if($food < -100)
		{
			$food = -100;
		}
		$this->food = $food;
	}
	public function setHappiness($happiness)
	{
		if($happiness > 100)
		{
			$happiness = 100;
		}
		else if($happiness < -100)
		{
			$happiness = -100;
		}
		$this->happiness = $happiness;
	}
	public function setMoney($money)
	{
		if($money > 100)
		{
			$money = 100;
		}
		else if($money < -100)
		{
			$money = -100;
		}
		$this->money = $money;
	}
	public function setEducation($education)
	{
		if($education > 100)
		{
			$education = 100;
		}
		else if($education < -100)
		{
			$education = -100;
		}
		$this->education = $education;
	}
	public function setMilitary($military)
	{
		if($military > 100)
		{
			$military = 100;
		}
		else if($military < -100)
		{
			$military = -100;
		}
		$this->military = $military;
	}
	public function setPopulation($population)
	{
		if($population > 100)
		{
			$population = 100;
		}
		else if($population < -100)
		{
			$population = -100;
		}
		$this->population = $population;
	}
}