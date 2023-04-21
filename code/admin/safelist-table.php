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
if (isset($_GET['id'])) {
    $sql = " id={$_GET['id']}";
} elseif (isset($_GET['kw'])) {
    $sql = " (url='{$_GET['kw']}' or id='{$_GET['kw']}' or uid='{$_GET['kw']}')";
    $link = '&kw=' . $_GET['kw'];
} else {
    $sql = "1";
}
$rs = $conn->query("select * from url_safe where{$sql}");
$numrows = $rs->num_rows;
?>
<table class="table table-striped border-top">
    <thead>
        <tr>
            <th style="width:8px;"><input type="checkbox" class="group-checkable" id="checkAll" /></th>
            <th class="hidden-phone">ID</th>
            <th>UID</th>
            <th>网址</th>
            <th class="hidden-phone">备注</th>
            <th>状态</th>
            <th class="hidden-phone">添加时间</th>
            <th class="hidden-phone">邮件通知</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $pagesize = 10;
        $pages = intval($numrows / $pagesize);
        if ($numrows % $pagesize) {
            $pages++;
        }
        if (isset($_GET['page'])) {
            $page = intval($_GET['page']);
        } else {
            $page = 1;
        }
        $offset = $pagesize * ($page - 1);
        $rs = $conn->query("select * from url_safe where{$sql} order by addtime desc limit $offset,$pagesize");
        while ($res = $rs->fetch_array()) {
            echo '<tr><td><input type="checkbox" name="checkid" class="checkboxes" value="' . $res['id'] . '" /></td><td class="hidden-phone">' . $res['id'] . '</td><td>' . $res['uid'] . '</td><td><a href="' . $res['url'] . '" target="_blank">' . $res['url'] . '</a></td><td class="hidden-phone">' . $res['remarks'] . '</td><td>' . ($res['safe'] == 1 ? '<span class="btn btn-xs btn-success">正常</span>' : '<span class="btn btn-xs btn-danger">报毒</span>') . '</td><td class="hidden-phone">' . $res['addtime'] . '</td><td class="hidden-phone">' . ($res['notice'] == 1 ? '<span class="btn btn-xs btn-success" onclick="setNotice(' . $res['id'] . ',0)">开启</span>' : '<span class="btn btn-xs btn-warning" onclick="setNotice(' . $res['id'] . ',1)">关闭</span>') . '</td><td><a title="编辑" href="./safelist.php?my=edit&id=' . $res['id'] . '" class="btn btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;<a title="删除" href="./safelist.php?my=delete&id=' . $res['id'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除该网址吗？\');"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
        }
        ?>
    </tbody>
    <script>
        var i = 0;
        $("#checkAll").on("click", function() {
            if (i == 0) {
                $(".checkboxes").prop("checked", true);
                i = 1;
            } else {
                $(".checkboxes").prop("checked", false);
                i = 0;
            }

        });
    </script>
</table>
<div class="row">
    <div class="col-sm-6">
        <div class="dataTables_info" id="sample_1_info">共有 <b><?php echo $numrows; ?></b> 条网址监控记录</div>
    </div>
    <div class="col-sm-6">
        <div class="dataTables_paginate paging_bootstrap pagination">
            <?php
            echo '<ul class="pagination">';
            $first = 1;
            $prev = $page - 1;
            $next = $page + 1;
            $last = $pages;
            if ($page > 1) {
                echo '<li><a href="javascript:void(0)" onclick="listTable(\'page=' . $first . $link . '\')">首页</a></li>';
                echo '<li><a href="javascript:void(0)" onclick="listTable(\'page=' . $prev . $link . '\')">&laquo;</a></li>';
            } else {
                echo '<li class="disabled"><a>首页</a></li>';
                echo '<li class="disabled"><a>&laquo;</a></li>';
            }
            for ($i = 1; $i < $page; $i++)
                echo '<li><a href="javascript:void(0)" onclick="listTable(\'page=' . $i . $link . '\')">' . $i . '</a></li>';
            echo '<li class="disabled"><a>' . $page . '</a></li>';
            if ($pages >= 10) $s = 10;
            else $s = $pages;
            for ($i = $page + 1; $i <= $s; $i++)
                echo '<li><a href="javascript:void(0)" onclick="listTable(\'page=' . $i . $link . '\')">' . $i . '</a></li>';
            echo '';
            if ($page < $pages) {
                echo '<li><a href="javascript:void(0)" onclick="listTable(\'page=' . $next . $link . '\')">&raquo;</a></li>';
                echo '<li><a href="javascript:void(0)" onclick="listTable(\'page=' . $last . $link . '\')">尾页</a></li>';
            } else {
                echo '<li class="disabled"><a>&raquo;</a></li>';
                echo '<li class="disabled"><a>尾页</a></li>';
            }
            echo '</ul>';
            ?>
        </div>
    </div>
</div>