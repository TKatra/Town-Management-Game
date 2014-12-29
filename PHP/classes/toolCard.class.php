<?php
class ToolCard extends Card
{
	protected $targetSelf; //bool
	protected $cost; //associativ array (Food = -20)
	protected $selfEffect; //associativ array (Food => 20)
	protected $opponentEffect; //associativ array



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