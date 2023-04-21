<?php
include('../includes/common.php');
if (isset($_COOKIE['adminlogin'])) {
    $_SESSION['adminlogin'] = 1;
}
if ($_SESSION['adminlogin'] != 1) {
    exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
?>

<?php
$my = isset($_GET['my']) ? $_GET['my'] : null;
$title = '网址管理';
include('head.php');
?>
<section id="main-content">
    <section class="wrapper">
        <div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">搜索网址</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" name="kw" placeholder="请输入网址"><br />
                        <button type="button" class="btn btn-primary btn-block" id="search_submit">搜索</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php

        $uid = $userrow['id'];
        if ($my == 'add') {
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            添加新网址
                        </header>
                        <div class="panel-body">
                            <form action="./urllist.php?my=add_submit" method="post" class="cmxform form-horizontal tasi-form" role="form">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">uid:</label>
                                    <div class="col-sm-10"><input type="text" name="uid" value="<?php echo $conf['uid'] ?>" class="form-control" required /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">默认跳转:</label>
                                    <div class="col-sm-10"><input type="text" name="url" value="" class="form-control" required /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">备注:</label>
                                    <div class="col-sm-10"><input type="text" name="remarks" value="" class="form-control" /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">访问密码:</label>
                                    <div class="col-sm-10"><input type="text" name="pwd" value="" class="form-control" />
                                        <p class="help-block">留空则不需要输入密码</p>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">QQ跳转:</label>
                                    <div class="col-sm-10"><input type="text" name="qqjump" value="" class="form-control" />
                                        <p class="help-block">留空则为默认跳转</p>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">微信跳转:</label>
                                    <div class="col-sm-10"><input type="text" name="wxjump" value="" class="form-control" />
                                        <p class="help-block">留空则为默认跳转</p>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">支付宝跳转:</label>
                                    <div class="col-sm-10"><input type="text" name="alijump" value="" class="form-control" />
                                        <p class="help-block">留空则为默认跳转</p>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-danger" type="submit">确认添加</button>
                                        <a href="./urllist.php" class="btn btn-default" type="button">返回列表</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        <?php
        } elseif ($my == 'add_submit') {
            $uid = trim($_POST['uid']);
            $url = trim($_POST['url']);
            $pwd = trim($_POST['pwd']);
            $qqjump = trim($_POST['qqjump']);
            $wxjump = trim($_POST['wxjump']);
            $alijump = trim($_POST['alijump']);
            $remarks = $_POST['remarks'];
            $preg = "/^http(s)?:\\/\\/.+/";
            if (!preg_match($preg, $url)) {
                if ($conf['is_https'] == 1) {
                    $url = 'https://' . $url;
                } else {
                    $url = 'http://' . $url;
                }
            }
            if (($uid == NULL || $url == NULL)) {
                showmsg('保存错误,请确保每项都不为空!', 3);
            } else {
                $id = getCode(7);
                $ip = $_SERVER["REMOTE_ADDR"];
                if ($conf['is_https'] == 1) {
                    $tzurl = 'https://' . $conf['domain'] . '/tz.php?id=' . $id;
                } else {
                    $tzurl = 'http://' . $conf['domain'] . '/tz.php?id=' . $id;
                }
                $tcn = tcn($tzurl);
                $urlcn = urlcn($tzurl);
                $sql = "insert into url_list(id,uid,addtime,tcn,urlcn,url,pwd,qqjump,wxjump,alijump,setip,remarks) values('$id','$uid','$nowDate','$tcn','$urlcn','$url','$pwd','$qqjump','$wxjump','$alijump','$ip','$remarks')";
                $rs = $conn->query($sql);
                if ($rs) {
                    showmsg('添加网址成功！<br/>新浪 ' . $tcn . '<br/>腾讯 ' . $urlcn . '<br/><br/><a href="./urllist.php">>>返回网址列表</a>', 1);
                } else {
                    showmsg('添加网址失败！', 4);
                }
            }
        } elseif ($my == 'edit_submit') {
            $id = $_GET['id'];
            $rows = $conn->query("select * from url_list where id = '{$id}'");
            if ($rows->num_rows == 0) {
                showmsg('当前记录不存在！', 3);
            } else {
                $tcn = trim($_POST['tcn']);
                $urlcn = trim($_POST['urlcn']);
                $url = $_POST['url'];
                $setip = $_POST['setip'];
                $remarks = $_POST['remarks'];
                $pwd = trim($_POST['pwd']);
                $qqjump = trim($_POST['qqjump']);
                $wxjump = trim($_POST['wxjump']);
                $alijump = trim($_POST['alijump']);
                if ($url == NULL) {
                    showmsg('保存错误,请确保每项都不为空!', 3);
                } else {
                    $rs = $conn->query("update url_list set tcn='$tcn',urlcn='$urlcn',url='$url',setip='$setip',remarks='$remarks',pwd='$pwd',qqjump='$qqjump',wxjump='$wxjump',alijump='$alijump' where id='$id'");
                    if ($rs) {
                        showmsg('修改网址成功！<br/><br/><a href="./urllist.php">>>返回网址列表</a>', 1);
                    } else {
                        showmsg('修改网址失败！', 4);
                    }
                }
            }
        } elseif ($my == 'edit') {
            $id = $_GET['id'];
            $rs = $conn->query("select * from url_list where id= '$id'");
            if ($rs->num_rows == 0) {
                exit("<script language='javascript'>alert('当前记录不存在');history.go(-1);</script>");
            }
            $row = $rs->fetch_assoc();
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            修改网址信息
                        </header>
                        <div class="panel-body">
                            <form action="./urllist.php?my=edit_submit&id=<?php echo $row['id']; ?>" method="post" class="cmxform form-horizontal tasi-form" role="form">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">新浪网址:</label>
                                    <div class="input-group col-sm-10">
                                        <input type="text" name="tcn" value="<?php echo $row['tcn']; ?>" class="form-control" />
                                        <span class="input-group-btn">
                                            <a href="javascript:upTcn('<?php echo $row['id']; ?>')" class="btn btn-default" title="更新网址"><i class="fa fa-refresh"></i></a>
                                        </span>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">腾讯网址:</label>
                                    <div class="input-group col-sm-10">
                                        <input type="text" name="urlcn" value="<?php echo $row['urlcn']; ?>" class="form-control" />
                                        <span class="input-group-btn">
                                            <a href="javascript:upUrlcn('<?php echo $row['id']; ?>')" class="btn btn-default" title="更新网址"><i class="fa fa-refresh"></i></a>
                                        </span>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">跳转网址:</label>
                                    <div class="col-sm-10"><input type="text" name="url" value="<?php echo $row['url']; ?>" class="form-control" required /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">添加IP:</label>
                                    <div class="col-sm-10"><input type="text" name="setip" value="<?php echo $row['setip']; ?>" class="form-control" /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">网址备注:</label>
                                    <div class="col-sm-10"><input type="text" name="remarks" value="<?php echo $row['remarks']; ?>" class="form-control" /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">访问密码:</label>
                                    <div class="col-sm-10"><input type="text" name="pwd" value="<?php echo $row['pwd']; ?>" class="form-control" />
                                        <p class="help-block">留空则不需要填写密码</p>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">QQ跳转:</label>
                                    <div class="col-sm-10"><input type="text" name="qqjump" value="<?php echo $row['qqjump']; ?>" class="form-control" />
                                        <p class="help-block">留空则为默认跳转</p>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">微信跳转:</label>
                                    <div class="col-sm-10"><input type="text" name="wxjump" value="<?php echo $row['wxjump']; ?>" class="form-control" />
                                        <p class="help-block">留空则为默认跳转</p>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">支付宝跳转:</label>
                                    <div class="col-sm-10"><input type="text" name="alijump" value="<?php echo $row['alijump']; ?>" class="form-control" />
                                        <p class="help-block">留空则为默认跳转</p>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-danger" type="submit">确认修改</button>
                                        <a href="./urllist.php" class="btn btn-default" type="button">返回列表</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        <?php
        } elseif ($my == 'delete') {
            $id = $_GET['id'];
            $rs = $conn->query("select * from url_list where id='$id'");
            if ($rs->num_rows == 0) {
                showmsg('当前记录不存在！', 3);
            } else {
                $rs = $conn->query("delete from url_list where id='$id'");
                if ($rs) {
                    showmsg('删除成功！<br/><br/><a href="./urllist.php">>>返回网址列表</a>', 1);
                } else {
                    showmsg('删除失败！', 4);
                }
            }
        } else {
            $rs = $conn->query("select * from url_list");
            $numrows = $rs->num_rows;
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <a href="./urllist.php?my=add" class="btn btn-primary">添加网址</a>&nbsp;
                            <button class="btn btn-danger" onclick="datadel()">删除选中</button>&nbsp;
                            <a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>&nbsp;
                            <a href="javascript:listTable('start')" class="btn btn-default" title="刷新网址列表"><i class="fa fa-refresh"></i></a>
                        </header>
                        <div id="listTable"></div>
                    </section>
                </div>
            </div>
        <?php
        }
        ?>
    </section>
</section>
<script>
    function listTable(query) {
        var url = window.document.location.href.toString();
        var queryString = url.split("?")[1];
        query = query || queryString;
        if (query == 'start' || query == undefined) {
            query = '';
            history.replaceState({}, null, './urllist.php');
        } else if (query != undefined) {
            history.replaceState({}, null, './urllist.php?' + query);
        }
        layer.closeAll();
        var ii = layer.load(2, {
            shade: [0.1, '#fff']
        });
        $.ajax({
            type: 'GET',
            url: 'urllist-table.php?' + query,
            dataType: 'html',
            cache: false,
            success: function(data) {
                layer.close(ii);
                $("#listTable").html(data)
            },
            error: function(data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function datadel() {
        layer.confirm('您确定要删除这些网址吗？', {
            btn: ['确定', '取消']
        }, function() {
            var cks = document.getElementsByName("checkid");
            var str = "";
            for (var i = 0; i < cks.length; i++) {
                if (cks[i].checked) {
                    str += cks[i].value + "&";
                }
            }
            str = str.substring(0, str.length - 1);
            $.ajax({
                url: "ajax.php?act=delSelect",
                type: "POST",
                data: {
                    "str": str
                },
                dataType: "json",
                success: function(result) {
                    if (result.code == 0) {
                        window.location.reload();
                    }
                },
                error: function(data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        })
    }

    function upTcn(id) {
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=upTcn&id=' + id,
            dataType: 'json',
            success: function(data) {
                window.location.reload();
            },
            error: function(data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function upUrlcn(id) {
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=upUrlcn&id=' + id,
            dataType: 'json',
            success: function(data) {
                window.location.reload();
            },
            error: function(data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function setActive(id, state) {
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=setUrl&id=' + id + '&state=' + state,
            dataType: 'json',
            success: function(data) {
                listTable();
            },
            error: function(data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function show(id) {
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=getInfo&id=' + id,
            dataType: 'json',
            success: function(data) {
                if (data.code == 0) {
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-molv',
                        anim: 2,
                        shadeClose: true,
                        title: '详细信息',
                        content: '<div style="padding:15px"><p>网址ID：' + data.id + '</p><p>UID：' + data.uid + '</p><p>默认跳转：' + data.url + '</p><p>网址备注：' + data.remarks + '</p><p>新浪短链：' + data.tcn + '</p><p>腾讯短链：' + data.urlcn + '</p><p>QQ跳转：' + data.qqjump + '</p><p>微信跳转：' + data.wxjump + '</p><p>支付宝跳转：' + data.alijump + '</p><p>访问次数：' + data.view + '</p><p>访问密码：' + data.pwd + '</p><p>网址状态：' + data.state + '</p><p>生成IP：' + data.setip + '</p><p>添加时间：' + data.addtime + '</p></div>'
                    });
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function(data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    $(document).ready(function() {
        $("#search_submit").click(function() {
            var kw = $("input[name='kw']").val();
            $("#search").modal('hide');
            if (kw == '') {
                listTable('start');
            } else {
                listTable('kw=' + kw);
            }
        });
    });
    $(document).ready(function() {
        listTable();
    })
</script>