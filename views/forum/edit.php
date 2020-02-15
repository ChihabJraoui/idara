<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 17/12/2015
 * Time: 20:22
 */

$db = $this->getData('database');


$forumDAO = new App\DAO\Forum($db);
$catDAO = new \DAO\Category($db);


$cats = $catDAO->selectAll();


$forumID = filter_input(INPUT_POST, "forumID");
$forum = $forumDAO->select($forumID);

?>


<form id="formEditForum">

    <input type="hidden" name="forumId" value="<?php echo $forumID ?>">

    <div class="form-group">
        <label for="text-name">اسم المنتدى</label>
        <input type="text" name="name" id="text-name" class="form-control"
            value="<?php echo $forum->getName() ?>" />
    </div>

    <div class="form-group">
        <label for="select-cat-id">الفئة</label>
        <select name="catID" id="select-cat-id" class="form-control">
            <option selected disabled value="0">اختر الفئة</option>';

            <?php foreach($cats as $cat): ?>

            <option value="<?php echo $cat->getCatID() ?>"
                <?php echo Func::checkSelect($cat->getCatID(), $forum->getCatID()) ?>>
                    <?php echo $cat->getName() ?>
            </option>

            <?php endforeach; ?>

        </select>
    </div>

    <div class="form-group">
        <label for="text-desc">الوصف</label>
        <textarea name="description" id="text-desc" class="form-control"
            style="resize: vertical"><?php echo $forum->getDescription() ?></textarea>
    </div>

    <div class="form-group">
        <label for="text-icon">الأيقونة</label>
        <input type="text" name="icon" id="text-icon" class="form-control"
            value="<?php echo $forum->getIcon() ?>" dir="ltr" />
    </div>

    <div class="form-group">
        <label for="radio-sex">الجنس</label>
        <div id="radio-sex">
            <label class="radio-inline">
                <input type="radio" name="sex" value="A" <?php echo Func::checkRadio("A", $forum->getSex()) ?>/>
                 الجميع
             </label>
            <label class="radio-inline">
                <input type="radio" name="sex" value="M" <?php echo Func::checkRadio("M", $forum->getSex()) ?>/>
                 الذكور
            </label>
            <label class="radio-inline">
                <input type="radio" name="sex" value="F" <?php echo Func::checkRadio("F", $forum->getSex()) ?>/>
                 الإناث
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="radio-hide">مخفية</label>
        <div id="radio-hide">
            <label class="radio-inline">
                <input type="radio" name="hide" value="1" <?php echo Func::checkRadio(1, $cat->getHide()) ?>/>
                 نعم
             </label>
            <label class="radio-inline">
                <input type="radio" name="hide" value="0" <?php echo Func::checkRadio(0, $cat->getHide()) ?>/>
                 لا
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="select-level">المجموعة</label>
        <select name="level" id="select-level" class="form-control">
            <option value="0" <?php echo Func::checkSelect(0, $cat->getLevel()) ?>>الكل</option>
            <option value="4" <?php echo Func::checkSelect(4, $cat->getLevel()) ?>>الأعضاء</option>
            <option value="3" <?php echo Func::checkSelect(3, $cat->getLevel()) ?>>المشرفون</option>
            <option value="2" <?php echo Func::checkSelect(2, $cat->getLevel()) ?>>المراقبون</option>
            <option value="1" <?php echo Func::checkSelect(1, $cat->getLevel()) ?>>المدراء</option>
        </select>
    </div>

</form>