function selectTownClick()
{
	$(".town-list-item.selected").removeClass("selected");
	$(this).addClass("selected");
}

function cardOnClick()
{
	$(".site-cover").fadeIn(500);
	$(".pop-up.use-card").show(500);

	var card = $(this);

	requestData.cardIndex = card.data("cardIndex");
}

function useCardButtonOnClick()
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

function startGameButtonOnClick()
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
		townIndex = $(".town-list-item.selected").data("index");
	}

	if(textBoxesValid === true && townSelectionValid === true)
	{
		console.log("Valid Settings!");
		$(".pop-up.pre-game .error-message.text-boxes").hide();
		$(".pop-up.pre-game .error-message.town").hide();

		requestData.commandLine = "startNewGame";
		requestData.playerSettings.playerName = playerName;
		requestData.playerSettings.townName = townName;
		requestData.playerSettings.townIndex = townIndex;
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

function restartGameButtonOnClick()
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
	contactPHP(requestData, showPreGamePopUp);
}