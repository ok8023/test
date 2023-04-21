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
$title = '用户管理';
include('head.php');
?>
<section id="main-content">
    <section class="wrapper">
        <div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">搜索用户</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" name="kw" placeholder="请输入用户名"><br />
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
                            添加新用户
                        </header>
                        <div class="panel-body">
                            <form action="./ulist.php?my=add_submit" method="post" class="cmxform form-horizontal tasi-form" role="form">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">用户名:</label>
                                    <div class="col-sm-10"><input type="text" name="user" value="" class="form-control" required /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">密码:</label>
                                    <div class="col-sm-10"><input type="text" name="pwd" value="123456" class="form-control" required /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">等级:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="power">
                                            <option value="0" selected>普通会员</option>
                                            <option value="1">超级会员</option>
                                        </select>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">QQ:</label>
                                    <div class="col-sm-10"><input type="text" name="qq" value="" class="form-control" /></div>
                                </div><br />
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-danger" type="submit">确认添加</button>
                                        <a href="./ulist.php" class="btn btn-default" type="button">返回列表</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        <?php
        } elseif ($my == 'add_submit') {
            $user = trim($_POST['user']);
            $pwd = trim($_POST['pwd']);
            $power = trim($_POST['power']);
            $qq = $_POST['qq'];
            if (($user == NULL || $pwd == NULL)) {
                showmsg('保存错误,请确保每项都不为空!', 3);
            } else {
                $rows = $conn->query("select * from user_list where user='$user'");
                if ($rows->num_rows > 0) {
                    showmsg('用户名已存在！', 3);
                } else {
                    $rows = $conn->query("select * from user_list where qq='$qq'");
                    if ($rows->num_rows > 0) {
                        showmsg('QQ号已被注册', 3);
                    } else {
                        $rs = $conn->query("insert into user_list(user,pwd,power,addtime,qq) values('$user','$pwd','$power','$nowDate','$qq')");
                        if ($rs) {
                            showmsg('添加用户成功！<br/><br/><a href="./ulist.php">>>返回用户列表</a>', 1);
                        } else {
                            showmsg('添加用户失败！', 4);
                        }
                    }
                }
            }
        } elseif ($my == 'edit_submit') {
            $id = $_GET['id'];
            $rows = $conn->query("select * from user_list where id = '{$id}'");
            if ($rows->num_rows == 0) {
                showmsg('当前记录不存在！', 3);
            } else {
                $user = trim($_POST['user']);
                $pwd = $_POST['pwd'];
                $power = $_POST['power'];
                $qq = trim($_POST['qq']);
                $mail = trim($_POST['mail']);
                if ($user == NULL || $pwd == NULL || $power == NULL) {
                    showmsg('保存错误,请确保每项都不为空!', 3);
                } else {
                    $rs = $conn->query("select * from user_list where qq='$qq' and id <> '$id'");
                    if ($rs->num_rows > 0) {
                        exit("<script language='javascript'>alert('该QQ号已被其他账号使用！');history.go(-1);</script>");
                    } else {
                        $rs = $conn->query("update user_list set user='$user',pwd='$pwd',power='$power',qq='$qq',mail='$mail' where id='$id'");
                        if ($rs) {
                            showmsg('修改用户成功！<br/><br/><a href="./ulist.php">>>返回用户列表</a>', 1);
                        } else {
                            showmsg('修改用户失败！', 4);
                        }
                    }
                }
            }
        } elseif ($my == 'edit') {
            $id = $_GET['id'];
            $rs = $conn->query("select * from user_list where id= '$id'");
            if ($rs->num_rows == 0) {
                exit("<script language='javascript'>alert('当前记录不存在');history.go(-1);</script>");
            }
            $row = $rs->fetch_assoc();
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            修改用户信息
                        </header>
                        <div class="panel-body">
                            <form action="./ulist.php?my=edit_submit&id=<?php echo $row['id']; ?>" method="post" class="cmxform form-horizontal tasi-form" role="form">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">用户名:</label>
                                    <div class="col-sm-10"><input type="text" name="user" value="<?php echo $row['user']; ?>" class="form-control" required /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">密码:</label>
                                    <div class="col-sm-10"><input type="text" name="pwd" value="<?php echo $row['pwd']; ?>" class="form-control" required /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">等级:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="power">
                                            <option value="0" <?= $row['power'] == 0 ? "selected" : "" ?>>普通会员</option>
                                            <option value="1" <?= $row['power'] == 1 ? "selected" : "" ?>>超级会员</option>
                                        </select>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">QQ:</label>
                                    <div class="col-sm-10"><input type="text" name="qq" value="<?php echo $row['qq']; ?>" class="form-control" required /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">收件邮箱:</label>
                                    <div class="col-sm-10"><input type="text" name="mail" value="<?php echo $row['mail']; ?>" class="form-control" required /></div>
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
            $rs = $conn->query("select * from user_list where id='$id'");
            if ($rs->num_rows == 0) {
                showmsg('当前记录不存在！', 3);
            } else {
                $rs = $conn->query("delete from user_list where id='$id'");
                if ($rs) {
                    showmsg('删除成功！<br/><br/><a href="./ulist.php">>>返回用户列表</a>', 1);
                } else {
                    showmsg('删除失败！', 4);
                }
            }
        } else {
            $rs = $conn->query("select * from user_list");
            $numrows = $rs->num_rows;
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <a href="./ulist.php?my=add" class="btn btn-primary">添加用户</a>&nbsp;
                            <button class="btn btn-danger" onclick="datadel()">删除选中</button>&nbsp;
                            <a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>&nbsp;
                            <a href="javascript:listTable('start')" class="btn btn-default" title="刷新用户列表"><i class="fa fa-refresh"></i></a>
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
            history.replaceState({}, null, './ulist.php');
        } else if (query != undefined) {
            history.replaceState({}, null, './ulist.php?' + query);
        }
        layer.closeAll();
        var ii = layer.load(2, {
            shade: [0.1, '#fff']
        });
        $.ajax({
            type: 'GET',
            url: 'ulist-table.php?' + query,
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
        layer.confirm('您确定要删除这些用户吗？', {
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
                url: "ajax.php?act=delSelect3",
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

    function setActive(id, state) {
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=setUser&id=' + id + '&state=' + state,
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