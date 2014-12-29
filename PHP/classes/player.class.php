<?php
class Player
{
	protected $name; //string
	protected $town; //town
	protected $toolCards; //array of ToolCards

	public function __construct($name, $town)
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
	public function setToolCards($toolCards)
	{
		$this->toolCards = $toolCards;
	}
}