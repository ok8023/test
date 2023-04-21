<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<?php
//新功能添加的影片推荐 start
if(is_file('./data/aik.seturl.php')){
include('./data/aik.seturl.php');
  if(is_array($seturl)){
  //print_r($seturl['title'][0]);//打印输出
    if(count($seturl['title'])>0){
        for($i=0;$i<count($seturl['title']);$i++){
          $urls=array(
            'name' => $seturl['title'][$i],
            'urls' => array(
              'type' => array($seturl['type'][$i]),
              'url' => array($seturl['newurl'][$i]),            
              'ly' => array('自定义')
            )
          );
          $mbz=str_replace('+','imjh',base64_encode($seturl['newurl'][$i]));
        echo '<li class="item"><a class="js-tongjic" href="mplay.php?id='.$seturl['type'][$i].'&url='.$mbz.'&name='.$seturl['title'][$i].'" target="_blank"><div class="cover g-playicon"><img src="'.$seturl['img'][$i].'"  alt="'.$seturl['title'][$i].'"><span class="hint"></span></div><div class="detail"><p class="title g-clear"><span class="s1">'.$seturl['title'][$i].'</span><span class="s2"></span></p><p class="star"></p></div></a></li> ';
        } 
      echo '</ul></div></div><div class="clearfloat"></div>';
    }
  }
}
//新功能添加的影片推荐 start
?>
