<?php
class EventCard extends Card
{
	protected $winCondition; //Condition
	protected $loseCondition; //Condition
	protected $winEffect; //Effect
	protected $loseEffect; //Effect
	protected $startupEffect; //Effect

	public function __construct($cardDetails) //associative array
	{
		$this->title = $cardDetails["title"];
		$this->description = $cardDetails["description"];
		$this->winCondition = new Condition($cardDetails["winCondition"]);
		$this->loseCondition = new Condition($cardDetails["loseCondition"]);
		$this->winEffect = new Effect($cardDetails["winEffect"]);
		$this->loseEffect = new Effect($cardDetails["loseEffect"]);
		$this->startupEffect = new Effect($cardDetails["startupEffect"]);
	}

	public function getWinCondition()
	{
		return $this->winCondition;
	}
	public function getLoseCondition()
	{
		return $this->loseCondition;
	}
	public function getWinEffect()
	{
		return $this->winEffect;
	}
	public function getLoseEffect()
	{
		return $this->loseEffect;
	}
	public function getStartupEffect()
	{
		return $this->startupEffect;
	}
}