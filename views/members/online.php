<?php
//------------ Visitors ---------------
$stmtV = $pdo->prepare("SELECT * FROM online WHERE MemberID = 0");
$stmtV->execute();
$visitors = $stmtV->rowCount();

//------------ Members -----------------
$stmt = $pdo->prepare("SELECT * FROM online WHERE MemberID != 0");
$stmt->execute();

echo'
<h4 style="font-family: \'kufi\';">الأعضاء المتصلون : '.$stmt->rowCount().' | الزوار :'.$visitors.'</h4>';
		
if($stmt->rowCount() > 0)
{
	
	$rows = $stmt->fetchAll();
	foreach($rows as $r)
	{
		$memberO = $MemberM->Select($r['MemberID']);
		
		echo'
		<div style="float: right; margin-left: 4px; margin-right: 4px;">
			<a href="index?get=profile&id='.$memberO->getMemberID().'">
				<table class="table-condensed table-bordered">
				<tr>
					<td><img src="'.$memberO->getPhoto().'" height="32" /></td>
					<td>'.$memberO->getName().'</td>
				</tr>
				</table>
			</a>
		</div>';
	}
}
else
{
	echo'
	<div class="alert-danger alert">
		لا يوجد أعضاء متصلون
	</div>';
}