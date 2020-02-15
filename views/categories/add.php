<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 17/12/2015
 * Time: 11:51
 */

?>

<form id="formAddCat">

    <div class="form-group">
        <label for="text-name">اسم الفئة</label>
        <input type="text" id="text-name" name="name" />
    </div>

    <div class="form-group">
        <label>إخفاء الفئة</label>
        <label class="radio-inline"><input type="radio" name="hide" value="1" />نعم</label>
        <label class="radio-inline"><input type="radio" name="hide" value="0" checked />لا</label>
    </div>

    <div class="form-group">
        <label for="select-level">المجموعة</label>
        <select id="select-level" name="level" class="form-control">
            <option value="0">الكل</option>
            <option value="1">الأعضاء</option>
            <option value="2">المشرفون</option>
            <option value="3">المراقبون</option>
            <option value="4">المدراء</option>
        </select>
    </div>

</form>