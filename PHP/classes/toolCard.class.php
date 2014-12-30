<?php
class ToolCard extends Card
{
	protected $targetSelf; //bool
	protected $cost; //Effect
	protected $selfEffect; //Effect
	protected $opponentEffect; //Effect



	public function getTargetSelf()
	{
		return $this->targetSelf;
	}
	public function getCost()
	{
		return $this->cost;
	}
	public function getSelfEffect()
	{
		return $this->targetSelf;
	}
	public function getOpponentEffect()
	{
		return $this->opponentEffect;
	}
}