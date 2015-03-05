var requestData;
$(function ()
{
	
	$("div.button.button-start-game").click(startGameButtonOnClick);
	$("div.button.button-restart-game").click(restartGameButtonOnClick);

	

	siteStartup();
});

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
	contactPHP(requestData, showPreGamePopUp);
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