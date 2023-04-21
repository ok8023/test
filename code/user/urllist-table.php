<?php
include('../includes/common.php');
if ($islogin2 == 1) { } else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

<?php
$uid = $userrow['id'];
if (isset($_GET['id'])) {
    $sql = " id={$_GET['id']}";
} elseif (isset($_GET['kw'])) {
    $sql = " (url='{$_GET['kw']}' or tcn='{$_GET['kw']}' or urlcn='{$_GET['kw']}' or id='{$_GET['kw']}')";
    $link = '&kw=' . $_GET['kw'];
} else {
    $sql = "1";
}
$urs = $conn->query("select * from url_list where({$sql} and uid='$uid')");
$numrows = $urs->num_rows;
?>
<script>
    $(document).ready(function() {
        window.PreviewPhoto({
            imageContainerType: (IsPC() ? 2 : 1)
        });
    });

    function IsPC() {
        var userAgentInfo = navigator.userAgent;
        var Agents = ["Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
        var flag = true;
        for (var v = 0; v < Agents.length; v++) {
            if (userAgentInfo.indexOf(Agents[v]) > 0) {
                flag = false;
                break;
            }
        }
        return flag;
    };
</script>
<table class="table table-striped border-top">
    <thead>
        <tr>
            <th style="width:8px;"><input type="checkbox" class="group-checkable" id="checkAll" /></th>
            <th>新浪短链</th>
            <th class="hidden-phone"><span title="备注"><i class="fa fa-info-circle" aria-hidden="true"></i></span></th>
            <th class="hidden-phone"><span title="二维码"><i class="fa fa-qrcode" aria-hidden="true"></i></span></th>
            <th><span title="访问次数"><i class="fa fa-eye" aria-hidden="true"></i></span></th>
            <th class="hidden-phone">添加时间</th>
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
        $rs = $conn->query("select * from url_list where({$sql} and uid='$uid') order by addtime desc limit $offset,$pagesize");
        while ($res = $rs->fetch_array()) {
            $urlrs = $conn->query("select * from visitors where urlid = '{$res['id']}'");
            $viewNum = $urlrs->num_rows;
            $qrcode = 'https://api.btstu.cn/qrcode/api.php?size=300&text=http://' . $conf['domain'] . '/tz.php?id=' . $res['id'];
            echo '<tr><td><input type="checkbox" name="checkid" class="checkboxes" value="' . $res['id'] . '" /></td><td><a href="' . $res['tcn'] . '" target="_blank">' . $res['tcn'] . '</a></td><td class="hidden-phone">' . $res['remarks'] . '</td><td class="hidden-phone"><div class="hty-photo"><img title="点击查看" width="20px" height="20px" data-preview-src="" src="' . $qrcode . '" /></div></td><td>' . $viewNum . '</td><td class="hidden-phone">' . $res['addtime'] . '</td><td><a title="编辑" href="./urllist.php?my=edit&id=' . $res['id'] . '" class="btn btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;<a class="btn btn-xs btn-primary" title="详细信息" onclick="show(' . $res['id'] . ')"><i class="fa fa-info-circle" aria-hidden="true"></i></a>&nbsp;<a title="删除" href="./urllist.php?my=delete&id=' . $res['id'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除该网址吗？\');"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
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
        <div class="dataTables_info" id="sample_1_info">共有 <b><?php echo $numrows; ?></b> 条网址记录</div>
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