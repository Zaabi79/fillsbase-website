<style>
  .body-borders .top-border,
  .body-borders .right-border,
  .body-borders .bottom-border,
  .body-borders .left-border { background: #fff !important; }
  .comments-form input[type=email],
  .comments-form input[type=password] { border-color: #fff !important; }
</style>

<div class="fullrock config sec-bg3 motpath bg-colorstyle">
  <a href="{$WEB_ROOT}/index.php" class="closebtn">
    <img class="svg closer bg-transparent" src="{$WEB_ROOT}/assets/fonts/svg/close.svg" alt="">
  </a>
  <section class="fullrock-content">
    <div class="container">
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
            <!-- LOGIN -->
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
                        <label><span onclick="var i=document.getElementById('loginPassword');i.type=i.type==='password'?'text':'password';this.querySelector('i').className=i.type==='password'?'fas fa-eye':'fas fa-eye-slash';" style="cursor:pointer;"><i class="fas fa-eye"></i></span></label>
                        <input type="password" name="password" id="loginPassword" placeholder="{$LANG.twofaconfirmpw}" autocomplete="current-password" required>
                      </div>
                      {if $captcha->isEnabled()}
                      <div class="col-md-12 mt-3">
                        {include file="$template/includes/captcha.tpl"}
                      </div>
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
            <!-- REGISTER -->
            <div class="table tabs-item">
              <div class="cd-filter-block mb-0">
                <h4 class="mergecolor">{$LANG.register}</h4>
                <div class="cd-filter-content">
                  <form action="{$WEB_ROOT}/register.php" method="get" class="comments-form">
                    <div class="col-md-12 mt-3">
                      <button type="submit" class="btn btn-default-yellow-fill">
                        {$LANG.register} <i class="fas fa-user-plus"></i>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
