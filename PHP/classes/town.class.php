<?php
class Town
{
	protected $name;
	protected $type;
	protected $food;
	protected $happiness;
	protected $money;
	protected $education;
	protected $military;
	protected $population;

	public function __construct($name, $type)
	{
		$this->name = $name;
		$this->type = $type;
		
		$this->food = 0;
		$this->happiness = 0;
		$this->money = 0;
		$this->education = 0;
		$this->military = 0;
		$this->population = 0;
		// $this->food = 30;
		// $this->happiness = 10;
		// $this->money = 40;
		// $this->education = 20;
		// $this->military = 50;
		// $this->population = 0;
	}

	public function getName()
	{
		return $this->name;
	}
	public function getType()
	{
		return $this->type;
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
	public function setPopulation($population)
	{
		if($population > 100)
		{
			$population = 100;
		}
		else if($population < 0)
		{
			$population = 0;
		}
		$this->population = $population;
	}
}