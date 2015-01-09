$(function ()
{
	var requestData = {
		commandLine:""
	};
	function siteStartup()
	{

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
		console.log("townData: " + townData["towns"][0]);
	}

	siteStartup();
});