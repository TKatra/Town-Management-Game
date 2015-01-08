<?php
class Condition
{
	protected $conditionType; //string
	protected $statsType; //string
	protected $value; //int

	public function __construct($conditionDetails) //associative array
	{
		//highestOfPlayers
		//lowestOfPlayers
		//
		//moreThanValue
		//lessThanValue

		$this->checkType($conditionDetails["conditionType"]);
		$this->checkStatsType($conditionDetails["statsType"]);

		if($conditionDetails["value"] > 100)
		{
			$conditionDetails["value"] = 100;
		}
		else if($conditionDetails["value"] < -100)
		{
			$conditionDetails["value"] = -100;
		}

		$this->conditionType = $conditionDetails["conditionType"];
		$this->statsType = $conditionDetails["statsType"];
		$this->value = (int)$conditionDetails["value"];
	}

	public function getConditionType()
	{
		return $this->conditionType;
	}
	public function getValue()
	{
		return $this->value;
	}
	public function getStatsType()
	{
		return $this->statsType;
	}

	private function checkType($conditionType)
	{
		switch ($conditionType) 
		{
			case "highestOfPlayers":
				break;
			case "lowestOfPlayers":
				break;
			case "equalOrMoreThanValue":
				break;
			case "lessThanValue":
				break;
			default:
				throw new Exception("'".$conditionType."' is an incorrect condition type!");
				break;
		}
	}
	protected function checkStatsType($statsType)
	{
		switch ($statsType) 
		{
			case "food":
				break;
			case "happiness":
				break;
			case "money":
				break;
			case "education":
				break;
			case "military":
				break;
			case "population":
				break;
			default:
				throw new Exception("'".$statsType."' is an incorrect stats type!");				
				break;
		}
	}
}