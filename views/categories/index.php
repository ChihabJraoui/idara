<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 16/12/2015
 * Time: 23:04
 */

$db = $this->getData("database");

$catDAO = new \DAO\Category($db);
$cats = $catDAO->SelectAll();

?>


<div class="action-button">
    <a href="javascript:" id="btn-add-cat"
       data-toggle="tooltip" title="إضافة فئة جديدة" data-placement="right">
        <i class="material-icons">add</i>
    </a>
</div>


<section class="wrapper-content">
    <div class="container-fluid">

        <div class="data-table">

            <div class="title">
                جميع الفئات
            </div>

            <?php if(count($cats) > 0): ?>

            <table>
                <tr>
                    <th>رقم الفئة</th>
                    <th>الاسم</th>
                    <th>مخفية</th>
                    <th>المجموعة</th>
                    <th>خيارات</th>
                </tr>

                <?php foreach($cats as $cat): ?>

                <?php
                $hide = ""; $level = "";

                if($cat->getHide() == 1)
                    $hide = "<span class='label label-warning'>نعم</span>";
                else
                    $hide = '<span class="label label-success">لا</span>';

                if($cat->getLevel() == 0)
                    $level = '<span class="label label-primary">الجميع</span>';
                elseif($cat->getLevel() == 4)
                    $level = '<span class="label label-default">الأعضاء</span>';
                elseif($cat->getLevel() == 3)
                    $level = '<span class="label label-danger">المشرفون</span>';
                elseif($cat->getLevel() == 2)
                    $level = '<span class="label label-warning">المراقبون</span>';
                elseif($cat->getLevel() == 1)
                    $level = '<span class="label label-info">المديرون</span>';
                ?>

                <tr id="cat-<?php echo $cat->getCatID() ?>">
                    <td><?php echo $cat->getCatID() ?></td>
                    <td><?php echo $cat->getName() ?></td>
                    <td><?php echo $hide ?></td>
                    <td><?php echo $level ?></td>
                    <td>
                        <a data-cat-edit="<?php echo $cat->getCatID() ?>" href="javascript:">
                            <i class="material-icons">edit</i>
                        </a>
                        <a data-cat-delete="<?php echo $cat->getCatID() ?>" href="javascript:">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>

                <?php endforeach; ?>

            </table>

            <?php else: ?>

            <div class="alert alert-default">
                <span>لم يتم العثور على أي فئة</span>
            </div>

            <?php endif; ?>

        </div>

    </div>
</section>