<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 17/12/2015
 * Time: 13:01
 */

$db = $this->getData("database");

$webConfig = new \DAO\WebConfig($db);

?>

<section class="wrapper-content">
    <div class="container-fluid">

        <form id="formConfig">

            <div class="wrapper">
                <div class="wrapper-heading">
                    <span class="title">إعدادت الموقع</span>
                </div>

                <div class="wrapper-body">

                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">

                            <div class="form-group">
                                <label for="text-title">اسم المنتديات</label>
                                <input type="text" id="text-title" name="title" class="form-control"
                                    value="<?php echo $webConfig->getValue('Title') ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="text-desc">الوصف</label>
                                <textarea id="text-desc" name="desc" rows="3"
                                    ><?php echo $webConfig->getValue("Description") ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="text-keywords">الكلمات المفتاحية</label>
                                <input type="text" id="text-keywords" name="keywords" class="form-control"
                                    value="<?php echo $webConfig->getValue("Keywords") ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="text-logo">شعار المنتدى</label>
                                <input type="text" id="text-logo" name="logo" class="form-control"
                                    value="<?php echo $webConfig->getValue("Logo") ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="text-address">رابط المنتدى</label>
                                <input type="text" id="text-address" name="address" class="form-control" dir="ltr"
                                    value="<?php echo $webConfig->getValue("Address") ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="text-admin-address">رابط الإدارة</label>
                                <input type="text" id="text-admin-address" name="adminAddress" class="form-control" dir="ltr"
                                    value=" <?php echo $webConfig->getValue("AdminAddress") ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="text-copyright">الحقوق</label>
                                <input type="text" id="text-copyright" name="copyright" class="form-control" dir="ltr"
                                    value="<?php echo $webConfig->getValue("Copyright") ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="text-email">البريد الالكتروني</label>
                                <input type="text" id="text-email" name="email" class="form-control" dir="ltr"
                                    value="<?php echo $webConfig->getValue("Email") ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="text-author">الصاحب المنتدى</label>
                                <input type="text" id="text-author" name="author" class="form-control" dir="ltr"
                                    value="<?php echo $webConfig->getValue("Author") ?>" autocomplete="off" />
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success">حفظ المعلومات</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </form>

    </div>
</section>
