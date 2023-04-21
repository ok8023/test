                    </div>
                </div>
            </div>
            <br/>
            <div class="layui-bg-gray" style="padding: 10px">
                <div class="layui-row layui-col-space10">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            友情链接
                        </div>
                        <div class="layui-card-body">
                            <a href="https://www.dkewl.com/" target="_blank">刀客源码网</a>
                            <a href="https://www.dkewl.com/" target="_blank">精品源码</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 引用js -->
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>include/front/js/login.js"></script>
        <!-- js -->
        <script type="text/javascript">
            function nav_active(id) {
                var nav = document.getElementById('nav').children;
                
                document.getElementById(id).className = 'layui-nav-item layui-this';
                Object.keys(nav).forEach(function(key){
                    if (nav[key].id != id) {
                        var single_nav = document.getElementById(nav[key].id);
                        
                        if (single_nav != null) {
                            single_nav.className = 'layui-nav-item';
                        }
                    }
                });
            }
            
            function refresh_nav() {
                var hash = window.location.hash,
                    page_path = window.location.pathname;
                    is_tool = page_path.split('/');
                
                if (is_tool.length == 4) {
                    is_tool = true;
                }
                
                if (page_path == '/' || page_path == '/index.php' || is_tool == true) {
                    nav_active('index_button');
                } else {
                    nav_active('doc_button');
                }
            }
            
            refresh_nav();
            
            $(document).pjax('a[target!=_blank]', {
                container: '#container',
                fragment: '#container',
                timeout: 6000
            }).on('pjax:start',
                NProgress.start
            ).on('pjax:success', function() {
                _hmt.push(['_trackPageview', document.location.pathname]);
                refresh_nav();
                layui.use('form', function(){
                    var element = layui.element
                    ,form = layui.form;
                    
                    element.init();
                    form.render();
                });
            }).on('pjax:end',
                NProgress.done
            );
        </script>
    </body>
    
</html>