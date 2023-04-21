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
$title = '监控列表';
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
        $my = isset($_GET['my']) ? $_GET['my'] : null;
        $uid = $userrow['id'];
        if ($my == 'add') {
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            添加监控网址
                        </header>
                        <div class="panel-body">
                            <form action="./safelist.php?my=add_submit" method="post" class="cmxform form-horizontal tasi-form" role="form">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">uid:</label>
                                    <div class="col-sm-10"><input type="text" name="uid" value="<?php echo $conf['uid'] ?>" class="form-control" required /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">监控网址:</label>
                                    <div class="col-sm-10"><input type="text" name="url" value="" class="form-control" required /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">备注:</label>
                                    <div class="col-sm-10"><input type="text" name="remarks" value="" class="form-control" /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">邮箱通知:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="notice">
                                            <option value="1" selected>开启</option>
                                            <option value="0">关闭</option>
                                        </select>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-danger" type="submit">确认添加</button>
                                        <a href="./safelist.php" class="btn btn-default" type="button">返回列表</a>
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
            $notice = trim($_POST['notice']);
            $remarks = $_POST['remarks'];
            if (($uid == NULL || $url == NULL) || $notice == NULL) {
                showmsg('保存错误,请确保每项都不为空!', 3);
            } else {
                $rs = $conn->query("select * from url_safe where uid = '$uid' and url = '$url'");
                if ($rs->num_rows > 0) {
                    showmsg('该网址已存在!', 3);
                } else {
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $sql = "insert into url_safe(uid,addtime,url,setip,notice,remarks) values('$uid','$nowDate','$url','$ip','$notice','$remarks')";
                    $rs = $conn->query($sql);
                    if ($rs) {
                        showmsg('添加网址成功！<br/><a href="./safelist.php">>>返回监控列表</a>', 1);
                    } else {
                        showmsg('添加网址失败！', 4);
                    }
                }
            }
        } elseif ($my == 'edit_submit') {
            $id = $_GET['id'];
            $rs = $conn->query("select * from url_safe where id='$id'");
            if ($rs->num_rows == 0) {
                showmsg('当前记录不存在！', 3);
            } else {
                $url = trim($_POST['url']);
                $remarks = $_POST['remarks'];
                $notice = trim($_POST['notice']);
                if ($url == NULL || $notice == NULL) {
                    showmsg('保存错误,请确保每项都不为空!', 3);
                } else {
                    $rs = $conn->query("update url_safe set url='$url',remarks='$remarks',notice='$notice' where id='$id'");
                    if ($rs) {
                        showmsg('修改信息成功！<br/><br/><a href="./safelist.php">>>返回监控列表</a>', 1);
                    } else {
                        showmsg('修改信息失败！', 4);
                    }
                }
            }
        } elseif ($my == 'edit') {
            $id = $_GET['id'];
            $rs = $conn->query("select * from url_safe where id='$id'");
            if ($rs->num_rows == 0) {
                exit("<script language='javascript'>alert('当前记录不存在');history.go(-1);</script>");
            }
            $row = $rs->fetch_assoc();
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            修改监控信息
                        </header>
                        <div class="panel-body">
                            <form action="./safelist.php?my=edit_submit&id=<?php echo $row['id']; ?>" method="post" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">监控网址:</label>
                                    <div class="col-sm-10"><input type="text" name="url" value="<?php echo $row['url']; ?>" class="form-control" required /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">网址备注:</label>
                                    <div class="col-sm-10"><input type="text" name="remarks" value="<?php echo $row['remarks']; ?>" class="form-control" /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">邮箱通知:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="notice">
                                            <option value="1" <?= $row['notice'] == 1 ? "selected" : "" ?>>开启</option>
                                            <option value="0" <?= $row['notice'] == 0 ? "selected" : "" ?>>关闭</option>
                                        </select>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-danger" type="submit">确认修改</button>
                                        <a href="./safelist.php" class="btn btn-default" type="button">返回列表</a>
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
            $rs = $conn->query("select * from url_safe where id='$id'");
            if ($rs->num_rows == 0) {
                showmsg('当前记录不存在！', 3);
            } else {
                $rs = $conn->query("delete from url_safe where id='$id'");
                if ($rs) {
                    showmsg('删除成功！<br/><br/><a href="./safelist.php">>>返回监控列表</a>', 1);
                } else {
                    showmsg('删除失败！', 4);
                }
            }
        } else {
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <a href="./safelist.php?my=add" class="btn btn-primary">添加网址</a>&nbsp;
                            <div class="btn-group">
                                <a class="btn btn-warning" href="#" data-toggle="dropdown">
                                    操作
                                    <i class="icon-angle-down "></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" onclick="noticeAll('1')"><i class="icon-pencil"></i>开启通知</a></li>
                                    <li><a href="#" onclick="noticeAll('0')"><i class="icon-ban-circle"></i>关闭通知</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" onclick="datadel()"><i class="icon-trash"></i>删除</a></li>
                                </ul>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>&nbsp;
                            <a href="javascript:listTable('start')" class="btn btn-default" title="刷新监控列表"><i class="fa fa-refresh"></i></a>
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
            history.replaceState({}, null, './safelist.php');
        } else if (query != undefined) {
            history.replaceState({}, null, './safelist.php?' + query);
        }
        layer.closeAll();
        var ii = layer.load(2, {
            shade: [0.1, '#fff']
        });
        $.ajax({
            type: 'GET',
            url: 'safelist-table.php?' + query,
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
                url: "ajax.php?act=delSelect2",
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

    function noticeAll(notice) {

        layer.confirm('您确定要进行此操作吗？', {
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
                url: 'ajax.php?act=noticeAll&notice=' + notice,
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

    function setNotice(id, notice) {
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=setNotice&id=' + id + '&notice=' + notice,
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