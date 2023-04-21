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
    $sql = " (user='{$_GET['kw']}' or qq='{$_GET['kw']}' or id='{$_GET['kw']}')";
    $link = '&kw=' . $_GET['kw'];
} else {
    $sql = "1";
}
$rs = $conn->query("select * from user_list where{$sql}");
$numrows = $rs->num_rows;
?>
<table class="table table-striped border-top">
    <thead>
        <tr>
            <th style="width:8px;"><input type="checkbox" class="group-checkable" id="checkAll" /></th>
            <th>ID</th>
            <th>用户名</th>
            <th class="hidden-phone">QQ</th>
            <th class="hidden-phone">添加时间</th>
            <th>状态</th>
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
        $rs = $conn->query("select * from user_list where{$sql} order by id desc limit $offset,$pagesize");
        while ($res = $rs->fetch_array()) {
            echo '<tr><td><input type="checkbox" name="checkid" class="checkboxes" value="' . $res['id'] . '" /></td><td><b>' . $res['id'] . '</b></td><td>' . $res['user'] . '</td><td class="hidden-phone">' . $res['qq'] . '</td><td class="hidden-phone">' . $res['addtime'] . '</td><td>' . ($res['state'] == 1 ? '<span class="btn btn-xs btn-success" onclick="setActive(' . $res['id'] . ',0)">正常</span>' : '<span class="btn btn-xs btn-warning" onclick="setActive(' . $res['id'] . ',1)">封禁</span>') . '</td><td><a title="编辑" href="./ulist.php?my=edit&id=' . $res['id'] . '" class="btn btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;<a href="./urllist.php?kw=' . $res['id'] . '" class="btn btn-warning btn-xs"><i class="fa fa-list-alt" aria-hidden="true"></i></a>&nbsp;<a title="删除" href="./ulist.php?my=delete&id=' . $res['id'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除该用户吗？\');"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
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
        <div class="dataTables_info" id="sample_1_info">共有 <b><?php echo $numrows; ?></b> 个用户</div>
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