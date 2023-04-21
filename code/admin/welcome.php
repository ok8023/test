<?php
include('../includes/common.php');
if (isset($_COOKIE['adminlogin'])) {
	$_SESSION['adminlogin'] = 1;
}
if ($_SESSION['adminlogin'] != 1) {
	exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}

//用户总数
$rs = $conn->query("select * from user_list");
$userNum = $rs->num_rows;
//网址总数
$rs = $conn->query("select * from url_list");
$urlNum = $rs->num_rows;
//监控总数
$rs = $conn->query("select * from url_safe");
$safeNum = $rs->num_rows;

//一星期数据
$userTotal = getTotal('user_list');
$urlTotal = getTotal('url_list');
$safeTotal = getTotal('url_safe');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>后台管理</title>
	<link rel="stylesheet" type="text/css" href="../static/admin/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="../static/admin/css/admin.css" />
	<link rel="stylesheet" href="//at.alicdn.com/t/font_1507359_tggqsm0rkj.css">
</head>

<body>
	<div class="wrap-container welcome-container">
		<div class="row">
			<div class="welcome-left-container col-lg-9">
				<div class="data-show">
					<ul class="clearfix">
						<li class="col-sm-12 col-md-4 col-xs-12">
							<a href="javascript:;" class="clearfix">
								<div class="icon-bg bg-org f-l">
									<span class="iconfont iconpingtaiguanliyonghuguanli"></span>
								</div>
								<div class="right-text-con">
									<p class="name">会员数</p>
									<p><span class="color-org"><?php echo $userNum; ?></span></p>
								</div>
							</a>
						</li>
						<li class="col-sm-12 col-md-4 col-xs-12">
							<a href="javascript:;" class="clearfix">
								<div class="icon-bg bg-blue f-l">
									<span class="iconfont iconlianjie"></span>
								</div>
								<div class="right-text-con">
									<p class="name">网址数</p>
									<p><span class="color-blue"><?php echo $urlNum; ?></span></p>
								</div>
							</a>
						</li>
						<li class="col-sm-12 col-md-4 col-xs-12">
							<a href="javascript:;" class="clearfix">
								<div class="icon-bg bg-green f-l">
									<span class="iconfont iconyulan"></span>
								</div>
								<div class="right-text-con">
									<p class="name">监控数</p>
									<p><span class="color-green"><?php echo $safeNum; ?></span></p>
								</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="chart-panel panel panel-default">
					<div class="panel-body" id="chart" style="height: 376px;">
					</div>
				</div>
			</div>
			<div class="welcome-edge col-lg-3">
				<div class="panel panel-default comment-panel">
					<div class="panel-header">近期注册</div>
					<div class="panel-body">
						<div class="commentbox">
							<ul class="commentList">
								<?php
								$rs = $conn->query("select * from user_list order by addtime desc limit 6");
								while ($res = $rs->fetch_array()) {
									?>
									<li class="item cl">
										<a href="https://api.btstu.cn/qqtalk/api.php?qq=<?php echo $res['qq'] ?>" target="_blank">
											<i class="avatar size-L radius">
												<img alt="" src="<?php echo qq_img($res['qq'])['imgurl'] ?>">
											</i>

										</a>
										<div style="text-align: center;">
											<p><?php echo $res['user'] ?></p>
											<p><?php echo $res['addtime'] ?></p>
										</div>
									</li>
								<?php
								}
								?>
							</ul>
						</div>
						<div id="pagesbox" style="text-align: center;padding-top: 5px;">

						</div>
					</div>
				</div>
				<div class="panel panel-default contact-panel">
					<div class="panel-header">版本更新</div>
					<div class="panel-body">
						<?php
						$str = getUpdate();
						if ($conf['version'] >= $str['version']) {
							echo '<span style="color:green;">已更新最新版本' . $str['edition'] . '</span>';
						} else {
							
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
	<script src="../static/admin/lib/echarts/echarts.js"></script>
	<script type="text/javascript">
		layui.use(['layer', 'jquery'], function() {
			var layer = layui.layer;
			var $ = layui.jquery;
			var myChart;
			require.config({
				paths: {
					echarts: '../static/admin/lib/echarts'
				}
			});
			require(
				[
					'echarts',
					'echarts/chart/bar',
					'echarts/chart/line',
					'echarts/chart/map'
				],
				function(ec) {
					myChart = ec.init(document.getElementById('chart'));
					myChart.setOption({
						title: {
							text: "近7日增加",
							textStyle: {
								color: "rgb(85, 85, 85)",
								fontSize: 18,
								fontStyle: "normal",
								fontWeight: "normal"
							}
						},
						tooltip: {
							trigger: "axis"
						},
						legend: {
							data: ["用户", "网址", "监控"],
							selectedMode: false,
						},
						toolbox: {
							show: true,
							feature: {
								dataView: {
									show: false,
									readOnly: true
								},
								magicType: {
									show: false,
									type: ["line", "bar", "stack", "tiled"]
								},
								restore: {
									show: true
								},
								saveAsImage: {
									show: true
								},
								mark: {
									show: false
								}
							}
						},
						calculable: false,
						xAxis: [{
							type: "category",
							boundaryGap: false,
							data: ["<?php echo getWeek(7); ?>", "<?php echo getWeek(6); ?>", "<?php echo getWeek(5); ?>", "<?php echo getWeek(4); ?>", "<?php echo getWeek(3); ?>", "<?php echo getWeek(2); ?>", "<?php echo getWeek(1); ?>"]
						}],
						yAxis: [{
							type: "value"
						}],
						grid: {
							x2: 30,
							x: 50
						},
						series: [{
								name: "用户",
								type: "line",
								smooth: true,
								itemStyle: {
									normal: {
										areaStyle: {
											type: "default"
										}
									}
								},
								data: [<?php echo $userTotal[0][1] ?>, <?php echo $userTotal[1][1] ?>, <?php echo $userTotal[2][1] ?>, <?php echo $userTotal[3][1] ?>, <?php echo $userTotal[4][1] ?>, <?php echo $userTotal[5][1] ?>, <?php echo $userTotal[6][1] ?>]
							},
							{
								name: "网址",
								type: "line",
								smooth: true,
								itemStyle: {
									normal: {
										areaStyle: {
											type: "default"
										}
									}
								},
								data: [<?php echo $urlTotal[0][1] ?>, <?php echo $urlTotal[1][1] ?>, <?php echo $urlTotal[2][1] ?>, <?php echo $urlTotal[3][1] ?>, <?php echo $urlTotal[4][1] ?>, <?php echo $urlTotal[5][1] ?>, <?php echo $urlTotal[6][1] ?>]
							},
							{
								name: "监控",
								type: "line",
								smooth: true,
								itemStyle: {
									normal: {
										areaStyle: {
											type: "default"
										},
										color: "rgb(110, 211, 199)"
									}
								},
								data: [<?php echo $safeTotal[0][1] ?>, <?php echo $safeTotal[1][1] ?>, <?php echo $safeTotal[2][1] ?>, <?php echo $safeTotal[3][1] ?>, <?php echo $safeTotal[4][1] ?>, <?php echo $safeTotal[5][1] ?>, <?php echo $safeTotal[6][1] ?>]
							}
						]
					});
				}
			);
			$(window).resize(function() {
				myChart.resize();
			})
		});
	</script>
</body>

</html>