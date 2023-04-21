<script type="text/javascript"> 
 function jsCopy(){ 
 var e=document.getElementById("content");
e.select(); //选择对象 
 document.execCommand("Copy",false,null); 

alert("已复制好，可贴粘。"); 
 } 
</script> 
<?php
error_reporting(0);
$shouquan=$_GET['ma'];
echo "<html lang=\"en\">\n";
echo "   <head>\n";
echo "       <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
echo "       <title>$message</title>\n";
echo "       <link href=\"macc_t/public.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
echo "       <link href=\"macc_t/index.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
echo "       <link href=\"macc_t/404.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
echo "       <script src=\"macc_t/jquery-1.7.2.min.js\"></script>\n";
echo "       <script type=\"text/javascript\">\n";
echo "           $(function() {\n";
echo "               var h = $(window).height();\n";
echo "               $('body').height(h);\n";
echo "               $('.mianBox').height(h);\n";
echo "               centerWindow(\".tipInfo\");\n";
echo "           });\n";
echo "            //2.将盒子方法放入这个方，方便法统一调用\n";
echo "           function centerWindow(a) {\n";
echo "               center(a);\n";
echo "               //自适应窗口\n";
echo "               $(window).bind('scroll resize',\n";
echo "                       function() {\n";
echo "                           center(a);\n";
echo "                       });\n";
echo "           }\n";
echo "            //1.居中方法，传入需要剧中的标签\n";
echo "           function center(a) {\n";
echo "               var wWidth = $(window).width();\n";
echo "               var wHeight = $(window).height();\n";
echo "               var boxWidth = $(a).width();\n";
echo "               var boxHeight = $(a).height();\n";
echo "               var scrollTop = $(window).scrollTop();\n";
echo "               var scrollLeft = $(window).scrollLeft();\n";
echo "               var top = scrollTop + (wHeight - boxHeight) / 2;\n";
echo "               var left = scrollLeft + (wWidth - boxWidth) / 2;\n";
echo "               $(a).css({\n";
echo "                   \"top\": top,\n";
echo "                   \"left\": left\n";
echo "               });\n";
echo "           }\n";
echo "       </script>\n";
echo "   </head>\n";
echo "   <body>\n";
echo "       <div class=\"mianBox\">\n";
echo "           <img src=\"macc_t/yun0.png\" alt=\"\" class=\"yun yun0\" />\n";
echo "           <img src=\"macc_t/yun1.png\" alt=\"\" class=\"yun yun1\" />\n";
echo "           <img src=\"macc_t/yun2.png\" alt=\"\" class=\"yun yun2\" />\n";
echo "           <img src=\"macc_t/bird.png\" alt=\"\" class=\"bird\" />\n";
echo "           <img src=\"macc_t/san.png\" alt=\"\" class=\"san\" />\n";
echo "           <div class=\"tipInfo\">\n";
echo "               <div class=\"in\">\n";
echo "                   <div class=\"textThis\">\n";
echo "                        <h2>授权码：<input type=\"text\" name=\"content\" id=\"content\" class=\"text\" value=\"$shouquan\" /></h2>\n";
echo "                       <a type=\"button\" class=\"btn\" onclick=\"jsCopy()\" href=\"#\" />点击复制授权码</a>\n";
echo "                       <script type=\"text/javascript\">                            (function() {\n";
echo "                               var wait = document.getElementById('wait'), href = document.getElementById('href').href;\n";
echo "                               var interval = setInterval(function() {\n";
echo "                                   var time = --wait.innerHTML;\n";
echo "                                   if (time <= 0) {\n";
echo "                                       location.href = href;\n";
echo "                                       clearInterval(interval);\n";
echo "                                   }\n";
echo "                                   ;\n";
echo "                               }, 1000);\n";
echo "                           })();\n";
echo "                       </script>\n";
echo "                   </div>\n";
echo "               </div>\n";
echo "           </div>\n";
echo "       </div>\n";
echo "   </body>\n";
echo "</html>\n";
?>

