<div class="text-center mb-4">
    <p class="section-subheading mergecolor">{$LANG.pwresetemailneeded}</p>
</div>

<form method="post" action="{routePath('password-reset-validate-email')}" role="form">
    <input type="hidden" name="action" value="reset" />

    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            <input type="email" name="email" class="form-control" id="inputEmail"
                placeholder="{$LANG.enteremail}" autofocus required
                style="border:2px solid #333 !important;border-radius:8px;padding:12px 16px;">
        </div>
    </div>

    {if $captcha && $captcha->isEnabled() && $showCaptchaAfterLimit}
    <div class="text-center mb-3">
        {include file="$template/includes/captcha.tpl"}
    </div>
    {/if}

    <div class="col-md-12 mt-4 text-center">
        <button type="submit" id="resetPasswordButton"
            {if $showCaptchaAfterLimit}data-captcha-required="true"{/if}
            class="btn btn-default-yellow-fill {$captcha->getButtonClass($captchaForm)}">
            <span class="me-2">{$LANG.pwresetsubmit}</span>
            <i class="fas fa-paper-plane"></i>
        </button>
        <a class="golink ms-4" href="{routePath('login')}">
            <i class="fas fa-arrow-left me-1"></i> Retour à la connexion
        </a>
    </div>
</form>
