/*-------------------
*Description:        By www.yiwuku.com
*Website:            https://app.zblogcn.com/?id=1558
*Author:             尔今 erx@qq.com
*update:             2017-11-28(Last:2019-09-09)
-------------------*/

$(function(){
	//控制脚本
	function lrdlShow(){
		$("#lr_mform dl").each(function(){
			var $lrmcd = $(this), $pht = $(window).height();
			if($pht < 640){
				$lrmcd.animate({marginLeft:-$lrmcd.outerWidth()/2},300);
			}else{
				$lrmcd.animate({marginTop:-$lrmcd.outerHeight()/2,marginLeft:-$lrmcd.outerWidth()/2},300);
			}
			if(!$lrmcd.children(".lr_btn_close").length){
				$lrmcd.append('<dd class="lr_btn_close" title="关闭"><i class="icon iconfont icon-lr-close"></i></dd><dd class="lr_tips"><div><i class="icon iconfont icon-lr-xinxi"></i><span>未知错误</span></div></dd>');
			}
		});
	}
	$(window).resize(function() {
		lrdlShow();
	});
	var lrsbar = zbp.cookie.get("lrsbar");
	if(lrsbar == 1){
		$("#lr_mainbar").css({left:"-100%"});
		$(".lr_arrow").show();
	}
	$("#lr_mainbar").delay(lrDelay*1000).animate({bottom:"0"},900).append('<div class="lr_mbg"></div>');
	$("#lr_mainbar .lr_btn_close").click(function() {
		lrmBar("-100%", 1);
		zbp.cookie.set("lrsbar", 1, lrCookie);
	});
	$(".lr_arrow").click(function() {
		lrmBar(0, 0);
		zbp.cookie.set("lrsbar", 0, lrCookie);
	});
	function lrmBar(n, c){
		$("#lr_mainbar").animate({left:n},600);
		if(c == 1){
			$(".lr_arrow").delay(600).fadeIn(200);
		}else{
			$(".lr_arrow").fadeOut(200);
		}
	}
	document.onkeydown = function(e){  
		if(e.keyCode == 13 && $(".lr_login:visible").length){
			lrLogin(".lr_login .lr_post");
		}
		if(e.keyCode == 13 && $(".lr_reg:visible").length){
			lrReg(".lr_reg .lr_post");
		}
		if(e.keyCode == 13 && $(".lr_password_find:visible").length){
			lrPasswordFind(".lr_password_find .lr_post");
		}
		if(e.keyCode == 13 && $(".lr_password_reset:visible").length){
			lrPasswordReset(".lr_password_reset .lr_post");
		}
		if(e.altKey && e.keyCode==76 && lrCkey){
			lrShow(".lr_login");
		}
		if(e.altKey && e.keyCode==82 && lrCkey){
			lrShow(".lr_reg");
		}
		if(e.altKey && e.keyCode==88 && lrCkey){
			lrFormHide();
		}
	}
	function lrTips(t){
		$(".lr_tips").show().addClass("animated bounceIn").find("span").text(t);
		setTimeout(function(){
			$(".lr_tips").removeClass("animated bounceIn").fadeOut();
		}, 3000);
	}
	//弹出表单
	$("body").on("click", ".xylogin", function() {
		lrShow(".lr_login");
	});
	$("a[href*='#xylogin'], #navbar-item-lrlogin a").click(function(){
		lrShow(".lr_login");
		return false;
	});
	$("body").on("click", ".xyreg", function() {
		lrShow(".lr_reg");
	});
	$("a[href*='#xyreg']").click(function(){
		lrShow(".lr_reg");
		return false;
	});
	function lrShow(c){
		lrmBar("-100%", 1);
		$("#lr_mform").fadeIn();
		$(c).siblings().addClass("animated flipOutY").fadeOut();
		$(c).fadeIn().removeClass("flipOutY").addClass("animated flipInY");
		lrInput(c);
		lrdlShow();
	}
	function lrInput(c){
		$(c).find(".lr_int").each(function(){
			var iv = $(this).val(), $tip = $(this).parent().children(".tip"),
				iwt = $(this).outerWidth(), twt = $tip.outerWidth();
			if(iv != ''){
				$tip.addClass("cu").css({left:(iwt-twt)+"px"});
			}
			$(this).focus(function(){
				$tip.addClass("cu").css({left:(iwt-twt)+"px"});
		    }).blur(function(){
				if($(this).val() == ''){
					$tip.removeClass("cu").css({left:"30px"});
				}else{
					$tip.addClass("cu").css({left:(iwt-twt)+"px"});
				}
		    });
	    });
	}
	//关闭
	$("#lr_mform").on("click", ".lr_btn_close", function() {
		lrFormHide();
	});
	function lrFormHide(){
		$("#lr_mform").fadeOut();
		$("#lr_mform dl").addClass("animated flipOutY").fadeOut();
		if(lrsbar != 1){
			lrmBar(0, 0);
		}
	}
	//表单切换
	$(".lr_to_reg").click(function() {
		lrFormChange(".lr_reg");
	});
	$(".lr_to_login").click(function() {
		lrFormChange(".lr_login");
	});
	$(".lr_to_find").click(function() {
		var lrfound = zbp.cookie.get("lrfound");
		if(lrfound != null){
			lrTips("您刚刚操作过了！请稍后再试");
		}else{
			lrFormChange(".lr_password_find");
		}
	});
	function lrFormChange(s){
		$("#lr_mform dl").addClass("animated flipOutY").fadeOut();
		$(s).fadeIn().removeClass("flipOutY").addClass("animated flipInY");
		$("#verfiycode").click();
		lrInput(s);
	}
	//登录
	$(".lr_login .lr_post").click(function() {
		lrLogin(this);
	});
	function lrLogin(self){
		var name = $(".lr_login input[name='UserName']").val(),
		pswd = $(".lr_login input[name='PassWord']").val();
		if(name.length < 2){
			lrTips("请正确填写用户名！");
			$(".lr_login input[name='UserName']").focus();
			return false;
		}
		if(pswd.length < 6){
			lrTips("请正确填写密码！");
			$(".lr_login input[name='PassWord']").focus();
			return false;
		}
		$(self).addClass("act").attr("disabled",true);
		$.post(bloghost+'zb_users/plugin/LoginReg/act.php?act=login',{
			"username":name,
			"password":pswd,
			"savedate":$(".lr_login #Remember:checked").val(),
			},function(data){
				var s =data;
				if((s.search("faultCode")>0)&&(s.search("faultString")>0)){
					lrTips(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
					$(self).removeClass("act").attr("disabled",false);
				}else{
					if(lrGoto == "1" || lrGoto == ""){
						window.location.reload();
					}else if(lrGoto == "2"){
						location.href = bloghost;
					}else{
						location.href = lrGoto;
					}
					if(lrTools){
						lrmBar("-100%", 1);
						zbp.cookie.set("lrsbar", 1, lrCookie);
					}
					$(self).removeClass("act").attr("disabled",false);
				}
			}
		);
	}
	//注册
	$(".lr_reg .lr_post").click(function() {
		lrReg(this);
	});
	function lrReg(self){
		var name = $(".lr_reg input[name='UserName']").val(),
		pswd = $(".lr_reg input[name='PassWord']").val(),
		pswd2 = $(".lr_reg input[name='PassWord2']").val(),
		pname = $(".lr_reg input[name='PersonName']").val(),
		email = $(".lr_reg input[name='Email']").val(),
		qq = $(".lr_reg input[name='qq']").val(),
		icode = $(".lr_reg input[name='Icode']").val(),
		vcode = $(".lr_reg input[name='Vcode']").val();
		if(name.length < 3){
			lrTips("请填写用户名且至少3个字符！");
			$(".lr_reg input[name='UserName']").focus();
			return false;
		}
		if(pswd.length < 6){
			lrTips("请填写密码且至少8位！");
			$(".lr_reg input[name='PassWord']").focus();
			return false;
		}
		if(pswd != pswd2){
			lrTips("两次输入密码不一样！");
			$(".lr_reg input[name='PassWord2']").focus();
			return false;
		}
		if($(".lr_reg input[name='PersonName']").length && pname.length < 1){
			lrTips("昵称不能为空！");
			$(".lr_reg input[name='PersonName']").focus();
			return false;
		}
		if($(".lr_reg input[name='Email']").length && !RegExp(/^\w+@[a-z0-9A-Z]+\.[a-z]+$/).test(email)){
			lrTips("请正确填写邮箱！");
			$(".lr_reg input[name='Email']").focus();
			return false;
		}
		if($(".lr_reg input[name='qq']").length && !RegExp(/^[1-9]\d{4,14}$/).test(qq)){
			lrTips("请正确填写QQ号！");
			$(".lr_reg input[name='qq']").focus();
			return false;
		}
		if($(".lr_reg input[name='Icode']").length && icode.length != 22){
			lrTips("请正确填写22位邀请码！");
			$(".lr_reg input[name='Icode']").focus();
			return false;
		}
		if($(".lr_reg input[name='Vcode']").length && vcode.length != 5){
			lrTips("请正确填写5位验证码！");
			$(".lr_reg input[name='Vcode']").focus();
			return false;
		}
		if($(".lr_reg input[name='agreement']").length && !$(".lr_reg input[name='agreement']").is(':checked')){
			lrTips("请阅读并同意注册协议！");
			$("#agreement").focus();
			return false;
		}
		$(self).addClass("act").attr("disabled",true);
		$.post(bloghost+'zb_users/plugin/LoginReg/act.php?act=reg',{
			"username":name,
			"qq":qq,
			"password":pswd,
			"repassword":pswd2,
			"personname":pname,
			"email":email,
			"invitecode":icode,
			"verifycode":vcode,
			},function(data){
				var s =data;
				if((s.search("faultCode")>0)&&(s.search("faultString")>0)){
					lrTips(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
					$("#verfiycode").click();
					$(self).removeClass("act").attr("disabled",false);
				}else{
					if($(".lr_reg input[name='Email']").length && lrRmail){
						$.post(bloghost+'zb_users/plugin/LoginReg/regmail.php',{
							"email":email,
							"username":name,
							"password":pswd,
							"action":lrRmail,
							},function(data){
								var s =data;
								if((s.search("faultCode")>0)&&(s.search("faultString")>0)){
									lrTips(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
									$(self).removeClass("act").attr("disabled",false);
								}else{
									lrTips(s);
									$(".lr_reg .lr_int").val("");
									$(self).removeClass("act").attr("disabled",false);
									setTimeout(function(){
										lrFormChange(".lr_login");
									}, 2000);
								}
							}
						);
					}else{
						lrTips(s);
						$(".lr_reg .lr_int").val("");
						$(self).removeClass("act").attr("disabled",false);
						setTimeout(function(){
							lrFormChange(".lr_login");
						}, 2000);
					}
				}
			}
		);
	}
	$(".lr_reset").click(function() {
		$(".lr_reg .lr_int").val("").attr("placeholder","");
		$("#lr_mform dd .tip").show();
	});
	//退出
	$(".lr_logout, a[href*='#xylogout'], #navbar-item-lrlogout a").click(function() {
		$.get(bloghost+'zb_users/plugin/LoginReg/act.php?act=logout',{
			},function(data){
				var s =data;
				if(s){
					window.location.reload();
				}
			}
		);
		return false;
	});
	//获取邀请码
	$(".geticode").click(function() {
		if(lrGiway != ""){
			$(this).attr({href:lrGiway,target:"_blank"});
			$("input[name='Icode']").attr("placeholder","请留意新打开窗口");
		}else{
			$("input[name='Icode']").val("正在获取……");
			$.post(bloghost+'zb_users/plugin/LoginReg/act.php?act=icode',{
				"action":1,
				},function(data){
					var s =data;
					if(s){
						$("input[name='Icode']").val(s);
					}
				}
			);
		}
		$(this).next().hide();
	});
	//找回密码
	$(".lr_password_find .lr_post").click(function() {
		lrPasswordFind(this);
	});
	function lrPasswordFind(self){
		var name = $(".lr_password_find input[name='UserName']").val(),
		email = $(".lr_password_find input[name='Email']").val(),
		time = $(".lr_password_find input[name='Ptime']").val();
		if(name.length < 3){
			lrTips("请正确填写用户名！");
			$(".lr_password_find input[name='UserName']").focus();
			return false;
		}
		if(email.indexOf("@") < 1 || email.indexOf(".") < 3){
			lrTips("请正确填写邮箱！");
			$(".lr_password_find input[name='Email']").focus();
			return false;
		}
		$(self).addClass("act").attr("disabled",true);
		$.post(bloghost+'zb_users/plugin/LoginReg/act.php?act=passwordfind',{
			"username":name,
			"email":email,
			"action":1,
			},function(data){
				var s =data;
				if((s.search("faultCode")>0)&&(s.search("faultString")>0)){
					lrTips(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
					$(self).removeClass("act").attr("disabled",false);
				}else{
					$.post(bloghost+'zb_users/plugin/LoginReg/passwordmail.php',{
						"username":name,
						"email":email,
						"action":1,
						},function(data){
							var s =data;
							if((s.search("faultCode")>0)&&(s.search("faultString")>0)){
								lrTips(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
								$(self).removeClass("act").attr("disabled",false);
							}else{
								lrTips(s);
								zbp.cookie.set("lrfound", 1, 0.125);
								$(self).removeClass("act").attr("disabled",false);
								setTimeout(function(){
									window.location.reload();
								}, 2000);
							}
						}
					);
				}
			}
		);
	}
	//重置密码
	if($(".lr_password_reset").length){
		PasswordResetShow();
	}
	function PasswordResetShow(){
		lrShow(".lr_password_reset");
		lrmBar("-100%", 1);
		var nint = $(".lr_password_reset").find("input[name='UserName']");
		if(nint.val() != ""){
			nint.next().addClass("tip2 cu");
		}
	}
	$(".lr_password_reset .lr_post").click(function() {
		lrPasswordReset(this);
	});
	function lrPasswordReset(self){
		var name = $(".lr_password_reset input[name='UserName']").val(),
		pswd = $(".lr_password_reset input[name='PassWord']").val(),
		pswd2 = $(".lr_password_reset input[name='PassWord2']").val(),
		hash = $(".lr_password_reset input[name='hash']").val();
		if(name.length < 3){
			lrTips("链接错误！");
			$(".lr_password_reset input[name='UserName']").focus();
			return false;
		}
		if(pswd.length < 6){
			lrTips("请填写密码且至少8位！");
			$(".lr_password_reset input[name='PassWord']").focus();
			return false;
		}
		if(pswd != pswd2){
			lrTips("两次输入密码不一样！");
			$(".lr_password_reset input[name='PassWord2']").focus();
			return false;
		}
		$(self).addClass("act").attr("disabled",true);
		$.post(bloghost+'zb_users/plugin/LoginReg/act.php?act=passwordreset',{
			"username":name,
			"password":pswd,
			"hash":hash,
			},function(data){
				var s =data;
				if((s.search("faultCode")>0)&&(s.search("faultString")>0)){
					lrTips(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
					$(self).removeClass("act").attr("disabled",false);
				}else{
					lrTips(s);
					$(".lr_password_reset .lr_int").val("");
					$(self).removeClass("act").attr("disabled",false);
					setTimeout(function(){
						location.href = bloghost;
					}, 2000);
				}
			}
		);
	}
});