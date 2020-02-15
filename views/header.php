<?php

use DAO\WebConfig;


$user = $this->getData("user");
$db = $this->getData("database");
$pageTitle = $this->getData('pageTitle');


$urls = Func::parseUrl();
$ctrl = $urls["controller"];


$webConfig = new WebConfig($db);

?>


<!DOCTYPE html>
<html dir="rtl">
<head>
    <title><?php echo $pageTitle ?></title>
    <meta charset="UTF-8" />
    <base href="<?php echo $webConfig->getValue("AdminAddress") ?>" />

    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css"/>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/base.css"/>
</head>

<body>

    <?php if(User::isLoggedIn()): ?>

    <header>
        <div class="container-fluid">

            <div class="header-logo">
                <a href="index">الإدارة</a>
            </div>

            <ul class="header-nav">
                <li class="dropdown">
                    <a href="javascript:" data-toggle="dropdown">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="<?php echo $webConfig->getValue("Address") ?>" target="_blank">المنتدى</a>
                        </li>
                        <li>
                            <a href="index/logout">
                                <i class="material-icons md-18">power_settings_new</i>
                                تسجيل الخروج
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </header>


    <!-- Side Menu -->
    <aside id="section-sidemenu" class="wrapper-sidemenu">

        <div class="sidemenu-profile">
            <div>
                <img src="images/20151105_00.png" class="img-thumbnail-circle" height="80" />
            </div>
            <span style="color: #ddd;">
                <?php echo $user->getName() ?>
            </span>
        </div>

        <nav>

            <ul class="sidemenu">

                <!-- item 1 -->
                <li <?php echo $ctrl == 'index' ? 'class="active"' : '' ?>>
                    <a href="index" class="sidemenu-heading">
                        <i class="material-icons">dashboard</i>
                        الرئيسية
                    </a>
                </li>

                <!-- item 2 -->
                <li <?php echo $ctrl == 'settings' ? 'class="active"' : '' ?>>
                    <a href="settings/">
                        <i class="material-icons">settings</i>
                        إعدادات
                    </a>
                </li>

                <!-- item 3 -->
                <li <?php echo $ctrl == 'category' ? 'class="active"' : '' ?>>
                    <a href="category/">
                        <i class="material-icons">format_list_bulleted</i>
                        <span>الفئات</span>
                    </a>
                </li>

                <!-- item 4 -->
                <li <?php echo $ctrl == 'forum' ? 'class="active"' : '' ?>>
                    <a href="forum/">
                        <i class="material-icons md-18">storage</i>
                        <span>المنتديات</span>
                    </a>
                </li>

                <!-- item 5 -->
                <li <?php echo $ctrl == 'member' ? 'class="active"' : '' ?>>
                    <a href="javascript:">
                        <i class="material-icons">account_circle</i>
                        <span>الأعضاء</span>
                    </a>
                </li>

            </ul>

        </nav>

    </aside><!-- end of side menu -->

    <?php endif; ?>

