<?php
echo'
	<ul class="nav nav-tabs">
		<li '.(($_GET["tab"] == "online" OR $_GET["tab"] == "") ? 'class="active"' : '').'>
			<a href="index?get=idara&m=members&tab=online">المتصلون</a>
		</li>
		<li '.($_GET["tab"] == "unmoderated" ? 'class="active"' : '').'>
			<a href="index?get=idara&m=members&tab=unmoderated">أعضاء ينتظرون الموافقة</a>
		</li>
		<li '.($_GET["tab"] == "settings" ? 'class="active"' : '').'>
			<a href="index?get=idara&m=members&tab=settings">إعدادات</a>
		</li>
	</ul>
	
	<div class="div-tabs">';
	switch($_GET["tab"])
	{
		case "":							require_once "idara/members/online.php"; break;
		case "online":					require_once "idara/members/online.php"; break;
		case "unmoderated":				require_once "idara/members/unmoderated_members.php"; break;
		case "settings":					require_once "idara/members/settings"; break;
	}
	echo'
	</div>';
?>