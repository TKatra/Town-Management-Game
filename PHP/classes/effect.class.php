<?php
class Effect 
{
	protected $food; //int
	protected $happiness; //int
	protected $money; //int
	protected $education; //int
	protected $military; //int
	protected $population; //int
	protected $cardsToRemove; //int

	public function __construct($effectDetails) //associative array
	{
		foreach($effectDetails as $key => $value)
		{
			if($key != "cardsToRemove")
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
			else
			{
				if($effectDetails[$key] > 5)
				{
					$effectDetails[$key] = 5;
				}
				else if($effectDetails[$key] < 0)
				{
					$effectDetails[$key] = 0;
				}
			}
		}

		$this->food = (int)$effectDetails["food"];
		$this->happiness = (int)$effectDetails["happiness"];
		$this->money = (int)$effectDetails["money"];
		$this->education = (int)$effectDetails["education"];
		$this->military = (int)$effectDetails["military"];
		$this->population = (int)$effectDetails["population"];
		$this->cardsToRemove = (int)$effectDetails["cardsToRemove"];
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
	public function getCardsToRemove()
	{
		return $this->cardsToRemove;
	}

	public function toArray()
	{
		// protected $food; //int
		// protected $happiness; //int
		// protected $money; //int
		// protected $education; //int
		// protected $military; //int
		// protected $population; //int
		// protected $cardsToRemove; //int

		$responseArray = array();
		$responseArray["food"] = $this->food;
		$responseArray["happiness"] = $this->happiness;
		$responseArray["money"] = $this->money;
		$responseArray["education"] = $this->education;
		$responseArray["military"] = $this->military;
		$responseArray["population"] = $this->population;
		$responseArray["cardsToRemove"] = $this->cardsToRemove;
		return $responseArray;
	}
}