<?php
//-------------------------------------------
try
{
	$stmt = $pdo->prepare("SELECT * FROM members WHERE Status = 2 ORDER BY RegisterDate DESC");
	$stmt->execute();
}
catch(PDOException $e)
{
	die($e->getMessage());
}

if($stmt->rowCount() > 0)
{
	echo'
	<table class="table table-condensed table-striped">
	<tr>
		<td>الرقم</td>
		<td>اسم المستخدم</td>
		<td>الاسم و النسب</td>
		<td>البريد الالكتروني</td>
		<td>خيارات</td>
	</tr>';
	$rows = $stmt->fetchAll();
	foreach($rows as $r)
	{
		echo'
		<tr>
			<td>'.$r["MemberID"].'</td>
			<td>'.$r["Pseudo"].'</td>
			<td>'.$r["FName"].' '.$r["LName"].'</td>
			<td>'.$r["Email"].'</td>
			<td>
				<input type="checkbox" name="unmoderated_members[]" value="'.$r["MemberID"].'" />
			</td>
		</tr>';
	}
	echo'
	</table>
	
	<div style="text-align: center;">
		<button id="btn-accept" class="btn btn-success btn-sm">موافق</button>
		<button id="btn-delete" class="btn btn-default btn-sm">حذف</button>
	</div>';
	?>
	<script>
	$("#btn-accept").click(function(){
		var members = $("input[name='unmoderated_members[]']:checked");
		
		$.ajax({
			type: 'POST',
			url: 'members/unmoderated_members_ajax.php',
			data: "members="+members+"&ajax=true",
			success: function(result){
				// if(result == 1)
				// {
					// Notice("تمت الموافقة على الأعضاء", true);
					// setTimeout(function()
					// {
						// location.reload();
					// }, 1500);
				// }
				// else
				// {
					Notice(result, false);
				// }
			}
		});
	});
	</script>
	<?php
}
else
{
	echo'
	<div class="alert-danger alert">
		لا يوجد أعضاء ينتظرون الموافقة
	</div>';
}
?>