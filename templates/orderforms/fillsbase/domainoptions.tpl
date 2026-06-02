<style>
.lw-domain-opt-wrap {
    max-width: 600px; margin: 40px auto; text-align: center;
}
.lw-domain-opt-card {
    background: #fff; border-radius: 20px; padding: 50px 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08); border: 1px solid #eef0f3;
}
.lw-domain-opt-icon {
    width: 80px; height: 80px; border-radius: 50%; display: flex;
    align-items: center; justify-content: center; margin: 0 auto 24px;
    font-size: 2rem;
}
.lw-domain-opt-icon.success { background: #eafaf3; color: #27ae60; }
.lw-domain-opt-icon.danger  { background: #fef0f0; color: #e74c3c; }
.lw-domain-opt-title { font-size: 1.5rem; font-weight: 800; color: #1a1a2e; margin-bottom: 8px; }
.lw-domain-opt-sub   { color: #888; font-size: 0.95rem; margin-bottom: 28px; }
.lw-domain-opt-price {
    display: inline-block; background: linear-gradient(135deg,#f8fffb,#eafaf3);
    border: 2px solid #50d29e; border-radius: 50px; padding: 12px 36px;
    font-size: 1.6rem; font-weight: 800; color: #1a1a2e; margin-bottom: 28px;
}
.lw-domain-opt-btn {
    background: #50d29e; color: #fff; border: none; border-radius: 12px;
    padding: 14px 40px; font-size: 1rem; font-weight: 700; cursor: pointer;
    box-shadow: 0 5px 15px rgba(80,210,158,.3); transition: all .2s;
}
.lw-domain-opt-btn:hover { background: #3dbb8a; transform: translateY(-2px); }
.lw-domain-opt-notice { font-size: 0.78rem; color: #aaa; margin-top: 20px; }
.lw-redirect-bar {
    height: 4px; background: #eee; border-radius: 2px; margin-top: 28px; overflow: hidden;
}
.lw-redirect-bar-fill {
    height: 100%; background: linear-gradient(90deg,#50d29e,#00d1b2);
    border-radius: 2px; animation: lwRedirect 1.5s linear forwards;
}
@keyframes lwRedirect { from { width:0; } to { width:100%; } }
</style>

<div class="lw-domain-opt-wrap">

{if $invalid}
<div class="lw-domain-opt-card">
    <div class="lw-domain-opt-icon danger"><i class="fas fa-times-circle"></i></div>
    <div class="lw-domain-opt-title">{if $reason}{$reason}{else}{$LANG.cartdomaininvalid}{/if}</div>
    <a href="cart.php?a=add&domain=register" class="lw-domain-opt-btn mt-3 d-inline-block" style="text-decoration:none;">
        <i class="fas fa-search mr-2"></i>Nouvelle recherche
    </a>
</div>

{elseif $alreadyindb}
<div class="lw-domain-opt-card">
    <div class="lw-domain-opt-icon danger"><i class="fas fa-exclamation-circle"></i></div>
    <div class="lw-domain-opt-title">{$LANG.cartdomainexists}</div>
    <a href="cart.php?a=add&domain=register" class="lw-domain-opt-btn mt-3 d-inline-block" style="text-decoration:none;">
        <i class="fas fa-search mr-2"></i>Nouvelle recherche
    </a>
</div>

{else}

{if $checktype=="register" && $regenabled}
<input type="hidden" name="domainoption" value="register" />

{if $status eq "available" || $status eq "error"}
<input type="hidden" name="domains[]" value="{$searchResults.domainName}" />
<input type="hidden" name="domainsregperiod[{$domain}]" value="{$searchResults.shortestPeriod.period}" />
{assign var='continueok' value=true}
<div class="lw-domain-opt-card">
    <span class="domain-checker-available" style="display:none"></span>
    <div class="lw-domain-opt-icon success"><i class="fas fa-check-circle"></i></div>
    <div class="lw-domain-opt-title">{$searchResults.domainName}</div>
    <div class="lw-domain-opt-sub">{$LANG.orderForm.domainAddedToCart}</div>
    <span class="lw-ajax-price" style="display:none">{$searchResults.shortestPeriod.register}</span>
    <div class="lw-domain-opt-price">{$searchResults.shortestPeriod.register}</div>
    <br>
    <button type="submit" id="lwDomainOptContinue" class="lw-domain-opt-btn">
        <i class="fas fa-arrow-right mr-2"></i>{$LANG.continue}
    </button>
    <div class="lw-redirect-bar"><div class="lw-redirect-bar-fill"></div></div>
    <div class="lw-domain-opt-notice"><i class="fas fa-info-circle mr-1"></i>{$LANG.orderForm.domainAvailabilityCached}</div>
</div>

{elseif $status eq "unavailable"}
<div class="lw-domain-opt-card">
    <span class="domain-checker-unavailable" style="display:none"></span>
    <div class="lw-domain-opt-icon danger"><i class="fas fa-times-circle"></i></div>
    <div class="lw-domain-opt-title">{$LANG.cartdomaintaken|sprintf2:$domain}</div>
    <a href="cart.php?a=add&domain=register" class="lw-domain-opt-btn mt-3 d-inline-block" style="text-decoration:none;">
        <i class="fas fa-search mr-2"></i>Nouvelle recherche
    </a>
</div>
{/if}

{elseif $checktype=="transfer" && $transferenabled}
<input type="hidden" name="domainoption" value="transfer" />
{if $status eq "available"}
<div class="lw-domain-opt-card">
    <div class="lw-domain-opt-icon danger"><i class="fas fa-times-circle"></i></div>
    <div class="lw-domain-opt-title">{$LANG.carttransfernotregistered|sprintf2:$domain}</div>
    <div class="lw-domain-opt-sub">{$LANG.orderForm.tryRegisteringInstead}</div>
</div>
{elseif $status eq "unavailable" || $status eq "error"}
<input type="hidden" name="domains[]" value="{$domain}" />
<input type="hidden" name="domainsregperiod[{$domain}]" value="{$transferterm}" />
{assign var='continueok' value=true}
<div class="lw-domain-opt-card">
    <div class="lw-domain-opt-icon success"><i class="fas fa-exchange-alt"></i></div>
    <div class="lw-domain-opt-title">{$domain}</div>
    <div class="lw-domain-opt-sub">{$LANG.carttransferpossible|sprintf2:$domain:$transferprice}</div>
    <button type="submit" id="lwDomainOptContinue" class="lw-domain-opt-btn">
        <i class="fas fa-arrow-right mr-2"></i>{$LANG.continue}
    </button>
    <div class="lw-redirect-bar"><div class="lw-redirect-bar-fill"></div></div>
</div>
{/if}

{elseif $checktype=="owndomain" || $checktype=="subdomain"}
<input type="hidden" name="domainoption" value="{$checktype}" />
<input type="hidden" name="sld" value="{$sld}" />
<input type="hidden" name="tld" value="{$tld}" />
<script>domainGotoNextStep();</script>
{/if}

{/if}

</div>

{if $continueok}
<script>
(function() {
    var btn = document.getElementById('lwDomainOptContinue');
    if (btn) btn.click();
})();
</script>
{/if}
