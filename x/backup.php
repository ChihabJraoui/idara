<script language="JavaScript"> 
	function checkAll(form)
	{
		for (var i = 0; i < form.elements.length; i++)
		{
			eval("form.elements[" + i + "].checked = form.elements[0].checked");  
		} 
	} 
</script> 

<?
	$tables = @mysql_query("SHOW TABLE STATUS");
?>

	<form name="form1" method="post" action="backup_done.php"/>
	<table class="grid" align="center" width="80%" cellpadding="6" cellspacing="1" border="0">
	<tr><td class="cat" colspan="5">Êֽדםב ה׃־ֹ ַֽÊםַ״םֹ דה ÞַÚֹֿ ַבָםַהַÊ</td></tr>
	<tr><td class="optionheader_selected" colspan="5" style="font-size:8pt;">ַ־Êׁ ַבַּֿזב ַבÊם Êׁםֿ Êײדםהוַ Ýם ַבה׃־ֹ ַבַֽÊםַ״םֹ זדה ֻד ַײÛ״ Úבל Êֽדםב</td></tr>
	<tr><td class="cat">ַבּֿזב</td><td class="cat">ַבד׃ַֹֽ</td><td class="cat"><input type="checkbox" name="check_all" checked="checked" onClick="checkAll(this.form)"/></td></tr>

<?
	$i = 0;
	while($table = @mysql_fetch_array($tables))
	{
		if($i % 2)
		{
			$td = "f1";
		}
		else
		{
			$td = "f2ts";
		}
		$size = round($table['Data_length']/1024, 2); // ַםַּֿ ּֽד ַבּֿזב ַָבßםבזַָםÊ
		echo "<tr><td width=\"20%\" class=\"$td\">$table[Name]</td><td width=\"65%\" class=\"$td\">$size ßםבזַָםÊ</td><td width=\"5%\" class=\"$td\"><input type=\"checkbox\" name=\"check[]\" value=\"$table[Name]\" checked=\"checked\" /></td></tr>";
		$i++;
	}
?>
	<tr><td colspan="5" class="optionheader_selected"><center><input type="submit" class="button" name="submit" value="Êֽדםב" /></center></td></tr>
	</table></form>
