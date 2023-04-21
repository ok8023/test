<script type="text/html" id="tpl-company-custom-made">
    <div class="company_custom_made">
        <div>
            {{if siteLogo}}
             <img src="{{siteLogo}}" class="company_logo">
            {{else }}
                <img src="{{siteAddress}}/public/img/login/logo.png" class="company_logo">
            {{/if}}
        </div>
        <div>
            {{if siteName }}
            <span class="company_name">{{siteName}}</span>
            {{else}}
            <span class="company_name">Duckchat</span>
            {{/if}}
        </div>
        <div class="company_slogan">
            {{if loginWelcomeText }} {{loginWelcomeText}} {{else}}
                这是一个聊天站点<br/>官网：<a target="_blank" href="">http://lt.n99881.cn</a>
            {{/if}}
        </div>
        <div class="site_version">
            {{siteVersionName}}
        </div>
    </div>
</script>

<script type="text/html" id="tpl-string">
    {{string}}
</script>

<script type="text/html" id="tpl_third_login">
    <div style="width: 100%;height: 100%">
        <iframe src="{{landingUrl}}" class="third_login_iframe">
    </div>
</script>
