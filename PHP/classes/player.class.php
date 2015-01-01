<?php
class Player
{
	protected $name; //string 
	protected $town; //town
	protected $toolCards; //array of ToolCards
	protected $discardedToolCards; //array of discarded ToolCards

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
	public function getDiscardedToolCards()
	{
		return $this->discardedToolCards;
	}

	public function setToolCards($toolCards)
	{
		$this->toolCards = $toolCards;
	}
	public function setDiscardedToolCards($discardedToolCards)
	{
		$this->discardedToolCards = $discardedToolCards;
	}
}