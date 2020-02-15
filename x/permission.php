<?php
	if ($method == "mon") {

	 if ($type == "") {

	echo'
	<center>
	<table class="grid" border="0" cellspacing="1" cellpadding="4" width="80%">
	<form method="post" action="cp_home.php?mode=permission&method=mon&type=insert">
		<tr class="fixed">
			<td class="cat" colspan="2"><nobr>йзоМА йягнМу ЦягчхМД</nobr></td>
		</tr>
		<tr class="fixed">
			<td class="list">Цягчхи гАясгфА</td>
			<td class="userdetails_data"><input type="radio" value="1" name="CAN_SHOW_PM" '.check_radio($CAN_SHOW_PM, "1").'>ДзЦ&nbsp;&nbsp;
			<input type="radio" value="0" name="CAN_SHOW_PM" '.check_radio($CAN_SHOW_PM, "0").'>Аг</td>
		<tr class="fixed">
			<td class="list">чщА гАзжФМгй</td>
			<td class="userdetails_data"><input type="radio" value="1" name="CAN_CLOSE_M" '.check_radio($CAN_CLOSE_M, "1").'>ДзЦ&nbsp;&nbsp;
			<input type="radio" value="0" name="CAN_CLOSE_M" '.check_radio($CAN_CLOSE_M, "0").'>Аг</td>
		</tr>
		<tr class="fixed">
			<td class="list">щйм гАзжФМгй</td>
			<td class="userdetails_data"><input type="radio" value="1" name="CAN_OPEN_M" '.check_radio($CAN_OPEN_M, "1").'>ДзЦ&nbsp;&nbsp;
			<input type="radio" value="0" name="CAN_OPEN_M" '.check_radio($CAN_OPEN_M, "0").'>Аг</td>
		</tr>
		<tr class="fixed">
			<td align="middle" colspan="2"><input type="submit" value="еонгА хМгДгй">&nbsp;&nbsp;&nbsp;<input type="reset" value="еялгз Ду гАцуАМ"></td>
		</tr>
	';
	echo'
	</form>
	</table>
	</center>';
	 }

	 if ($type == "insert") {

	updata_mysql("CAN_SHOW_PM", $_POST['CAN_SHOW_PM']);
	updata_mysql("CAN_CLOSE_M", $_POST['CAN_CLOSE_M']);
	updata_mysql("CAN_OPEN_M", $_POST['CAN_OPEN_M']);
		if ($error != "") {
						echo'<br><center>
						<table bordercolor="#ffffff" width="99%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5" color="red"><br>ньц<br>'.$error.'..</font><br><br>
							   <a href="JavaScript:history.go(-1)">-- ежшь ЕДг ААялФз --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}


		if ($error == "") {

						echo'<br><br>
						<center>
						<table bordercolor="#ffffff" width="50%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5"><br>йЦ йзоМА хМгДгй хДлгм..</font><br><br>
							   <meta http-equiv="Refresh" content="2; URL=cp_home.php?mode=permission&method=mon">
							   <a href="cp_home.php?mode=permission&method=mon">-- гДчя ЕДг ААпЕгх гАЛ ущми гАгуАМи --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}

	 }

	}


	if ($method == "mod") {

	 if ($type == "") {

	echo'
	<center>
	<table class="grid" border="0" cellspacing="1" cellpadding="4" width="80%">
	<form method="post" action="cp_home.php?mode=permission&method=mod&type=insert">
		<tr class="fixed">
			<td class="cat" colspan="2"><nobr>йзоМА йягнМу гАЦтящМД</nobr></td>
		</tr>
		<tr class="fixed">
			<td class="list"><nobr>ежгщи цФугщ ААЦДйоЛ</nobr></td>
			<td class="userdetails_data">
			<input type="radio" value="1" name="mod_add_titles" '.check_radio($mod_add_titles, "1").'>ДзЦ&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" value="0" name="mod_add_titles" '.check_radio($mod_add_titles, "0").'>Аг
			</td>
		</tr>
		<tr class="fixed">
			<td class="list"><nobr>ежгщи цФсЦи ААЦДйоЛ</nobr></td>
			<td class="userdetails_data">
			<input type="radio" value="1" name="mod_add_medals" '.check_radio($mod_add_medals, "1").'>ДзЦ&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" value="0" name="mod_add_medals" '.check_radio($mod_add_medals, "0").'>Аг
			</td>
		</tr>
		<tr class="fixed">
			<td align="middle" colspan="2"><input type="submit" value="еонгА хМгДгй">&nbsp;&nbsp;&nbsp;<input type="reset" value="еялгз Ду гАцуАМ"></td>
		</tr>
	</form>
	</table>
	</center>';
	 }

	 if ($type == "insert") {

	$mod_add_titles = $_POST["mod_add_titles"];
	$mod_add_medals = $_POST["mod_add_medals"];

		if ($error != "") {
						echo'<br><center>
						<table bordercolor="#ffffff" width="99%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5" color="red"><br>ньц<br>'.$error.'..</font><br><br>
							   <a href="JavaScript:history.go(-1)">-- ежшь ЕДг ААялФз --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}


		if ($error == "") {

	updata_mysql("MOD_ADD_TITLES", $mod_add_titles);
	updata_mysql("MOD_ADD_MEDALS", $mod_add_medals);

						echo'<br><br>
						<center>
						<table bordercolor="#ffffff" width="50%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5"><br>йЦ йзоМА хМгДгй хДлгм..</font><br><br>
							   <meta http-equiv="Refresh" content="2; URL=cp_home.php?mode=permission&method=mod">
							   <a href="cp_home.php?mode=permission&method=mod">-- гДчя ЕДг ААпЕгх гАЛ ущми гАгуАМи --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}

	 }

	}

	if ($method == "mem") {

	 if ($type == "") {

	echo'
	<center>
	<table class="grid" border="0" cellspacing="1" cellpadding="4" width="80%">
	<form method="post" action="cp_home.php?mode=permission&method=mem&type=insert">
		<tr class="fixed">
			<td class="cat" colspan="2"><nobr>йзоМА йягнМу цзжга</nobr></td>
		</tr>
		<tr class="fixed">
			<td class="list_center" colspan="2"><br>Аг МФло йягнМу мгАМгП<br><br></td>
		</tr>';
	// 	<tr class="fixed">
	//		<td align="middle" colspan="2"><input type="submit" value="еонгА хМгДгй">&nbsp;&nbsp;&nbsp;<input type="reset" value="еялгз Ду гАцуАМ"></td>
	//	</tr>
	echo'
	</form>
	</table>
	</center>';
	 }

	 if ($type == "insert") {

		if ($error != "") {
						echo'<br><center>
						<table bordercolor="#ffffff" width="99%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5" color="red"><br>ньц<br>'.$error.'..</font><br><br>
							   <a href="JavaScript:history.go(-1)">-- ежшь ЕДг ААялФз --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}


		if ($error == "") {

						echo'<br><br>
						<center>
						<table bordercolor="#ffffff" width="50%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5"><br>йЦ йзоМА хМгДгй хДлгм..</font><br><br>
							   <meta http-equiv="Refresh" content="2; URL=cp_home.php?mode=permission&method=mem">
							   <a href="cp_home.php?mode=permission&method=mem">-- гДчя ЕДг ААпЕгх гАЛ ущми гАгуАМи --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}

	 }

	}


	if ($method == "bad") {

	 if ($type == "") {

	echo'
	<center>
	<table class="grid" border="0" cellspacing="1" cellpadding="4" width="80%">
	<form method="post" action="cp_home.php?mode=permission&method=bad&type=insert">
		<tr class="fixed">
			<td class="cat" colspan="2"><nobr>йзоМА йягнМу цзжга ЦЦДФзМД</nobr></td>
		</tr>
		<tr class="fixed">
			<td class="list_center" colspan="2"><br>Аг МФло йягнМу мгАМгП<br><br></td>
		</tr>';
	// 	<tr class="fixed">
	//		<td align="middle" colspan="2"><input type="submit" value="еонгА хМгДгй">&nbsp;&nbsp;&nbsp;<input type="reset" value="еялгз Ду гАцуАМ"></td>
	//	</tr>
	echo'
	</form>
	</table>
	</center>';
	 }

	 if ($type == "insert") {

		if ($error != "") {
						echo'<br><center>
						<table bordercolor="#ffffff" width="99%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5" color="red"><br>ньц<br>'.$error.'..</font><br><br>
							   <a href="JavaScript:history.go(-1)">-- ежшь ЕДг ААялФз --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}


		if ($error == "") {

						echo'<br><br>
						<center>
						<table bordercolor="#ffffff" width="50%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5"><br>йЦ йзоМА хМгДгй хДлгм..</font><br><br>
							   <meta http-equiv="Refresh" content="2; URL=cp_home.php?mode=permission&method=bad">
							   <a href="cp_home.php?mode=permission&method=bad">-- гДчя ЕДг ААпЕгх гАЛ ущми гАгуАМи --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}

	 }

	}
	 
	 
	 if ($method == "visitor") {

	 if ($type == "") {

	echo'
	<center>
	<table class="grid" border="0" cellspacing="1" cellpadding="4" width="80%">
	<form method="post" action="cp_home.php?mode=permission&method=visitor&type=insert">
		<tr class="fixed">
			<td class="cat" colspan="2"><nobr>йзоМА йягнМу гАрФгя</nobr></td>
		</tr>
		<tr class="fixed">
			<td class="list">ЦтгЕои гАЦДйоЛ</td>
			<td class="userdetails_data"><input type="radio" value="0" name="CAN_SHOW_FORUM" '.check_radio($CAN_SHOW_FORUM, "0").'>ДзЦ&nbsp;&nbsp;
			<input type="radio" value="1" name="CAN_SHOW_FORUM" '.check_radio($CAN_SHOW_FORUM, "1").'>Аг</td>
		</tr>
		<tr class="fixed">
			<td class="list">ЦтгЕои гАЦФгжМз</td>
			<td class="userdetails_data"><input type="radio" value="0" name="CAN_SHOW_TOPIC" '.check_radio($CAN_SHOW_TOPIC, "0").'>ДзЦ&nbsp;&nbsp;
			<input type="radio" value="1" name="CAN_SHOW_TOPIC" '.check_radio($CAN_SHOW_TOPIC, "1").'>Аг
	&nbsp;&nbsp;
			<input type="radio" value="2" name="CAN_SHOW_TOPIC" '.check_radio($CAN_SHOW_TOPIC, "2").'>лра ЦД гАЦФжФз
	</td>
		</tr>
		<tr class="fixed">
			<td class="list">ЦтгЕои гАзжФМгй</td>
			<td class="userdetails_data"><input type="radio" value="0" name="CAN_SHOW_PROFILE" '.check_radio($CAN_SHOW_PROFILE, "0").'>ДзЦ&nbsp;&nbsp;
			<input type="radio" value="1" name="CAN_SHOW_PROFILE" '.check_radio($CAN_SHOW_PROFILE, "1").'>Аг</td>
		</tr>
		<tr class="fixed">
			<td align="middle" colspan="2"><input type="submit" value="еонгА хМгДгй">&nbsp;&nbsp;&nbsp;<input type="reset" value="еялгз Ду гАцуАМ"></td>
		</tr>
	';
	echo'
	</form>
	</table>
	</center>';
	 }

	 if ($type == "insert") {


		if ($error != "") {
						echo'<br><center>
						<table bordercolor="#ffffff" width="99%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5" color="red"><br>ньц<br>'.$error.'..</font><br><br>
							   <a href="JavaScript:history.go(-1)">-- ежшь ЕДг ААялФз --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}


		if ($error == "") {

	updata_mysql("CAN_SHOW_FORUM", $_POST['CAN_SHOW_FORUM']);
	updata_mysql("CAN_SHOW_TOPIC", $_POST['CAN_SHOW_TOPIC']);
	updata_mysql("CAN_SHOW_PROFILE", $_POST['CAN_SHOW_PROFILE']);

						echo'<br><br>
						<center>
						<table bordercolor="#ffffff" width="50%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5"><br>йЦ йзоМА хМгДгй хДлгм..</font><br><br>
							   <meta http-equiv="Refresh" content="2; URL=cp_home.php?mode=permission&method=visitor">
							   <a href="cp_home.php?mode=permission&method=visitor">-- гДчя ЕДг ААпЕгх гАЛ ущми гАгуАМи --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}

	 }

	}
	 if ($method == "new") {

	 if ($type == "") {

	echo'
	<center>
	<table class="grid" border="0" cellspacing="1" cellpadding="4" width="80%">
	<form method="post" action="cp_home.php?mode=permission&method=new&type=insert">
		<tr class="fixed">
			<td class="cat" colspan="2"><nobr>йзоМА йягнМу гАцзжга гАлоо</nobr></td>
		</tr>
		<tr class="fixed">
			<td class="list"><nobr>зоо Цтгяъгй гАцзжга гАлоо мйЛ МтгЕоФг ЦФгжМз гАцняМД</nobr></td>
			<td class="middle"><input type="text" name="new_member_show_topic" size="10" value="'.$new_member_show_topic.'"></td>
		</tr>
		<tr class="fixed">
			<td class="list"><nobr>зоо Цтгяъгй гАцзжга гАлоо мйЛ МйЦ ящз гАячгхи зДЕЦ</nobr></td>
			<td class="middle"><input type="text" name="new_member_min_posts" size="10" value="'.$new_member_min_posts.'"></td>
		</tr>
		<tr class="fixed">
			<td class="list"><nobr>зоо Цтгяъгй гАцзжга гАлоо мйЛ МсЦм АЕЦ хйшМя гсЦгфЕЦ</nobr></td>
			<td class="middle"><input type="text" name="new_member_change_name" size="10" value="'.$new_member_change_name.'">
		</tr>
	<tr class="fixed">
			<td class="list"><nobr>зоо Цтгяъгй гАцзжга гАлоо мйЛ МйЦ ящз ячгхи гАясгфА зДЕЦ</nobr></td>
			<td class="middle"><input type="text" name="new_member_min_posts_pm" size="10" value="'.$new_member_min_posts_pm.'"></td>
			</tr>
	<tr class="fixed">
			<td class="list"><nobr>зоо Цтгяъгй гАцзжга гАлоо мйЛ МйЦ ящз ячгхи гАхмк зДЕЦ</nobr></td>
			<td class="middle"><input type="text" name="new_member_min_search" size="10" value="'.$new_member_min_search.'"></td>
		</tr>
		<tr class="fixed">
			<td align="middle" colspan="2"><input type="submit" value="еонгА хМгДгй">&nbsp;&nbsp;&nbsp;<input type="reset" value="еялгз Ду гАцуАМ"></td>
		</tr>
	';
	echo'
	</form>
	</table>
	</center>';
	 }

	 if ($type == "insert") {

	updata_mysql("NEW_MEMBER_MIN_SEARCH", $_POST['new_member_min_search']);
	updata_mysql("NEW_MEMBER_SHOW_TOPIC", $_POST['new_member_show_topic']);
	updata_mysql("NEW_MEMBER_CHANGE_NAME", $_POST['new_member_change_name']);
	updata_mysql("NEW_MEMBER_MIN_POSTS_PM", $_POST['new_member_min_posts_pm']);
	updata_mysql("NEW_MEMBER_MIN_POSTS", $_POST['new_member_min_posts']);
		if ($error != "") {
						echo'<br><center>
						<table bordercolor="#ffffff" width="99%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5" color="red"><br>ньц<br>'.$error.'..</font><br><br>
							   <a href="JavaScript:history.go(-1)">-- ежшь ЕДг ААялФз --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}


			if ($error == "")
			{

				echo'<br><br>
				<center>
				<table bordercolor="#ffffff" width="50%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br>йЦ йзоМА хМгДгй хДлгм..</font><br><br>
					   <meta http-equiv="Refresh" content="2; URL=cp_home.php?mode=permission&method=new">
					   <a href="cp_home.php?mode=permission&method=new">-- гДчя ЕДг ААпЕгх гАЛ ущми гАгуАМи --</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';
			}
		}
	}
?>
