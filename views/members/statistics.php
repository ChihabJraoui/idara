<?php

$db = $this->getData("database");


$memberDAO = new \DAO\Member($db);
$statsDAO = new \DAO\Statistics($db);


/*
 * Total Members this Week
 */
$totalMembers = $statsDAO->getTotalMembers();
$totalMembersRatio = $statsDAO->getTotalMembersRatio();

if($totalMembersRatio > 0)
{
    $totalMembersRatio = '<span style="color: Green;">
                            '. $totalMembersRatio .'%
                            <i class="material-icons">trending_up</i>
                        </span>';
}
elseif($totalMembersRatio < 0)
{
    $totalMembersRatio = '<span style="color: Crimson;">
                            '. $totalMembersRatio .'%
                            <i class="material-icons">trending_down</i>
                        </span>';
}
else
{
    $totalMembersRatio = '<span style="color: dodgerblue;">
                            '. $totalMembersRatio .'%
                            <i class="material-icons">trending_flat</i>
                        </span>';
}


/*
 * New Members
 */
$newMembers = $statsDAO->getNewMembers();
$newMembersRatio = $statsDAO->getNewMembersRatio();

if($newMembersRatio > 0)
{
    $newMembersRatio = '<span style="color: Green;">
                            '. $newMembersRatio .'%
                            <i class="material-icons">trending_up</i>
                        </span>';
}
elseif($newMembersRatio < 0)
{
    $newMembersRatio = '<span style="color: Crimson;">
                            '. $newMembersRatio .'%
                            <i class="material-icons">trending_down</i>
                        </span>';
}
else
{
    $newMembersRatio = '<span style="color: dodgerblue;">
                            '. $newMembersRatio .'%
                            <i class="material-icons">trending_flat</i>
                        </span>';
}


/*
 * New Visitors This Week
 */
$newVisitors = $statsDAO->getNewVisitors();
$newVisitorsRatio = $statsDAO->getNewVisitorsRatio();

if($newVisitorsRatio > 0)
{
    $newVisitorsRatio = '<span style="color: Green;">
                            '. $newVisitorsRatio .'%
                            <i class="material-icons">trending_up</i>
                        </span>';
}
elseif($newVisitorsRatio < 0)
{
    $newVisitorsRatio = '<span style="color: Crimson;">
                            '. $newVisitorsRatio .'%
                            <i class="material-icons">trending_down</i>
                        </span>';
}
else
{
    $newVisitorsRatio = '<span style="color: dodgerblue;">
                            '. $newVisitorsRatio .'%
                            <i class="material-icons">trending_flat</i>
                        </span>';
}


/*
 * Total Visitors This Week
 */
$totalVisitors = $statsDAO->getTotalVisitors();
$totalVisitorsRatio = $statsDAO->getTotalVisitorsRatio();

if($totalVisitorsRatio > 0)
{
    $totalVisitorsRatio = '<span style="color: Green;">
                            '. $totalVisitorsRatio .'%
                            <i class="material-icons">trending_up</i>
                        </span>';
}
elseif($totalVisitorsRatio < 0)
{
    $totalVisitorsRatio = '<span style="color: Crimson;">
                            '. $totalVisitorsRatio .'%
                            <i class="material-icons">trending_down</i>
                        </span>';
}
else
{
    $totalVisitorsRatio = '<span style="color: dodgerblue;" dir="ltr">
                            '. $totalVisitorsRatio .'%
                            <i class="material-icons">trending_flat</i>
                        </span>';
}

?>

<div class="container-fluid">

    <div class="widget-stats-container">
        <div class="col-xs-3">
            <div class="widget-stats">
                <div>
                    <span>إجمالي الأعضاء</span>
                    <span class="number">
                        <?php echo $totalMembers; ?>
                    </span>
                </div>
                <div>
                    <span>
                        <?php echo $totalMembersRatio; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="widget-stats">
                <div>
                    <span>الأعضاء الجدد</span>
                    <span class="number">
                        <?php echo $newMembers; ?>
                    </span>
                </div>
                <div>
                    <span>
                        <?php echo $newMembersRatio; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="widget-stats field">
                <div>
                    <span>الزوار الجدد</span>
                    <span class="number">
                        <?php echo $newVisitors; ?>
                    </span>
                </div>
                <div>
                    <span>
                        <?php echo $newVisitorsRatio; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="widget-stats field">
                <div>
                    <span>إجمالي الزوار</span>
                    <span class="number">
                        <?php echo $totalVisitors; ?>
                    </span>
                </div>
                <div>
                    <span>
                        <?php echo $totalVisitorsRatio; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>


    <!--  -->
    <div class="row">
        <div class="col-md-6">
            <div class="wrapper">
                <div class="wrapper-heading">
                    <span class="title">نسبة النقرات هذا الأسبوع</span>

                    <a id="refresh-hits-chart" href="javascript:" class="pull-left">
                        <i class="material-icons">refresh</i>
                    </a>
                </div>
                <div class="wrapper-body">
                    <div class="canvas-holder">
                        <canvas id="hits-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="wrapper">
                <div class="wrapper-heading">
                    <span class="title">نسبة الزوار</span>
                    <a id="refresh-visitors-chart" href="javascript:" class="pull-left">
                        <i class="material-icons">refresh</i>
                    </a>
                </div>
                <div class="wrapper-body">
                    <div class="canvas-holder">
                        <canvas id="visitors-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="wrapper">
                <div class="wrapper-heading">
                    <span class="title">الأعضاء حسب الرتب</span>
                </div>
                <div class="wrapper-body">
                    <div class="canvas-holder">
                        <canvas id="members-pie"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="wrapper">
                <div class="wrapper-heading">
                    <span class="title">العضويات المقفولة</span>
                </div>
                <div class="wrapper-body">
                    <div class="canvas-holder">
                        <canvas id="locked-members-pie"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>