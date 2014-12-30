<?php
class EventCard extends Card
{
	protected $winCondition; //Condition
	protected $loseCondition; //Condition
	protected $winEffect; //Effect
	protected $loseEffect; //Effect
	protected $startupEffect; //Effect

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