$(function ()
{
	var requestData = {
		commandLine:""
	};
	function siteStartup()
	{
		console.log("dthdryyrdtr");
		requestData.commandLine = "preGameBuild";
		console.log(requestData);
		contactPHP(requestData, temp);
	}

	function contactPHP(request, successFunction)
	{
		console.log(request);
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

	function temp(data)
	{
		console.log(data);
	}

	siteStartup();
});