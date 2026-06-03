<style>
.register-page-wrap {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 16px;
}
.register-box { width: 100%; max-width: 900px; }
.comments-form input[type=email],
.comments-form input[type=password],
.comments-form input[type=text],
.comments-form input[type=tel] { border-color: rgba(255,255,255,0.2) !important; }
</style>

<div class="register-page-wrap">
  <div class="register-box">
    <div class="sec-main sec-bg1 tabs bg-seccolorstyle noshadow">
      <div class="randomline"><div class="bigline"></div><div class="smallline"></div></div>
      {include file="$template/includes/flashmessage.tpl"}
      <h2 class="mergecolor"><b>{$LANG.register}</b></h2>
      <p class="mb-5 mergecolor">{$LANG.registerintro}</p>

      <form action="{$WEB_ROOT}/register.php" method="post" name="orderfrm" class="comments-form">
        <input type="hidden" name="token" value="{$token}">

        <div class="seccolor mb-2"><small>{$LANG.contactdetails}</small></div>
        <div class="row mb-4">
          <div class="col-md-6 position-relative">
            <label for="firstname"><i class="fas fa-user-tie"></i></label>
            <input type="text" name="firstname" id="firstname" placeholder="{$LANG.firstname}" value="{$clientsdetails.firstname}" required>
          </div>
          <div class="col-md-6 position-relative">
            <label for="lastname"><i class="fas fa-user-tie"></i></label>
            <input type="text" name="lastname" id="lastname" placeholder="{$LANG.lastname}" value="{$clientsdetails.lastname}" required>
          </div>
          <div class="col-md-6 position-relative">
            <label for="email"><i class="fas fa-envelope"></i></label>
            <input type="email" name="email" id="email" placeholder="{$LANG.email}" value="{$clientsdetails.email}" required>
          </div>
          <div class="col-md-6 position-relative">
            <label for="phonenumber"><i class="fas fa-phone"></i></label>
            <input type="tel" name="phonenumber" id="phonenumber" placeholder="{$LANG.phonenumber}" value="{$clientsdetails.phonenumber}" required>
          </div>
        </div>

        <div class="seccolor mb-2"><small>{$LANG.address}</small></div>
        <div class="row mb-4">
          <div class="col-md-6 position-relative">
            <label for="address1"><i class="far fa-building"></i></label>
            <input type="text" name="address1" id="address1" placeholder="{$LANG.address1}" value="{$clientsdetails.address1}" required>
          </div>
          <div class="col-md-6 position-relative">
            <label for="city"><i class="fas fa-map-marker-alt"></i></label>
            <input type="text" name="city" id="city" placeholder="{$LANG.city}" value="{$clientsdetails.city}" required>
          </div>
          <div class="col-md-6 position-relative">
            <div class="cd-select mt-4">
              <select name="country" id="country" class="select-filter form-control">
                {foreach $countries as $country}
                <option value="{$country.code}" {if $clientsdetails.country == $country.code}selected{/if}>{$country.name}</option>
                {/foreach}
              </select>
            </div>
          </div>
        </div>

        <div class="seccolor mb-2"><small>{$LANG.passwordsecurity}</small></div>
        <div class="row mb-5">
          <div class="col-md-6 position-relative">
            <label for="password"><i class="fas fa-lock"></i></label>
            <input type="password" name="password" id="password" placeholder="{$LANG.password}" required>
          </div>
          <div class="col-md-6 position-relative">
            <label for="password2"><i class="fas fa-lock"></i></label>
            <input type="password" name="password2" id="password2" placeholder="{$LANG.confirmpassword}" required>
          </div>
        </div>

        {if $captcha->isEnabled()}
        <div class="mb-4">{include file="$template/includes/captcha.tpl"}</div>
        {/if}

        <button type="submit" class="btn btn-default-yellow-fill disable-on-click spinner-on-click">
          {$LANG.register} <i class="fas fa-user-plus ms-1"></i>
        </button>
        <a href="{$WEB_ROOT}/index.php?rp=/login" class="golink ms-3">{$LANG.clientarealogin}</a>
      </form>
    </div>
  </div>
</div>
