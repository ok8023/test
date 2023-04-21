<?php
if(!$ycm){exit;}
?>
<?php 
	$title = $site_name.' - 首页';
	include 'head.php';
		echo '<div class="bg-image" style="background-image: url(http://wx.1314521.love/img/bg.jpg);">
    <div class="bg-black-50">
        <div class="content content-full bg-flat-op overflow-hidden">
            <div class="mt-7 mb-5 text-center">
                <h1 class="h2 text-white mb-2 js-appear-enabled animated fadeInDown" data-toggle="appear" data-class="animated fadeInDown">'.$site_name.'</h1>
                <h2 class="h4 font-w400 text-white-75 js-appear-enabled animated fadeInDown" data-toggle="appear" data-class="animated fadeInDown" style="color:#ffffff">陪伴是最长情的告白</h2>
            </div>
        </div>
    </div>
</div>
<div class="content content-boxed">
<div class="row row-deck py-4">
        <div class="col-md-6 col-lg-6 col-xl-6">
           <a class="block block-rounded block-link-pop" href="./index.php?mod=meinv">
                <div class="block-content block-content-full text-center bg-amethyst" style="color:#ffffff">
                    <div class="item item-2x item-circle bg-white-10 py-3 my-3 mx-auto js-appear-enabled animated fadeIn" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
                        <i class="fa fa-venus fa-2x"></i>
                    </div>
                    <div class="font-size-sm text-white-75">
                        <em>精选美女写真图片</em>
                    </div>
                </div>
                <div class="block-content block-content-full text-center">
                    <h4 class="mb-1">美女图片</h4>
                    <div class="font-size-sm text-muted"></div>
                </div>
            </a>
</div>
<div class="col-md-6 col-lg-6 col-xl-6">
           <a class="block block-rounded block-link-pop" href="./index.php?mod=wapbz">
                <div class="block-content block-content-full text-center bg-modern" style="color:#ffffff">
                    <div class="item item-2x item-circle bg-white-10 py-3 my-3 mx-auto js-appear-enabled animated fadeIn" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
                        <i class="fa fa-paper-plane-o fa-2x text-white-75"></i>
                    </div>
                    <div class="font-size-sm text-white-75">
                        <em>精选最新潮流壁纸</em>
                    </div>
                </div>
                <div class="block-content block-content-full text-center">
                    <h4 class="mb-1">手机壁纸</h4>
                    <div class="font-size-sm text-muted"></div>
                </div>
            </a>
</div>
</div>

';
	include 'foot.php';
?>

