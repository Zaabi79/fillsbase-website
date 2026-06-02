{include file="orderforms/fillsbase/common.tpl"}

<style>
:root {
  --primary-color: #00d1b2;
  --primary-dark: #00b89c;
}
.dt-hero {
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
  padding: 70px 20px 80px;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.dt-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: url("{$WEB_ROOT}/templates/fillsbase/assets/img/sliders/domains.jpg") center/cover no-repeat;
  opacity: 0.08;
}
.dt-hero-content { position: relative; z-index: 1; }
.dt-hero h1 {
  font-size: 2.6rem;
  font-weight: 800;
  color: #fff;
  margin-bottom: 14px;
  letter-spacing: -0.5px;
}
.dt-hero p {
  font-size: 1.1rem;
  color: rgba(255,255,255,0.75);
  max-width: 580px;
  margin: 0 auto 10px;
}
.dt-badge-note {
  display: inline-block;
  background: rgba(255,255,255,0.1);
  color: rgba(255,255,255,0.65);
  font-size: 0.8rem;
  padding: 4px 14px;
  border-radius: 20px;
  margin-top: 8px;
}

.dt-card-wrap {
  max-width: 620px;
  margin: -50px auto 60px;
  padding: 0 16px;
  position: relative;
  z-index: 2;
}
.dt-card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 20px 60px rgba(0,0,0,0.15);
  overflow: hidden;
}
.dt-card-header {
  background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
  padding: 18px 30px;
  display: flex;
  align-items: center;
  gap: 12px;
}
.dt-card-header i { font-size: 1.4rem; color: #fff; }
.dt-card-header span { font-size: 1rem; font-weight: 600; color: #fff; }
.dt-card-body { padding: 32px 30px 28px; }

.dt-input-wrap { position: relative; margin-bottom: 16px; }
.dt-input-wrap .dt-icon {
  position: absolute;
  left: 16px;
  top: 50%;
  transform: translateY(-50%);
  color: #aaa;
  font-size: 1rem;
}
.dt-input-wrap input {
  width: 100%;
  height: 52px;
  padding: 0 16px 0 44px;
  border: 1.5px solid #e0e0e0;
  border-radius: 10px;
  font-size: 0.97rem;
  color: #333;
  transition: border-color 0.2s, box-shadow 0.2s;
  background: #f9f9f9;
}
.dt-input-wrap input:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(0,201,167,0.12);
  background: #fff;
}
.dt-input-wrap input::placeholder { color: #bbb; }

.dt-help-note {
  font-size: 0.82rem;
  color: #999;
  margin-bottom: 20px;
  display: flex;
  align-items: flex-start;
  gap: 6px;
}
.dt-help-note i { color: var(--primary-color); margin-top: 2px; flex-shrink: 0; }

.dt-submit-btn {
  width: 100%;
  height: 52px;
  background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
  border: none;
  border-radius: 10px;
  color: #fff;
  font-size: 1rem;
  font-weight: 700;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  transition: opacity 0.2s, transform 0.15s;
  letter-spacing: 0.3px;
}
.dt-submit-btn:hover { opacity: 0.9; transform: translateY(-1px); }
.dt-submit-btn .loader.hidden { display: none; }

#transferUnavailable { margin-top: 14px; border-radius: 8px; }
#transferUnavailable.hidden { display: none; }

.dt-features {
  max-width: 620px;
  margin: 0 auto 60px;
  padding: 0 16px;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}
.dt-feature-item {
  background: #f8f9fb;
  border-radius: 12px;
  padding: 22px 16px;
  text-align: center;
}
.dt-feature-item i {
  font-size: 1.6rem;
  color: var(--primary-color);
  margin-bottom: 10px;
  display: block;
}
.dt-feature-item h6 {
  font-size: 0.88rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 5px;
}
.dt-feature-item p { font-size: 0.78rem; color: #888; margin: 0; }

@media (max-width: 600px) {
  .dt-hero h1 { font-size: 1.8rem; }
  .dt-features { grid-template-columns: 1fr; }
  .dt-card-body { padding: 24px 20px; }
}
</style>

<div id="order-standard_cart">

  <!-- Hero -->
  <div class="dt-hero">
    <div class="dt-hero-content">
      <h1><i class="fas fa-exchange-alt me-2" style="color:var(--primary-color)"></i> {$LANG.orderForm.transferToUs}</h1>
      <p>{lang key='orderForm.transferExtend'}*</p>
      <span class="dt-badge-note"><i class="fas fa-info-circle me-1"></i> * {lang key='orderForm.extendExclusions'}</span>
    </div>
  </div>

  <!-- Transfer Form Card -->
  <div class="dt-card-wrap">
    <div class="dt-card">
      <div class="dt-card-header">
        <i class="fas fa-lock"></i>
        <span>Transférez votre domaine en toute sécurité</span>
      </div>
      <div class="dt-card-body">
        <form method="post" action="{$WEB_ROOT}/cart.php" id="frmDomainTransfer">
          <input type="hidden" name="a" value="addDomainTransfer">

          <div class="dt-input-wrap">
            <i class="fas fa-globe dt-icon"></i>
            <input type="text" name="domain" id="inputTransferDomain" value="{$lookupTerm}"
              placeholder="{lang key='domainname'} (ex: mondomaine.com)"
              data-toggle="tooltip" data-placement="left" data-trigger="manual"
              title="{lang key='orderForm.enterDomain'}" />
          </div>

          <div class="dt-input-wrap">
            <i class="fas fa-key dt-icon"></i>
            <input type="text" name="epp" id="inputAuthCode"
              placeholder="{lang key='orderForm.authCodePlaceholder'}"
              data-toggle="tooltip" data-placement="left" data-trigger="manual"
              title="{lang key='orderForm.authCode'} {lang key='orderForm.required'}" />
          </div>

          <div class="dt-help-note">
            <i class="fas fa-question-circle"></i>
            <span>{lang key='orderForm.authCodeTooltip'}</span>
          </div>

          <div id="transferUnavailable" class="alert alert-warning text-center hidden"></div>

          {if $captcha->isEnabled() && !$captcha->recaptcha->isEnabled()}
          <div class="captcha-container mb-3" id="captchaContainer">
            <div class="default-captcha">
              <p class="text-muted small">{lang key="cartSimpleCaptcha"}</p>
              <div class="d-flex align-items-center gap-2">
                <img id="inputCaptchaImage" src="{$systemurl}includes/verifyimage.php" style="border-radius:6px" />
                <input id="inputCaptcha" type="text" name="code" maxlength="6" class="form-control" style="max-width:120px"
                  data-toggle="tooltip" data-placement="right" data-trigger="manual"
                  title="{lang key='orderForm.required'}" />
              </div>
            </div>
          </div>
          {elseif $captcha->isEnabled() && $captcha->recaptcha->isEnabled() && !$captcha->recaptcha->isInvisible()}
          <div class="form-group recaptcha-container mb-3" id="captchaContainer"></div>
          {/if}

          <button type="submit" id="btnTransferDomain" class="dt-submit-btn{$captcha->getButtonClass($captchaForm)}">
            <span class="loader hidden" id="addTransferLoader"><i class="fas fa-fw fa-spinner fa-spin"></i></span>
            <span id="addToCart">{lang key="orderForm.addToCart"}</span>
            <i class="fas fa-arrow-right"></i>
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Feature Highlights -->
  <div class="dt-features">
    <div class="dt-feature-item">
      <i class="fas fa-shield-alt"></i>
      <h6>Transfert Sécurisé</h6>
      <p>Protocole sécurisé avec code d'autorisation EPP</p>
    </div>
    <div class="dt-feature-item">
      <i class="fas fa-calendar-plus"></i>
      <h6>+1 An Offert</h6>
      <p>Prolongez votre domaine d'un an lors du transfert</p>
    </div>
    <div class="dt-feature-item">
      <i class="fas fa-headset"></i>
      <h6>Support 24/7</h6>
      <p>Notre équipe vous accompagne tout au long du processus</p>
    </div>
  </div>

</div>
