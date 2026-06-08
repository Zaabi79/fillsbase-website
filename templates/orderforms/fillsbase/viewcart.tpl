{if $checkout}
{include file="orderforms/$carttpl/checkout.tpl"}
{else}
<script>var statesTab=10;var stateNotRequired=true;</script>
{include file="orderforms/fillsbase/common.tpl"}
<script type="text/javascript" src="{$BASE_PATH_JS}/StatesDropdown.js"></script>

<style>
:root { --primary: #00d1b2; --primary-dark: #00b89c; --dark: #1a1a2e; --light: #f8f9fb; --border: #e8ecf0; }

/* Break out of WHMCS .container wrapper */
.wrapper.sec-normal { padding: 0 !important; background: #f4f6f9 !important; }
.wrapper.sec-normal > .container { max-width: 100% !important; padding: 0 !important; }
.wrapper.sec-normal > .container > .row { margin: 0 !important; }
.wrapper.sec-normal > .container > .row > .col-md-12 { padding: 0 !important; }

.vc-wrap { max-width: 1200px; margin: 0 auto; padding: 32px 24px 60px; background: #f4f6f9; min-height: 80vh; }

/* Steps */
.vc-steps { display: flex; align-items: center; justify-content: center; gap: 0; margin-bottom: 36px; background: #fff; border-radius: 14px; border: 1px solid var(--border); padding: 18px 28px; box-shadow: 0 2px 10px rgba(0,0,0,.04); flex-wrap: wrap; row-gap: 10px; }
.vc-step { display: flex; align-items: center; gap: 10px; font-size: 13px; font-weight: 700; color: #bbb; }
.vc-step.active { color: var(--primary); }
.vc-step-num { width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800; background: #eee; color: #bbb; flex-shrink: 0; }
.vc-step.active .vc-step-num { background: var(--primary); color: #fff; }
.vc-step-sep { width: 40px; height: 2px; background: #eee; margin: 0 8px; }
.vc-step-sep.done { background: var(--primary); }

/* Grid */
.vc-grid { display: grid; grid-template-columns: 1fr 360px; gap: 28px; align-items: start; }

/* Section label */
.vc-label { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; color: #9aa3b0; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
.vc-label i { color: var(--primary); }

/* Cards */
.vc-card { background: #fff; border-radius: 16px; border: 1px solid var(--border); box-shadow: 0 2px 12px rgba(0,0,0,.04); overflow: hidden; margin-bottom: 20px; }
.vc-card-head { padding: 16px 22px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 10px; background: #fafbfc; }
.vc-card-head h6 { margin: 0; font-size: 14px; font-weight: 800; color: var(--dark); }
.vc-card-body { padding: 20px 22px; }

/* Add-more tabs */
.vc-tabs { display: flex; border-bottom: 1px solid var(--border); background: #fafbfc; }
.vc-tab { flex: 1; padding: 14px 10px; text-align: center; font-size: 12px; font-weight: 700; cursor: pointer; color: #9aa3b0; border-bottom: 3px solid transparent; margin-bottom: -1px; transition: all .2s; }
.vc-tab.active { color: var(--dark); border-bottom-color: var(--primary); background: #fff; }
.vc-tab i { display: block; font-size: 1.1rem; margin-bottom: 5px; color: #ccc; }
.vc-tab.active i { color: var(--primary); }
.vc-pane { padding: 20px 22px; display: none; }
.vc-pane.active { display: block; }

/* Domain search in cart */
.vc-dom-search { display: flex; border: 2px solid var(--border); border-radius: 12px; overflow: hidden; }
.vc-dom-search input { flex: 1; border: none; outline: none; padding: 12px 18px; font-size: 15px; color: var(--dark); background: #fff; }
.vc-dom-search button { background: var(--primary); color: #fff; border: none; padding: 0 22px; font-size: 13px; font-weight: 800; cursor: pointer; white-space: nowrap; transition: opacity .2s; }
.vc-dom-search button:hover { opacity: .88; }
.vc-tld-pills { display: flex; flex-wrap: wrap; gap: 7px; margin-top: 12px; }
.vc-tld-pill { background: var(--light); border: 1px solid var(--border); border-radius: 20px; padding: 4px 13px; font-size: 12px; font-weight: 700; color: #666; cursor: pointer; transition: all .2s; }
.vc-tld-pill:hover { border-color: var(--primary); color: var(--primary); background: #f0fffe; }

/* Cart item */
.vc-item { display: flex; align-items: center; gap: 16px; padding: 18px 22px; border-bottom: 1px solid var(--border); }
.vc-item:last-child { border-bottom: none; }
.vc-item-icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
.vc-item-icon.domain { background: #e8faf7; color: var(--primary); }
.vc-item-icon.hosting { background: #eef1ff; color: #5c6bc0; }
.vc-item-icon.addon { background: #fff8e1; color: #f9a825; }
.vc-item-icon.renewal { background: #fce4ec; color: #e91e63; }
.vc-item-icon.upgrade { background: #f3e5f5; color: #9c27b0; }
.vc-item-info { flex: 1; min-width: 0; }
.vc-item-tag { font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--primary); margin-bottom: 3px; }
.vc-item-name { font-size: 15px; font-weight: 800; color: var(--dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.vc-item-meta { font-size: 12px; color: #9aa3b0; margin-top: 3px; }
.vc-item-right { text-align: right; flex-shrink: 0; }
.vc-item-price { font-size: 18px; font-weight: 900; color: var(--dark); }
.vc-item-actions { display: flex; align-items: center; justify-content: flex-end; gap: 6px; margin-top: 8px; }
.vc-btn-period { background: var(--light); border: 1.5px solid var(--border); border-radius: 8px; padding: 5px 12px; font-size: 12px; font-weight: 700; color: var(--dark); cursor: pointer; display: flex; align-items: center; gap: 5px; }
.vc-btn-delete { background: none; border: 1.5px solid #f0d0d0; color: #ddd; border-radius: 8px; padding: 5px 10px; font-size: 12px; cursor: pointer; transition: all .2s; }
.vc-btn-delete:hover { border-color: #e74c3c; color: #e74c3c; }
.vc-btn-edit { background: none; border: 1.5px solid var(--border); color: #999; border-radius: 8px; padding: 5px 11px; font-size: 12px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: all .2s; }
.vc-btn-edit:hover { border-color: var(--primary); color: var(--primary); text-decoration: none; }
.vc-item-addon { background: #fafbfc; border-top: 1px solid var(--border); padding: 10px 22px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; }

/* Empty cart */
.vc-empty { text-align: center; padding: 52px 20px; }
.vc-empty i { font-size: 3rem; color: #dde2e8; display: block; margin-bottom: 16px; }
.vc-empty h5 { font-size: 1.05rem; font-weight: 800; color: var(--dark); margin-bottom: 6px; }
.vc-empty p { font-size: .88rem; color: #9aa3b0; margin: 0; }

/* Promo */
.vc-promo-active { background: #eafaf7; border: 1.5px solid #b2ede7; border-radius: 10px; padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; font-weight: 700; color: var(--primary-dark); }
.vc-promo-form { display: flex; gap: 8px; }
.vc-promo-form input { flex: 1; border: 1.5px solid var(--border); border-radius: 10px; padding: 10px 15px; font-size: 14px; outline: none; transition: border-color .2s; }
.vc-promo-form input:focus { border-color: var(--primary); }
.vc-promo-form button { background: var(--dark); color: #fff; border: none; border-radius: 10px; padding: 10px 20px; font-size: 13px; font-weight: 700; cursor: pointer; white-space: nowrap; }

/* Summary card */
.vc-summary { background: #fff; border-radius: 16px; border: 1px solid var(--border); box-shadow: 0 4px 24px rgba(0,0,0,.07); overflow: hidden; position: sticky; top: 20px; }
.vc-summary-head { background: var(--dark); padding: 20px 24px; display: flex; align-items: center; justify-content: space-between; }
.vc-summary-head h5 { margin: 0; color: #fff; font-size: 15px; font-weight: 800; display: flex; align-items: center; gap: 8px; }
.vc-summary-body { padding: 22px 24px; }
.vc-sum-row { display: flex; justify-content: space-between; align-items: center; padding: 9px 0; border-bottom: 1px solid #f5f5f5; font-size: 14px; }
.vc-sum-row:last-child { border-bottom: none; }
.vc-sum-label { color: #9aa3b0; display: flex; align-items: center; gap: 6px; }
.vc-sum-value { font-weight: 700; color: var(--dark); }
.vc-total-box { background: linear-gradient(135deg, #f0fffe, #e5f9f7); border-radius: 14px; padding: 20px; margin: 16px 0; display: flex; justify-content: space-between; align-items: center; }
.vc-total-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: #999; margin-bottom: 4px; }
.vc-total-amount { font-size: 30px; font-weight: 900; color: var(--primary); line-height: 1; }
.vc-checkout-btn { display: block; width: 100%; background: var(--primary); color: #fff; border: none; border-radius: 12px; padding: 16px; font-size: 16px; font-weight: 800; text-align: center; text-decoration: none; cursor: pointer; box-shadow: 0 6px 20px rgba(0,209,178,.3); margin-bottom: 10px; transition: opacity .2s; }
.vc-checkout-btn:hover { opacity: .9; color: #fff; text-decoration: none; }
.vc-checkout-btn.disabled { background: #ccc; box-shadow: none; pointer-events: none; cursor: not-allowed; }
.vc-continue { display: block; text-align: center; color: #9aa3b0; font-size: 13px; text-decoration: none; }
.vc-continue:hover { color: var(--primary); text-decoration: none; }
.vc-trust { display: flex; flex-wrap: wrap; justify-content: center; gap: 12px; padding-top: 16px; margin-top: 14px; border-top: 1px solid #f0f2f5; }
.vc-trust-item { display: flex; align-items: center; gap: 5px; font-size: 11px; color: #c0c8d0; font-weight: 600; }

/* Quick link grid */
.vc-link-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 8px; }
.vc-link { display: flex; align-items: center; gap: 10px; padding: 12px 14px; background: #fff; border: 1px solid var(--border); border-radius: 12px; text-decoration: none; color: var(--dark); font-size: 13px; font-weight: 600; transition: all .2s; }
.vc-link:hover { border-color: var(--primary); color: var(--primary); text-decoration: none; }
.vc-link i { color: var(--primary); font-size: .95rem; }

@media(max-width: 900px) {
  .vc-grid { grid-template-columns: 1fr; }
  .vc-summary { position: static; }
  .vc-steps { padding: 14px 16px; }
}
@media(max-width: 500px) {
  .vc-item { flex-wrap: wrap; }
  .vc-item-right { width: 100%; display: flex; justify-content: space-between; align-items: center; }
  .vc-step-sep { width: 20px; }
}
</style>

<div id="order-standard_cart">
<div class="vc-wrap">

  {* Alerts *}
  {if $promoerrormessage}<div class="alert alert-warning rounded-lg mb-3" style="border-radius:12px!important;">{$promoerrormessage}</div>{/if}
  {if $errormessage}<div class="alert alert-danger rounded-lg mb-3" style="border-radius:12px!important;">{$errormessage}</div>{/if}
  {if $promoaddedsuccess}<div class="alert alert-success rounded-lg mb-3" style="border-radius:12px!important;">{$LANG.orderForm.promotionAccepted}</div>{/if}
  {if $bundlewarnings}<div class="alert alert-warning rounded-lg mb-3" style="border-radius:12px!important;"><ul class="mb-0">{foreach from=$bundlewarnings item=w}<li>{$w}</li>{/foreach}</ul></div>{/if}

  {* Steps *}
  <div class="vc-steps">
    <div class="vc-step active">
      <div class="vc-step-num"><i class="fas fa-check"></i></div> Panier
    </div>
    <div class="vc-step-sep done"></div>
    <div class="vc-step">
      <div class="vc-step-num">2</div> Compte
    </div>
    <div class="vc-step-sep"></div>
    <div class="vc-step">
      <div class="vc-step-num">3</div> Paiement
    </div>
    <div class="vc-step-sep"></div>
    <div class="vc-step">
      <div class="vc-step-num">4</div> Confirmation
    </div>
  </div>

  <div class="vc-grid">

    {* ── LEFT ── *}
    <div>

      {* Add more *}
      <div class="vc-label"><i class="fas fa-plus-circle"></i> Add Products</div>
      <div class="vc-card" style="margin-bottom:24px;">
        <div class="vc-tabs" id="vcTabNav">
          <div class="vc-tab active" onclick="vcTab(0)" id="vcT0">
            <i class="fas fa-globe"></i>Domaines
          </div>
          <div class="vc-tab" onclick="vcTab(1)" id="vcT1">
            <i class="fas fa-server"></i>Hébergement
          </div>
          <div class="vc-tab" onclick="vcTab(2)" id="vcT2">
            <i class="fas fa-th-large"></i>Services
          </div>
        </div>

        {* Domains pane *}
        <div class="vc-pane active" id="vcP0">
          <div class="vc-dom-search">
            <input type="text" id="vcDomQ" placeholder="Recherchez votre nom de domaine..." autocomplete="off"
              onkeydown="if(event.key==='Enter'){literal}{{/literal}vcDomSearch(){literal}}{/literal}" />
            <button onclick="vcDomSearch()"><i class="fas fa-search"></i> Rechercher</button>
          </div>
          <div class="vc-tld-pills">
            <span class="vc-tld-pill" onclick="vcTld('.com')">.com</span>
            <span class="vc-tld-pill" onclick="vcTld('.net')">.net</span>
            <span class="vc-tld-pill" onclick="vcTld('.org')">.org</span>
            <span class="vc-tld-pill" onclick="vcTld('.africa')">.africa</span>
            <span class="vc-tld-pill" onclick="vcTld('.ci')">.ci</span>
            <span class="vc-tld-pill" onclick="vcTld('.sn')">.sn</span>
            <span class="vc-tld-pill" onclick="vcTld('.cm')">.cm</span>
            <span class="vc-tld-pill" onclick="vcTld('.io')">.io</span>
          </div>
          <div id="vcDomLoad" style="display:none;text-align:center;padding:14px;color:#9aa3b0;">
            <i class="fas fa-spinner fa-spin" style="color:var(--primary);margin-right:6px;"></i> Checking...
          </div>
          <div id="vcDomRes" style="margin-top:10px;"></div>
          <div style="text-align:center;margin-top:12px;">
            <a href="{$WEB_ROOT}/cart.php?a=add&domain=register" style="font-size:13px;color:var(--primary);font-weight:700;text-decoration:none;">
              <i class="fas fa-external-link-alt" style="margin-right:4px;"></i> Recherche avancée de domaine
            </a>
          </div>
        </div>

        {* Hosting pane *}
        <div class="vc-pane" id="vcP1">
          <div class="vc-link-grid">
            {if $secondarySidebar}
              {foreach $secondarySidebar as $panel}
                {foreach $panel->getChildren() as $child}
                  {if $child->getUri()}
                  <a href="{$child->getUri()}" class="vc-link"><i class="fas fa-server"></i>{$child->getLabel()}</a>
                  {/if}
                {/foreach}
              {/foreach}
            {else}
              <a href="{$WEB_ROOT}/hosting" class="vc-link"><i class="fas fa-server"></i>Hébergement Web</a>
              <a href="{$WEB_ROOT}/vps" class="vc-link"><i class="fas fa-cube"></i>Cloud VPS</a>
              <a href="{$WEB_ROOT}/dedicated" class="vc-link"><i class="fas fa-microchip"></i>Serveur Dédié</a>
              <a href="{$WEB_ROOT}/cart.php" class="vc-link"><i class="fas fa-shopping-bag"></i>Toutes nos offres</a>
            {/if}
          </div>
        </div>

        {* Services pane *}
        <div class="vc-pane" id="vcP2">
          <div class="vc-link-grid">
            <a href="{$WEB_ROOT}/cart.php?a=add&domain=register" class="vc-link"><i class="fas fa-globe"></i>Register Domain</a>
            <a href="{$WEB_ROOT}/cart.php?a=add&domain=transfer" class="vc-link"><i class="fas fa-exchange-alt"></i>Transfer Domain</a>
            <a href="{$WEB_ROOT}/cart.php?a=add&domain=renew" class="vc-link"><i class="fas fa-redo"></i>Renouveler domaine</a>
            <a href="{$WEB_ROOT}/submitticket.php" class="vc-link"><i class="fas fa-headset"></i>Support</a>
            <a href="{$WEB_ROOT}/clientarea.php?action=services" class="vc-link"><i class="fas fa-list"></i>Mes services</a>
          </div>
        </div>
      </div>

      {* Cart items *}
      <div class="vc-label">
        <i class="fas fa-shopping-bag"></i> Items in Cart
        {if $cartitems > 0}<span style="background:var(--dark);color:#fff;font-size:10px;font-weight:800;border-radius:20px;padding:2px 9px;">{$cartitems}</span>{/if}
      </div>

      <form method="post" action="{$WEB_ROOT}/cart.php?a=view" id="vcCartForm">

        {if $cartitems == 0}
        <div class="vc-card">
          <div class="vc-empty">
            <i class="fas fa-shopping-cart"></i>
            <h5>Your cart is empty</h5>
            <p>Utilisez les onglets ci-dessus pour ajouter des domaines ou des hébergements.</p>
          </div>
        </div>
        {/if}

        {* Domains *}
        {foreach $domains as $num => $domain}
        <div class="vc-card">
          <div class="vc-item">
            <div class="vc-item-icon domain"><i class="fas fa-globe"></i></div>
            <div class="vc-item-info">
              <div class="vc-item-tag">{if $domain.type eq "register"}Domain Registration{else}Domain Transfer{/if}</div>
              <div class="vc-item-name">{$domain.domain}</div>
              <div class="vc-item-meta">
                {if $domain.dnsmanagement}<span style="color:var(--primary);margin-right:8px;"><i class="fas fa-check-circle"></i> DNS</span>{/if}
                {if $domain.emailforwarding}<span style="color:var(--primary);margin-right:8px;"><i class="fas fa-check-circle"></i> Email</span>{/if}
                {if $domain.idprotection}<span style="color:var(--primary);"><i class="fas fa-check-circle"></i> Protection ID</span>{/if}
              </div>
            </div>
            <div class="vc-item-right">
              <div class="vc-item-price"><span name="{$domain.domain}Price">{$domain.price}</span></div>
              {if isset($domain.renewprice)}<div style="font-size:11px;color:#9aa3b0;margin-top:2px;">Renouv. <span class="renewal-price">{$domain.renewprice->toPrefixed()}</span>/an</div>{/if}
              <div class="vc-item-actions">
                <div class="dropdown">
                  <button class="vc-btn-period dropdown-toggle" data-toggle="dropdown" id="{$domain.domain}Pricing" name="{$domain.domain}Pricing">
                    <i class="fas fa-calendar-alt"></i> {$domain.regperiod} {$domain.yearsLanguage}
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right" style="border-radius:12px;border:1px solid #eee;box-shadow:0 8px 28px rgba(0,0,0,.1);padding:6px;min-width:200px;">
                    {foreach $domain.pricing as $years => $price}
                    <li><a href="#" onclick="selectDomainPeriodInCart('{$domain.domain}','{$price.register}',{$years},'{if $years==1}{lang key='orderForm.year'}{else}{lang key='orderForm.years'}{/if}');return false;" style="border-radius:8px;padding:9px 14px;color:#444;font-size:13px;display:block;">
                      <i class="fas fa-calendar" style="color:var(--primary);margin-right:6px;"></i>
                      {$years} {if $years==1}{lang key='orderForm.year'}{else}{lang key='orderForm.years'}{/if} — {$price.register}
                    </a></li>
                    {/foreach}
                  </ul>
                </div>
                <button type="button" class="vc-btn-delete" onclick="removeItem('d','{$num}')"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>
        </div>
        {/foreach}

        {* Products *}
        {foreach $products as $num => $product}
        <div class="vc-card">
          <div class="vc-item">
            <div class="vc-item-icon hosting"><i class="fas fa-server"></i></div>
            <div class="vc-item-info">
              <div class="vc-item-tag">{$product.productinfo.groupname}</div>
              <div class="vc-item-name">{$product.productinfo.name}</div>
              <div class="vc-item-meta">
                {if $product.domain}<i class="fas fa-globe" style="color:var(--primary);margin-right:4px;"></i>{$product.domain} &nbsp;{/if}
                {if $product.billingcyclefriendly}<i class="fas fa-sync-alt" style="margin-right:4px;"></i>{$product.billingcyclefriendly}{/if}
              </div>
              {if $product.configoptions}
              <div class="vc-item-meta" style="margin-top:4px;">
                {foreach key=k item=c from=$product.configoptions}
                <span style="margin-right:8px;">&#8250; {$c.name}: {if $c.type eq 1 || $c.type eq 2}{$c.option}{elseif $c.type eq 3}{if $c.qty}{$c.option}{else}{$LANG.no}{/if}{elseif $c.type eq 4}{$c.qty}×{$c.option}{/if}</span>
                {/foreach}
              </div>
              {/if}
            </div>
            <div class="vc-item-right">
              <div class="vc-item-price">{$product.pricing.totalTodayExcludingTaxSetup}</div>
              {if $product.pricing.productonlysetup}<div style="font-size:11px;color:#9aa3b0;margin-top:2px;">+ {$product.pricing.productonlysetup->toPrefixed()} setup</div>{/if}
              {if $product.proratadate}<div style="font-size:11px;color:#9aa3b0;">{$LANG.orderprorata} {$product.proratadate}</div>{/if}
              <div class="vc-item-actions">
                <a href="{$WEB_ROOT}/cart.php?a=confproduct&i={$num}" class="vc-btn-edit"><i class="fas fa-pen"></i> Modifier</a>
                <button type="button" class="vc-btn-delete" onclick="removeItem('p','{$num}')"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>
          {if $showqtyoptions && $product.allowqty}
          <div class="vc-item-addon" style="justify-content:space-between;">
            <span>Quantité</span>
            <div class="input-group" style="width:130px;">
              <input type="number" name="qty[{$num}]" value="{$product.qty}" class="form-control form-control-sm text-center" min="0" style="border-radius:8px 0 0 8px;border:1.5px solid var(--border);"/>
              <div class="input-group-append"><button type="submit" class="btn btn-sm" style="background:var(--dark);color:#fff;border-radius:0 8px 8px 0;font-weight:700;">OK</button></div>
            </div>
          </div>
          {/if}
          {foreach $product.addons as $an => $addon}
          <div class="vc-item-addon">
            <span><i class="fas fa-plus-circle" style="color:#f9a825;margin-right:6px;"></i>{$addon.name}</span>
            <span style="font-weight:700;color:var(--dark);">{$addon.totaltoday}</span>
          </div>
          {/foreach}
        </div>
        {/foreach}

        {* Standalone addons *}
        {foreach $addons as $num => $addon}
        <div class="vc-card">
          <div class="vc-item">
            <div class="vc-item-icon addon"><i class="fas fa-puzzle-piece"></i></div>
            <div class="vc-item-info">
              <div class="vc-item-tag">{$addon.productname} — Addon</div>
              <div class="vc-item-name">{$addon.name}</div>
              <div class="vc-item-meta">{if $addon.billingcyclefriendly}{$addon.billingcyclefriendly}{/if}{if $addon.domainname} &nbsp;<i class="fas fa-globe" style="color:var(--primary);margin-right:3px;"></i>{$addon.domainname}{/if}</div>
            </div>
            <div class="vc-item-right">
              <div class="vc-item-price">{$addon.totaltoday}</div>
              <div class="vc-item-actions">
                <button type="button" class="vc-btn-delete" onclick="removeItem('a','{$num}')"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>
        </div>
        {/foreach}

        {* Service renewals *}
        {foreach $renewalsByType['services'] as $num => $s}
        <div class="vc-card">
          <div class="vc-item">
            <div class="vc-item-icon renewal"><i class="fas fa-redo"></i></div>
            <div class="vc-item-info">
              <div class="vc-item-tag">Renouvellement service</div>
              <div class="vc-item-name">{$s.name}</div>
              <div class="vc-item-meta">{if $s.domainName}<i class="fas fa-globe" style="color:var(--primary);margin-right:4px;"></i>{$s.domainName} &nbsp;{/if}{$s.billingCycle}</div>
            </div>
            <div class="vc-item-right">
              <div class="vc-item-price">{$s.recurringBeforeTax}</div>
              <div class="vc-item-actions">
                <button type="button" class="vc-btn-delete" onclick="removeItem('r','{$num}','service')"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>
        </div>
        {/foreach}

        {* Domain renewals *}
        {foreach $renewalsByType['domains'] as $num => $d}
        <div class="vc-card">
          <div class="vc-item">
            <div class="vc-item-icon domain"><i class="fas fa-redo"></i></div>
            <div class="vc-item-info">
              <div class="vc-item-tag">Renouvellement domaine</div>
              <div class="vc-item-name">{$d.domain}</div>
              <div class="vc-item-meta">{$d.regperiod} {$LANG.orderyears}</div>
            </div>
            <div class="vc-item-right">
              <div class="vc-item-price">{$d.price}</div>
              <div class="vc-item-actions">
                <button type="button" class="vc-btn-delete" onclick="removeItem('r','{$num}','domain')"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>
        </div>
        {/foreach}

        {* Upgrades *}
        {foreach $upgrades as $num => $u}
        <div class="vc-card">
          <div class="vc-item">
            <div class="vc-item-icon upgrade"><i class="fas fa-arrow-up"></i></div>
            <div class="vc-item-info">
              <div class="vc-item-tag">Mise à niveau</div>
              <div class="vc-item-name">{if $u->type=='service'}{$u->originalProduct->name} → {$u->newProduct->name}{elseif $u->type=='addon'}{$u->originalAddon->name} → {$u->newAddon->name}{/if}</div>
              {if $u->type=='service' && $u->service->domain}<div class="vc-item-meta">{$u->service->domain}</div>{/if}
            </div>
            <div class="vc-item-right">
              <div class="vc-item-price">{$u->newRecurringAmount}</div>
              <div style="font-size:11px;color:#9aa3b0;margin-top:2px;">{$u->localisedNewCycle}</div>
              {if $u->totalDaysInCycle > 0}<div style="font-size:11px;color:#27ae60;margin-top:2px;">Crédit: -{$u->creditAmount}</div>{/if}
              <div class="vc-item-actions">
                <button type="button" class="vc-btn-delete" onclick="removeItem('u','{$num}')"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>
        </div>
        {/foreach}

      </form>

      {* Promo code *}
      <div class="vc-card">
        <div class="vc-card-head">
          <i class="fas fa-tag" style="color:var(--primary);"></i>
          <h6>Code promotionnel</h6>
        </div>
        <div class="vc-card-body">
          {if $promotioncode}
          <div class="vc-promo-active">
            <span><i class="fas fa-check-circle" style="margin-right:8px;"></i>{$promotioncode} — {$promotiondescription}</span>
            <a href="{$WEB_ROOT}/cart.php?a=removepromo" style="color:#e74c3c;font-size:18px;line-height:1;"><i class="fas fa-times-circle"></i></a>
          </div>
          {else}
          <form method="post" action="{$WEB_ROOT}/cart.php?a=view">
            <div class="vc-promo-form">
              <input type="text" name="promocode" placeholder="Entrez votre code promotionnel">
              <button type="submit" name="validatepromo" value="{$LANG.orderpromovalidatebutton}">
                <i class="fas fa-check" style="margin-right:4px;"></i>Appliquer
              </button>
            </div>
          </form>
          {/if}
        </div>
      </div>

      {foreach $hookOutput as $o}<div style="margin-top:12px;">{$o}</div>{/foreach}
      {foreach $gatewaysoutput as $go}<div class="vc-card" style="padding:18px 22px;margin-top:12px;">{$go}</div>{/foreach}

      {if $taxenabled && !$loggedin}
      <div class="vc-card">
        <div class="vc-card-head"><i class="fas fa-calculator" style="color:var(--primary);"></i><h6>Estimer les taxes</h6></div>
        <div class="vc-card-body">
          <form method="post" action="{$WEB_ROOT}/cart.php?a=setstateandcountry">
            <div class="row">
              <div class="col-sm-5 mb-2"><input type="text" name="state" value="{$clientsdetails.state}" class="form-control" placeholder="Région" style="border-radius:10px;border:1.5px solid var(--border);"/></div>
              <div class="col-sm-5 mb-2">
                <select name="country" class="form-control" style="border-radius:10px;border:1.5px solid var(--border);">
                  {foreach $countries as $cc => $cl}<option value="{$cc}"{if (!$country && $cc==$defaultcountry)||$cc==$country} selected{/if}>{$cl}</option>{/foreach}
                </select>
              </div>
              <div class="col-sm-2 mb-2"><button type="submit" class="btn btn-block" style="background:var(--primary);color:#fff;border-radius:10px;font-weight:700;height:100%;">{$LANG.orderForm.updateTotals}</button></div>
            </div>
          </form>
        </div>
      </div>
      {/if}

    </div>{* /LEFT *}

    {* ── RIGHT: SUMMARY ── *}
    <div>
      <div class="vc-summary">
        <div class="vc-summary-head">
          <h5><i class="fas fa-receipt"></i> Order Summary</h5>
          <div style="display:flex;align-items:center;gap:10px;">
            {if $cartitems > 0}
            <span style="background:var(--primary);color:#fff;font-size:11px;font-weight:800;border-radius:20px;padding:3px 10px;">{$cartitems} article{if $cartitems > 1}s{/if}</span>
            <button id="btnEmptyCart" type="button" style="background:none;border:none;cursor:pointer;color:rgba(255,255,255,.45);font-size:12px;">
              <i class="fas fa-trash-alt"></i>
            </button>
            {/if}
          </div>
        </div>
        <div class="vc-summary-body">

          <div id="orderSummaryLoader" style="display:none;text-align:center;padding:8px;"><i class="fas fa-spinner fa-spin" style="color:var(--primary);"></i></div>

          <div class="vc-sum-row">
            <span class="vc-sum-label">{$LANG.ordersubtotal}</span>
            <span class="vc-sum-value" id="subtotal">{$subtotal}</span>
          </div>
          {if $promotioncode}
          <div class="vc-sum-row">
            <span class="vc-sum-label"><i class="fas fa-tag" style="color:var(--primary);"></i> {$promotiondescription}</span>
            <span class="vc-sum-value" style="color:#e74c3c;" id="discount">-{$discount}</span>
          </div>
          {/if}
          {if $taxrate}
          <div class="vc-sum-row">
            <span class="vc-sum-label">{$taxname} ({$taxrate}%)</span>
            <span class="vc-sum-value" id="taxTotal1">{$taxtotal}</span>
          </div>
          {/if}
          {if $taxrate2}
          <div class="vc-sum-row">
            <span class="vc-sum-label">{$taxname2} ({$taxrate2}%)</span>
            <span class="vc-sum-value" id="taxTotal2">{$taxtotal2}</span>
          </div>
          {/if}

          <span id="recurring">
            <span id="recurringMonthly" {if !$totalrecurringmonthly}style="display:none"{/if}>
              <div class="vc-sum-row"><span class="vc-sum-label"><i class="fas fa-sync-alt" style="color:var(--primary);font-size:10px;"></i> Mensuel</span><span class="vc-sum-value cost">{$totalrecurringmonthly}</span></div>
            </span>
            <span id="recurringQuarterly" {if !$totalrecurringquarterly}style="display:none"{/if}>
              <div class="vc-sum-row"><span class="vc-sum-label"><i class="fas fa-sync-alt" style="color:var(--primary);font-size:10px;"></i> Trimestriel</span><span class="vc-sum-value cost">{$totalrecurringquarterly}</span></div>
            </span>
            <span id="recurringSemiAnnually" {if !$totalrecurringsemiannually}style="display:none"{/if}>
              <div class="vc-sum-row"><span class="vc-sum-label"><i class="fas fa-sync-alt" style="color:var(--primary);font-size:10px;"></i> Semestriel</span><span class="vc-sum-value cost">{$totalrecurringsemiannually}</span></div>
            </span>
            <span id="recurringAnnually" {if !$totalrecurringannually}style="display:none"{/if}>
              <div class="vc-sum-row"><span class="vc-sum-label"><i class="fas fa-sync-alt" style="color:var(--primary);font-size:10px;"></i> Annuel</span><span class="vc-sum-value cost">{$totalrecurringannually}</span></div>
            </span>
            <span id="recurringBiennially" {if !$totalrecurringbiennially}style="display:none"{/if}>
              <div class="vc-sum-row"><span class="vc-sum-label"><i class="fas fa-sync-alt" style="color:var(--primary);font-size:10px;"></i> Biennal</span><span class="vc-sum-value cost">{$totalrecurringbiennially}</span></div>
            </span>
            <span id="recurringTriennially" {if !$totalrecurringtriennially}style="display:none"{/if}>
              <div class="vc-sum-row"><span class="vc-sum-label"><i class="fas fa-sync-alt" style="color:var(--primary);font-size:10px;"></i> Triennal</span><span class="vc-sum-value cost">{$totalrecurringtriennially}</span></div>
            </span>
          </span>

          <div class="vc-total-box">
            <div>
              <div class="vc-total-label">Total dû aujourd'hui</div>
              <div class="vc-total-amount" id="totalDueToday">{$total}</div>
            </div>
            <i class="fas fa-shield-alt" style="font-size:2rem;color:var(--primary);opacity:.25;"></i>
          </div>

          {foreach $expressCheckoutButtons as $btn}
          <div style="margin-bottom:12px;">{$btn}</div>
          <div style="text-align:center;margin-bottom:12px;color:#ccc;font-size:12px;font-weight:700;letter-spacing:1px;">— OU —</div>
          {/foreach}

          <a href="{$WEB_ROOT}/cart.php?a=checkout&e=false" id="checkout"
            class="vc-checkout-btn{if $cartitems==0} disabled{/if}">
            <i class="fas fa-lock" style="margin-right:8px;"></i> Passer la commande
          </a>
          <a href="{$WEB_ROOT}/cart.php" class="vc-continue">
            <i class="fas fa-chevron-left" style="margin-right:4px;"></i> Continuer mes achats
          </a>

          <div class="vc-trust">
            <div class="vc-trust-item"><i class="fas fa-shield-alt"></i> Paiement sécurisé</div>
            <div class="vc-trust-item"><i class="fas fa-lock"></i> SSL 256-bit</div>
            <div class="vc-trust-item"><i class="fas fa-headset"></i> Support 24/7</div>
          </div>
        </div>
      </div>
    </div>

  </div>{* /vc-grid *}
</div>{* /vc-wrap *}
</div>{* /order-standard_cart *}

{* Modals *}
<form method="post" action="{$WEB_ROOT}/cart.php">
  <input type="hidden" name="a" value="remove"/>
  <input type="hidden" name="r" value="" id="inputRemoveItemType"/>
  <input type="hidden" name="rt" value="" id="inputRemoveItemRenewalType">
  <div class="modal fade" id="modalRemoveItem" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm"><div class="modal-content" style="border-radius:16px;overflow:hidden;border:none;">
      <div class="modal-header" style="background:var(--dark);color:#fff;border:none;padding:20px 24px;">
        <h5 class="modal-title" style="font-weight:800;"><i class="fas fa-trash-alt" style="margin-right:8px;"></i>Supprimer</h5>
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:.6;">&times;</button>
      </div>
      <div class="modal-body text-center py-4" style="color:#555;">{$LANG.cartremoveitemconfirm}</div>
      <div class="modal-footer border-0 justify-content-center pb-4">
        <button type="button" class="btn" data-dismiss="modal" style="border-radius:9px;padding:9px 24px;border:1.5px solid var(--border);font-weight:700;color:#666;">{$LANG.no}</button>
        <button type="submit" class="btn btn-danger" style="border-radius:9px;padding:9px 24px;font-weight:700;">{$LANG.yes}</button>
      </div>
    </div></div>
  </div>
</form>
<form method="post" action="{$WEB_ROOT}/cart.php">
  <input type="hidden" name="a" value="empty"/>
  <div class="modal fade" id="modalEmptyCart" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm"><div class="modal-content" style="border-radius:16px;overflow:hidden;border:none;">
      <div class="modal-header" style="background:var(--dark);color:#fff;border:none;padding:20px 24px;">
        <h5 class="modal-title" style="font-weight:800;"><i class="fas fa-trash-alt" style="margin-right:8px;"></i>Clear Cart</h5>
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:.6;">&times;</button>
      </div>
      <div class="modal-body text-center py-4" style="color:#555;">{$LANG.cartemptyconfirm}</div>
      <div class="modal-footer border-0 justify-content-center pb-4">
        <button type="button" class="btn" data-dismiss="modal" style="border-radius:9px;padding:9px 24px;border:1.5px solid var(--border);font-weight:700;color:#666;">{$LANG.no}</button>
        <button type="submit" class="btn btn-danger" style="border-radius:9px;padding:9px 24px;font-weight:700;">{$LANG.yes}</button>
      </div>
    </div></div>
  </div>
</form>

{include file="orderforms/fillsbase/recommendations-modal.tpl"}
{/if}

<script type="text/javascript" src="{$WEB_ROOT}/templates/orderforms/fillsbase/js/main.js?v={$versionHash}"></script>
<script>
{literal}
/* Tab switching */
function vcTab(i) {
  for (var j = 0; j < 3; j++) {
    var btn = document.getElementById('vcT'+j);
    var pane = document.getElementById('vcP'+j);
    if (j === i) {
      btn.classList.add('active');
      pane.classList.add('active');
    } else {
      btn.classList.remove('active');
      pane.classList.remove('active');
    }
  }
}

/* Domain search */
function vcDomSearch() {
  var q = (document.getElementById('vcDomQ').value || '').trim();
  if (!q) return;
  if (q.indexOf('.') === -1) q += '.com';
  vcDoSearch(q);
}
function vcTld(tld) {
  var base = (document.getElementById('vcDomQ').value || '').trim().split('.')[0];
  if (!base) { document.getElementById('vcDomQ').focus(); return; }
  vcDoSearch(base + tld);
}
function vcDoSearch(domain) {
  var res = document.getElementById('vcDomRes');
  var load = document.getElementById('vcDomLoad');
  res.innerHTML = '';
  load.style.display = 'block';
  jQuery.post('/domaincheck.php', { domain: domain, token: csrfToken }, function(data) {
    load.style.display = 'none';
    try {
      var r = typeof data === 'string' ? JSON.parse(data) : data;
      var items = r.domains || r.results || [];
      if (!items.length && r.domain) items = [r];
      if (!items.length) { res.innerHTML = '<p style="text-align:center;color:#999;padding:12px;">Aucun résultat.</p>'; return; }
      items.forEach(function(d) {
        var avail = d.status === 'available' || d.available;
        var name = d.domain || domain;
        var price = d.price || '';
        res.innerHTML += '<div style="display:flex;align-items:center;justify-content:space-between;padding:12px 14px;border-radius:10px;margin-bottom:8px;border:1px solid #e4e8ef;background:#fff;">' +
          '<div><div style="font-size:15px;font-weight:700;color:#1a1a2e;">' + name + '</div>' +
          '<div style="font-size:11px;font-weight:700;margin-top:3px;color:' + (avail ? '#27ae60' : '#e74c3c') + ';">' +
          (avail ? '<i class="fas fa-check-circle"></i> Available' : '<i class="fas fa-times-circle"></i> Taken') + '</div></div>' +
          '<div style="display:flex;align-items:center;gap:10px;">' +
          (price ? '<span style="font-size:14px;font-weight:800;color:#1a1a2e;">' + price + '</span>' : '') +
          (avail ? '<a href="/cart.php?a=add&domain=register&query=' + encodeURIComponent(name) + '" style="background:#00d1b2;color:#fff;border-radius:8px;padding:7px 16px;font-size:12px;font-weight:700;text-decoration:none;">Add</a>'
                 : '<span style="background:#f0f2f5;color:#9aa3b0;border-radius:8px;padding:7px 16px;font-size:12px;font-weight:700;">Non dispo.</span>') +
          '</div></div>';
      });
    } catch(e) {
      load.style.display = 'none';
      res.innerHTML = '<p style="text-align:center;padding:12px;"><a href="/cart.php?a=add&domain=register" style="color:#00d1b2;font-weight:700;">Utiliser la page de recherche</a></p>';
    }
  }).fail(function() {
    load.style.display = 'none';
    res.innerHTML = '<p style="text-align:center;padding:12px;"><a href="/cart.php?a=add&domain=register" style="color:#00d1b2;font-weight:700;">Utiliser la page de recherche</a></p>';
  });
}

/* Normalise prices */
function vcNorm() {
  document.querySelectorAll('[name$="Price"],.renewal-price,#subtotal,#discount,#taxTotal1,#taxTotal2,#totalDueToday,.cost').forEach(function(e) {
    e.innerHTML = e.innerHTML.replace(/(\d),(\d{3})/g, '$1 $2');
  });
}
document.addEventListener('DOMContentLoaded', vcNorm);
new MutationObserver(vcNorm).observe(document.body, { childList: true, subtree: true, characterData: true });
{/literal}
</script>
