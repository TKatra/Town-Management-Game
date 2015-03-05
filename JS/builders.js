function buildTownList(townData)
{
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



function buildStats(statsType, value)
{
	var newStat = $("<section>").addClass("stats");
	var statText = camelCaseToNormalCase(statsType);

	newStat.append($("<img>").attr(
		{
			"src" : "Images/" + statsType + ".png",
			"alt" : statText,
			"title" : statText
		}));
	if(value != 0)
	{
		newStat.append($("<p>").text(value));
	}

	return newStat;
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

			for(var j = 0; j < players[i]["toolCardsInDeck"]; j++)//
			{
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