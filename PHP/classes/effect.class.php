<?php
class Effect 
{
	protected $food; //int
	protected $happiness; //int
	protected $money; //int
	protected $education; //int
	protected $military; //int
	protected $population; //int

	public function __construct($effectDetails) 
	{
		foreach($effectDetails as $key => $value)
		{
			if($effectDetails[$key] > 100)
			{
				$effectDetails[$key] = 100;
			}
			else if($effectDetails[$key] < -100)
			{
				$effectDetails[$key] = -100;
			}
		}

		$this->food = $effectDetails["food"];
		$this->happiness = $effectDetails["happiness"];
		$this->money = $effectDetails["money"];
		$this->education = $effectDetails["education"];
		$this->military = $effectDetails["military"];
		$this->population = $effectDetails["population"];
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
}