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
		$this->playerQueue = $players;
		$this->toolDiscardPile = $toolDeck;
		$this->eventDiscardPile = $eventDeck;
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

	public function startNewRound()
	{
		$this->dealToolCards();
		$this->takeAnEventCard();
		$this->currentPlayerTurn = 0;
	}

	public function endTurn()
	{

	}

	protected function endRound()
	{

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

	public function fetchDiscardedCards()//protected
	{
		for ($i = 0; $i < count($this->playerQueue); $i++)
		{
			$this->addToDiscardPile($this->playerQueue[$i]->getDiscardPile());
			$this->playerQueue[$i]->clearDiscardPile();
		}
	}

	public function sortToolDeck()//protected
	{
		while (count($this->toolDiscardPile) > 0)
		{
			$randomIndex = rand(0, count($this->toolDiscardPile) -1);
			$this->toolDeck[] = $this->toolDiscardPile[$randomIndex];
			unset($this->toolDiscardPile[$randomIndex]);
			$this->toolDiscardPile = array_values($this->toolDiscardPile);
		}
	}

	public function sortEventDeck()//protected
	{
		while (count($this->eventDiscardPile) > 0)
		{
			$randomIndex = rand(0, count($this->eventDiscardPile) -1);
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
		$this->currentEventCard = $this->eventDeck[0];
		unset($this->eventDeck[0]);
		$this->eventDeck = array_values($this->eventDeck);
	}
}