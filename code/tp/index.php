<?php 
	include './core/core.php';
 	if($mod){
 		if(file_exists('view/'.$mod.'.php')){
			include 'view/'.$mod.'.php';
		}elseif(file_exists('view/wapbz/'.$mod.'.php')){
			include 'view/'.$mod.'.php';
		}else{
			exit('<script>location="./index.php";</script>');
		}
 	}else{
 		include './view/index.php';
 	}
 ?> 