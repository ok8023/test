var zbp = new ZBP({
    bloghost: "https://www.rjfxz.com/",
    ajaxurl: "https://www.rjfxz.com/zb_system/cmd.php?act=ajax&src=",
    cookiepath: "/",
    lang: {
        error: {
            72: "名称不能为空或格式不正确",
            29: "邮箱格式不正确，可能过长或为空",
            46: "评论内容不能为空或过长"
        }
    }
});

var bloghost = zbp.options.bloghost;
var cookiespath = zbp.options.cookiepath;
var ajaxurl = zbp.options.ajaxurl;
var lang_comment_name_error = zbp.options.lang.error[72];
var lang_comment_email_error = zbp.options.lang.error[29];
var lang_comment_content_error = zbp.options.lang.error[46];

$(function () {

    zbp.cookie.set("timezone", (new Date().getTimezoneOffset()/60)*(-1));
    var $cpLogin = $(".cp-login").find("a");
    var $cpVrs = $(".cp-vrs").find("a");
    var $addinfo = zbp.cookie.get("addinfo");
    if (!$addinfo){
        return ;
    }
    $addinfo = JSON.parse($addinfo);

    if ($addinfo.chkadmin){
        $(".cp-hello").html("欢迎 " + $addinfo.useralias + " (" + $addinfo.levelname  + ")");
        if ($cpLogin.length == 1 && $cpLogin.html().indexOf("[") > -1) {
            $cpLogin.html("[后台管理]");
        } else {
            $cpLogin.html("后台管理");
        }
    }

    if($addinfo.chkarticle){
        if ($cpLogin.length == 1 && $cpVrs.html().indexOf("[") > -1) {
            $cpVrs.html("[新建文章]");
        } else {
            $cpVrs.html("新建文章");
        }
        $cpVrs.attr("href", zbp.options.bloghost + "zb_system/cmd.php?act=ArticleEdt");
    }

});

