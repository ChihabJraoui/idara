<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 17/12/2015
 * Time: 12:31
 */
$db = $this->getData("database");


$catDAO = new \DAO\Category($db);


$cats = $catDAO->selectAll();

?>


<form id="formAddForum">

    <div class="form-group">
        <label for="text-name">اسم المنتدى</label>
        <input type="text" id="text-name" name="name" class="form-control" />
    </div>

    <div class="form-group">
        <label for="select-catId">الفئة</label>
        <select name="catId" id="select-catId" class="form-control">
            <option selected value="0">اختر الفئة</option>

            <?php if(count($cats) > 0): ?>
            <?php foreach($cats as $cat): ?>
                <option
                    value="<?php echo $cat->getCatID(); ?>">
                    <?php echo $cat->getName(); ?>
                </option>';
            <?php endforeach; ?>
            <?php endif; ?>s

        </select>
    </div>

    <div class="form-group">
        <label for="text-desc">وصف المنتدى</label>
        <textarea id="text-desc" name="desc" rows="3" style="resize: vertical"
                  class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="text-icon">الأيقونة</label>
        <input id="text-icon" name="icon" type="text" class="form-control" dir="ltr" />
    </div>

    <div class="form-group">
        <label for="radio-sex">الجنس</label>
        <div id="radio-sex" class="text-center">
            <label class="radio-inline"><input type="radio" name="sex" value="A" checked />الكل</label>
            <label class="radio-inline"><input type="radio" name="sex" value="M" />الذكور</label>
            <label class="radio-inline"><input type="radio" name="sex" value="F" />الإناث</label>
        </div>
    </div>

    <div class="form-group">
        <label for="radio-hide">مخفي</label>
        <div id="radio-hide" class="text-center">
            <label class="radio-inline"><input type="radio" name="hide" value="0" checked />لا</label>
            <label class="radio-inline"><input type="radio" name="hide" value="1" />نعم</label>
        </div>
    </div>

    <div class="form-group">
        <label for="select-level">المجموعة</label>
        <select name="level" id="select-level" class="form-control">
            <option value="0">الكل</option>
            <option value="1">الأعضاء</option>
            <option value="2">المشرفون</option>
            <option value="3">المراقبون</option>
            <option value="4">المدراء</option>
        </select>
    </div>

</form>