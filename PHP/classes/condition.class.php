<?php
class Condition
{
	protected $winType; //string
	protected $loseType; //string
	protected $winValue; //int
	protected $loseValue; //int

//om databaskall returnerar associativa arrayer mata in en sån i construktor
	public function __construct()
	{
		
	}

	public function getWinType()
	{
		return $this->winType;
	}
	public function getLoseType()
	{
		return $this->loseType;
	}
	public function getWinValue()
	{
		return $this->winValue;
	}
	public function getLoseValue()
	{
		return $this->loseValue;
	}
}