document.writeln("<script src='https://www.rjfxz.com/zb_users/plugin/UEditor/third-party/prism/prism.js' type='text/javascript'></script><link rel='stylesheet' type='text/css' href='https://www.rjfxz.com/zb_users/plugin/UEditor/third-party/prism/prism.css'/>");$(function(){var compatibility={as3:"actionscript","c#":"csharp",delphi:"pascal",html:"markup",xml:"markup",vb:"basic",js:"javascript",plain:"markdown",pl:"perl",ps:"powershell"};var runFunction=function(doms,callback){doms.each(function(index,unwrappedDom){var dom=$(unwrappedDom);var codeDom=$("<code>");if(callback)callback(dom);var languageClass="prism-language-"+function(classObject){if(classObject===null)return"markdown";var className=classObject[1];return compatibility[className]?compatibility[className]:className}(dom.attr("class").match(/prism-language-([0-9a-zA-Z]+)/));codeDom.html(dom.html()).addClass("prism-line-numbers").addClass(languageClass);dom.html("").addClass(languageClass).append(codeDom)})};runFunction($("pre.prism-highlight"));runFunction($('pre[class*="brush:"]'),function(preDom){var original;if((original=preDom.attr("class").match(/brush:([a-zA-Z0-9\#]+);/))!==null){preDom.get(0).className="prism-highlight prism-language-"+original[1]}});Prism.highlightAll()});

var lrDelay = 99999999999, lrCkey = 0, lrCookie = 7, lrGoto = "1", lrGiway = "", lrRmail = 0, lrTools = 1;

var lcp = {
    lang: ['图形验证成功，请继续操作','关闭验证','图形验证失败','前往充值','取消','下载附件','收藏','已收藏','复制成功','网站公告','已读','可在用户中心右上角“头像”→“网站公告”重新查看','请登陆后购买，正在带你登陆...','正在注销...',''],
    loginback: 'https://www.rjfxz.com/MemberCenter/LoginSuccess.html',
    tcaptcha_enable: '1',
    ajaxurl: ajaxurl + 'laycenter&target=',
    csrfToken: 'e35912c5b89d3990076f8c4a907137c9',
    membercenter: 'https://www.rjfxz.com/MemberCenter',
    loginurl: 'https://www.rjfxz.com/MemberCenter/Login.html',
    
    mc: {},
    
    ajax: function(url, data, fun){
        var _this = this;
        var lcpajax = $.ajax(
        {
            async: true,
            cache: false,
            type: data ? 'POST' : 'GET',
            url: typeof url == 'object' ? url[0] : this.ajaxurl + url,
            data: data,
            dataType: 'json',
            success: function(res){
                fun(res);
            },
            error: function (r, t, e){
                _this.ShowError(r, t, e);
            }
        });
    },
    
    loadhtml: function(action,fun){
        var _this = this;
        $.ajax(
        {
            async: true,
            cache: false,
            type: 'GET',
            url: this.ajaxurl + 'page&type=' + action,
            dataType: 'html',
            success: function(res){
                fun(res.replace(/{%randstr%}/g, 'r' + new Date().getTime()));
            },
            error: function (r, t, e){
                _this.ShowError(r, t, e);
            }
        });
    },
    
    ShowError: function(request, textStatus, error){
        var json = $.parseJSON(request.responseText);
        layer.alert(json.msg,{icon:2});
    },
    
    logoff: function(load){
        //zbp.cookie.set('username','');
        //zbp.cookie.set('token','');
        //zbp.cookie.set('logintoken','');
        if (load === true)
        layer.msg(lcp.lang[13], {icon: 16,time:false,shade:0.1});
        $.get(bloghost + 'zb_system/cmd.php?act=logout&csrfToken=' + this.csrfToken);
        setTimeout(function(){window.location.reload();},500)
    },
    
    notice: function(must){
        var md5 = 'd41d8cd98f00b204e9800998ecf8427e';
        var show = '0';
        if (zbp.cookie.get('web_notice') != md5 && show == 1 || must == true)
        layui.use('layer', function(){
            var layer = layui.layer;
            layer.open({
                type: 1
                ,title: lcp.lang[9]
                ,closeBtn: false
                ,area: '300px;'
                ,shade: 0.2
                ,id: 'LAY_layuipro_notice'
                ,btn: [lcp.lang[10]]
                ,btnAlign: 'c'
                ,moveType: 1
                ,content: '<div style="padding: 15px;line-height: 22px;">暂无消息</div>'
                ,end: function(){
                    zbp.cookie.set('web_notice',md5,365);
                    if (must != true){
                        layer.msg(lcp.lang[11]);
                    }
                }
            });
        }); 
    },
    
    serialize: function(form){
        var a = form.serializeArray();
        var $radio = $('input[type=radio],input[type=checkbox]', form);
        var temp = {};
        $.each($radio, function () {
            if (!temp.hasOwnProperty(this.name)) {
                if (form.find("input[name='" + this.name + "']:checked").length == 0) {
                    temp[this.name] = "";
                    a.push({name: this.name, value: "0"});
                }
            }
        });
        return jQuery.param(a);
    },
    
    clickcopy: function(obj){
        obj.select();
        document.execCommand("Copy");
        layer.msg(lcp.lang[8],{icon:1});
    },
    
    tcaptcha: function(success, cancel, fail){
        var status = false;
        if (this.tcaptcha_enable == 0){
            if (success !== undefined){
                return success();
            }
            return true;
        }
        if (!zbp.cookie.get('ticket')){
            new TencentCaptcha('2078255790', function(res) {
                if (res.ret === 0){
                    zbp.cookie.set('ticket', res.ticket);
                    zbp.cookie.set('randstr', res.randstr);
                    if (success === undefined){
                        layer.msg(lcp.lang[0],{icon:6});
                    }else{
                        status = success();
                    }
                }else if(res.ret === 2){
                    if (cancel !== undefined){
                        cancel();
                    }
                }else{
                    if (cancel === undefined){
                        layer.msg(lcp.lang[2],{icon:2});
                    }else{
                        fail();
                    }
                }
            }).show();
        }else{
            status = success();
        }
        return status;
    },
    
    buy: function(id,fun){
        this.ajax('purchase',{
            id: id,
            csrfToken: this.csrfToken
        },fun);
    },
    
    download: function(url){
        if (url.indexOf(bloghost)){
            var index = layer.open({
                title: lcp.lang[5],
                type: 2,
                shade:0,
                content: url,
                area: ['300px', '200px'],
                maxmin: true
            });
            layer.full(index);
        }else{
            var elemIF = document.createElement("iframe");   
            elemIF.src = url;   
            elemIF.style.display = "none";   
            document.body.appendChild(elemIF);
        }
    }
    
};

$(document).ready(function(){
    $(document).on('click','#lcpbuy',function(){
        $('.lcphidebox .shade').show();
        lcp.buy($(this).data('id'),function(res){
        $('.lcphidebox .shade').hide();
            if (res.code == 1){
                layer.msg(res.msg,{icon:1});
                $('.lcphidebox .lcp-body').html(res.data.content);
                $('.lcphidebox .balance span').text(res.data.balance);
            }else if (res.code == 2){
                layer.confirm(res.msg, {
                    btn: [lcp.lang[3],lcp.lang[4]]
                }, function(){
                    window.location.href = lcp.membercenter + '#User/Invest/Price';
                });
            }else if (res.code == 12){
                layer.msg(lcp.lang[12], {icon: 16,time:false,shade:0.1});
                setTimeout(function(){
                    window.location.href = lcp.loginurl;
                },1000)
            }else{
                layer.alert(res.msg,{icon:res.code});
            }
        });
        return false;
    })
    
    $(document).on('click','.download .lcpdownload',function(){
        var _this = $(this);
        if (lcp.lang[14] != '' && !_this.hasClass('purchased')){
            layer.confirm(lcp.lang[14], {
                btn: [_this.text(),lcp.lang[4]]
            }, function(){
                layer.closeAll();
                layer.msg(lcp.lang[5]+'...',{icon: 16,time:false,shade:0.1});
                downloadOrbuy(_this);
            });
        }else{
            downloadOrbuy(_this);
        }
        function downloadOrbuy(_this){
            $('.lcphidebox .shade').show();
            lcp.buy(_this.data('id'),function(res){
                $('.lcphidebox .shade').hide();
                if (res.code == 1 || res.code == 3){
                    layer.msg(res.msg,{icon:1});
                    if (res.code == 1){
                        $('.lcphidebox .balance span').text(res.data.balance);
                    }
                    lcp.download(res.data.filelink);
                    if (res.data.buysuccess == 1){
                        _this.text(lcp.lang[5]).addClass('purchased');
                    }
                }else if (res.code == 2){
                    layer.confirm(res.msg, {
                        btn: [lcp.lang[3],lcp.lang[4]]
                    }, function(){
                        window.location.href = lcp.membercenter + '#User/Invest/Price';
                    });
                }else if (res.code == 12){
                    layer.msg(lcp.lang[12], {icon: 16,time:false,shade:0.1});
                    setTimeout(function(){
                        window.location.href = lcp.loginurl;
                    },1000)
                }else{
                    layer.alert(res.msg,{icon:res.code});
                }
            });
        }
        return false;
    })
    
        
    var pid = $('meta[name=pid]').attr('content');
    
    if (pid != undefined)
    lcp.ajax('collect&check',{
        csrfToken: lcp.csrfToken,
        article: pid
    },function(res){
        if (res.code == 1) {
            var t = lcp.lang[7];
            var tc = 'collected'
        }else if(res.code == 0) {
            var t = lcp.lang[6];
            var tc = ''
        }
        try {
            $('').before("<a href='javascript:;' class='lcFavBtn " + tc + " ' id=''>" + t + "</a>");
        } catch(d) {}
    })
    
    $(document).on('click', '.lcFavBtn',function() {
        var btn = $(this);
        lcp.ajax('collect',{
            csrfToken: lcp.csrfToken,
            article: pid
        },function(res) {
            if (res.code == 1) {
                btn.html(lcp.lang[7]).addClass('collected')
            }else if (res.code == 2) {
                btn.html(lcp.lang[6]).removeClass('collected')
            }else{
                layer.msg(res.msg,{icon:0});
            }
        })
    });
    
    if (zbp.cookie.get('web_notice') != 1){
        lcp.notice();
    }
    
});var guestpay_alipay = 0;var guestpay_weixin = 0;var guestpay_kucatpay = 1;var guestpay_alipayf2f = 1;var guestpay_weixinh5 = 0;