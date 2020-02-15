<?php
echo'
	<div class="wrapper wrapper-flat">
		<div class="wrapper-heading"><span>إعدادت الموقع</span></div>

		<form id="fConfig" name="fConfig">
			<div class="wrapper-body">
				<table class="table-condensed" style="width: 60%;">
				<tr>
					<td>اسم المنتدى</td>
					<td><input class="form-control" type="text" name="forumTitle" value="'.$config["ForumTitle"].'"></td>
				</tr>
				<tr>
					<td>عنوان المنتدى</td>
					<td><input class="form-control" type="text" name="siteAddress" dir="ltr" value="'.$config["SiteAddress"].'"></td>
				</tr>
				<tr>
					<td>الإصدار</td>
					<td><input class="form-control" type="text" name="version" dir="ltr" value="'.$config["Version"].'"></td>
				</tr>
				<tr>
					<td>إسم الاصدار</td>
					<td><input class="form-control" type="text" name="versionName" dir="ltr" value="'.$config["VersionName"].'"></td>
				</tr>
				<tr>
					<td>البريد الالكتروني</td>
					<td><input class="form-control" type="text" name="adminEmail" dir="ltr" value="'.$config["AdminEmail"].'"></td>
				</tr>
				<tr>
					<td>المؤلف</td>
					<td><input class="form-control" type="text" name="author" value="'.$config["Author"].'"></td>
				</tr>
				<tr>
					<td><nobr>وصف المنتدى</nobr></td>
					<td><textarea class="form-control" name="meta" rows="5" style="resize: vertical;">'.$config["Meta"].'</textarea></td>
				</tr>
				<tr>
					<td><nobr>الكلمات المفتاحية</nobr></td>
					<td><input class="form-control" type="text" name="keyWords" value="'.$config["KeyWords"].'"></td>
				</tr>
				<tr>
					<td><nobr>حقوق المنتدى</nobr></td>
					<td><input class="form-control" type="text" name="copyRight" value="'.$config["CopyRight"].'"></td>
				</tr>
				<tr>
					<td><nobr>رابط شعار المنتدى</nobr></td>
					<td><input class="form-control" type="text" name="logo" dir="ltr" value="'.$config["Logo"].'"></td>
				</tr>
				<tr>
					<td><nobr>مجلد الصور</nobr></td>
					<td><input class="form-control" type="text" name="imageFolder" dir="ltr" value="'.$config["ImageFolder"].'"></td>
				</tr>
				</table>
			</div>
			
			<div class="wrapper-footer">
				<button type="submit" class="btn btn-primary">إدخال بيانات</button>
			</div>
		</form>
	</div>';
?>

<script>
$(document).ready(function()
{
	$("#fConfig").submit(function(e)
	{
		var data = new FormData(fConfig);
		data.append("ajax", true);
		
		$.ajax({
			type: "POST",
			url: "idara/ajax/site_config.php",
			data: data,
			processData: false,
			contentType: false,
			success: function(result)
			{
				if(result == 1)
				{
					Notice('تم تعديل البيانات بنجاح', true);
				}
				else
				{
					Notice(result, false);
				}
			}
		});
		e.preventDefault();
	});
});
</script>