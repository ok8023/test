<?php
include('../includes/common.php');
if ($islogin2 == 1) { } else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

<?php
$title = '用户首页';
$active = 'index';
include('head.php');
$uid = $userrow['id'];
$rs = $conn->query("select * from url_safe where uid='$uid'");
$allSafe = $rs->num_rows;
$rs = $conn->query("select * from url_list where uid='$uid'");
$allUrl = $rs->num_rows;
$rs = $conn->query("select * from visitors where uid='$uid'");
$viewNum = $rs->num_rows;
$rs = $conn->query("select distinct ip from visitors where uid='$uid'");
$ipNum = $rs->num_rows;
$dayVit = statDay('all', $uid);
$weekVit = statWeek('all', $uid);
?>
<section id="main-content">
    <section class="wrapper">
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="value">
                        <h1><?php echo $allSafe; ?></h1>
                        <p>总监控数</p>
                    </div>
                </section>
            </div>    
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol yellow">
                        <i class="fa fa-link"></i>
                    </div>
                    <div class="value">
                        <h1><?php echo $allUrl; ?></h1>
                        <p>总链接数</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol red">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="value">
                        <h1><?php echo $ipNum; ?></h1>
                        <p>总访问者</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-location-arrow"></i>
                    </div>
                    <div class="value">
                        <h1><?php echo $viewNum; ?></h1>
                        <p>总访问数</p>
                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="border-head">
                    <h3>近24小时访问统计</h3>
                </div>
                <div class="custom-bar-chart">
                    <div class="bar">
                        <div class="title">0-2</div>
                        <div class="value tooltips" data-original-title="<?php echo $dayVit[1]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $dayVit[1] / $dayVit[0] * 100. . '%'; ?></div>
                    </div>
                    <div class="bar doted">
                        <div class="title">2-4</div>
                        <div class="value tooltips" data-original-title="<?php echo $dayVit[2]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $dayVit[2] / $dayVit[0] * 100. . '%'; ?></div>
                    </div>
                    <div class="bar ">
                        <div class="title">4-6</div>
                        <div class="value tooltips" data-original-title="<?php echo $dayVit[3]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $dayVit[3] / $dayVit[0] * 100. . '%'; ?></div>
                    </div>
                    <div class="bar doted">
                        <div class="title">6-8</div>
                        <div class="value tooltips" data-original-title="<?php echo $dayVit[4]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $dayVit[4] / $dayVit[0] * 100. . '%'; ?></div>
                    </div>
                    <div class="bar">
                        <div class="title">8-10</div>
                        <div class="value tooltips" data-original-title="<?php echo $dayVit[5]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $dayVit[5] / $dayVit[0] * 100. . '%'; ?></div>
                    </div>
                    <div class="bar doted">
                        <div class="title">10-12</div>
                        <div class="value tooltips" data-original-title="<?php echo $dayVit[6]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $dayVit[6] / $dayVit[0] * 100. . '%'; ?></div>
                    </div>
                    <div class="bar">
                        <div class="title">12-14</div>
                        <div class="value tooltips" data-original-title="<?php echo $dayVit[7]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $dayVit[7] / $dayVit[0] * 100. . '%'; ?></div>
                    </div>
                    <div class="bar doted">
                        <div class="title">14-16</div>
                        <div class="value tooltips" data-original-title="<?php echo $dayVit[8]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $dayVit[8] / $dayVit[0] * 100. . '%'; ?></div>
                    </div>
                    <div class="bar ">
                        <div class="title">16-18</div>
                        <div class="value tooltips" data-original-title="<?php echo $dayVit[9]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $dayVit[9] / $dayVit[0] * 100. . '%'; ?></div>
                    </div>
                    <div class="bar doted">
                        <div class="title">18-20</div>
                        <div class="value tooltips" data-original-title="<?php echo $dayVit[10]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $dayVit[10] / $dayVit[0] * 100. . '%'; ?></div>
                    </div>
                    <div class="bar ">
                        <div class="title">20-22</div>
                        <div class="value tooltips" data-original-title="<?php echo $dayVit[11]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $dayVit[11] / $dayVit[0] * 100. . '%'; ?></div>
                    </div>
                    <div class="bar doted">
                        <div class="title">22-24</div>
                        <div class="value tooltips" data-original-title="<?php echo $dayVit[12]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $dayVit[12] / $dayVit[0] * 100. . '%'; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-group m-bot20" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            公告①
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <?php echo $conf['gg1']; ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            公告②
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php echo $conf['gg2']; ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            公告③
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php echo $conf['gg3']; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<script src="../static/user/js/common-scripts.js"></script>