<style>
.login-page-wrap {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 16px;
}
.login-box {
    width: 100%;
    max-width: 780px;
}
.login-box .randomline { margin-bottom: 20px; }
.login-box h2 { font-size: 1.8rem; font-weight: 700; }
.login-box .tabs-header ul { list-style: none; padding: 0; margin: 0 0 30px 0; display: flex; gap: 10px; }
.login-box .tabs-header ul li { cursor: pointer; }
.comments-form input[type=email],
.comments-form input[type=password],
.comments-form input[type=text],
.comments-form input[type=tel] { border-color: rgba(255,255,255,0.2) !important; }
</style>

<div class="login-page-wrap">
  <div class="login-box">
    <div class="sec-main sec-bg1 tabs bg-seccolorstyle noshadow">
      <div class="randomline">
        <div class="bigline"></div>
        <div class="smallline"></div>
      </div>
      {include file="$template/includes/flashmessage.tpl"}
      <h2 class="mergecolor"><b>{$LANG.clientareahomeloginbtn}</b></h2>
      <p class="mb-5 mergecolor">{$LANG.restrictedpage}</p>
      <div class="tabs-header btn-select-customer">
        <ul class="btn-group d-block">
          <li class="btn btn-secondary active mb-2">{$LANG.clientarealogin}</li>
          <li class="btn btn-secondary">{$LANG.register}</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <!-- LOGIN TAB -->
          <div class="table tabs-item active">
            <div class="cd-filter-block mb-0">
              <h4 class="m-0 mergecolor">{$LANG.clientarealogin}</h4>
              <div class="cd-filter-content">
                <div class="{if !$linkableProviders}hidden{/if}">
                  {include file="$template/includes/linkedaccounts.tpl" linkContext="login" customFeedback=true}
                </div>
                <div class="providerLinkingFeedback mx-3"></div>
                <form method="post" action="{routePath('login-validate')}" class="comments-form login-form" role="form">
                  <div class="row">
                    <div class="col-md-6 position-relative">
                      <label><i class="fas fa-envelope"></i></label>
                      <input type="email" name="username" placeholder="{$LANG.pwresetemailrequired}" required autofocus>
                    </div>
                    <div class="col-md-6 position-relative">
                      <label>
                        <span onclick="var i=document.getElementById('loginPw');i.type=i.type==='password'?'text':'password';this.querySelector('i').className=i.type==='password'?'fas fa-eye':'fas fa-eye-slash';" style="cursor:pointer;">
                          <i class="fas fa-eye"></i>
                        </span>
                      </label>
                      <input type="password" name="password" id="loginPw" placeholder="{$LANG.twofaconfirmpw}" autocomplete="current-password" required>
                    </div>
                    {if $captcha->isEnabled()}
                    <div class="col-md-12 mt-3">{include file="$template/includes/captcha.tpl"}</div>
                    {/if}
                    <div class="col-md-12 mt-5 position-relative">
                      <button type="submit" id="login" value="login" class="btn btn-default-yellow-fill mt-0 mb-3 me-3 {$captcha->getButtonClass($captchaForm)}">
                        {$LANG.loginbutton} <i class="fas fa-lock"></i>
                      </button>
                      <a href="{routePath('password-reset-begin')}" class="golink me-3 position-relative">{$LANG.forgotpw}</a>
                      <ul class="list d-inline">
                        <li>
                          <input name="rememberme" type="checkbox" id="rememberme" class="filter">
                          <label for="rememberme" class="checkbox-label c-grey seccolor">{$LANG.loginrememberme}</label>
                        </li>
                      </ul>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- REGISTER TAB -->
          <div class="table tabs-item">
            <div class="cd-filter-block mb-0">
              <h4 class="mergecolor">{$LANG.register}</h4>
              <div class="cd-filter-content">
                <p class="seccolor mb-4">{$LANG.registerintro}</p>
                <a href="{$WEB_ROOT}/register.php" class="btn btn-default-yellow-fill">
                  {$LANG.register} <i class="fas fa-user-plus ms-1"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
