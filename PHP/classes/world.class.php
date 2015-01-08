<?php
class World
{
	protected $playerQueue = array();
	protected $toolDeck = array();
	protected $toolDiscardPile = array();
	protected $eventDeck = array();
	protected $eventDiscardPile = array();
	protected $currentEventCard;
	protected $currentPlayerTurn;

	public function __construct($players, $toolDeck, $eventDeck)// array, array, array
	{
		$this->startNewGame($players, $toolDeck, $eventDeck);
	}

	public function getPlayerQueue()
	{
		return $this->playerQueue;
	}
	public function getToolDeck()
	{
		return $this->toolDeck;
	}
	public function getEventDeck()
	{
		return $this->eventDeck;
	}
	public function getCurrentEventCard()
	{
		return $this->currentEventCard;
	}
	public function getCurrentPlayerTurn()
	{
		return $this->$currentPlayerTurn;
	}

	//REMOVE THESE AFTER TESTS!!
	////////////////////////////////////////
	public function getToolDiscardPile()//REMOVE!
	{
		return $this->toolDiscardPile;
	}
	public function getEventDiscardPile()//REMOVE!
	{
		return $this->eventDiscardPile;
	}
	////////////////////////////////////////

	public function startNewGame($players, $toolDeck, $eventDeck)
	{
		$this->playerQueue = $players;
		$this->toolDiscardPile = $toolDeck;
		$this->eventDiscardPile = $eventDeck;

		$this->startNewRound();
	}

	public function startNewRound()
	{
		$this->dealToolCards();
		$this->takeAnEventCard();

		for ($i = 0; $i < count($this->playerQueue); $i++)
		{
			$this->activateEffect($this->currentEventCard->getStartupEffect(), $this->playerQueue[$i]);
		}

		$this->currentPlayerTurn = 0;
	}

	public function endTurn()
	{
		$this->fetchDiscardedCards($this->currentPlayerTurn);
		$this->currentPlayerTurn++;

		if(!($this->currentPlayerTurn < count($this->playerQueue)))
		{
			$this->endRound();
		}
	}

	protected function endRound()
	{
		for ($i = 0; $i < count($this->playerQueue); $i++)
		{
			if($this->hasPassedCondition($this->currentEventCard->getWinCondition(),$this->playerQueue[$i]) == true)
			{

			}
			else if($this->hasPassedCondition($this->currentEventCard->getLoseCondition(),$this->playerQueue[$i]) == true)
			{

			}
		}
	}

	protected function gameOver()
	{

	}

