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

	public function discardCard($index)
	{
		if ($this->cardExists($index) == true)
		{
			$this->discardPile[] = $this->toolCards[$index];
			unset($this->toolCards[$index]);
			$this->toolCards = array_values($this->toolCards);
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

	protected function cardExists($index)
	{
		if (count($this->toolCards) != 0)
		{
			if(!($index < 0) && !($index > (count($this->toolCards) - 1)))
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

	protected function activateEffect($effect, $toolCard, $targetedPlayer = null)
	{
		if($targetedPlayer != null)
		{
			$targetedPlayer->town->setFood($targetedPlayer->town->getFood() + $effect->getFood());
			$targetedPlayer->town->setHappiness($targetedPlayer->town->getHappiness() + $effect->getHappiness());
			$targetedPlayer->town->setMoney($targetedPlayer->town->getMoney() + $effect->getMoney());
			$targetedPlayer->town->setEducation($targetedPlayer->town->getEducation() + $effect->getEducation());
			$targetedPlayer->town->setMilitary($targetedPlayer->town->getMilitary() + $effect->getMilitary());
			$targetedPlayer->town->setPopulation($targetedPlayer->town->getPopulation() + $effect->getPopulation());

			if($effect->getCardsToRemove() > 0)
			{
				for($i = 0; $i < $effect->getCardsToRemove(); $i++)
				{
					$targetedPlayer->discardCard(mt_rand(0, (count($targetedPlayer->toolCards) - 1)));
				}
			}
		}
		else
		{
			$this->town->setFood($this->town->getFood() + $effect->getFood());
			$this->town->setHappiness($this->town->getHappiness() + $effect->getHappiness());
			$this->town->setMoney($this->town->getMoney() + $effect->getMoney());
			$this->town->setEducation($this->town->getEducation() + $effect->getEducation());
			$this->town->setMilitary($this->town->getMilitary() + $effect->getMilitary());
			$this->town->setPopulation($this->town->getPopulation() + $effect->getPopulation());

			if($effect->getCardsToRemove() > 0)
			{
				if($toolCard != null)
				{
					for($i = 0; $i < $effect->getCardsToRemove(); $i++)
					{
						do
						{
							$randomIndex = mt_rand(0, (count($this->toolCards) - 1));
						}while ($randomIndex == array_search($toolCard, $this->toolCards));

						$this->discardCard($randomIndex);
					}
				}
				else
				{
					throw new Exception("Player card not defined.");
				}
			}
		}
	}

	public function useToolCard($index, $opponent = null)
	{
		if ($this->cardExists($index) == true)
		{
			$toolCard = $this->toolCards[$index];
			if($this->canAffordToolCard($toolCard) == true)
			{
				if ($toolCard->getTargetSelf() == true)
				{
					$this->activateEffect($toolCard->getCostEffect());
					$this->activateEffect($toolCard->getSelfEffect());

					$this->discardCard(array_search($toolCard, $this->toolCards));
				}
				else 
				{
					if (is_a($opponent, "Player") || is_subclass_of($opponent, "Player"))
					{
						$this->activateEffect($toolCard->getCostEffect(), $toolCard);
						$this->activateEffect($toolCard->getSelfEffect(), $toolCard);
						$this->activateEffect($toolCard->getOpponentEffect(), $toolCard, $opponent);

						$this->discardCard(array_search($toolCard, $this->toolCards));
					}
					else
					{
						throw new Exception("No target selected");
					}
				}
			}
			else
			{
				throw new Exception("Can't afford the card");
			}
		}
	}
}