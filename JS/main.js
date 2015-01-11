$(function ()
{
	var requestData = {
		commandLine:null,
		cardIndex:null,
		opponentIndex:null,
		playerSettings:{
			playerName:null,
			townName:null,
			townIndex: null
		}
	};
	function siteStartup()
	{
		$(".pop-up").hide();
		$(".error-message").hide();
		$(".pop-up.pre-game").show();
		$(".site-cover").show();

		$("div.button.start-game").click(startGame);
		$("div.button.restart-game").click(siteStartup);
		$("div.tool-card").click(useCard);

		requestData.commandLine = "preGameBuild";
		contactPHP(requestData, buildTownList);
	}

	function contactPHP(request, successFunction)
	{
		$.ajax({
			url:"PHP/main.php",
			dataType: "json",
			data: request,
			success: successFunction,
			error:function(data)
			{
				console.log("AJAX ERROR: ", data.responseText);
			}
		});
	}

	function buildTownList(townData)
	{
		console.log("townData" + townData);
		console.log("townData(JSON.stringify): " + JSON.stringify(townData));
		console.log("townData.towns[0].type: " + townData.towns[0].type);
		console.log("townData.towns.length: ", townData.towns.length);

		for (var i = 0; i < townData.towns.length; i++)
		{
			var newTown = $("<section>");
			newTown.data("index", i);
			newTown.addClass("town-list-item noselect");
			newTown.click(selectTownClick);

			newTown.append($("<h3>").text(townData.towns[i].type));
			newTown.append($("<p>").text("Food: " + townData.towns[i].food));
			newTown.append($("<p>").text("Happiness: " + townData.towns[i].happiness));
			newTown.append($("<p>").text("Money: " + townData.towns[i].money));
			newTown.append($("<p>").text("Education: " + townData.towns[i].education));
			newTown.append($("<p>").text("Military: " + townData.towns[i].military));

			$(".pop-up.pre-game .town-list").append(newTown);
		}
	}

	function selectTownClick()
	{
		$(".town-list-item.selected").removeClass("selected");
		$(this).addClass("selected");
	}

	function startGame()
	{
		var playerName;
		var townName;
		var townIndex;
		var textBoxesValid = true;
		var townSelectionValid = true;

		$(".pop-up.pre-game input").each(function()
		{
			if($.trim($(this).val()) == "")
			{
				textBoxesValid = false;
			}
			else
			{
				if($(this).attr("name") == "playerName")
				{
					playerName = $(this).val();
				}
				else if($(this).attr("name") == "townName")
				{
					townName = $(this).val();
				}
			}
		});

		if($(".town-list-item.selected").length != 1)
		{
			townSelectionValid = false;
		}
		else
		{
			console.log("Selected town index: ", $(".town-list-item.selected").data("index"));
			townIndex = $(".town-list-item.selected").data("index");
		}

		console.log("playerName: ", playerName);
		console.log("townName: ", townName);
		console.log("townIndex: ", townIndex);

		console.log("textBoxesValid: ", textBoxesValid);
		console.log("townSelectionValid: ", townSelectionValid);

		if(textBoxesValid === true && townSelectionValid === true)
		{
			console.log("Valid Settings!");
			$(".pop-up.pre-game .error-message.text-boxes").hide();
			$(".pop-up.pre-game .error-message.town").hide();

			requestData.commandLine = "startNewGame";
			requestData.playerSettings.playerName = playerName;
			requestData.playerSettings.townName = townName;
			requestData.playerSettings.townIndex = townIndex;
			console.log("requestData: ", requestData);
			contactPHP(requestData, updateBoard);
		}
		else 
		{
			console.log("Invalid Settings!");
			if(textBoxesValid === false)
			{
				$(".pop-up.pre-game .error-message.text-boxes").show();
			}
			else
			{
				$(".pop-up.pre-game .error-message.text-boxes").hide();
			}

			if(townSelectionValid === false)
			{
				$(".pop-up.pre-game .error-message.town").show();
			}
			else
			{
				$(".pop-up.pre-game .error-message.town").hide();
			}
		}
	}

	function updateBoard(updateData)
	{
		// console.log("townData(JSON.stringify): " + JSON.stringify(townData));
		console.log("updateData: ", updateData);
		console.log("updateData(JSON.stringify): " + JSON.stringify(updateData));

		$(".pop-up.pre-game").hide();
		$(".site-cover").hide();

		var players = updateData["world"]["players"];
		var currentEventCard = updateData["world"]["currentEventCard"];

		buildPlayerDisplays(players);
		buildEventCardDisplay(currentEventCard);

		for(var i = 0; i < players.length; i++)
		{
			if(players[i]["isComputer"] == false)
			{
				buildToolCardDisplay(players[i]["toolCards"]);
			}
		}
	}

	function buildToolCardDisplay(toolCards)
	{
		var display;
		var costEffect;
		var selfEffect;
		var opponentEffect;

		for(var i = 0; i < toolCards.length; i++)
		{
			display = $("#tool-card-" + i);
			display.data("cardIndex", i);
			display.data("targetSelf", toolCards[i]["targetSelf"])

			costEffect = display.find(".cost-effect");
			selfEffect = display.find(".self-effect");
			opponentEffect = display.find(".opponent-effect");

			display.find(".title-value").text(toolCards[i]["title"]);

			costEffect.find(".food-value").text(toolCards[i]["costEffect"]["food"]);
			costEffect.find(".happiness-value").text(toolCards[i]["costEffect"]["happiness"]);
			costEffect.find(".money-value").text(toolCards[i]["costEffect"]["money"]);
			costEffect.find(".education-value").text(toolCards[i]["costEffect"]["education"]);
			costEffect.find(".military-value").text(toolCards[i]["costEffect"]["military"]);
			costEffect.find(".population-value").text(toolCards[i]["costEffect"]["population"]);
			costEffect.find(".cardsToRemove-value").text(toolCards[i]["costEffect"]["cardsToRemove"]);

			selfEffect.find(".food-value").text(toolCards[i]["selfEffect"]["food"]);
			selfEffect.find(".happiness-value").text(toolCards[i]["selfEffect"]["happiness"]);
			selfEffect.find(".money-value").text(toolCards[i]["selfEffect"]["money"]);
			selfEffect.find(".education-value").text(toolCards[i]["selfEffect"]["education"]);
			selfEffect.find(".military-value").text(toolCards[i]["selfEffect"]["military"]);
			selfEffect.find(".population-value").text(toolCards[i]["selfEffect"]["population"]);
			selfEffect.find(".cardsToRemove-value").text(toolCards[i]["selfEffect"]["cardsToRemove"]);

			opponentEffect.find(".food-value").text(toolCards[i]["opponentEffect"]["food"]);
			opponentEffect.find(".happiness-value").text(toolCards[i]["opponentEffect"]["happiness"]);
			opponentEffect.find(".money-value").text(toolCards[i]["opponentEffect"]["money"]);
			opponentEffect.find(".education-value").text(toolCards[i]["opponentEffect"]["education"]);
			opponentEffect.find(".military-value").text(toolCards[i]["opponentEffect"]["military"]);
			opponentEffect.find(".population-value").text(toolCards[i]["opponentEffect"]["population"]);
			opponentEffect.find(".cardsToRemove-value").text(toolCards[i]["opponentEffect"]["cardsToRemove"]);

			display.find(".description-value").text(toolCards[i]["description"]);
		}
	}

	function buildEventCardDisplay(eventCard)
	{
		var display = $(".event-card");
		var winCondition = display.find(".win-condition");
		var loseCondition = display.find(".lose-condition");
		var startupEffect = display.find(".startup-effect");
		var winEffect = display.find(".win-effect");
		var loseEffect = display.find(".lose-effect");

		display.find(".title-value").text(eventCard["title"]);

		//winCondition
		winCondition.find(".condition-type").text(conditionTypeToText(eventCard["winCondition"]["conditionType"]));
		winCondition.find(".stats-type").attr({
			"src": "Images/" + eventCard["winCondition"]["statsType"] + ".png",
			"alt": eventCard["winCondition"]["statsType"],
			"title": eventCard["winCondition"]["statsType"]
		});

		if(eventCard["winCondition"]["conditionType"] != "highestOfPlayers" && eventCard["winCondition"]["conditionType"] != "lowestOfPlayers")
		{
			winCondition.find(".condition-value").text(eventCard["winCondition"]["value"]);
		}
		else
		{
			winCondition.find(".condition-value").text("");
		}
		

		//loseCondition
		loseCondition.find(".condition-type").text(conditionTypeToText(eventCard["loseCondition"]["conditionType"]));
		loseCondition.find(".stats-type").attr({
			"src": "Images/" + eventCard["loseCondition"]["statsType"] + ".png",
			"alt": eventCard["loseCondition"]["statsType"],
			"title": eventCard["loseCondition"]["statsType"]
		});
		if(eventCard["loseCondition"]["conditionType"] != "highestOfPlayers" && eventCard["loseCondition"]["conditionType"] != "lowestOfPlayers")
		{
			loseCondition.find(".condition-value").text(eventCard["loseCondition"]["value"]);
		}
		else
		{
			loseCondition.find(".condition-value").text("");
		}
		

		startupEffect.find(".food-value").text(eventCard["startupEffect"]["food"]);
		startupEffect.find(".happiness-value").text(eventCard["startupEffect"]["happiness"]);
		startupEffect.find(".money-value").text(eventCard["startupEffect"]["money"]);
		startupEffect.find(".education-value").text(eventCard["startupEffect"]["education"]);
		startupEffect.find(".military-value").text(eventCard["startupEffect"]["military"]);
		startupEffect.find(".population-value").text(eventCard["startupEffect"]["population"]);
		startupEffect.find(".cardsToRemove-value").text(eventCard["startupEffect"]["cardsToRemove"]);

		winEffect.find(".food-value").text(eventCard["winEffect"]["food"]);
		winEffect.find(".happiness-value").text(eventCard["winEffect"]["happiness"]);
		winEffect.find(".money-value").text(eventCard["winEffect"]["money"]);
		winEffect.find(".education-value").text(eventCard["winEffect"]["education"]);
		winEffect.find(".military-value").text(eventCard["winEffect"]["military"]);
		winEffect.find(".population-value").text(eventCard["winEffect"]["population"]);
		winEffect.find(".cardsToRemove-value").text(eventCard["winEffect"]["cardsToRemove"]);

		loseEffect.find(".food-value").text(eventCard["loseEffect"]["food"]);
		loseEffect.find(".happiness-value").text(eventCard["loseEffect"]["happiness"]);
		loseEffect.find(".money-value").text(eventCard["loseEffect"]["money"]);
		loseEffect.find(".education-value").text(eventCard["loseEffect"]["education"]);
		loseEffect.find(".military-value").text(eventCard["loseEffect"]["military"]);
		loseEffect.find(".population-value").text(eventCard["loseEffect"]["population"]);
		loseEffect.find(".cardsToRemove-value").text(eventCard["loseEffect"]["cardsToRemove"]);

		display.find(".description-value").text(eventCard["description"]);
	}

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

	function buildPlayerDisplays(players)
	{
		for (var i = 0; i < players.length; i++)
		{
			var playerNameAndTitle = players[i]["name"] + " the mayor of " + players[i]["town"]["name"] + " the " + players[i]["town"]["type"];
			var display;
			if(players[i]["isComputer"] != true)
			{
				display = $(".player-section");
				display.find(".status-display .food-value").text(players[i]["town"]["food"]);
				display.find(".status-display .happiness-value").text(players[i]["town"]["happiness"]);
				display.find(".status-display .money-value").text(players[i]["town"]["money"]);
				display.find(".status-display .education-value").text(players[i]["town"]["education"]);
				display.find(".status-display .military-value").text(players[i]["town"]["military"]);
				display.find(".status-display .population-value").text(players[i]["town"]["population"]);

				display.find(".name-value").text(playerNameAndTitle);
			}
			else
			{
				display = $("#opponent-" + players[i]["id"]);
				display.find(".food-value").text(players[i]["town"]["food"]);
				display.find(".happiness-value").text(players[i]["town"]["happiness"]);
				display.find(".money-value").text(players[i]["town"]["money"]);
				display.find(".education-value").text(players[i]["town"]["education"]);
				display.find(".military-value").text(players[i]["town"]["military"]);
				display.find(".population-value").text(players[i]["town"]["population"]);


				display.find(".name-value").text(playerNameAndTitle);
			}
		}
	}

	function useCard()
	{
		var card = $(this);

		if(card.data("targetSelf") == true)
		{
			// requestData.opponentIndex = card.data("opponentIndex");
			// requestData.cardIndex = card.data("cardIndex");
			// requestData.commandLine = "useCard";
			// contactPHP(requestData, updateBoard);
		}
		else
		{

		}
	}

	siteStartup();
});