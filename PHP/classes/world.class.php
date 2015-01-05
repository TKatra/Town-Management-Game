<?php
class World
{
	protected $playerQueue = array();
	protected $toolDeck = array();
	protected $toolDiscardDeck = array();
	protected $eventDeck = array();
	protected $eventDiscardDeck = array();
	protected $currentEventCard;

	public function __construct($players)//, $toolDeck, $eventDeck array, array, array
	{
		$this->playerQueue = $players;
		// $this->toolDeck = $toolDeck;
		// $this->eventDeck = $eventDeck;
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

	//REMOVE THESE AFTER TESTS!!
	////////////////////////////////////////
	public function getToolDiscardDeck()
	{
		return $this->toolDiscardDeck;
	}
	public function getEventDiscardDeck()
	{
		return $this->eventDiscardDeck;
	}
	////////////////////////////////////////

	public function changePlayerOrder()
	{
		$this->playerQueue[] = $this->playerQueue[0];
		unset($this->playerQueue[0]);
		$this->playerQueue = array_values($this->playerQueue);
	}
}