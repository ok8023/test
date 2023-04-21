<?php
include("../includes/common.php");
if ($islogin2 == 1) { } else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

<?php
$active = 'uset-user';
$title = '用户资料设置';
include 'head.php';
$id = $userrow['id'];
$rs = $conn->query("select * from user_list where id='$id'");
$res = $rs->fetch_assoc();
$mod = isset($_GET['mod']) ? $_GET['mod'] : null;
?>
<section id="main-content">
    <section class="wrapper">
        <?php
        if ($mod == 'user') {
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            用户资料设置
                        </header>
                        <div class="panel-body">
                            <form action="./uset.php?mod=user_n" method="post" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ＱＱ</label>
                                    <div class="col-sm-10"><input type="text" name="qq" value="<?php echo $res['qq']; ?>" class="form-control" placeholder="用于联系与找回密码" /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">收件邮箱</label>
                                    <div class="col-sm-10"><input type="text" name="mail" value="<?php echo $res['mail']; ?>" class="form-control" placeholder="用于联系与找回密码" /></div>
                                </div><br />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">重置密码</label>
                                    <div class="col-sm-10"><input type="text" name="pwd" value="" class="form-control" placeholder="不修改请留空" /></div>
                                </div><br />
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-danger" type="submit">确认修改</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        <?php
        } elseif ($mod == 'user_n') {
            $qq = daddslashes(strip_tags($_POST['qq']));
            $mail = daddslashes(strip_tags($_POST['mail']));
            $pwd = daddslashes(strip_tags($_POST['pwd']));
            if (!empty($pwd) && !preg_match('/^[a-zA-Z0-9\_\!\@\#\$~\%\^\&\*.,]+$/', $pwd)) {
                showmsg('密码只能为英文与数字！', 3);
            } elseif (!preg_match('#^[0-9]{5,11}+$#', $qq)) {
                showmsg('QQ格式不正确！', 3);
            } else {
                $rs = $conn->query("select * from user_list where qq='$qq' and id <> '$id'");
                if ($rs->num_rows > 0) {
                    exit("<script language='javascript'>alert('该QQ号已被其他账号使用！');history.go(-1);</script>");
                }
                $conn->query("update user_list set qq='$qq',mail='$mail' where id='$id'");
                if (!empty($pwd)) $conn->query("update user_list set pwd='$pwd' where id='$id'");
                showmsg('修改保存成功！', 1);
            }
        }
        ?>
    </section>
</section>
<script src="../static/user/js/common-scripts.js"></script>