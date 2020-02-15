<?
	// function send pm 
	function send_pm($from, $to, $subject, $message, $date)
	{

		global $Prefix, $connection;

		 $send_pm = "INSERT INTO PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_OUT, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
		 $send_pm .= " '$from', ";
		 $send_pm .= " '$to', ";
		 $send_pm .= " '$from', ";
		 $send_pm .= " '1', ";
		 $send_pm .= " '$subject', ";
		 $send_pm .= " '$message', ";
		 $send_pm .= " '$date') ";

		 mysql_query($send_pm, $connection) or die (mysql_error());

		 $store_pm = "INSERT INTO PM (PM_ID, PM_MID, PM_TO, PM_FROM, PM_SUBJECT, PM_MESSAGE, PM_DATE) VALUES (NULL, ";
		 $store_pm .= " '$to', ";
		 $store_pm .= " '$to', ";
		 $store_pm .= " '$from', ";
		 $store_pm .= " '$subject', ";
		 $store_pm .= " '$message', ";
		 $store_pm .= " '$date') ";

		 mysql_query($store_pm, $connection) or die (mysql_error());
	}



	if ($type == "")
	{
		echo'
		<center>
		<table class="grid" border="0" cellspacing="1" cellpadding="1" width="80%">
		<form method="post" action="cp_home.php?mode=pm&type=insert_data">
			<tr class="fixed">
				<td class="cat" colspan="2"><nobr>«—”«· —”«·… Ã„«⁄Ì…</nobr></td>
			</tr>
			<tr class="fixed">
				<td class="list"><nobr>⁄‰Ê«‰ «·—”«·…</nobr></td>
				<td class="middle">
					<input type="text" name="subject">
				</td>
		</tr>
		<tr class="fixed">
		<td class="list"><nobr>„Õ ÊÏ «·—”«·…</nobr></td>
					<td class="middle"><textarea name="message" style="HEIGHT: 80px;WIDTH: 300px;FONT-WEIGHT: bold;FONT-SIZE: 15px;BACKGROUND: darkseagreen;COLOR: white;FONT-FAMILY: tahoma"></textarea></td>
		</td>
			</tr>
			<tr class="fixed">
				<td class="list"><nobr>«·„Ã„Ê⁄…</nobr></td>
				<td class="middle">
					<select class="insidetitle" name="level">
					<option value="all">«·ﬂ·</option>
					<option value="1">«·«⁄÷«¡</option>
					<option value="2">«·„‘—›Ì‰</option>
					<option value="3">«·„—«ﬁ»Ì‰</option>
					</select>
				</td>
		</tr>
			<tr class="fixed">
				<td class="list"><nobr>«⁄÷«¡ „ÕœœÌ‰</nobr></td>
				<td class="middle">
					<input type="text" name="array_m"><nobr>&nbsp;<font color="red">»⁄œ  ÕœÌœ «·„Ã„Ê⁄… Ì„ﬂ‰ﬂ «—”«· «·—”«·… «·Ï «⁄÷«¡ „ÕœœÌ‰ œ«Œ· ÂœÂ «·„Ã„Ê⁄… <br> Ìﬂ›Ì Ê÷⁄ «”„ «·⁄÷ÊÌ… Ê«·›’· »Ì‰ ﬂ· «”„ Ê«Œ— »«·—„“ ; </nobr></font>
				</td>
		</tr>
			<tr class="fixed">
				<td align="middle" colspan="2"><input type="submit" value="√—”·">&nbsp;&nbsp;&nbsp;<input type="reset" value="≈—Ã«⁄ ‰’ «·√’·Ì"></form></td>
			</tr></table>
		</center>';
	}

	if($type == "insert_data")
	{
		$subject = trim($_POST['subject']);
		$message = $_POST['message'];
		$message = str_replace("\n","<br>",$message);
		$level = $_POST['level'];
		$array_m = $_POST['array_m'];
		$date = time();


		// ########## If it isnt array ########

		if(!$array_m)
		{
			// ########## To All Member ########
			if($level == "all")
			{
				$sql = mysql_query("select * from MEMBERS WHERE M_LEVEL NOT IN(4) ORDER BY MEMBER_ID ") or die(mysql_error());
				while($r = mysql_fetch_array($sql))
				{
					send_pm($CPMemberID, $r['MEMBER_ID'], $subject, $message, $date);
				}
			}
			// ########## To All Member ########
			if($level != "all")
			{
				$sql = mysql_query("select * from MEMBERS WHERE M_LEVEL = '$level' ORDER BY MEMBER_ID ") or die(mysql_error());
				while($r = mysql_fetch_array($sql))
				{
					send_pm($CPMemberID, $r['MEMBER_ID'], $subject, $message, $date);
				}
			}
		}

		// ########## If it array ########
		if($array_m)
		{
			$m = explode(";",$array_m);
			if($level == "all"){
			$and = "";
			}else{
			$and = " AND M_LEVEL = '$level' ";
			}
			for($i=0;$i<count($m);$i++){
			$m_name = $m[$i];
			$r = mysql_fetch_array(mysql_query("select * from MEMBERS WHERE M_NAME = '$m_name' $and "));
			send_pm($CPMemberID, $r['MEMBER_ID'], $subject, $message, $date);
			}
		}

		echo'<br><br>
		<center>
		<table bordercolor="#ffffff" width="50%" border="1">
		   <tr class="normal">
			   <td class="list_center" colSpan="10"><font size="5"><br> „ «—”«· «·—”«·… «·Ã„«⁄Ì… »‰Ã«Õ ..</font><br><br>
			   <meta http-equiv="Refresh" content="2; URL=cp_home.php?mode=pm&method=send_pm">
			   <a href="cp_home.php?mode=pm&method=send_pm">-- «‰ﬁ— Â‰« ··–Â«» «·Ï ’›Õ… «·«’·Ì… --</a><br><br>
			   </td>
		   </tr>
		</table>
		</center>';

	}


	?>