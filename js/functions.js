/* Notice Function */
function Notice(msg, color)
{
	if(color)
		color = "green";
	else
        color = "red";

	var content='<div style="font: normal normal 13px tahoma; text-align: center;">'
				    + msg +
				'</div>';

    new jBox('Notice',
        {
            content: content,
            color: color,
            theme: "NoticeBorder",
            attributes: {
                x: 'left',
                y: 'bottom'
            },
            delayClose: 3000
        });
}