$(function ()
{
	var requestData = {
		commandLine:""
	};
	function siteStartup()
	{
		requestData.commandLine = "preGameBuild";
		console.log(requestData);
		contactPHP(requestData, temp);
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

	function temp(data)
	{
		console.log(data);
	}

	siteStartup();
});