function buildToolCardDisplay(toolCards)
{
	var cardSection = $(".player-card-section");
	var newToolCard;
	var descriptionRow;
	cardSection.empty();

	for(var i = 0; i < toolCards.length; i++)
	{
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
	var descriptionRow = $("<section>").addClass("card-row");

	newEventCard.empty();
	newEventCard.append($("<h2>").text(eventCard["title"]));

	newEventCard.append($("<h3>").text("Win Condition"));
	newEventCard.append(buildCardConditionRow("Win Condition", eventCard["winCondition"]));

	newEventCard.append($("<h3>").text("Lose Condition"));
	newEventCard.append(buildCardConditionRow("Lose Condition", eventCard["loseCondition"]));

	newEventCard.append(buildCardEffectRow("Startup Effect", eventCard["startupEffect"]));
	newEventCard.append(buildCardEffectRow("Win Effect", eventCard["winEffect"]));
	newEventCard.append(buildCardEffectRow("Lose Effect", eventCard["loseEffect"]));

	descriptionRow.append($("<h3>").text("Description"));
	descriptionRow.append($("<p>").text(eventCard["description"]));
	newEventCard.append(descriptionRow);
}

function buildCardConditionRow(label, condition)
{
	var newConditionRow = $("<section>").addClass("card-row");

	newConditionRow.append($("<p>").text(conditionTypeToText(condition["conditionType"])));
	newConditionRow.append(buildStats(condition["statsType"], condition["value"]));

	return newConditionRow;
}

function buildCardEffectRow(label, effects)
{
	var anyEffects = false;
	var newEffectRow = $("<section>").addClass("card-row");
	newEffectRow.append($("<h3>").text(label));

	for(var effect in effects)
	{
		if (effects[effect] !== 0)
		{
			anyEffects = true;
			newEffectRow.append(buildStats(effect, effects[effect]));
		}
	}

	if (anyEffects === true)
	{
		return newEffectRow;
	}
	else
	{
		return false;
	}
}