<?php
include('../includes/common.php');
if (isset($_COOKIE['adminlogin'])) {
    $_SESSION['adminlogin'] = 1;
}
if ($_SESSION['adminlogin'] != 1) {
    exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
$mod = isset($_GET['mod']) ? $_GET['mod'] : null;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>系统设置</title>
    <link rel="stylesheet" type="text/css" href="../static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="../static/admin/css/admin.css" />
</head>

<body>
    <div class="layui-tab page-content-wrap">
        <ul class="layui-tab-title">
            <li <?= $mod != 'account' ? 'class="layui-this"' : '' ?>>站点配置</li>
            <li <?= $mod == 'account' ? 'class="layui-this"' : '' ?>>账号配置</li>
            <li>SEO配置</li>
            <li>跳转配置</li>
            <li>邮箱配置</li>
            <li>公告配置</li>
        </ul>
        <div class="layui-tab-content">
            <!--站点配置-->
            <div class="layui-tab-item <?= $mod != 'account' ? 'layui-show' : '' ?> ">
                <form class="layui-form" style="width: 90%;padding-top: 20px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">网站名称：</label>
                        <div class="layui-input-block">
                            <input type="text" name="web_name" autocomplete="off" class="layui-input" value="<?php echo $conf['web_name']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">网站域名：</label>
                        <div class="layui-input-block">
                            <input type="text" name="domain" autocomplete="off" class="layui-input" value="<?php echo $conf['domain']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">站长QQ：</label>
                        <div class="layui-input-block">
                            <input type="text" name="web_qq" required lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo $conf['web_qq']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">默认UID：</label>
                        <div class="layui-input-block">
                            <input type="text" name="uid" required lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo $conf['uid']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">监控秘钥：</label>
                        <div class="layui-input-block">
                            <input type="text" name="cronkey" required lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo $conf['cronkey']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">首页背景：</label>
                        <div class="layui-input-block">
                            <select name="index_bg" lay-verify="required">
                                <option value="1" <?php if ($conf['index_bg'] == 1) { ?>selected<?php } ?>>随机背景</option>
                                <option value="2" <?php if ($conf['index_bg'] == 2) { ?>selected<?php } ?>>随机动漫背景</option>
                                <option value="3" <?php if ($conf['index_bg'] == 3) { ?>selected<?php } ?>>随机美女背景</option>
                                <option value="4" <?php if ($conf['index_bg'] == 4) { ?>selected<?php } ?>>随机风景背景</option>
                                <option value="5" <?php if ($conf['index_bg'] == 5) { ?>selected<?php } ?>>自定义背景</option>
                            </select>
                            <a style="color:blue" href="./inter.php?mod=set_logo">logo设置</a> <a style="color:blue" href="./inter.php?mod=set_bg">背景设置</a>
                        </div>

                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">首页模板：</label>
                        <div class="layui-input-block">
                            <select name="template" lay-verify="required">
                                <option value="blum" <?php if ($conf['template'] == 'blum') { ?>selected<?php } ?>>blum</option>
                                <option value="rain" <?php if ($conf['template'] == 'rain') { ?>selected<?php } ?>>rain</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">http协议：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="is_https" value="1" title="https" <?= $conf['is_https'] == 1 ? 'checked=""' : '' ?>>
                            <input type="radio" name="is_https" value="0" title="http" <?= $conf['is_https'] == 0 ? 'checked=""' : '' ?>>
                            
                        </div>
                        <span style="color:red">建议弄个https，不是https新浪短链生成很慢</span>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">注册开关：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="is_reg" value="1" title="开启" <?= $conf['is_reg'] == 1 ? 'checked=""' : '' ?>>
                            <input type="radio" name="is_reg" value="0" title="关闭" <?= $conf['is_reg'] == 0 ? 'checked=""' : '' ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="siteInfo">立即提交</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--管理配置-->
            <div class="layui-tab-item <?= $mod == 'account' ? 'layui-show' : '' ?>">
                <form class="layui-form" style="width: 90%;padding-top: 20px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">管理账号：</label>
                        <div class="layui-input-block">
                            <input type="text" name="admin_user" placeholder="请输入管理账号" autocomplete="off" class="layui-input" value="<?php echo $conf['admin_user']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">管理密码：</label>
                        <div class="layui-input-block">
                            <input type="password" name="admin_pwd" placeholder="请输入管理密码" autocomplete="off" class="layui-input" value="<?php echo $conf['admin_pwd']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="zhInfo">立即提交</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--SEO配置-->
            <div class="layui-tab-item">
                <form class="layui-form" style="width: 90%;padding-top: 20px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">SEO标题：</label>
                        <div class="layui-input-block">
                            <input type="text" name="web_name" placeholder="请输入seo标题" autocomplete="off" class="layui-input" value="<?php echo $conf['web_name']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">关键字：</label>
                        <div class="layui-input-block">
                            <input type="text" name="keywords" placeholder="请输入seo关键字" autocomplete="off" class="layui-input" value="<?php echo $conf['keywords']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">描述：</label>
                        <div class="layui-input-block">
                            <textarea name="description" placeholder="请输入seo描述" class="layui-textarea"><?php echo $conf['description'] ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="seoInfo">立即提交</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--跳转配置-->
            <div class="layui-tab-item">
                <form class="layui-form" style="width: 90%;padding-top: 20px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">无ID跳转：</label>
                        <div class="layui-input-block">
                            <input type="text" name="jump_1" placeholder="没有ID参数时跳转" autocomplete="off" class="layui-input" value="<?php echo $conf['jump_1']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">封禁跳转：</label>
                        <div class="layui-input-block">
                            <input type="text" name="jump_2" placeholder="网址被封禁时跳转" autocomplete="off" class="layui-input" value="<?php echo $conf['jump_2']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">错误ID：</label>
                        <div class="layui-input-block">
                            <input type="text" name="jump_3" placeholder="系统不存在该ID时跳转" autocomplete="off" class="layui-input" value="<?php echo $conf['jump_3']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="tzInfo">立即提交</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--邮箱配置-->
            <div class="layui-tab-item">
                <form class="layui-form" style="width: 90%;padding-top: 20px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">SMTP服务器：</label>
                        <div class="layui-input-block">
                            <input type="text" name="mail_smtp" placeholder="请输入SMTP服务器" autocomplete="off" class="layui-input" value="<?php echo $conf['mail_smtp']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">SMTP端口：</label>
                        <div class="layui-input-block">
                            <input type="text" name="mail_port" placeholder="请输入SMTP端口" autocomplete="off" class="layui-input" value="<?php echo $conf['mail_port']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">邮箱账号：</label>
                        <div class="layui-input-block">
                            <input type="text" name="mail_name" placeholder="请输入邮箱账号" autocomplete="off" class="layui-input" value="<?php echo $conf['mail_name']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">邮箱密码：</label>
                        <div class="layui-input-block">
                            <input type="text" name="mail_pwd" placeholder="请输入邮箱密码" autocomplete="off" class="layui-input" value="<?php echo $conf['mail_pwd']; ?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="emailInfo">立即提交</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--公告设置-->
            <div class="layui-tab-item">
                <form class="layui-form" style="width: 90%;padding-top: 20px;">
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">公告①：</label>
                        <div class="layui-input-block">
                            <textarea name="gg1" class="layui-textarea"><?php echo $conf['gg1'] ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">公告②：</label>
                        <div class="layui-input-block">
                            <textarea name="gg2" class="layui-textarea"><?php echo $conf['gg2'] ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">公告③：</label>
                        <div class="layui-input-block">
                            <textarea name="gg3" class="layui-textarea"><?php echo $conf['gg3'] ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="commentInfo">立即提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <script>
        //Demo
        layui.use(['form', 'element'], function() {
            var form = layui.form();
            var element = layui.element();
            $ = layui.jquery;
            form.render();
            //监听信息提交
            form.on('submit(siteInfo)', function(data) {
                $.ajax({
                    type: "post",
                    url: "ajax.php?act=site",
                    dataType: "text",
                    data: data.field,
                    success: function(obj) {
                        layer.msg('修改成功');
                    },
                    error: function(a) {
                        layer.msg('修改失败');
                    }
                });
                return false;
            });
            //监听账号提交
            form.on('submit(zhInfo)', function(data) {
                $.ajax({
                    type: "post",
                    url: "ajax.php?act=site",
                    dataType: "text",
                    data: data.field,
                    success: function(obj) {
                        layer.msg('修改成功');
                    },
                    error: function(a) {
                        layer.msg('修改失败');
                    }
                });
                return false;
            });
            //监听seo提交
            form.on('submit(seoInfo)', function(data) {
                $.ajax({
                    type: "post",
                    url: "ajax.php?act=site",
                    dataType: "text",
                    data: data.field,
                    success: function(obj) {
                        layer.msg('修改成功');
                    },
                    error: function(a) {
                        layer.msg('修改失败');
                    }
                });
                return false;
            });
            //监听跳转提交
            form.on('submit(tzInfo)', function(data) {
                $.ajax({
                    type: "post",
                    url: "ajax.php?act=site",
                    dataType: "text",
                    data: data.field,
                    success: function(obj) {
                        layer.msg('修改成功');
                    },
                    error: function(a) {
                        layer.msg('修改失败');
                    }
                });
                return false;
            });
            //监听邮箱提交
            form.on('submit(emailInfo)', function(data) {
                $.ajax({
                    type: "post",
                    url: "ajax.php?act=site",
                    dataType: "text",
                    data: data.field,
                    success: function(obj) {
                        layer.msg('修改成功');
                    },
                    error: function(a) {
                        layer.msg('修改失败');
                    }
                });
                return false;
            });
            //监听公告提交
            form.on('submit(commentInfo)', function(data) {
                $.ajax({
                    type: "post",
                    url: "ajax.php?act=site",
                    dataType: "text",
                    data: data.field,
                    success: function(obj) {
                        layer.msg('修改成功');
                    },
                    error: function(a) {
                        layer.msg('修改失败');
                    }
                });
                return false;
            });
        });
    </script>
</body>

</html>