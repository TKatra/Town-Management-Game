<?php
class Town
{
	protected $name; //string
	protected $type; //string
	protected $food; //int
	protected $happiness; //int
	protected $money; //int
	protected $education; //int
	protected $military; //int
	protected $population; //int

	public function __construct($townDetails) //associative array 
	{
		$this->name = $townDetails["name"];
		$this->type = $townDetails["type"];
		$this->food = (int)$townDetails["food"];
		$this->happiness = (int)$townDetails["happiness"];
		$this->money = (int)$townDetails["money"];
		$this->education = (int)$townDetails["education"];
		$this->military = (int)$townDetails["military"];
		$this->population = (int)$townDetails["population"];
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
		$this->food = $this->numberLimiter($food);
	}
	public function setHappiness($happiness)
	{
		$this->happiness = $this->numberLimiter($happiness);
	}
	public function setMoney($money)
	{
		$this->money = $this->numberLimiter($money);
	}
	public function setEducation($education)
	{
		$this->education = $this->numberLimiter($education);
	}
	public function setMilitary($military)
	{
		$this->military = $this->numberLimiter($military);
	}
	public function setPopulation($population)
	{
		$this->population = $this->numberLimiter($population);
	}

	protected function numberLimiter($number)
	{
		if($number > 100)
		{
			$number = 100;
		}
		else if($number < 0)
		{
			$number = 0;
		}
		return $number;
	}
}