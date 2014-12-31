<?php
class EventCard extends Card
{
	protected $winCondition; //Condition
	protected $loseCondition; //Condition
	protected $winEffect; //Effect
	protected $loseEffect; //Effect
	protected $startupEffect; //Effect

	public function __construct($cardDetails)
	{
		$this->winCondition = new Condition($cardDetails["winCondition"]);
		$this->loseCondition = new Condition($cardDetails["loseCondition"]);
		$this->winEffect = new Effect($cardDetails["winEffect"]);
		$this->loseEffect = new Effect($cardDetails["loseEffect"]);
		$this->startupEffect = new Effect($cardDetails["startupEffect"]);
	}

	public getWinCondition()
	{
		return $this->winCondition;
	}
	public getLoseCondition()
	{
		return $this->loseCondition;
	}
	public getWinEffect()
	{
		return $this->winEffect;
	}
	public getLoseEffect()
	{
		return $this->loseEffect;
	}
	public getStartupEffect()
	{
		return $this->startupEffect;
	}
}