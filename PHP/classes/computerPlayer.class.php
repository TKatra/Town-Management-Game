<?
class ComputerPlayer extends Player
{
	public function __construct($name, $town) //string, Town 
	{
		$this->name = $name;
		$this->town = $town;
	}

	public function toArray()
	{
		// protected $name; //string 
		// protected $town; //town
		// protected $toolCards = array(); //array of ToolCards
		// protected $discardPile = array(); //array of discarded ToolCards

		$responseArray = array();
		$responseArray["name"] = $this->name;
		$responseArray["town"] = $this->town->toArray();
		$responseArray["toolCardsInDeck"] = count($this->toolCards);
		return $responseArray;
	}
}