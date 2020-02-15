function getMessagesCount(data)
{
	$.ajax({
		type: 'POST',
		url: 'process/message/get_messages_count.php',
		data: data,
		processData: false,
		contentType: false,
		success: function(result)
		{
			if(result != 0)
			{
				$("#header-messages-count").text(result).show();
			}
		}
	});
}

function markAsRead(data)
{
	$.ajax({
		type: "POST",
		url: "process/message/mark_as_read.php",
		data: data,
		contentType:false,
		processData: false,
		success: function(result)
		{
			if(result == 1)
			{
				$("#header-messages-count").hide();
			}
		}
	});
}

function fetchAllMessages(data)
{	
	$.ajax({
		type: "POST",
		url: "messages/fetch_data.php",
		data: data,
		processData: false,
		contentType: false,
		success: function(result)
		{
			$("#messages").html(result);
			var scrolltoh = $("#messages")[0].scrollHeight;
			$("#messages").scrollTop(scrolltoh);
		}
	});
}