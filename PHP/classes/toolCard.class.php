<?php
class ToolCard extends Card
{
	protected $targetSelf; //bool
	protected $costEffect; //Effect
	protected $selfEffect; //Effect
	protected $opponentEffect; //Effect

	public function __construct($cardDetails) //associative array
	{
		$this->title = $cardDetails["title"];
		$this->description = $cardDetails["description"];
		$this->targetSelf = $cardDetails["targetSelf"];
		$this->costEffect = new Effect($cardDetails["costEffect"]);
		$this->selfEffect = new Effect($cardDetails["selfEffect"]);
		$this->opponentEffect = new Effect($cardDetails["opponentEffect"]);
	}

	public function getTargetSelf()
	{
		return $this->targetSelf;
	}
	public function getCostEffect()
	{
		return $this->costEffect;
	}
	public function getSelfEffect()
	{
		return $this->selfEffect;
	}
	public function getOpponentEffect()
	{
		return $this->opponentEffect;
	}

	public function toArray()
	{
		// protected $title; //string
		// protected $description; //string
		// protected $targetSelf; //bool
		// protected $costEffect; //Effect
		// protected $selfEffect; //Effect
		// protected $opponentEffect; //Effect

		$responseArray = array();
		$responseArray["title"] = $this->title;
		$responseArray["description"] = $this->description;
		$responseArray["targetSelf"] = $this->targetSelf;
		$responseArray["costEffect"] = $this->costEffect;
		$responseArray["selfEffect"] = $this->selfEffect;
		$responseArray["opponentEffect"] = $this->opponentEffect;
		return $responseArray;
	}
}