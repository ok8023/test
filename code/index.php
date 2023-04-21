<?php require_once './include/front/header.php'; ?>
        
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li class="layui-this">热门</li>
                <?php
                    foreach ($tool_data as $tool_data_key => $tool_data_value) {
                        echo '<li>'.$tool_data_value['name'].'</li>';
                    }
                ?>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <div class="layui-bg-gray" style="padding: 5px">
                        <div class="layui-row layui-col-space10">
                            <?php
                                foreach ($tool_data as $tool_data_key => $tool_data_value) {
                                    foreach ($tool_data_value as $tool_data_value_key => $tool_data_value_value) {
                                        if ($tool_data_value_key != 'name' and $tool_data_value_value['hot']) {
                                            echo '
                                                <div class="layui-col-md3">
                                                    <div class="layui-card">
                                                        <div class="layui-card-header">
                                                            <a href="./tool/'.$tool_data_key.'/'.$tool_data_value_key.'.php">['.$tool_data_value['name'].']'.$tool_data_value_value['name'].'</a>
                                                        </div>
                                                        <div class="layui-card-body">'
                                                            .$tool_data_value_value['keyword'].'<br>
                                                            使用次数:'.$tool_times_data[$tool_data_key][$tool_data_value_key].
                                                        '</div>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                    foreach ($tool_data as $tool_data_key => $tool_data_value) {
                        echo '
                            <div class="layui-tab-item">
                                <div class="layui-bg-gray" style="padding: 5px;">
                                    <div class="layui-row layui-col-space10">
                        ';
                        foreach ($tool_data_value as $tool_data_value_key => $tool_data_value_value) {
                            if ($tool_data_value_key != 'name') {
                                echo '
                                    <div class="layui-col-md3">
                                        <div class="layui-card">
                                            <div class="layui-card-header">
                                                <a href="./tool/'.$tool_data_key.'/'.$tool_data_value_key.'.php">'.$tool_data_value_value['name'].'</a>
                                            </div>
                                            <div class="layui-card-body">'
                                                .$tool_data_value_value['keyword'].'<br>
                                                使用次数:'.$tool_times_data[$tool_data_key][$tool_data_value_key].
                                            '</div>
                                        </div>
                                    </div>
                                ';
                            }
                        }
                        echo '
                                </div>
                            </div>
                        </div>
                        ';
                    }
                ?>
        
<?php require_once './include/front/footer.php'; ?>