	protected function hasPassedCondition($condition, $player)
	{
		// $ $this->getStatType()
		if($condition->getConditionType() == "highestOfPlayers")
		{
			if($condition->getStatsType() == "food")
			{
				for ($i = 0; $i < count($this->playerQueue); $i++)
				{
					if($this->playerQueue[$i]->getFood() > $player->getFood())
					{
						return false;
					}
				}
				return true;
			}
			else if($condition->getStatsType() == "happiness")
			{
				for ($i = 0; $i < count($this->playerQueue); $i++)
				{
					if($this->playerQueue[$i]->getTown()->getHappiness() > $player->getTown()->getHappiness())
					{
						return false;
					}
				}
				return true;
			}
			else if($condition->getStatsType() == "money")
			{
				for ($i = 0; $i < count($this->playerQueue); $i++)
				{
					if($this->playerQueue[$i]->getTown()->getMoney() > $player->getTown()->getMoney())
					{
						return false;
					}
				}
				return true;
			}
			else if($condition->getStatsType() == "education")
			{
				for ($i = 0; $i < count($this->playerQueue); $i++)
				{
					if($this->playerQueue[$i]->getTown()->getEducation() > $player->getTown()->getEducation())
					{
						return false;
					}
				}
				return true;
			}
			else if($condition->getStatsType() == "military")
			{
				for ($i = 0; $i < count($this->playerQueue); $i++)
				{
					if($this->playerQueue[$i]->getTown()->getMilitary() > $player->getTown()->getMilitary())
					{
						return false;
					}
				}
				return true;
			}
			else if($condition->getStatsType() == "population")
			{
				for ($i = 0; $i < count($this->playerQueue); $i++)
				{
					if($this->playerQueue[$i]->getTown()->getPopulation() > $player->getTown()->getPopulation())
					{
						return false;
					}
				}
				return true;
			}
		}
		else if($condition->getConditionType() == "lowestOfPlayers")
		{
			if($condition->getStatsType() == "food")
			{
				for ($i = 0; $i < count($this->playerQueue); $i++)
				{
					if($this->playerQueue[$i]->getFood() < $player->getFood())
					{
						return false;
					}
				}
				return true;
			}
			else if($condition->getStatsType() == "happiness")
			{
				for ($i = 0; $i < count($this->playerQueue); $i++)
				{
					if($this->playerQueue[$i]->getTown()->getHappiness() < $player->getTown()->getHappiness())
					{
						return false;
					}
				}
				return true;
			}
			else if($condition->getStatsType() == "money")
			{
				for ($i = 0; $i < count($this->playerQueue); $i++)
				{
					if($this->playerQueue[$i]->getTown()->getMoney() < $player->getTown()->getMoney())
					{
						return false;
					}
				}
				return true;
			}
			else if($condition->getStatsType() == "education")
			{
				for ($i = 0; $i < count($this->playerQueue); $i++)
				{
					if($this->playerQueue[$i]->getTown()->getEducation() < $player->getTown()->getEducation())
					{
						return false;
					}
				}
				return true;
			}
			else if($condition->getStatsType() == "military")
			{
				for ($i = 0; $i < count($this->playerQueue); $i++)
				{
					if($this->playerQueue[$i]->getTown()->getMilitary() < $player->getTown()->getMilitary())
					{
						return false;
					}
				}
				return true;
			}
			else if($condition->getStatsType() == "population")
			{
				for ($i = 0; $i < count($this->playerQueue); $i++)
				{
					if($this->playerQueue[$i]->getTown()->getPopulation() < $player->getTown()->getPopulation())
					{
						return false;
					}
				}
				return true;
			}
		}
		else if($condition->getConditionType() == "equalOrMoreThanValue")
		{
			if($condition->getStatsType() == "food")
			{
				if($player->getFood() >= $condition->getValue())
				{
					return true;
				}
				return false;
			}
			else if($condition->getStatsType() == "happiness")
			{
				if($player->getHappiness() >= $condition->getValue())
				{
					return true;
				}
				return false;
			}
			else if($condition->getStatsType() == "money")
			{
				if($player->getMoney() >= $condition->getValue())
				{
					return true;
				}
				return false;
			}
			else if($condition->getStatsType() == "education")
			{
				if($player->getEducation() >= $condition->getValue())
				{
					return true;
				}
				return false;
			}
			else if($condition->getStatsType() == "military")
			{
				if($player->getMilitary() >= $condition->getValue())
				{
					return true;
				}
				return false;
			}
			else if($condition->getStatsType() == "population")
			{
				if($player->getPopulation() >= $condition->getValue())
				{
					return true;
				}
				return false;
			}
		}
		else if($condition->getConditionType() == "lessThanValue")
		{
			if($condition->getStatsType() == "food")
			{
				if($player->getFood() <= $condition->getValue())
				{
					return true;
				}
				return false;
			}
			else if($condition->getStatsType() == "happiness")
			{
				if($player->getHappiness() <= $condition->getValue())
				{
					return true;
				}
				return false;
			}
			else if($condition->getStatsType() == "money")
			{
				if($player->getMoney() <= $condition->getValue())
				{
					return true;
				}
				return false;
			}
			else if($condition->getStatsType() == "education")
			{
				if($player->getEducation() <= $condition->getValue())
				{
					return true;
				}
				return false;
			}
			else if($condition->getStatsType() == "military")
			{
				if($player->getMilitary() <= $condition->getValue())
				{
					return true;
				}
				return false;
			}
			else if($condition->getStatsType() == "population")
			{
				if($player->getPopulation() <= $condition->getValue())
				{
					return true;
				}
				return false;
			}
		}
	}

