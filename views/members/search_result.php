<?php

$members = $this->getData('members');

?>
<?php if(count($members) > 0): ?>
<table class="data-table">

	<?php foreach($members as $member): ?>
	<tr>
		<td>
			<img src="<?php $member->getPhoto(); ?>" class="photo-circle"  />
			<?php $member->getName(); ?>
		</td>
	</tr>
	<?php endforeach; ?>

</table>
<?php else: ?>
<div class="wrapper">
	<div class="wrapper-body">
		<div class="alert alert-default">
			لم يتك العثور على أي تطابق
		</div>
	</div>
</div>
<?php endif; ?>
