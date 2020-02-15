function getNotifications(data)
{
	$("#div-notifi-content").hide();
	$("#div-notifi").append($("#middle-spinner").show());

	$.ajax({
		type: "POST",
		url: "process/get_all_notifications.php",
		data: data,
		processData: false,
		contentType: false,
		success: function(result)
		{
			setTimeout(function()
			{
				$("#middle-spinner").hide();
				$("#div-notifi-content").html(result).show();
			}, 800);
		}
	});
}