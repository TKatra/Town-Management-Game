$(function ()
{
	var requestData = {
		commandLine:null,
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
		var eventCard = updateData["world"]["currentEventCard"];


		for (var i = 0; i < players.length; i++)
		{
			var playerNameAndTitle = players[i]["name"] + " the mayor of " + players[i]["town"]["name"] + " the " + players[i]["town"]["type"];
			if(players[i]["isComputer"] != true)
			{

			}
			else
			{
				var display = $("#opponent-" + players[i]["id"]);
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

	siteStartup();
});