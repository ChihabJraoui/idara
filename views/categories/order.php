<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 17/12/2015
 * Time: 22:53
 */

$db = $this->getData("database");

$catDAO = new \DAO\Category($db);
$cats = $catDAO->SelectAll();

echo'
<div class="container-fluid">
	<form id="formCatOrder">

        <div class="wrapper">
            <div class="wrapper-heading">
                <span class="title">جميع الفئات</span>
            </div>

            <div class="wrapper-body">
                <table class="table-condensed table-bordered table-striped">
                <tr>
                    <th>رقم الفئة</th>
                    <th>الاسم</th>
                    <th>الترتيب</th>
                </tr>';

        if(count($cats) > 0)
        {
            foreach($cats as $cat)
            {
                echo'
                <tr>
                    <td>
                        '.$cat->getCatID().'
                        <input type="hidden" name="catID[]" value="'.$cat->getCatID().'" />
                    </td>
                    <td>'.$cat->getName().'</td>
                    <td>
                        <input type="text" name="order[]" class="form-control"
                        value="'.$cat->getCatOrder().'" />
                    </td>
                </tr>';
            }

            echo'
            </table>';
        }
        else
        {
            echo'
            <tr class="bg-danger">
                <td class="text-danger">لم يتم العثور على أي فئة</td>
            </tr>';
        }

            echo'
            </div>

            <div class="wrapper-footer">
                <button type="submit" class="btn btn-success">حفظ</button>
            </div>
        </div>

	</form>
</div>';