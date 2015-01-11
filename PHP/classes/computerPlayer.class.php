<?
class ComputerPlayer extends Player
{
	protected $id;
	public function __construct($name, $town, $id) //string, Town 
	{
		$this->name = $name;
		$this->town = $town;
		$this->id = $id;
	}

	public function toArray()
	{
		// protected $name; //string 
		// protected $town; //town
		// protected $toolCards = array(); //array of ToolCards
		// protected $discardPile = array(); //array of discarded ToolCards

		$responseArray = array();
		$responseArray["name"] = $this->name;
		$responseArray["isComputer"] = true;
		$responseArray["id"] = $this->id;
		$responseArray["town"] = $this->town->toArray();
		$responseArray["toolCardsInDeck"] = count($this->toolCards);
		return $responseArray;
	}
}