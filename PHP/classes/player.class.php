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

	protected function canAffordCard($costEffect)
	{
		
	}

	public function useToolCard($index, $opponent = null)
	{
		if (count($this->toolCards) != 0)
		{
			if(!($index < 0) || !($index >= (count($this->toolCards) -1)))
			{
				$toolCard = $this->toolCards[$index];

				if ()
				// return $toolCard;
				if ($toolCard->targetSelf == true)
				{

				}
				else
				{

				}
			}
			else
			{
				throw new Exception("'".(int)$index."' is an invalid index.");
			}
		}
		else 
		{
			throw new Exception("The 'toolCards' array is empty.");
			// return "The 'toolCards' array is empty.";
		}
	}
}