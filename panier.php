<?php
/**
 * Standalone cart page - fully custom, WHMCS-session-aware
 * Mirrors cart.php?a=view but with full control over the HTML
 */

// Prevent browser caching so JS changes always load fresh
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

define('CLIENTAREA', true);
define('ADMINAREA', false);
define('WHMC_ROOT', __DIR__);

// Try to load WHMCS init to get cart data
$whmcsCartItems = [];
$whmcsTotal = '';
$whmcsSubtotal = '';
$whmcsDiscount = '';
$whmcsCsrf = '';
$webRoot = '';

try {
    if (file_exists(__DIR__ . '/init.php')) {
        // We can't fully init WHMCS safely here, so we'll use the API approach
    }
    // Read web root from configuration
    if (file_exists(__DIR__ . '/configuration.php')) {
        include_once __DIR__ . '/configuration.php';
        // $whmcs_url is set in configuration.php
    }
} catch (Exception $e) { }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panier | Fillsbase Africa</title>
  <link href="assets/img/favicon.ico" rel="shortcut icon">
  <link href="assets/fonts/fontawesome/css/all.min.css" rel="stylesheet">
  <link href="assets/fonts/fonts.min.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/vendors.min.css" rel="stylesheet">
  <link href="assets/css/theme.min.css" rel="stylesheet">
  <link href="assets/css/fillsbase_custom.css?v=4.1" rel="stylesheet">
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <style>
    :root { --primary: #00d1b2; --primary-dark: #00b89c; --dark: #1a1a2e; --border: #e8ecf0; }
    body { background: #f4f6f9; }

    .cart-page { max-width: 1180px; margin: 0 auto; padding: 32px 20px 80px; }

    /* Steps */
    .cart-steps { display: flex; align-items: center; justify-content: center; gap: 0; background: #fff; border-radius: 14px; border: 1px solid var(--border); padding: 16px 28px; margin-bottom: 32px; box-shadow: 0 2px 10px rgba(0,0,0,.04); flex-wrap: wrap; row-gap: 8px; }
    .cs { display: flex; align-items: center; gap: 9px; font-size: 13px; font-weight: 700; color: #bbb; }
    .cs.active { color: var(--primary); }
    .cs-num { width: 28px; height: 28px; border-radius: 50%; background: #eee; color: #bbb; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800; flex-shrink: 0; }
    .cs.active .cs-num { background: var(--primary); color: #fff; }
    .cs-sep { width: 36px; height: 2px; background: #eee; margin: 0 6px; }
    .cs-sep.done { background: var(--primary); }

    /* Grid */
    .cart-grid { display: grid; grid-template-columns: 1fr 360px; gap: 28px; align-items: start; }
    @media(max-width:900px){ .cart-grid { grid-template-columns: 1fr; } .cs-sep { width:18px; } }

    /* Section label */
    .sec-lbl { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; color: #9aa3b0; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
    .sec-lbl i { color: var(--primary); }

    /* Card */
    .c-card { background: #fff; border-radius: 16px; border: 1px solid var(--border); box-shadow: 0 2px 12px rgba(0,0,0,.04); overflow: hidden; margin-bottom: 18px; }
    .c-card-head { padding: 15px 22px; border-bottom: 1px solid var(--border); background: #fafbfc; display: flex; align-items: center; gap: 10px; }
    .c-card-head h6 { margin: 0; font-size: 14px; font-weight: 800; color: var(--dark); }
    .c-card-body { padding: 20px 22px; }

    /* Tabs */
    .c-tabs { display: flex; border-bottom: 1px solid var(--border); background: #fafbfc; }
    .c-tab { flex: 1; padding: 14px 8px; text-align: center; font-size: 12px; font-weight: 700; cursor: pointer; color: #9aa3b0; border-bottom: 3px solid transparent; margin-bottom: -1px; transition: all .2s; }
    .c-tab.active { color: var(--dark); border-bottom-color: var(--primary); background: #fff; }
    .c-tab i { display: block; font-size: 1rem; margin-bottom: 4px; }
    .c-tab.active i { color: var(--primary); }
    .c-pane { padding: 20px 22px; display: none; }
    .c-pane.active { display: block; }

    /* Domain search */
    .dom-search { display: flex; border: 2px solid var(--border); border-radius: 12px; overflow: hidden; }
    .dom-search input { flex: 1; border: none; outline: none; padding: 12px 18px; font-size: 15px; background: #fff; color: var(--dark); }
    .dom-search button { background: var(--primary); color: #fff; border: none; padding: 0 22px; font-size: 13px; font-weight: 800; cursor: pointer; white-space: nowrap; }
    .tld-pills { display: flex; flex-wrap: wrap; gap: 7px; margin-top: 12px; }
    .tld-pill { background: #f4f6f9; border: 1px solid var(--border); border-radius: 20px; padding: 4px 13px; font-size: 12px; font-weight: 700; color: #666; cursor: pointer; }
    .tld-pill:hover { border-color: var(--primary); color: var(--primary); }

    /* Cart items */
    .cart-empty { text-align: center; padding: 52px 20px; }
    .cart-empty i { font-size: 3rem; color: #dde2e8; display: block; margin-bottom: 16px; }
    .cart-empty h5 { font-size: 1rem; font-weight: 800; color: var(--dark); margin-bottom: 6px; }
    .cart-empty p { font-size: .85rem; color: #9aa3b0; margin: 0; }

    .c-item { display: flex; align-items: flex-start; gap: 15px; padding: 18px 22px; border-bottom: 1px solid var(--border); }
    .c-item:last-child { border-bottom: none; }
    .c-item-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.05rem; flex-shrink: 0; }
    .c-icon-domain  { background: #e8faf7; color: var(--primary); }
    .c-icon-hosting { background: #eef1ff; color: #5c6bc0; }
    .c-icon-addon   { background: #fff8e1; color: #f9a825; }
    .c-icon-renew   { background: #fce4ec; color: #e91e63; }
    .c-item-info { flex: 1; min-width: 0; }
    .c-item-tag { font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--primary); margin-bottom: 3px; }
    .c-item-name { font-size: 15px; font-weight: 800; color: var(--dark); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .c-item-meta { font-size: 12px; color: #9aa3b0; margin-top: 3px; }
    .c-item-right { text-align: right; flex-shrink: 0; }
    .c-item-price { font-size: 17px; font-weight: 900; color: var(--dark); }
    .c-item-actions { display: flex; gap: 6px; justify-content: flex-end; margin-top: 8px; }
    .c-btn-sm { background: none; border: 1.5px solid var(--border); color: #999; border-radius: 8px; padding: 5px 10px; font-size: 12px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; }
    .c-btn-del { border-color: #f0d0d0; color: #ddd; }
    .c-btn-del:hover { border-color: #e74c3c; color: #e74c3c; }
    .c-item-subrow { background: #fafbfc; border-top: 1px solid var(--border); padding: 10px 22px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; }

    /* Promo */
    .promo-active { background: #eafaf7; border: 1.5px solid #b2ede7; border-radius: 10px; padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; font-weight: 700; color: var(--primary-dark); }
    .promo-form { display: flex; gap: 8px; }
    .promo-form input { flex: 1; border: 1.5px solid var(--border); border-radius: 10px; padding: 10px 15px; font-size: 14px; outline: none; }
    .promo-form input:focus { border-color: var(--primary); }
    .promo-form button { background: var(--dark); color: #fff; border: none; border-radius: 10px; padding: 10px 20px; font-size: 13px; font-weight: 700; cursor: pointer; }

    /* Summary */
    .sum-card { background: #fff; border-radius: 16px; border: 1px solid var(--border); box-shadow: 0 4px 24px rgba(0,0,0,.07); overflow: hidden; position: sticky; top: 20px; }
    .sum-head { background: var(--dark); padding: 20px 24px; display: flex; align-items: center; justify-content: space-between; }
    .sum-head h5 { margin: 0; color: #fff; font-size: 15px; font-weight: 800; display: flex; align-items: center; gap: 8px; }
    .sum-body { padding: 22px 24px; }
    .sum-row { display: flex; justify-content: space-between; align-items: center; padding: 9px 0; border-bottom: 1px solid #f5f5f5; font-size: 14px; }
    .sum-row:last-of-type { border-bottom: none; }
    .sum-lbl { color: #9aa3b0; }
    .sum-val { font-weight: 700; color: var(--dark); }
    .total-box { background: linear-gradient(135deg,#f0fffe,#e5f9f7); border-radius: 14px; padding: 20px; margin: 16px 0; display: flex; justify-content: space-between; align-items: center; }
    .total-lbl { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: #999; margin-bottom: 4px; }
    .total-amt { font-size: 30px; font-weight: 900; color: var(--primary); line-height: 1; }
    .checkout-btn { display: block; width: 100%; background: var(--primary); color: #fff; border: none; border-radius: 12px; padding: 16px; font-size: 16px; font-weight: 800; text-align: center; text-decoration: none; box-shadow: 0 6px 20px rgba(0,209,178,.3); margin-bottom: 10px; transition: opacity .2s; cursor: pointer; }
    .checkout-btn:hover { opacity: .9; color: #fff; text-decoration: none; }
    .checkout-btn.off { background: #ccc; box-shadow: none; pointer-events: none; }
    .continue-link { display: block; text-align: center; color: #9aa3b0; font-size: 13px; text-decoration: none; margin-top: 4px; }
    .continue-link:hover { color: var(--primary); }
    .trust-bar { display: flex; flex-wrap: wrap; justify-content: center; gap: 12px; padding-top: 16px; margin-top: 14px; border-top: 1px solid #f0f2f5; }
    .trust-item { display: flex; align-items: center; gap: 5px; font-size: 11px; color: #c8d0d8; font-weight: 600; }

    /* Product cards grid */
    .prod-group-title { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; color: #9aa3b0; margin: 18px 0 10px; display: flex; align-items: center; gap: 8px; }
    .prod-group-title::after { content:''; flex:1; height:1px; background:var(--border); }
    .prod-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(210px,1fr)); gap: 12px; margin-bottom: 4px; }
    .prod-card { border: 1.5px solid var(--border); border-radius: 14px; padding: 18px 16px; background: #fff; display: flex; flex-direction: column; gap: 10px; transition: border-color .2s, box-shadow .2s; }
    .prod-card:hover { border-color: var(--primary); box-shadow: 0 4px 16px rgba(0,209,178,.1); }
    .prod-card-name { font-size: 14px; font-weight: 800; color: var(--dark); }
    .prod-card-features { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 4px; }
    .prod-card-features li { font-size: 11px; color: #7a8390; display: flex; align-items: flex-start; gap: 5px; }
    .prod-card-features li::before { content: '✓'; color: var(--primary); font-weight: 700; flex-shrink: 0; margin-top: 1px; }
    .prod-card-price { margin-top: auto; }
    .prod-card-amount { font-size: 20px; font-weight: 900; color: var(--dark); }
    .prod-card-cycle { font-size: 11px; color: #9aa3b0; font-weight: 600; }
    .prod-card-cycle-sel { font-size: 11px; border: 1px solid var(--border); border-radius: 6px; padding: 3px 6px; color: var(--dark); background: #f8f9fa; cursor: pointer; outline: none; margin-top: 4px; width: 100%; }
    .prod-card-btn { display: block; width: 100%; background: var(--primary); color: #fff; border: none; border-radius: 10px; padding: 10px; font-size: 13px; font-weight: 800; cursor: pointer; text-align: center; margin-top: 10px; transition: opacity .2s; }
    .prod-card-btn:hover { opacity: .85; }
    .prod-card-btn.added { background: var(--dark); cursor: default; }
    .prod-card-btn:disabled { background: #ccc; cursor: not-allowed; }
    .prod-loading { text-align: center; padding: 30px; color: #9aa3b0; font-size: 13px; }

    /* Quick links */
    .qlink-grid { display: grid; grid-template-columns: repeat(auto-fill,minmax(140px,1fr)); gap: 8px; }
    .qlink { display: flex; align-items: center; gap: 9px; padding: 12px 14px; background: #fff; border: 1px solid var(--border); border-radius: 12px; text-decoration: none; color: var(--dark); font-size: 13px; font-weight: 600; }
    .qlink:hover { border-color: var(--primary); color: var(--primary); text-decoration: none; }
    .qlink i { color: var(--primary); }

    /* Pending item */
    .c-item-pending { opacity: .85; background: #fffdf0; }
    .c-item-pending .c-item-name { color: #856404; }

    /* Loading spinner */
    .spin-wrap { text-align: center; padding: 40px 20px; }
    .spin-wrap i { font-size: 2rem; color: var(--primary); animation: spin 1s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }
  </style>
</head>
<body>
<div class="box-container limit-width">
  <section id="settings"></section>
  <div id="spinner-area" style="display:none;"></div>
  <header id="header"></header>

  <div class="cart-page">


    <div class="cart-grid">

      <!-- LEFT -->
      <div>
        <!-- Add products card -->
        <div class="sec-lbl"><i class="fas fa-plus-circle"></i> Add Products</div>
        <div class="c-card" style="margin-bottom:24px;">
          <div class="c-tabs" id="cTabNav">
            <div class="c-tab active" onclick="cTab(0)" id="cT0"><i class="fas fa-globe"></i>Domains</div>
            <div class="c-tab" onclick="cTab(1)" id="cT1"><i class="fas fa-server"></i>Hosting</div>
            <div class="c-tab" onclick="cTab(2)" id="cT2"><i class="fas fa-th-large"></i>Services</div>
          </div>

          <!-- Domains -->
          <div class="c-pane active" id="cP0">
            <div class="dom-search">
              <input type="text" id="cDomQ" placeholder="Search a domain..." autocomplete="off">
              <button onclick="cDomSearch()"><i class="fas fa-search"></i> Search</button>
            </div>
            <div class="tld-pills">
              <span class="tld-pill" onclick="cTld('.com')">.com</span>
              <span class="tld-pill" onclick="cTld('.net')">.net</span>
              <span class="tld-pill" onclick="cTld('.org')">.org</span>
              <span class="tld-pill" onclick="cTld('.africa')">.africa</span>
              <span class="tld-pill" onclick="cTld('.ci')">.ci</span>
              <span class="tld-pill" onclick="cTld('.sn')">.sn</span>
              <span class="tld-pill" onclick="cTld('.cm')">.cm</span>
              <span class="tld-pill" onclick="cTld('.io')">.io</span>
            </div>
            <div id="cDomLoad" style="display:none;text-align:center;padding:14px;color:#9aa3b0;font-size:13px;">
              <i class="fas fa-spinner fa-spin" style="color:var(--primary);margin-right:6px;"></i> Checking...
            </div>
            <div id="cDomRes" style="margin-top:10px;"></div>
            <div style="text-align:center;margin-top:12px;">
              <a href="cart.php?a=add&domain=register" style="font-size:13px;color:var(--primary);font-weight:700;text-decoration:none;">
                <i class="fas fa-external-link-alt" style="margin-right:4px;"></i> Advanced Search
              </a>
            </div>
          </div>

          <!-- Hosting -->
          <div class="c-pane" id="cP1">
            <div id="prodHosting"><div class="prod-loading"><i class="fas fa-spinner fa-spin" style="color:var(--primary);margin-right:6px;"></i>Loading...</div></div>
          </div>

          <!-- Services -->
          <div class="c-pane" id="cP2">
            <div id="prodServices"><div class="prod-loading"><i class="fas fa-spinner fa-spin" style="color:var(--primary);margin-right:6px;"></i>Loading...</div></div>
          </div>
        </div>

        <!-- Cart items -->
        <div class="sec-lbl" id="cartCountLbl"><i class="fas fa-shopping-bag"></i> Items in cart</div>
        <div id="cartItemsContainer">
          <div class="c-card">
            <div class="spin-wrap"><i class="fas fa-spinner"></i></div>
          </div>
        </div>

        <!-- Promo -->
        <div class="c-card" id="promoCard" style="display:none;">
          <div class="c-card-head"><i class="fas fa-tag" style="color:var(--primary);"></i><h6>Promo Code</h6></div>
          <div class="c-card-body">
            <div class="promo-form">
              <input type="text" id="promoInput" placeholder="Enter promo code">
              <button onclick="applyPromo()"><i class="fas fa-check" style="margin-right:4px;"></i>Apply</button>
            </div>
            <div id="promoMsg" style="margin-top:8px;font-size:13px;display:none;"></div>
          </div>
        </div>
      </div>

      <!-- RIGHT: Summary -->
      <div>
        <div class="sum-card">
          <div class="sum-head">
            <h5><i class="fas fa-receipt"></i> Order Summary</h5>
            <span id="cartBadge" style="background:var(--primary);color:#fff;font-size:11px;font-weight:800;border-radius:20px;padding:3px 10px;display:none;"></span>
          </div>
          <div class="sum-body">
            <div id="sumRows">
              <div class="sum-row">
                <span class="sum-lbl">Subtotal</span>
                <span class="sum-val" id="sumSubtotal">—</span>
              </div>
            </div>
            <div id="discountRow" class="sum-row" style="display:none;">
              <span class="sum-lbl"><i class="fas fa-tag" style="color:var(--primary);margin-right:4px;"></i>Discount</span>
              <span class="sum-val" style="color:#e74c3c;" id="sumDiscount">—</span>
            </div>
            <div class="total-box">
              <div>
                <div class="total-lbl">Total Due Today</div>
                <div class="total-amt" id="sumTotal">—</div>
              </div>
              <i class="fas fa-shield-alt" style="font-size:2rem;color:var(--primary);opacity:.2;"></i>
            </div>

            <a href="cart.php?a=checkout&e=false" class="checkout-btn off" id="checkoutBtn">
              <i class="fas fa-lock" style="margin-right:8px;"></i> Place Order
            </a>
            <a href="cart.php" class="continue-link">
              <i class="fas fa-chevron-left" style="margin-right:4px;"></i> Continue Shopping
            </a>

            <div class="trust-bar">
              <div class="trust-item"><i class="fas fa-shield-alt"></i> Secure Payment</div>
              <div class="trust-item"><i class="fas fa-lock"></i> SSL 256-bit</div>
              <div class="trust-item"><i class="fas fa-headset"></i> Support 24/7</div>
            </div>
          </div>
        </div>
      </div>

    </div><!-- /cart-grid -->
  </div><!-- /cart-page -->

  <footer id="footer"></footer>
</div>

<script>
// Load header/footer
$(document).ready(function(){
  $('#header').load('header.php');
  $('#footer').load('footer.php');
  loadCart();
  setInterval(loadCart, 8000); // refresh every 8s
});

// ─── Tab switching ───────────────────────────────────────
var prodLoaded = {};
function cTab(i) {
  for (var j = 0; j < 3; j++) {
    document.getElementById('cT'+j).classList.toggle('active', j===i);
    document.getElementById('cP'+j).classList.toggle('active', j===i);
  }
  if (i === 1 && !prodLoaded.hosting)  { loadProducts('hosting',  '#prodHosting');  prodLoaded.hosting  = true; }
  if (i === 2 && !prodLoaded.services) { loadProducts('services', '#prodServices'); prodLoaded.services = true; }
}

// ─── Load & render product catalogue ─────────────────────
function loadProducts(tab, container) {
  $.getJSON('cart_products.php?tab=' + tab, function(data) {
    if (data.status !== 'success' || !data.groups.length) {
      $(container).html('<p style="text-align:center;padding:20px;color:#9aa3b0;font-size:13px;">Aucun produit disponible.</p>');
      return;
    }
    var html = '';
    data.groups.forEach(function(group) {
      html += '<div class="prod-group-title"><i class="fas fa-layer-group" style="color:var(--primary);"></i>' + group.name + '</div>';
      html += '<div class="prod-grid">';
      group.items.forEach(function(item) {
        var cycles = item.cycles || {};
        var cycleKeys = Object.keys(cycles);
        var hasCycles = cycleKeys.length > 1;
        var selectHtml = '';
        if (hasCycles) {
          selectHtml = '<select class="prod-card-cycle-sel" onchange="updateProdPrice(this,' + item.id + ')">';
          cycleKeys.forEach(function(k) {
            var sel = (k === item.cycle) ? ' selected' : '';
            selectHtml += '<option value="' + k + '"' + sel + ' data-price="' + cycles[k].price + '">' + cycles[k].price + cycles[k].label + '</option>';
          });
          selectHtml += '</select>';
        }
        var priceHtml = item.free
          ? '<div class="prod-card-amount" style="color:var(--primary);">Gratuit</div>'
          : (item.price
              ? '<div class="prod-card-amount" id="pp_' + item.id + '">' + item.price + '</div>' +
                '<div class="prod-card-cycle">' + item.cycle_label + '</div>' + selectHtml
              : '<div class="prod-card-cycle">Price on request</div>');

        var featHtml = '';
        if (item.features && item.features.length) {
          featHtml = '<ul class="prod-card-features">';
          item.features.forEach(function(f) { featHtml += '<li>' + f + '</li>'; });
          featHtml += '</ul>';
        }

        var btnLabel = item.free ? 'Select' : 'Add to Cart';
        html += '<div class="prod-card">' +
          '<div class="prod-card-name">' + item.name + '</div>' +
          featHtml +
          '<div class="prod-card-price">' + priceHtml + '</div>' +
          '<button class="prod-card-btn" id="pb_' + item.id + '" ' +
          'data-pid="' + item.id + '" data-cycle="' + item.cycle + '" ' +
          'onclick="addProductToCart(' + item.id + ',this)">' +
          '<i class="fas fa-cart-plus" style="margin-right:6px;"></i>' + btnLabel + '</button>' +
          '</div>';
      });
      html += '</div>';
    });
    $(container).html(html);
  }).fail(function() {
    $(container).html('<p style="text-align:center;padding:20px;color:#e74c3c;font-size:13px;">Erreur de chargement.</p>');
  });
}

function updateProdPrice(sel, pid) {
  var opt = sel.options[sel.selectedIndex];
  var price = opt.getAttribute('data-price');
  var cycle = sel.value;
  $('#pp_' + pid).text(price);
  $('#pb_' + pid).data('cycle', cycle).attr('data-cycle', cycle);
}

function addProductToCart(pid, btn) {
  var cycle = $(btn).attr('data-cycle') || 'monthly';
  $(btn).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
  $.post('cart_add_domain.php', { action: 'add_product', pid: pid, billingcycle: cycle }, function(res) {
    if (res.status === 'success' || res.status === 'exists') {
      $(btn).html('<i class="fas fa-check" style="margin-right:5px;"></i>Ajouté').addClass('added');
      loadCart();
    } else {
      $(btn).prop('disabled', false).html('<i class="fas fa-cart-plus" style="margin-right:6px;"></i>Add to Cart');
    }
  }, 'json').fail(function() {
    $(btn).prop('disabled', false).html('<i class="fas fa-cart-plus" style="margin-right:6px;"></i>Add to Cart');
  });
}

// ─── Domain search ───────────────────────────────────────
function cDomSearch() {
  var q = $('#cDomQ').val().trim().toLowerCase();
  if (!q) return;
  if (q.indexOf('.') === -1) q += '.com';
  cDoSearch(q);
}
function cTld(tld) {
  var base = $('#cDomQ').val().trim().split('.')[0];
  if (!base) { $('#cDomQ').focus(); return; }
  cDoSearch(base + tld);
}
$('#cDomQ').on('keydown', function(e){ if (e.key === 'Enter') cDomSearch(); });

function cDoSearch(domain) {
  $('#cDomRes').empty();
  $('#cDomLoad').show();
  var parts = domain.split('.');
  var sld = parts[0];
  var tld = '.' + parts.slice(1).join('.');

  $.ajax({
    url: 'cart.php',
    method: 'POST',
    data: { a: 'domainoptions', checktype: 'register', sld: sld, tld: tld, ajax: 1 },
    timeout: 15000
  }).done(function(html) {
    $('#cDomLoad').hide();
    var available = html.indexOf('domain-checker-available') !== -1 && html.indexOf('domain-checker-unavailable') === -1;
    // Extract price from the hidden lw-ajax-price span, then reformat with space thousands separator
    var priceRaw = '';
    var priceSpan = html.match(/<span[^>]*class="lw-ajax-price"[^>]*>([^<]+)<\/span>/i);
    if (priceSpan) {
      priceRaw = priceSpan[1].trim().replace(/(\d),(\d)/g, '$1 $2');
    } else {
      var m = html.match(/([\d][0-9,\. ]+)\s*(?:FCFA|€|\$)/i);
      if (m) priceRaw = m[0].trim().replace(/(\d),(\d)/g, '$1 $2');
    }
    var price = priceRaw;

    var color = available ? '#27ae60' : '#e74c3c';
    var icon  = available ? 'fa-check-circle' : 'fa-times-circle';
    var status = available ? 'Available' : 'Unavailable';

    var btn = available
      ? '<button onclick="addDomainToCart(\'' + domain.replace(/'/g,"\\'")+'\',this)" style="background:var(--primary);color:#fff;border-radius:8px;padding:7px 16px;font-size:12px;font-weight:700;border:none;cursor:pointer;"><i class="fas fa-cart-plus" style="margin-right:5px;"></i>Add</button>'
      : '<span style="background:#f0f2f5;color:#9aa3b0;border-radius:8px;padding:7px 16px;font-size:12px;font-weight:700;">Unavail.</span>';

    $('#cDomRes').html(
      '<div style="display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border-radius:12px;border:2px solid '+(available?'var(--primary)':'#eee')+';background:#fff;margin-top:8px;">' +
      '<div><div style="font-size:16px;font-weight:800;color:var(--dark);">' + domain + '</div>' +
      '<div style="font-size:12px;font-weight:700;color:'+color+';margin-top:3px;"><i class="fas '+icon+'" style="margin-right:5px;"></i>' + status + '</div></div>' +
      '<div style="display:flex;align-items:center;gap:12px;">' +
      (price ? '<span style="font-size:15px;font-weight:800;color:var(--dark);">'+price+'</span>' : '') +
      btn + '</div></div>'
    );
  }).fail(function() {
    $('#cDomLoad').hide();
    $('#cDomRes').html('<p style="text-align:center;padding:10px;font-size:13px;"><a href="cart.php?a=add&domain=register" style="color:var(--primary);font-weight:700;">Use advanced search</a></p>');
  });
}

// ─── Load cart from WHMCS ────────────────────────────────
function loadCart() {
  $.getJSON('cart_ajax.php', function(data) {
    if (data.status === 'success') {
      renderCart(data);
      if (data.checkout_url) $('#checkoutBtn').attr('href', data.checkout_url);
      if (data.promo && data.promo.code) {
        $('#promoInput').val(data.promo.code);
        $('#promoMsg').html('<span style="color:#27ae60;"><i class="fas fa-check-circle mr-1"></i>' + (data.promo.label || 'Code applied') + '</span>').show();
      }
      $('#promoCard').show();
    } else {
      showCartError();
    }
  }).fail(function() { showCartError(); });
}

function renderCart(data) {
  var items     = data.items || [];
  var itemCount = data.count || 0;

  // ── Badge & section label ──────────────────────────────
  if (itemCount > 0) {
    $('#cartBadge').text(itemCount + ' item' + (itemCount > 1 ? 's' : '')).show();
    $('#cartCountLbl').html(
      '<i class="fas fa-shopping-bag" style="color:var(--primary);"></i> Items in cart ' +
      '<span style="background:var(--dark);color:#fff;font-size:10px;font-weight:800;border-radius:20px;padding:2px 9px;margin-left:4px;">' + itemCount + '</span>'
    );
    $('#checkoutBtn').removeClass('off');
  } else {
    $('#cartBadge').hide();
    $('#checkoutBtn').addClass('off');
  }

  // ── Totals ─────────────────────────────────────────────
  $('#sumSubtotal').text(data.subtotal || '0 FCFA');
  $('#sumTotal').text(data.total || '0 FCFA');
  if (data.discount) {
    $('#sumDiscount').text('- ' + data.discount);
    $('#discountRow').show();
  } else {
    $('#discountRow').hide();
  }

  // ── Empty state ────────────────────────────────────────
  if (items.length === 0) {
    $('#cartItemsContainer').html(
      '<div class="c-card"><div class="cart-empty">' +
      '<i class="fas fa-shopping-cart"></i>' +
      '<h5>Your cart is empty</h5>' +
      '<p>Utilisez les onglets ci-dessus pour ajouter des domaines ou des hébergements.</p>' +
      '</div></div>'
    );
    return;
  }

  // ── Item cards ─────────────────────────────────────────
  var html = '<div class="c-card">';
  items.forEach(function(item) {
    var isDomain  = item.type === 'domain';
    var iconClass = isDomain ? 'fas fa-globe' : 'fas fa-server';
    var iconBg    = isDomain ? 'c-icon-domain' : 'c-icon-hosting';
    var tag       = isDomain ? 'Domain' : 'Hosting';
    var period    = item.period ? item.period : '';
    var addons    = (item.addons && item.addons.length) ? item.addons.join(' · ') : '';
    var isPending = item.pending;
    var delId     = (item.id === 'pending') ? 'pending' : item.id;

    html += '<div class="c-item' + (isPending ? ' c-item-pending' : '') + '">';
    html += '<div class="c-item-icon ' + iconBg + '"><i class="' + iconClass + '"></i></div>';
    html += '<div class="c-item-info">';
    html += '<div class="c-item-tag">' + tag + (isPending ? ' <span style="font-size:9px;background:#fff3cd;color:#856404;padding:1px 6px;border-radius:4px;margin-left:4px;">EN ATTENTE</span>' : '') + '</div>';
    html += '<div class="c-item-name">' + item.name + '</div>';
    if (period || addons) {
      html += '<div class="c-item-meta">';
      if (period) html += '<i class="fas fa-calendar-alt" style="margin-right:4px;color:var(--primary);"></i>' + period;
      if (period && addons) html += ' &nbsp;·&nbsp; ';
      if (addons) html += addons;
      html += '</div>';
    }
    html += '</div>';
    html += '<div class="c-item-right">';
    html += '<div class="c-item-price">' + (item.price || '') + '</div>';
    html += '<div class="c-item-actions">';
    var safeId   = String(delId).replace(/'/g, "\\'");
    var safeName = String(item.name).replace(/'/g, "\\'");
    html += '<button class="c-btn-sm c-btn-del" title="Remove" onclick="removeItem(\'' + item.type + '\',\'' + safeId + '\',\'' + safeName + '\')">';
    html += '<i class="fas fa-trash-alt"></i></button>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
  });
  html += '</div>';
  $('#cartItemsContainer').html(html);
}

function showCartError() {
  $('#cartItemsContainer').html(
    '<div class="c-card"><div class="cart-empty">' +
    '<i class="fas fa-exclamation-circle" style="color:#e74c3c;"></i>' +
    '<h5>Erreur de chargement</h5>' +
    '<p>Unable to load cart. <a href="cart.php?a=view" style="color:var(--primary);font-weight:700;">Retry</a></p>' +
    '</div></div>'
  );
}

// ─── Add domain inline ───────────────────────────────────
function addDomainToCart(domain, btn) {
  console.log('[panier] addDomainToCart:', domain);
  $(btn).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
  $.post('cart_add_domain.php', { action: 'add', domain: domain, regperiod: 1 }, function(res) {
    console.log('[panier] add response:', res);
    if (res.status === 'success' || res.status === 'exists') {
      $(btn).html('<i class="fas fa-check" style="margin-right:5px;"></i>Ajouté')
            .css({ background: '#1a1a2e', cursor: 'default' });
      loadCart();
    } else {
      $(btn).prop('disabled', false).html('<i class="fas fa-cart-plus" style="margin-right:5px;"></i>Ajouter');
    }
  }, 'json').fail(function() {
    $(btn).prop('disabled', false).html('<i class="fas fa-cart-plus" style="margin-right:5px;"></i>Ajouter');
  });
}

// ─── Remove item ─────────────────────────────────────────
function removeItem(type, id, name) {
  console.log('[panier] removeItem called', type, id, name);
  var postData = (type === 'domain')
    ? { action: 'remove', domain: name }
    : { action: 'remove_product', id: parseInt(id, 10) };

  $.ajax({
    url: '/cart_add_domain.php',
    type: 'POST',
    data: postData,
    success: function(res) {
      console.log('[panier] removeItem success', res);
      loadCart();
    },
    error: function(xhr) {
      console.error('[panier] removeItem error', xhr.status, xhr.responseText);
      loadCart();
    }
  });
}

// ─── Apply promo code ────────────────────────────────────
function applyPromo() {
  var code = $('#promoInput').val().trim();
  if (!code) return;
  $.post('cart.php', { a: 'addpromo', promocode: code }, function(html) {
    $.getJSON('cart_ajax.php', function(data) {
      if (data.promo && data.promo.code) {
        $('#promoMsg').html('<span style="color:#27ae60;"><i class="fas fa-check-circle" style="margin-right:5px;"></i>Code applied!</span>').show();
        renderCart(data.items, data.subtotal, data.total, null, data.count);
      } else {
        $('#promoMsg').html('<span style="color:#e74c3c;"><i class="fas fa-times-circle" style="margin-right:5px;"></i>Invalid or expired code.</span>').show();
      }
    });
  });
}
</script>

<script defer src="assets/js/gdpr-cookie.min.js"></script>
<script defer src="assets/js/aos.min.js"></script>
<script defer src="assets/js/jquery.lazyload-any.min.js"></script>
<script defer src="assets/js/scripts.min.js"></script>
<script defer src="assets/js/settings-init.js"></script>
</body>
</html>
