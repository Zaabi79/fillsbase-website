<style>
.login-modern-page {
    min-height: 100vh;
    background: #0f1923;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 16px;
}
.login-modern-logo {
    margin-bottom: 40px;
    text-align: center;
}
.login-modern-logo img { width: 160px; height: auto; }
.login-modern-box {
    background: #1a2535;
    border-radius: 16px;
    padding: 48px 48px 40px;
    width: 100%;
    max-width: 560px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.4);
}
.login-modern-box h2 {
    color: #fff;
    font-size: 1.9rem;
    font-weight: 700;
    margin-bottom: 8px;
}
.login-modern-box p.subtitle {
    color: #8a9bb0;
    font-size: 0.95rem;
    margin-bottom: 28px;
}
.login-tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 28px;
}
.login-tab {
    padding: 10px 22px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    border: none;
    text-decoration: none;
    transition: all 0.2s;
}
.login-tab.active {
    background: #ee5586;
    color: #fff;
}
.login-tab.inactive {
    background: #2d3a4a;
    color: #8a9bb0;
}
.login-tab.inactive:hover { background: #364557; color: #fff; }
.login-modern-box .form-group { margin-bottom: 18px; }
.login-modern-box label {
    color: #8a9bb0;
    font-size: 0.85rem;
    margin-bottom: 6px;
    display: block;
}
.login-modern-box .form-control {
    background: #0f1923;
    border: 1px solid #2d3a4a;
    border-radius: 10px;
    color: #fff;
    padding: 13px 16px;
    font-size: 0.95rem;
    width: 100%;
    outline: none;
    transition: border 0.2s;
}
.login-modern-box .form-control:focus { border-color: #ee5586; }
.login-modern-box .form-control::placeholder { color: #4a5a6a; }
.pw-wrapper { position: relative; }
.pw-wrapper .form-control { padding-right: 46px; }
.pw-toggle {
    position: absolute; right: 14px; top: 50%;
    transform: translateY(-50%);
    background: none; border: none; color: #8a9bb0; cursor: pointer; font-size: 16px;
}
.login-actions {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-top: 28px;
    flex-wrap: wrap;
}
.btn-login {
    background: #ee5586;
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 12px 32px;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.2s;
    display: flex; align-items: center; gap: 8px;
}
.btn-login:hover { background: #d4406e; }
.forgot-link { color: #ee5586; font-size: 0.9rem; text-decoration: none; }
.forgot-link:hover { text-decoration: underline; }
.remember-wrap { display: flex; align-items: center; gap: 8px; color: #8a9bb0; font-size: 0.88rem; margin-left: auto; }
.remember-wrap input { accent-color: #ee5586; }
@media(max-width: 560px) {
    .login-modern-box { padding: 32px 22px 28px; }
    .login-modern-box h2 { font-size: 1.5rem; }
}
</style>

<div class="login-modern-page">
    <div class="login-modern-logo">
        <a href="{$WEB_ROOT}/index.php">
            <img src="{$WEB_ROOT}/templates/{$template}/assets/img/fillsbase_logo.png" alt="{$companyname}">
        </a>
    </div>

    <div class="login-modern-box">
        {include file="$template/includes/flashmessage.tpl"}

        <h2>Log in to your customer area</h2>
        <p class="subtitle">Log in to manage your services, domains and invoices.</p>

        <div class="login-tabs">
            <span class="login-tab active">Already A Customer?</span>
            <a href="{$WEB_ROOT}/register.php" class="login-tab inactive">Create An Account</a>
        </div>

        <div class="{if !$linkableProviders}hidden{/if}">
            {include file="$template/includes/linkedaccounts.tpl" linkContext="login" customFeedback=true}
        </div>
        <div class="providerLinkingFeedback"></div>

        <form method="post" action="{routePath('login-validate')}" class="login-form" role="form">
            <div class="form-group">
                <label for="inputEmail">{$LANG.clientareaemail}</label>
                <input type="email" name="username" class="form-control" id="inputEmail" placeholder="you@example.com" autofocus>
            </div>
            <div class="form-group">
                <label for="inputPassword">{$LANG.clientareapassword}</label>
                <div class="pw-wrapper">
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="••••••••" autocomplete="off">
                    <button type="button" class="pw-toggle" onclick="var f=document.getElementById('inputPassword');f.type=f.type==='password'?'text':'password';this.innerHTML=f.type==='password'?'<i class=\'fas fa-eye\'></i>':'<i class=\'fas fa-eye-slash\'></i>'">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            {if $captcha->isEnabled()}
            <div class="mt-3">{include file="$template/includes/captcha.tpl"}</div>
            {/if}

            <div class="login-actions">
                <button type="submit" id="login" class="btn-login {$captcha->getButtonClass($captchaForm)}">
                    {$LANG.loginbutton} <i class="fas fa-lock"></i>
                </button>
                <a class="forgot-link" href="{routePath('password-reset-begin')}">{$LANG.forgotpw}</a>
                <label class="remember-wrap">
                    <input type="checkbox" name="rememberme" id="rememberme">
                    {$LANG.loginrememberme}
                </label>
            </div>
        </form>
    </div>
</div>
