$(function ()
{
	var requestData;
	$("div.button.button-start-game").click(startGame);
	// $("div.tool-card").click(cardOnClick);
	$("div.button.button-restart-game").click(siteStartup);


	function siteStartup()
	{
		requestData = {
			commandLine:null,
			cardIndex:null,
			opponentIndex:null,
			playerSettings:{
				playerName:null,
				townName:null,
				townIndex: null
			}
		};

		$(".pop-up").hide();
		$(".error-message").hide();
		$(".site-cover").hide();

		

		$(".site-cover").fadeIn(500);
		
		

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
		$(".pop-up.pre-game").show(500);
		$(".site-cover").fadeIn(500);
		// console.log("townData" + townData);
		// console.log("townData(JSON.stringify): " + JSON.stringify(townData));
		// console.log("townData.towns[0].type: " + townData.towns[0].type);
		// console.log("townData.towns.length: ", townData.towns.length);
		$(".pop-up.pre-game .town-list").empty();
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
			// console.log("Selected town index: ", $(".town-list-item.selected").data("index"));
			townIndex = $(".town-list-item.selected").data("index");
		}

		// console.log("playerName: ", playerName);
		// console.log("townName: ", townName);
		// console.log("townIndex: ", townIndex);

		// console.log("textBoxesValid: ", textBoxesValid);
		// console.log("townSelectionValid: ", townSelectionValid);

		if(textBoxesValid === true && townSelectionValid === true)
		{
			console.log("Valid Settings!");
			$(".pop-up.pre-game .error-message.text-boxes").hide();
			$(".pop-up.pre-game .error-message.town").hide();

			requestData.commandLine = "startNewGame";
			requestData.playerSettings.playerName = playerName;
			requestData.playerSettings.townName = townName;
			requestData.playerSettings.townIndex = townIndex;
			// console.log("requestData: ", requestData);
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
		// console.log("updateData: ", updateData);
		// console.log("updateData(JSON.stringify): " + JSON.stringify(updateData));

		$(".pop-up.pre-game").hide(500);
		$(".site-cover").fadeOut(500);

		var players = updateData["world"]["players"];
		var currentEventCard = updateData["world"]["currentEventCard"];

		buildPlayerDisplays(players);
		buildEventCardDisplay(currentEventCard);
	}

	function buildToolCardDisplay(toolCards)
	{
		var cardSection = $(".player-card-section");
		var newToolCard;
		var descriptionRow;

		for(var i = 0; i < toolCards.length; i++)
		{
			// toolCard = $("#tool-card-" + i);
			newToolCard = $("<div>").addClass("tool-card");
			newToolCard.data("cardIndex", i);
			newToolCard.data("targetSelf", toolCards[i]["targetSelf"]);

			newToolCard.append($("<h2>").text(toolCards[i]["title"]));

			newToolCard.append(buildCardEffectRow("Cost", toolCards[i]["costEffect"]));
			newToolCard.append(buildCardEffectRow("Self Effect", toolCards[i]["selfEffect"]));
			newToolCard.append(buildCardEffectRow("Opponent Effect", toolCards[i]["opponentEffect"]));

			descriptionRow = $("<section>").addClass("card-row");
			descriptionRow.append($("<h3>").text("Description"));
			descriptionRow.append($("<p>").text(toolCards[i]["description"]));
			newToolCard.append(descriptionRow);

			cardSection.append(newToolCard);
		}
	}

	

	

	function buildEventCardDisplay(eventCard)
	{
		var newEventCard = $(".event-card");
		// var winCondition = display.find(".win-condition");
		// var loseCondition = display.find(".lose-condition");
		var descriptionRow = $("<section>").addClass("card-row");
		// var startupEffect = display.find(".startup-effect");
		// var winEffect = display.find(".win-effect");
		// var loseEffect = display.find(".lose-effect");

		newEventCard.append($("<h2>").text(eventCard["title"]));

		// //winCondition
		// winCondition.find(".condition-type").text(conditionTypeToText(eventCard["winCondition"]["conditionType"]));
		// winCondition.find(".stats-type").attr({
		// 	"src": "Images/" + eventCard["winCondition"]["statsType"] + ".png",
		// 	"alt": eventCard["winCondition"]["statsType"],
		// 	"title": eventCard["winCondition"]["statsType"]
		// });

		// if(eventCard["winCondition"]["conditionType"] != "highestOfPlayers" && eventCard["winCondition"]["conditionType"] != "lowestOfPlayers")
		// {
		// 	winCondition.find(".condition-value").text(eventCard["winCondition"]["value"]);
		// }
		// else
		// {
		// 	winCondition.find(".condition-value").text("");
		// }
		

		// //loseCondition
		// loseCondition.find(".condition-type").text(conditionTypeToText(eventCard["loseCondition"]["conditionType"]));
		// loseCondition.find(".stats-type").attr({
		// 	"src": "Images/" + eventCard["loseCondition"]["statsType"] + ".png",
		// 	"alt": eventCard["loseCondition"]["statsType"],
		// 	"title": eventCard["loseCondition"]["statsType"]
		// });
		// if(eventCard["loseCondition"]["conditionType"] != "highestOfPlayers" && eventCard["loseCondition"]["conditionType"] != "lowestOfPlayers")
		// {
		// 	loseCondition.find(".condition-value").text(eventCard["loseCondition"]["value"]);
		// }
		// else
		// {
		// 	loseCondition.find(".condition-value").text("");
		// }





		newEventCard.append(buildCardEffectRow("Startup Effect", eventCard["startupEffect"]));
		newEventCard.append(buildCardEffectRow("Win Effect", eventCard["winEffect"]));
		newEventCard.append(buildCardEffectRow("Lose Effect", eventCard["loseEffect"]));

		descriptionRow.append($("<h3>").text("Description"));
		descriptionRow.append($("<p>").text(eventCard["description"]));
		newEventCard.append(descriptionRow);
		// startupEffect.find(".food-value").text(eventCard["startupEffect"]["food"]);
		// startupEffect.find(".happiness-value").text(eventCard["startupEffect"]["happiness"]);
		// startupEffect.find(".money-value").text(eventCard["startupEffect"]["money"]);
		// startupEffect.find(".education-value").text(eventCard["startupEffect"]["education"]);
		// startupEffect.find(".military-value").text(eventCard["startupEffect"]["military"]);
		// startupEffect.find(".population-value").text(eventCard["startupEffect"]["population"]);
		// startupEffect.find(".cardsToRemove-value").text(eventCard["startupEffect"]["cardsToRemove"]);

		// winEffect.find(".food-value").text(eventCard["winEffect"]["food"]);
		// winEffect.find(".happiness-value").text(eventCard["winEffect"]["happiness"]);
		// winEffect.find(".money-value").text(eventCard["winEffect"]["money"]);
		// winEffect.find(".education-value").text(eventCard["winEffect"]["education"]);
		// winEffect.find(".military-value").text(eventCard["winEffect"]["military"]);
		// winEffect.find(".population-value").text(eventCard["winEffect"]["population"]);
		// winEffect.find(".cardsToRemove-value").text(eventCard["winEffect"]["cardsToRemove"]);

		// loseEffect.find(".food-value").text(eventCard["loseEffect"]["food"]);
		// loseEffect.find(".happiness-value").text(eventCard["loseEffect"]["happiness"]);
		// loseEffect.find(".money-value").text(eventCard["loseEffect"]["money"]);
		// loseEffect.find(".education-value").text(eventCard["loseEffect"]["education"]);
		// loseEffect.find(".military-value").text(eventCard["loseEffect"]["military"]);
		// loseEffect.find(".population-value").text(eventCard["loseEffect"]["population"]);
		// loseEffect.find(".cardsToRemove-value").text(eventCard["loseEffect"]["cardsToRemove"]);

		// newEventCard.find(".description-value").text(eventCard["description"]);
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

	function buildCardEffectRow(label, effects)
	{
		var anyEffects = false;
		var newRow = $("<section>").addClass("card-row");
		newRow.append($("<h3>").text(label));

		for(var effect in effects)
		{
			if (effects[effect] !== 0)
			{
				anyEffects = true;
				newRow.append(buildStats(effect, effects[effect]));
			}
		}

		if (anyEffects === true)
		{
			// console.log("newRow: ", newRow);
			return newRow;
		}
		else
		{
			return false;
		}
	}

	function buildStats(statsType, value)
	{
		var newStat = $("<section>").addClass("stats");
		var statText = camelCaseToNormalCase(statsType);
		// console.log("newStat, at start: ", newStat);
		newStat.append($("<img>").attr(
			{
				"src" : "Images/" + statsType + ".png",
				"alt" : statText,
				"title" : statText
			}));
		// console.log("newStat, after imege added: ", newStat);
		// if(showValue === true)
		// {
			// console.log("value:", value);
			newStat.append($("<p>").text(value));
		// }
		// console.log("newStat, before return: ", newStat);
		return newStat;
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

	function buildPlayerDisplays(players)
	{
		$(".cards-on-hand").empty();
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

				buildToolCardDisplay(players[i]["toolCards"]);
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

				// console.log("Computer - cards on hand: " ,players[i]["toolCardsInDeck"]);
				for(var j = 0; j < players[i]["toolCardsInDeck"]; j++)//
				{
					// console.log("Shit stain");
					var cardImage = $("<img>").attr(
					{
						"src" : "Images/cardOnHand.png",
						"alt" : "Card on hand",
						"title" : "Card on hand"
					});
					display.find(".cards-on-hand").append(cardImage);
				}

				display.find(".name-value").text(playerNameAndTitle);
			}
		}
	}

	function cardOnClick()
	{
		$(".site-cover").fadeIn(500);
		$(".pop-up.use-card").show(500);

		var card = $(this);

		requestData.cardIndex = card.data("cardIndex");
	}

	function useCard()
	{
		

		



		if(card.data("targetSelf") == true)
		{
			console.log("targetSelf = true");
			requestData.opponentIndex = null;
			
			requestData.commandLine = "useToolCard";
			contactPHP(requestData, updateBoard);
		}
		else
		{
			console.log("targetSelf = false");
			// requestData.opponentIndex = ;
			// pickTargetPopup();
		}
	}

	function pickTarget()
	{
		// $(".site-cover").fadeIn(500);
		// $(".pop-up.use-card").show(500);
		
		// requestData.opponentIndex = ;
	}

	siteStartup();
});