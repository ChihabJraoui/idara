<?php

use App\DAO\Forum as ForumDAO;
use DAO\Category as CatDAO;


$db = $this->getData("database");


$catDAO = new CatDAO($db);
$forumDAO = new ForumDAO($db);


$cats = $catDAO->selectAll();

?>


<div class="action-button">
    <a href="javascript:" id="btn-add-forum">
        <i class="material-icons">add</i>
    </a>
</div>


<section class="wrapper-content">
    <div class="container-fluid">

        <h2 class="title">جميع المنتديات</h2>

        <?php if(count($cats) > 0): ?>

        <?php foreach($cats as $cat): ?>

        <?php
        $forums = $catDAO->selectForums($cat);
        ?>

        <div class="data-table">
            <div class="title">
                <span><?php echo $cat->getName() ?></span>
            </div>


		    <?php if(count($forums) > 0): ?>

            <table>
                <tr>
                    <th>الترتيب</th>
                    <th>الاسم</th>
                    <th>الوصف</th>
                    <th>الأيقونة</th>
                    <th>الجنس</th>
                    <th>مخفي</th>
                    <th>المجموعة</th>
                    <th nowrap>خيارات</th>
                </tr>


			    <?php foreach($forums as $forum): ?>

                <tr id="forum-<?php echo $forum->getForumID() ?>">
					<td><?php echo $forum->getForumOrder() ?></td>
					<td><?php echo $forum->getName() ?></td>
					<td><?php echo $forum->getDescription() ?></td>
					<td><?php echo $forum->getIcon() ?></td>
					<td><?php echo $forum->getSexLabel() ?></td>
					<td><?php echo $forum->getHideLabel() ?></td>
					<td><?php echo $forum->getLevelLabel() ?></td>
					<td>
						<a href="javascript:" data-forum-edit="<?php echo $forum->getForumID() ?>">
							<i class="material-icons">edit</i>
						</a>
						<a href="javascript:" data-forum-delete="<?php echo $forum->getForumID() ?>">
							<i class="material-icons">delete</i>
						</a>
					</td>
				</tr>
			    <?php endforeach; ?>

            </table>

            <?php else: ?>

            <div class="alert alert-default">
                لم يتم العثور على أي منتدى
            </div>

            <?php endif; ?>

	    </div>

        <?php endforeach; ?>

        <?php endif; ?>

    </div>
</section>