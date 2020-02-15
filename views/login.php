<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 08/01/2016
 * Time: 22:08
 */


?>

<section id="login">

        <div class="login-box">
            <form id="formLogin">
                <div class="login-heading">
                    <span>تسجيل الدخول</span>
                </div>
                <div class="login-body">

                    <div class="form-group">
                        <label for="pseudo" class="sr-only">اسم المستخدم</label>
                        <input type="text" id="pseudo" name="pseudo" class="form-control text-login"
                               placeholder="اسم المستخدم" />
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">كلمة المرور</label>
                        <input type="password" id="password" name="password" class="form-control text-login"
                               placeholder="كلمة المرور" />
                    </div>
                    <div class="form-group text-left">
                        <a href="#">
                            نسيت كلمة المرور ؟
                        </a>
                    </div>

                </div>
                <div class="login-footer">

                    <div class="form-group col-xs-6">
                        <button id="btn-login" type="submit" class="btn btn-default btn-block btn-login">
                            الدخول
                        </button>
                    </div>
                    <div class="form-group col-xs-6">
                        <div class="checkbox">
                            <label class="save-login">
                                <input type="checkbox" name="save" value="1" />
                                حفظ المعلومات
                            </label>
                        </div>
                    </div>

                </div>

            </form>
        </div>

</section>