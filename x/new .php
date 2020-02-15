<?php
		echo'
		<form method="post" action="index?get=adm&opt=option&method=site&type=insert_data">
			<table class="simpleTable" border="0" cellspacing="1" cellpadding="3" width="80%">	
			<tr >
				<td class="cat" colspan="2"><nobr>اعدادات الموقع</nobr></td>
			</tr>
			<tr >
				<td ><nobr>وقت الموقع</nobr></td>
				<td >
					<select class="insidetitle" name="site_timezone">
					<option value="-12" '.check_select($site_timezone, "-12").'>GMT -12 (إينيوتوك، كوجلانيا)</option>
					<option value="-11" '.check_select($site_timezone, "-11").'>GMT -11 (آسلاندا، سيماوا)</option>
					<option value="-10" '.check_select($site_timezone, "-10").'>GMT -10 (هواي)</option>
					<option value="-9" '.check_select($site_timezone, "-9").'>GMT -9 (ألاسكا)</option>
					<option value="-8" '.check_select($site_timezone, "-8").'>GMT -8 (توقيت المحيد الأطلنتي، كندا، الولايات المتحدة الأمريكية)</option>
					<option value="-7" '.check_select($site_timezone, "-7").'>GMT -7 (توقيت جبال كندا، الولايات المتحدة الأمريكية)</option>
					<option value="-6" '.check_select($site_timezone, "-6").'>GMT -6 (مدينة ميكسيكو)</option>
					<option value="-5" '.check_select($site_timezone, "-5").'>GMT -5 (بوغوتا، ليما)</option>
					<option value="-4" '.check_select($site_timezone, "-4").'>GMT -4 (كركاس، لوباس)</option>
					<option value="-3" '.check_select($site_timezone, "-3").'>GMT -3 (البرازيل، بوينوس آيريس، جورج تاون)</option>
					<option value="-2" '.check_select($site_timezone, "-2").'>GMT -2 (توقيت وسط المحيط الأطلنتي)</option>
					<option value="-1" '.check_select($site_timezone, "-1").'>GMT -1 (أزوريس، كاب فيرد آيسلاندا)</option>
					<option value="0" '.check_select($site_timezone, "0").'>GMT (الدار البيضاء، لندن، لشبونة)</option>
					<option value="1" '.check_select($site_timezone, "1").'>GMT +1 (مدريد، باريس، بروكسيل)</option>
					<option value="2" '.check_select($site_timezone, "2").'>GMT +2 (جنوب أفريقيا)</option>
					<option value="3" '.check_select($site_timezone, "3").'>GMT +3 (مكة المكرمة، الرياض، بغداد، موسكو، سان بيترسبورغ)</option>
					<option value="4" '.check_select($site_timezone, "4").'>GMT +4 (أو ظبي، طهران، باكو)</option>
					<option value="5" '.check_select($site_timezone, "5").'>GMT +5 (كابول، كراشي، اسلام أباد)</option>
					<option value="6" '.check_select($site_timezone, "6").'>GMT +6 (الماتي، دهاكا، كولومبو)</option>
					<option value="7" '.check_select($site_timezone, "7").'>GMT +7 (بانكوك، جكارتا)</option>
					<option value="8" '.check_select($site_timezone, "8").'>GMT +8 (بكين، سنغافورة، هونغ كونغ)</option>
					<option value="9" '.check_select($site_timezone, "9").'>GMT +9 (طوكيو، اوساكا)</option>
					<option value="10" '.check_select($site_timezone, "10").'>GMT +10 (كام، غرب أستراليا)</option>
					<option value="11" '.check_select($site_timezone, "11").'>GMT +11 (مغادان، جزر سلومان، كالدونيا)</option>
					<option value="12" '.check_select($site_timezone, "12").'>GMT +12 (فيجي، كامشاتكا)</option>
					</select>
				</td>
			</tr>
			<tr >
				<td align="middle" colspan="2"><input type="submit" value="إدخال بيانات">&nbsp;&nbsp;&nbsp;<input type="reset" value="إرجاع نص الأصلي"></td>
			</tr>
			</table>
		</form>';

		
		echo'
		<script type="text/javascript">
			function deleteItem(id){
			if(confirm("هل انت متأكد من انك تريد حدف هدا الاي بي من قائمة المحظورين , والسماح له بدخول المنتدى ؟")){
			window.location = "index?get=adm&opt=option&method=ip&type=del&id="+id;
			}else{
			return;
			}
			}
			function get_ip(){
			var ipsearch = document.getElementById("ipsearch").value;
			window.location="index?get=adm&opt=option&method=ip&ip="+ipsearch;
			}
		</script>
		
		<form name="fip" method="post" action="index?get=adm&opt=option&method=ip&type=insert_data">
			<table class="simpleTable" border="0" cellspacing="1" cellpadding="1">
			<tr >
				<td class="cat" colspan="2"><nobr>اعدادات منع الاي بي</nobr></td>
			</tr>
			<tr>
				<td ><nobr>منع اي بي جديد</nobr></td>
				<td >
					<input type="text" name="ip">&nbsp;
					<select class="insidetitle" name="date_unban">
						<option value="always">منع دائم</option>
						<option value="1">يوم</option>
						<option value="2">يومين</option>
						<option value="3">3 ايام</option>
						<option value="4">4 ايام</option>
						<option value="5">5 ايام</option>
						<option value="7">اسبوع</option>
						<option value="14">اسبوعين</option>
						<option value="30">شهر</option>
						<option value="60">شهرين</option>
						<option value="360">سنة</option>
						<option value="720">سنتين</option>
					</select>&nbsp;
					<textarea name="why" style="HEIGHT: 60px;WIDTH: 200px;FONT-WEIGHT: bold;FONT-SIZE: 15px;BACKGROUND: darkseagreen;COLOR: white;FONT-FAMILY: arial"></textarea>
				</td>
			</tr>
			<tr>
				<td align="middle" colspan="2"><input type="submit" value="إدخال بيانات">&nbsp;&nbsp;&nbsp;<input type="reset" value="إرجاع نص الأصلي"></form></td>
			</tr>
			<tr>
				<td class="cat" colspan="2"><nobr>البحث عن اي بي</nobr></td>
			</tr>
			<tr>
				<td colspan="2"><nobr>ادخل الاي بي للبحث عن العضو : &nbsp;&nbsp;<input type="text" name="ipsearch" id="ipsearch">&nbsp;&nbsp;<input type="button" value="إدخال بيانات" onclick="get_ip()"></nobr></td>
			</tr>';
			if($_GET['ip'])
			{
				$ip = $_GET['ip'];
				$sql = mysql_query("select * from MEMBERS WHERE M_IP = '$ip' OR M_LAST_IP = '$ip' ");
				if(mysql_num_rows($sql) == 0)
				{
					echo '<tr ><td align="center"  colspan="2">لم يتم العثور على اي نتيجة</td></tr>';
				}
				else
				{
					while($r = mysql_fetch_array($sql))
					{
						echo '<tr ><td align="center"  colspan="2">'.link_profile($r['M_NAME'], $r['MEMBER_ID']).'</td></tr>';
					}
				}
			}
			echo'
			<tr>
				<td class="cat" colspan="2"><nobr>الاي بي هات الممنوعة</nobr></td>
			</tr>
			<tr >
				<td colspan="2">
					<table  width="100%">
					<tr>
						<td class="optionheader_selected">الاي بي</td>
						<td class="optionheader_selected">تاريخ المنع</td>
						<td class="optionheader_selected">بواسطة</td>
						<td class="optionheader_selected">السبب</td>
						<td class="optionheader_selected">تاريخ ازالة المنع</td>
						<td class="optionheader_selected">&nbsp;</td>
					</tr>';
		$Sql = mysql_query("SELECT * FROM IP_BAN ORDER BY ID ASC ");
		$Num = mysql_num_rows($Sql);
		if($Num == 0)
		{
			echo'
					<tr>
						<td class="list_center" colspan="6">لم يتم حظر اي بي .</td>
					</tr>';
		}
		if($Num != 0)
		{
			while($r = mysql_fetch_array($Sql))
			{
				if($r['DATE_UNBAN'] == '0')
				{
					$un_ban = "<font color=\"red\">منع دائم</font>";
				}
				else
				{
					$un_ban = normal_date($r['DATE_UNBAN']);
				}
				echo'
					<tr >
						<td class="list_center">'.$r['IP'].'</td>
						<td class="list_center">'.normal_date($r['DATE']).'</td>
						<td class="list_center">'.member_name($r['HWO']).'</td>
						<td class="list_center">'.$r['WHY'].'</td>
						<td class="list_center">'.$un_ban.'</td>
						<td class="list_center"><a href="javascript:deleteItem('.$r['ID'].')">'.icons($icon_trash,"أحذف هذا العضو من هذه القائمة").'</a></td>
					</tr>';
			}
		}
		echo'
					</table>
				</td>
			</tr>
			</table>';

			
		$ip = $_POST['ip'];
		$why = $_POST['why'];
		$date_unban = $_POST['date_unban'];
		if($date_unban == 'always')
		{
			$date_unban = 0;
		}
		else
		{
			$date_unban = time() + (60 * 60 * 24 * $date_unban);
		}

		$date = time();

		if(!$ip)
		{
			$error = "لم تقم بكتابة الاي بي";
		}
		if(!$why)
		{
			$error = "لم تقم بكتابة سبب الحظر";
		}
		if ($error != "")
		{
			echo'<br><center>
			<table bordercolor="#ffffff" width="99%" border="1">
			   <tr class="normal">
				   <td class="list_center" colSpan="10"><font size="5" color="red"><br>خطأ<br>'.$error.'..</font><br><br>
				   <a href="JavaScript:history.go(-1)">-- إضغط هنا للرجوع --</a><br><br>
				   </td>
			   </tr>
			</table>
			</center>';
		}
		else
		{
			mysql_query("INSERT INTO IP_BAN SET IP = '$ip',DATE = '$date',WHY = '$why',DATE_UNBAN = '$date_unban',HWO = '$CPMemberID' ") or die(mysql_error());

			echo"تم حظر الأي بي بنجاح"; 
			success_message($msg);
		}
//	}
//	elseif($method == "del")
//	{
//		mysql_query("DELETE FROM IP_BAN WHERE ID = '$id' ");
//
//		echo"تم حذف الإي بي بنجاح";
//	}