//--------- Functions -------------
function editorValidate()
{
	var subject = editorForm.subject.value;
	var message = editorForm.message.value;
	
	if(subject.lenght == 0)
	{
		alert("title_empty");
		return false;
	}
	else if(message.lenght == 0)
	{
		alert("message_empty");
		return false;
	}
	editorForm.submit();
}