	protected function getStatType()
	{

	}

	protected function activateEffect($effect, $player)
	{
		$player->getTown()->setFood($player->getTown()->getFood() + $effect->getFood());
		$player->getTown()->setHappiness($player->getTown()->getHappiness() + $effect->getHappiness());
		$player->getTown()->setMoney($player->getTown()->getMoney() + $effect->getMoney());
		$player->getTown()->setEducation($player->getTown()->getEducation() + $effect->getEducation());
		$player->getTown()->setMilitary($player->getTown()->getMilitary() + $effect->getMilitary());
		$player->getTown()->setPopulation($player->getTown()->getPopulation() + $effect->getPopulation());

		if($effect->getCardsToRemove() > 0)
		{
			for($i = 0; $i < $effect->getCardsToRemove(); $i++)
			{
				$player->discardCard(mt_rand(0, (count($player->toolCards) - 1)));
			}
		}
	}

	public function changePlayerOrder()//protected
	{
		$this->playerQueue[] = $this->playerQueue[0];
		unset($this->playerQueue[0]);
		$this->playerQueue = array_values($this->playerQueue);
	}

	protected function addToDiscardPile($discardedCards)
	{
		for ($i = 0; $i < count($discardedCards); $i++)
		{
			$this->toolDiscardPile[] = $discardedCards[$i];
		}
	}

	public function fetchDiscardedCards($index)
	{
		$this->addToDiscardPile($this->playerQueue[$index]->getDiscardPile());
		$this->playerQueue[$index]->clearDiscardPile();
	}

	public function sortToolDeck()//protected
	{
		while (count($this->toolDiscardPile) > 0)
		{
			$randomIndex = mt_rand(0, count($this->toolDiscardPile) -1);
			$this->toolDeck[] = $this->toolDiscardPile[$randomIndex];
			unset($this->toolDiscardPile[$randomIndex]);
			$this->toolDiscardPile = array_values($this->toolDiscardPile);
		}
	}

	public function sortEventDeck()//protected
	{
		while (count($this->eventDiscardPile) > 0)
		{
			$randomIndex = mt_rand(0, count($this->eventDiscardPile) -1);
			$this->eventDeck[] = $this->eventDiscardPile[$randomIndex];
			unset($this->eventDiscardPile[$randomIndex]);
			$this->eventDiscardPile = array_values($this->eventDiscardPile);
		}
	}

	protected function givePlayerCards($player)
	{
		$cardsToGive = array();
		for ($i = 0; $i < (5 - count($player->getToolCards())); $i++)
		{
			$cardsToGive[] = $this->toolDeck[0];
			unset($this->toolDeck[0]);
			$this->toolDeck = array_values($this->toolDeck);
		}
		$player->addToolCards($cardsToGive);
	}

	public function dealToolCards()//protected
	{
		for ($i = 0; $i < count($this->playerQueue); $i++)
		{
			if(5 - count($this->playerQueue[$i]->getToolCards()) > count($this->toolDeck))
			{
				$this->sortToolDeck();
				$this->givePlayerCards($this->playerQueue[$i]);
			}
			else
			{
				$this->givePlayerCards($this->playerQueue[$i]);
			}
		}
	}

	public function takeAnEventCard()
	{
		if(count($this->eventDeck) < 1)
		{
			$this->sortEventDeck();

			$this->currentEventCard = $this->eventDeck[0];
			unset($this->eventDeck[0]);
			$this->eventDeck = array_values($this->eventDeck);
		}
		else
		{
			$this->currentEventCard = $this->eventDeck[0];
			unset($this->eventDeck[0]);
			$this->eventDeck = array_values($this->eventDeck);
		}
	}
}