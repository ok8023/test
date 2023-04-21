// �ر�
function turnoff(obj){
  document.getElementById(obj).style.display="none";
}
// ���ֹ���
(function($){
  $.fn.extend({
    Scroll:function(opt,callback){
      if(!opt) var opt={};
      var _this=this.eq(0).find("ul:first");
      var lineH=_this.find("li:first").height(),
      line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10),
      speed=opt.speed?parseInt(opt.speed,10):10000, //���ٶȣ���ֵԽ���ٶ�Խ�������룩
      timer=opt.timer?parseInt(opt.timer,10):5000; //������ʱ������룩
      if(line==0) line=1;
      var upHeight=0-line*lineH;
      scrollUp=function(){
        _this.animate({
          marginTop:upHeight
        },speed,function(){
          for(i=1;i<=line;i++){
            _this.find("li:first").appendTo(_this);
          }
        _this.css({marginTop:0});
        });
      }
      _this.hover(function(){
        clearInterval(timerID);
      },function(){
        timerID=setInterval("scrollUp()",timer);
      }).mouseout();
    }
  })
})(jQuery);
$(document).ready(function(){
  $(".rand_post").Scroll({line:1,speed:1000,timer:5000});//�޸Ĵ����ֵ�������ʱ��
});