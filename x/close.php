<?php
	if ($method == "close")
	{
		if ($type == "")
		{
			echo'
			<table align="center" class="grid" border="0" cellspacing="1" cellpadding="4" width="80%">
			<form method="post" action="cp_home.php?mode=close&method=close&type=insert_data">
					<td class="cat" colspan="2"><nobr>����� �������</nobr></td>	
						<tr class="fixed">
					<td class="list"><nobr>����� �������</nobr></td>
					<td class="userdetails_data"><input type="radio" value="1" name="forum_status" '.check_radio($forum_status, "1").'>����&nbsp;&nbsp;
					<input type="radio" value="0" name="forum_status" '.check_radio($forum_status, "0").'>�����</td>
				</tr>
					<tr class="fixed">
					<td align="middle" colspan="2"><input type="submit" value="����� ������">&nbsp;&nbsp;&nbsp;<input type="reset" value="����� �� ������"></td>
				</tr>
			</form>
			</table>';
		}

		if ($type == "insert_data")
		{
			$Admin_ForumStatus = $_POST["forum_status"];
			if ($error != "")
			{
						echo'<br><center>
						<table bordercolor="#ffffff" width="99%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5" color="red"><br>���<br>'.$error.'..</font><br><br>
							   <a href="JavaScript:history.go(-1)">-- ���� ��� ������ --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
			}
			if ($error == "")
			{
				updata_mysql("FORUM_STATUS", $Admin_ForumStatus);

				echo'<br><br>
				<center>
				<table bordercolor="#ffffff" width="50%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br>�� ����� ������ �����..</font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=cp_home.php?mode=close&method=close">
					   <a href="cp_home.php?mode=close&method=close">-- ���� ��� ������ ��� ���� ������� --</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';
			}
		}
	}
	
	if ($method == "msg")
	{
		if ($type == "")
		{
			echo'
			<center>
			<table class="grid" border="0" cellspacing="1" cellpadding="1" width="80%">
			<form method="post" action="cp_home.php?mode=close&method=msg&type=insert_data">
					<td class="cat" colspan="2"><nobr>����� ��� �������</nobr></td>	
				</tr>

			<tr class="fixed">
			<td class="list"><nobr>�������</nobr></td>
						<td class="middle">
			<textarea name="close" style="HEIGHT:169;WIDTH: 646;FONT-WEIGHT: bold;FONT-SIZE: 15px;BACKGROUND: darkseagreen;COLOR: #000000;FONT-FAMILY: Times New Roman" cols="1" rows="999">'.$close.'</textarea></td>
			</tr>

						<tr class="fixed">
					<td align="middle" colspan="2"><input type="submit" value="����� ������">&nbsp;&nbsp;&nbsp;<input type="reset" value="����� �� ������"></td>
				</tr>
			</form>
			</table>
			</center>';
		}
		if ($type == "insert_data")
		{
			if ($error != "")
			{
				echo'<br><center>
				<table bordercolor="#ffffff" width="99%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5" color="red"><br>���<br>'.$error.'..</font><br><br>
					   <a href="JavaScript:history.go(-1)">-- ���� ��� ������ --</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';
			}
			if ($error == "")
			{
				updata_mysql("close", $_POST['close']);

				echo'<br><br>
				<center>
				<table bordercolor="#ffffff" width="50%" border="1">
				   <tr class="normal">
					   <td class="list_center" colSpan="10"><font size="5"><br>�� ����� ������ �����..</font><br><br>
					   <meta http-equiv="Refresh" content="1; URL=cp_home.php?mode=close&method=msg">
					   <a href="cp_home.php?mode=close&method=msg">-- ���� ��� ������ ��� ���� ������� --</a><br><br>
					   </td>
				   </tr>
				</table>
				</center>';
			}
		}
	}
?>