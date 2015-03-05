function conditionTypeToText(conditionType)
{
	switch (conditionType)
	{
		case "highestOfPlayers":
			return "Being the highest of all towns in:";
		case "lowestOfPlayers":
			return "Being the lowest of all towns in:";
		case "equalOrMoreThanValue":
			return "Have the same or higher than:";
		case "lessThanValue":
			return "Have less than:";
	}
}

function camelCaseToNormalCase(inputString)
{
	inputString = inputString.replace(/([A-Z])/g, ' $1');
	inputString = inputString.toLowerCase();
	inputString = inputString.replace(/^./, function(str)
			{
				return str.toUpperCase();
			});

	return inputString;
}

function showPreGamePopUp(data)
{
	$(".pop-up.pre-game").show(500);
	$(".site-cover").fadeIn(500);

	$(".pop-up.pre-game .town-list").empty();
	buildTownList(data);
}

function pickTarget()
{
	// $(".site-cover").fadeIn(500);
	// $(".pop-up.use-card").show(500);
	
	// requestData.opponentIndex = ;
}