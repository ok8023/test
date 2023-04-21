function set_cookie(name, value) {
    cookie = name + '=' + escape(value);
    document.cookie = cookie;
}

function get_cookie(name) {
    var cookie_name = name + '=',
        cookie_array = document.cookie.split(';');
    
    for (var count = 0; count < cookie_array.length; count++) {
        var single = cookie_array[count].trim();
        if (single.indexOf(cookie_name) == 0) {
            return unescape(single.substring(cookie_name.length, single.length));
        }
    }
    return '';
}

function delete_cookie(name) {
    document.cookie = name + '=; expires=' + (new Date(0)).toGMTString();
}

function get_root_path(){
    var curWwwPath = window.document.location.href;
    var pathName = window.document.location.pathname;
    var pos = curWwwPath.indexOf(pathName);
    var localhostPath = curWwwPath.substring(0, pos) + '/';
    return localhostPath;
};

var ROOT_PATH = get_root_path();

var state_label = document.getElementById('state'),
    qq_number_label = document.getElementById('qq_number');

if (!get_cookie('state')) {
    set_cookie('state', '状态:未登录');
}
if (!get_cookie('qq_number')) {
    set_cookie('qq_number', '账号:未登录');
}

state_label.innerHTML = get_cookie('state');
qq_number_label.innerHTML = get_cookie('qq_number');

var get_ing = false;
    qr_sig = '',
    qr_code = '',
    redirect_url = '',
    check_login_qr_code_handle = undefined;

function check_login_qr_code() {
    var check_login_qr_code_count = 0;
    
    delete_cookie('state');
    delete_cookie('qq_number');
    delete_cookie('uin');
    delete_cookie('skey');
    delete_cookie('p_uin');
    delete_cookie('p_skey');
    delete_cookie('pt4_token');
    delete_cookie('g_tk');
    state_label.innerHTML = '状态:未登录';
    qq_number_label.innerHTML = '账号:未登录';
    
    check_login_qr_code_count++;
    if (check_login_qr_code_count > 120) {
        clearInterval(check_login_qr_code_handle);
    }
    axios.get(ROOT_PATH + 'include/back/login.php?type=result&qr_sig=' + qr_sig)
        .then(function(data) {
            data = data['data'];
            if (typeof data == 'object') {
                var uin = data['uin'],
                    qq_number = uin.replace('o', '');
                
                set_cookie('state', '状态:已登录');
                set_cookie('qq_number', '账号:' + qq_number);
                set_cookie('uin', uin);
                set_cookie('skey', data['skey']);
                set_cookie('p_uin', data['p_uin']);
                set_cookie('p_skey', data['p_skey']);
                set_cookie('pt4_token', data['pt4_token']);
                set_cookie('g_tk', data['g_tk']);
                $('#qr_code_state').html('状态:已扫描');
                state_label.innerHTML = '状态:已登录';
                qq_number_label.innerHTML = '账号:' + qq_number;
                layer.alert('登录成功');
                clearInterval(check_login_qr_code_handle);
            } else if (data == '已失效') {
                clearInterval(check_login_qr_code_handle);
                $('#qr_code_state').html('状态:已失效(点击二维码刷新)');
            } else {
                $('#qr_code_state').html('状态:' + data);
            }
        });
}

function get_login_qr_code() {
    if (!get_ing) {
        var load = layer.load(0, {shade: false});
        
        get_ing = true;
        
        axios.get(ROOT_PATH + 'include/back/login.php?type=get')
            .then(function(data) {
                data = data['data'];
                qr_sig = data['qr_sig'];
                qr_code = data['qr_code'];
                redirect_url = data['redirect_url'];
                $('#qr_code').html('<img onclick="get_login_qr_code()" src="' + qr_code +
                    '" width="100%" title="点击刷新">');
                clearInterval(check_login_qr_code_handle);
                check_login_qr_code_handle = setInterval(check_login_qr_code, 1000);
                get_ing = false;
                layer.close(load);
            });
    }
}

function login() {
    get_login_qr_code();
    
    Dialog.init(' \
                    <div id="qr_code"></div> \
                    <div id="qr_code_state"></div> \
                ', {
        title: '<p style="display: block; text-align: center;">QQ扫码登录</p>',
        button: {
            点击转跳至手机QQ: function() {
                window.location.href = redirect_url;
            }
        }
    });
}

function log_out() {
    delete_cookie('state');
    delete_cookie('qq_number');
    delete_cookie('uin');
    delete_cookie('skey');
    delete_cookie('p_uin');
    delete_cookie('p_skey');
    delete_cookie('pt4_token');
    delete_cookie('g_tk');
    state_label.innerHTML = '状态:未登录';
    qq_number_label.innerHTML = '账号:未登录';
    layer.alert('退出成功');
}