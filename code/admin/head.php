<div id="header">
  <div class="con">
      <h1 class="logo png"><a href="./">影院管理系统</a></h1>
      <div class="aik_info"><a href="../" target="_blank">网站首页</a>，欢迎您，<?php echo $aik['admin_name']?>，&nbsp;<a href="./login.php?act=logout">退出</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
      <ul class="aik_nav">
		<li><a href="./"<?php echo $nav=='home'?' class="this"':''?>>首页</a></li>
		<li><a href="./setting.php"<?php echo $nav=='setting'?' class="this"':''?>>设置</a></li>
				<li><a href="./seturl.php" <?php echo $nav=='seturl'?' class="this"':''?>>影片发布</a></li>
		<li><a href="https://jq.qq.com/?_wv=1027&k=Siuu3tEX" target="_blank">更新</a></li>
      </ul>
  </div>
</div>
