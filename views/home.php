<?php

$db = $this->getData('database');


$webConfigDAO = new \DAO\WebConfig($db);
$statDAO = new \DAO\Statistics($db);
$memberDAO = new App\DAO\Member($db);



/*
 * Last Registred Members
 */
$lastMembers = $memberDAO->selectLastRegistred();

?>

<section class="wrapper-content">
    <div class="container-fluid">

        <h2 class="title">
            <i class="material-icons">home</i>
            الرئيسية
        </h2>

        <div class="row">
            <div class="col-md-3">

                <div class="widget stats">
                    <div>
                        <span>عدد الأعضاء</span>
                    </div>
                    <div>
                        <span class="icon">
                            <i class="material-icons md-36">people</i>
                        </span>
                        <span class="number">
                            <?php echo $statDAO->getNumMembers(); ?>
                        </span>
                    </div>
                </div>

            </div>
            <div class="col-md-3">

                <div class="widget stats">
                    <div>
                        <span>المواضيع</span>
                    </div>
                    <div>
                        <span class="icon">
                            <i class="material-icons md-36">subject</i>
                        </span>
                        <span class="number"><?php echo $statDAO->getNumTopics(); ?></span>
                    </div>
                </div>

            </div>
            <div class="col-md-3">

                <div class="widget stats">
                    <div>
                        <span>الردود</span>
                    </div>
                    <div>
                        <span class="icon">
                            <i class="material-icons md-36">reply</i>
                        </span>
                        <span class="number"><?php echo $statDAO->getNumReplies(); ?></span>
                    </div>
                </div>

            </div>
            <div class="col-md-3">

                <div class="widget stats">
                    <div>
                        <span>عدد الأعضاء</span>
                    </div>
                    <div>
                        <span class="icon">
                            <i class="material-icons md-36">people</i>
                        </span>
                        <span class="number"><?php echo $statDAO->getNumMembers(); ?></span>
                    </div>
                </div>

            </div>
        </div>


        <!-- last registred members -->
        <div class="row">
            <div class="col-md-9">

            </div>
            <div class="col-md-3">
                <div class="wrapper">
                    <div class="wrapper-heading">
                        <span class="title">آخر الآعضاء المتسجلون</span>
                    </div>


                    <?php if(count($lastMembers) > 0): ?>

                    <ul class="list-view">

                    <?php foreach($lastMembers as $member): ?>
                    <li>
                        <div class="chip">
                            <div class="chip-object">
                                <img src="<?php echo $member->getPhoto() ?>" />
                            </div>
                            <div class="chip-body">
                                <?php echo $member->getName(); ?>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>

                    </ul>

                    <?php endif; ?>


                </div>
            </div>
        </div>
    </div>
</section>