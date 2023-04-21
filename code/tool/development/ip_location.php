<?php require_once '../../include/front/header.php'; ?>
    
        <div class="layui-card">
            <div class="layui-card-header">控制台</div>
            <div class="layui-card-body">
            
                <form class="layui-form layui-form-pane">
                    
                    <div class="layui-form-item">
                        <label class="layui-form-label">IP</label>
                        <div class="layui-input-block">
                            <input type="text" name="ip" autocomplete="off" placeholder="请输入IP" class="layui-input" lay-verify="required"/>
                        </div>
                    </div>
                    
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button type="submit" id="submit_button" class="layui-btn" lay-submit="" lay-filter="submit_button">查询</button>
                        </div>
                    </div>
                    
                </form>
                
            </div>
        </div>
        
        <div id="result" style="display: none;" class="layui-card">
            <div class="layui-card-header">结果</div>
            <div class="layui-card-body">
                
                <table id="result_table" class="layui-table" lay-skin="row" lay-even="">
                    <colgroup>
                        <col width="30%"/>
                        <col width="70%"/>
                        <col/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th>键</th>
                            <th>值</th>
                        </tr>
                    </thead>
                </table>
                
            </div>
        </div>
        
        <script type="text/javascript">
            function get_request_parameter(name) {
                var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i'),
                    r = window.location.search.substr(1).match(reg);
                
                if (r != null) {
                    return unescape(r[2]);
                }
                return null;
            }
            
            ip = get_request_parameter('ip');
            
            if (ip) {
                query(ip);
            }
            
            layui.use(['form'], function(){
                var form = layui.form;
                
                form.on('submit(submit_button)', function(data){
                    data = data.field;
                    
                    var ip = data.ip;
                    
                    submit_d(ip);
                    
                    return false;
                });
            });
            
            function submit_d(ip='') {
                var load = layer.load(0, {shade: false}),
                    submit_button = document.getElementById('submit_button'),
                    result = document.getElementById('result'),
                    result_table = document.getElementById('result_table');
                
                if (!ip) {
                    var ip = $('#ip').val();
                }
                
                submit_button.disabled = true;
                $('tr:gt(0)').remove();
                result.style.display = 'none';
                
                if(!ip){
                    layer.close(load);
                    layer.msg('请输入IP');
                    submit_button.disabled = false;
                } else {
                    axios.get('https://api.heroa.cn:3403/development/ip_location/?ip=' + ip)
                        .then(function(data){
                            data = data.data.information;
                            if (typeof data == 'object') {
                                location_d = data.location;
                                region = data.region;
                                result_table.innerHTML += ' \
                                    <tr><td>经度</td><td>' + location_d.longitude + '</td></tr> \
                                    <tr><td>纬度</td><td>' + location_d.latitude + '</td></tr> \
                                    <tr><td>国家</td><td>' + region.nation + '</td></tr> \
                                    <tr><td>省份</td><td>' + region.province + '</td></tr> \
                                    <tr><td>城市</td><td>' + region.city + '</td></tr> \
                                    <tr><td>县区</td><td>' + region.district + '</td></tr> \
                                ';
                                layer.close(load);
                                result.style.display = "block";
                                submit_button.disabled = false;
                            } else {
                                layer.close(load);
                                layer.alert('IP错误');
                                submit_button.disabled = false;
                            }
                    });
                }
            }
        </script>
        
<?php require_once '../../include/front/footer.php'; ?>