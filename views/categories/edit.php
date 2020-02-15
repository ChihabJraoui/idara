<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 17/12/2015
 * Time: 20:22
 */

$db = $this->getData("database");

$catDAO = new \DAO\Category($db);

$catID = $this->getData('catId');
$cat = $catDAO->select($catID);

?>


<form id="formEditCat">

    <input type="hidden" name="catId" value="<?php echo $catID ?>">

    <div class="form-group">
        <label for="text-name">اسم الفئة</label>
        <input type="text" id="text-name" name="name" value="<?php echo $cat->getName() ?>" />
    </div>

    <div class="form-group">
        <label>مخفية</label>
        <div>
            <label class="radio-inline">
                <input type="radio" name="hide" value="1" <?php echo Func::checkRadio(1, $cat->getHide()) ?>/> نعم
            </label>
            <label class="radio-inline">
                <input type="radio" name="hide" value="0" <?php echo Func::checkRadio(0, $cat->getHide()) ?>/> لا
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="select-cat">المجموعة</label>
        <select id="select-cat" name="level" class="form-control">
                <option value="0" <?php echo Func::checkSelect(0, $cat->getLevel()) ?>>الكل</option>
                <option value="4" <?php echo Func::checkSelect(4, $cat->getLevel()) ?>>الأعضاء</option>
                <option value="3" <?php echo Func::checkSelect(3, $cat->getLevel()) ?>>المشرفون</option>
                <option value="2" <?php echo Func::checkSelect(2, $cat->getLevel()) ?>>المراقبون</option>
                <option value="1" <?php echo Func::checkSelect(1, $cat->getLevel()) ?>>المدراء</option>
        </select>
    </div>

</form>