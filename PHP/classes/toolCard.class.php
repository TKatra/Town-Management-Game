<?php
class ToolCard extends Card
{
	protected $targetSelf; //bool
	protected $cost; //Effect
	protected $selfEffect; //Effect
	protected $opponentEffect; //Effect

	public function __construct($cardDetails)
	{
		$this->targetSelf = $cardDetails["targetSelf"];
		$this->cost = new Effect($cardDetails["cost"]);
		$this->selfEffect = new Effect($cardDetails["selfEffect"]);
		$this->opponentEffect = new Effect($cardDetails["opponentEffect"]);
	}

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
		return $this->selfEffect;
	}
	public function getOpponentEffect()
	{
		return $this->opponentEffect;
	}
}