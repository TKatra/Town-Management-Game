$(function ()
{
	var requestData = {
		commandLine:""
	};
	function siteStartup()
	{
		$(".pop-up").hide();
		$(".error-message").hide();
		$(".pop-up.pre-game").show();

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
				console.log(data.responseText);
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

			}
		});

		if($(".town-list-item.selected").length != 1)
		{
			townSelectionValid = false;
		}
		else
		{
			console.log("Selected town index", $(".town-list-item.selected").data("index"));
		}

		console.log("textBoxesValid: ", textBoxesValid);
		console.log("townSelectionValid: ", townSelectionValid);

		if(textBoxesValid === true && townSelectionValid === true)
		{
			$(".pop-up.pre-game .error-message.text-boxes").hide();
			$(".pop-up.pre-game .error-message.town").hide();

			requestData.commandLine = "startNewGame";
			requestData.playerSettings.playerName = 
			contactPHP(requestData, updateBoard);
		}
		else 
		{
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
		console.log("updateData: ", updateData);
	}

	siteStartup();
});