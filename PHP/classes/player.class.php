<?php
class Player
{
	protected $name; //string 
	protected $town; //town
	protected $toolCards = array(); //array of ToolCards
	protected $discardPile = array(); //array of discarded ToolCards

	public function __construct($name, $town) //string, Town 
	{
		$this->name = $name;
		$this->town = $town;
	}

	public function getName()
	{
		return $this->name;
	}
	public function getTown()
	{
		return $this->town;
	}
	public function getToolCards()
	{
		return $this->toolCards;
	}
	public function getDiscardPile()
	{
		return $this->discardPile;
	}

	public function addToolCards($toolCards)
	{
		// $this->toolCards = $toolCards;
		for ($i = 0; $i < count($toolCards); $i++) 
		{
			$this->toolCards[] = $toolCards[$i];
		}
	}

	public function clearDiscardPile()
	{
		$this->discardPile = array();
	}

	protected function canAffordToolCard($toolCard)
	{
		$cost = $toolCard->getCostEffect();
		$town = $this->town;
		// $statsArray = $toolCard->
		if (!(($town->getFood() + $cost->getFood()) < 0))
		{
			if (!(($town->getHappiness() + $cost->getHappiness()) < 0))
			{
				if (!(($town->getMoney() + $cost->getMoney()) < 0))
				{
					if (!(($town->getEducation() + $cost->getEducation()) < 0))
					{
						if (!(($town->getMilitary() + $cost->getMilitary()) < 0))
						{
							if (!(($town->getPopulation() + $cost->getPopulation()) < 0))
							{
								return true;
							}
						}
					}
				}
			}
		}
		return false;
	}

	protected function canUseToolCard($index)
	{
		if (count($this->toolCards) != 0)
		{
			if(!($index < 0) || !($index >= (count($this->toolCards) -1)))
			{
				return true;
			}
			else
			{
				throw new Exception("'".(int)$index."' is an invalid index.");
			}
		}
		else 
		{
			throw new Exception("The 'toolCards' array is empty.");
		}
	}

	protected function activateEffect($effect, $town)
	{
		$town->setFood($town->getFood() + $effect->getFood());
		$town->setHappiness($town->getHappiness() + $effect->getHappiness());
		$town->setMoney($town->getMoney() + $effect->getMoney());
		$town->setEducation($town->getEducation() + $effect->getEducation());
		$town->setMilitary($town->getMilitary() + $effect->getMilitary());
		$town->setPopulation($town->getPopulation() + $effect->getPopulation());
	}

	public function useToolCard($index, $opponent = null)
	{
		if ($this->canUseToolCard($index) == true)
		{
			$toolCard = $this->toolCards[$index];

			if($this->canAffordToolCard($toolCard) == true)
			{
				if ($toolCard->getTargetSelf() == true)
				{
					$this->activateEffect($toolCard->getCostEffect(), $this->town);
					$this->activateEffect($toolCard->getSelfEffect(), $this->town);
				}
				else 
				{
					if (is_a($opponent, "Player") || is_subclass_of($opponent, "Player"))
					{
						$this->activateEffect($toolCard->getCostEffect(), $this->town);
						$this->activateEffect($toolCard->getSelfEffect(), $this->town);
						$this->activateEffect($toolCard->getSelfEffect(), $opponent->town);
					}
					else
					{
						return "No target selected";
						//maybe exception
					}
				}
			}
			else
			{
				return "Can't afford the card";
				//maybe exception
			}
		}
	}
}