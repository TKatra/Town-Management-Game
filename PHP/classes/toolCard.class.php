<?php
class ToolCard extends Card
{
	protected $targetSelf; //bool
	protected $costEffect; //Effect
	protected $selfEffect; //Effect
	protected $opponentEffect; //Effect

	public function __construct($cardDetails)
	{
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
}