<?php
class Condition
{
	protected $winType; //string
	protected $loseType; //string
	protected $winValue; //int
	protected $loseValue; //int

	public function __construct()
	{
		
	}

	public function getType()
	{
		return $this->type;
	}
	public function getValue()
	{
		return $this->value;
	}
}