<?php
	
	if ($type == "")
	{

	echo'
	<center>
		<table class="grid" border="0" cellspacing="1" cellpadding="3" width="98%">
		<form method="post" action="cp_home.php?mode=best&type=insert_data">
				<td class="cat" colspan="4"><nobr>«⁄œ«œ«  «· „Ì“</nobr></td>
			</tr>
			 <tr class="fixed">
			 </td><td class="list"><nobr>Ê’› «·Œ«’Ì…</nobr>
			  <td class="userdetails_data"><input type="text" name="best_t" size="40" value="'.$best_t.'">
			  <td class="list"><nobr> ‘€Ì· «·Œ«’Ì…</nobr></td>
			  <td class="userdetails_data"><input type="radio" value="1" name="best" '.check_radio($best, "1").'>·«&nbsp;&nbsp;
				<input type="radio" value="0" name="best" '.check_radio($best, "0").'>‰⁄„</td>
			</tr>
				<tr class="fixed">
				<td class="list"><nobr>Ê’› «·⁄÷Ê «·„„Ì“</nobr>
				<td class="list"><input type="text" name="best_mem_t" size="40" value="'.$best_mem_t.'">
				<td class="list"><nobr>—ﬁ„ ⁄÷ÊÌ… «·⁄÷Ê «·„„Ì“</nobr>
				<td class="list"><input type="text" name="best_mem" size="10" value="'.$best_mem.'">

			</tr>
				<tr class="fixed">
				<td class="list"><nobr>Ê’› «·„Ê÷Ê⁄ «·„„Ì“</nobr></td>
				<td class="middle"><input type="text" name="best_topic_t" size="40" value="'.$best_topic_t.'">
						<td class="list"><nobr>—ﬁ„ «·„Ê÷Ê⁄ «·„„Ì“</nobr></td>
				<td class="middle"><input type="text" name="best_topic" size="10" value="'.$best_topic.'">
			</tr>
				<tr class="fixed">
				<td class="list"><nobr>Ê’› «·„‘—› «·„„Ì“</nobr></td>
				<td class="middle"><input type="text" name="best_mod_t" size="40" value="'.$best_mod_t.'">
						<td class="list"><nobr>—ﬁ„ «·„‘—› «·„„Ì“</nobr></td>
				<td class="middle"><input type="text" name="best_mod" size="10" value="'.$best_mod.'">
			</tr>
				<tr class="fixed">
				<td class="list"><nobr>Ê’› «·„‰ œÏ «·„„Ì“</nobr></td>
				<td class="middle"><input type="text" name="best_frm_t" size="40" value="'.$best_frm_t.'">
					<td class="list"><nobr>—ﬁ„ «·„‰ œÏ «·„„Ì“</nobr></td>
				<td class="middle"><input type="text" name="best_frm" size="10" value="'.$best_frm.'">
			</tr>


			<tr class="fixed">
				<td align="middle" colspan="4"><input type="submit" value="≈œŒ«· »Ì«‰« ">&nbsp;&nbsp;&nbsp;<input type="reset" value="≈—Ã«⁄ ‰’ «·√’·Ì"></td>
			</tr>
		</form>
		</table>
		</center>';
	 }

	 if ($type == "insert_data")
	 {


		if ($error != "") {
						echo'<br><center>
						<table bordercolor="#ffffff" width="99%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5" color="red"><br>Œÿ√<br>'.$error.'..</font><br><br>
							   <a href="JavaScript:history.go(-1)">-- ≈÷€ÿ Â‰« ··—ÃÊ⁄ --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}


		if ($error == "")
		{
			updata_mysql("BEST", $_POST['best']);
			updata_mysql("BEST_MEM", $_POST['best_mem']);
			updata_mysql("BEST_TOPIC", $_POST['best_topic']);
			updata_mysql("BEST_MOD", $_POST['best_mod']);
			updata_mysql("BEST_FRM", $_POST['best_frm']);

			updata_mysql("BEST_T", $_POST['best_t']);
			updata_mysql("BEST_MEM_T", $_POST['best_mem_t']);
			updata_mysql("BEST_TOPIC_T", $_POST['best_topic_t']);
			updata_mysql("BEST_MOD_T", $_POST['best_mod_t']);
			updata_mysql("BEST_FRM_T", $_POST['best_frm_t']);


						echo'<br><br>
						<center>
						<table bordercolor="#ffffff" width="50%" border="1">
						   <tr class="normal">
							   <td class="list_center" colSpan="10"><font size="5"><br> „  ⁄œÌ· »Ì«‰«  »‰Ã«Õ..</font><br><br>
							   <meta http-equiv="Refresh" content="2; URL=cp_home.php?mode=best">
							   <a href="cp_home.php?mode=best">-- «‰ﬁ— Â‰« ··–Â«» «·Ï ’›Õ… «·«’·Ì… --</a><br><br>
							   </td>
						   </tr>
						</table>
						</center>';
		}
	}
	?>
