<?php

$db = $this->getData('database');

$catDAO = new \DAO\Category($db);
$forumDAO = new \DAO\Forum($db);

$cats = $catDAO->selectAll();

echo'
<div class="container-fluid">
	<form  id="formForumOrder">

		<div class="wrapper">
			<div class="wrapper-heading">
			    <span class="title">ترتيب المنتديات</span>
            </div>

			<div class="wrapper-body">';

if(count($cats) > 0)
{
	echo'
	<table class="table-condensed table-striped table-bordered">';

	foreach($cats as $cat)
	{
		$forums = $catDAO->selectForums($cat);

		echo'
		<tr>
			<th colspan="4">'.$cat->getName().'</th>
		</tr>';

		if(count($forums) > 0)
		{
			echo'
			<tr>
				<th>الرقم</th>
				<th>الاسم</th>
				<th>الترتيب</th>
			</tr>';

			foreach($forums as $forum)
			{
				$sex = ""; $hide = ""; $level = "";


				echo'
				<tr>
					<td>
					    '.$forum->getForumID().'
					    <input type="hidden" name="forumId[]" value="'. $forum->getForumID() .'" />
                    </td>
					<td>'.$forum->getName().'</td>
					<td>
						<input type="text" name="forumOrder[]" class="form-control"
						value="'.$forum->getForumOrder().'" />
					</td>
				</tr>';
			}
		}
	}

	echo'
	</table';
}

echo'
			</div>

			<div class="wrapper-footer">
				<button type="submit" class="btn btn-success">حفظ</button>
			</div>
		</div>
	</form>
</div>';
