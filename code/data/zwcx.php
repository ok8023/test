<?php
include ('./../inc/aik.config.php');
$cxurl = $aik['zhanwai'];
$url = $cxurl."?p=1";
$data=json_decode(file_get_contents($url),true);		
		for($i=0; $i<12; $i++){
      $player="./mplay.php?id=".$data['data'][$i]['vod_id'];
	?>	
<li  class='item'><a class='js-tongjic' href='<?php echo $player;?>' title='<?php echo $data['data'][$i]['vod_name'];?>' target='_blank'>
         <div class='cover g-playicon'>
          <img src='<?php echo $data['data'][$i]['vod_pic'];?>' alt='<?php echo $data['data'][$i]['vod_name'];?>' />
          <span class='pay'>最新</span>       <span class='hint'></span>
         </div>
         <div class='detail'>
          <p class='title g-clear'>
        <span class='s1'><?php echo $data['data'][$i]['vod_name'];?></span>
      <span class='s2'></span></p>
           <p class='star'><?php echo $star=$data['data'][$i]['vod_actor']=''?'未知':$data['data'][$i]['vod_actor'];?></p>
          </div>
         </a></li>

<?php } ?> 