{include file="orderforms/fillsbase/common.tpl"}

<div id="order-standard_cart">
    <div class="container pb-5 mt-4">
        <div class="row">
            <!-- Search + Results -->
            <div class="col-lg-8">
                <div class="lw-search-container mb-5" style="background: linear-gradient(135deg, #fceabb 0%, #f8b500 100%); padding: 60px 40px; border-radius: 20px; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(248,181,0,0.2);">
                    <div style="position:absolute;right:-20px;bottom:-20px;opacity:0.1;transform:rotate(-15deg);">
                        <i class="fas fa-globe fa-10x text-white"></i>
                    </div>
                    <h2 class="text-white font-weight-bold mb-4" style="text-shadow:0 2px 4px rgba(0,0,0,0.1);">Trouvez votre nom de domaine</h2>
                    <div class="lw-search-box" style="background:#fff;padding:10px;border-radius:50px;display:flex;align-items:center;box-shadow:0 15px 35px rgba(0,0,0,0.1);">
                        <input type="text" id="inputDomain" class="form-control border-0 px-4"
                               placeholder="{$LANG.findyourdomain}" value="{$lookupTerm}"
                               style="height:50px;font-size:18px;border-radius:50px;flex:1;outline:none;box-shadow:none!important;" />
                        <button type="button" id="btnSearch" class="btn btn-primary"
                                style="height:50px;border-radius:50px;padding:0 40px;font-weight:700;font-size:16px;letter-spacing:1px;background:#1a1a2e;border:none;">
                            {$LANG.search}
                        </button>
                    </div>
                </div>

                <div id="lwResults">
                    <div id="lwLoading" class="text-center py-5" style="display:none;">
                        <div class="spinner-border" role="status" style="width:3rem;height:3rem;color:#50d29e!important;"></div>
                        <p class="mt-3 text-muted font-weight-bold">Vérification de la disponibilité...</p>
                    </div>
                    <div id="lwResultsList"></div>
                </div>
            </div>

            <!-- Cart Sidebar -->
            <div class="col-lg-4">
                <div class="cart-summary-card sticky-top" style="top:20px;background:#fff;border-radius:20px;border:1px solid #eee;padding:30px;box-shadow:0 5px 20px rgba(0,0,0,0.05);">
                    <h5 class="font-weight-bold mb-4" style="color:#1a1a2e;">Récapitulatif</h5>
                    <div id="lwCartContent">
                        <div class="text-center py-5 bg-light rounded mb-4" style="border:2px dashed #eee;">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3" style="opacity:.3;display:block;"></i>
                            <p class="text-muted small mb-0">Votre panier est vide.</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div id="lwTotalsArea"></div>
                    <a href="{$WEB_ROOT}/cart.php?a=view" id="btnCheckout"
                       class="btn btn-block btn-lg mt-4"
                       style="border-radius:12px;font-weight:700;background:#50d29e;border:none;color:#fff;box-shadow:0 5px 15px rgba(80,210,158,0.3);">
                        Voir le panier <i class="fas fa-chevron-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.lw-domain-item {
    background:#fff;border-radius:16px;padding:24px;margin-bottom:16px;
    display:flex;justify-content:space-between;align-items:center;
    border:1px solid #eef0f3;transition:all .3s;position:relative;overflow:hidden;
}
.lw-domain-item:hover { transform:translateY(-3px);box-shadow:0 10px 25px rgba(0,0,0,0.06); }
.lw-domain-item.available { border-color:#50d29e; }
.lw-domain-item.unavailable { border-color:#eee;opacity:.75; }
.lw-domain-item.primary { border:2px solid #50d29e;background:#f8fffb; }
.lw-domain-item.primary::before {
    content:"EXACT MATCH";position:absolute;top:0;left:0;
    background:#50d29e;color:#fff;font-size:10px;font-weight:900;
    padding:4px 12px;border-bottom-right-radius:12px;
}
.lw-domain-name { font-size:22px;font-weight:800;color:#1a1a2e; }
.lw-domain-item.primary .lw-domain-name { font-size:26px; }
.lw-domain-tld { color:#50d29e; }
.lw-domain-status { font-size:12px;font-weight:700;margin-top:5px; }
.lw-status-available { color:#27ae60; }
.lw-status-taken { color:#e74c3c; }
.lw-domain-actions { display:flex;align-items:center;gap:20px; }
.lw-price-amount { font-size:22px;font-weight:800;color:#1a1a2e; }
.lw-price-period { font-size:11px;color:#999;display:block;text-align:right; }
.lw-btn-add {
    background:#50d29e;color:#fff;border:none;padding:12px 24px;
    border-radius:12px;font-weight:700;font-size:14px;cursor:pointer;
    transition:all .2s;white-space:nowrap;box-shadow:0 4px 10px rgba(80,210,158,.2);
}
.lw-btn-add:hover { background:#3dbb8a;transform:scale(1.05); }
.lw-btn-add.added { background:#1a1a2e; }
.lw-btn-add:disabled { background:#eee;color:#bbb;cursor:not-allowed;box-shadow:none;transform:none; }
.lw-section-title {
    font-size:14px;font-weight:800;color:#1a1a2e;text-transform:uppercase;
    letter-spacing:1px;margin:24px 0 16px;display:flex;align-items:center;
}
.lw-section-title::after { content:"";flex:1;height:1px;background:#eee;margin-left:16px; }
</style>

<span id="lwConfig" data-webroot="{$WEB_ROOT}" data-lookupterm="{$lookupTerm|escape:'html'}" style="display:none"></span>
<script>
{literal}
var lwWebRoot = document.getElementById('lwConfig').getAttribute('data-webroot');
var lwLookupTerm = document.getElementById('lwConfig').getAttribute('data-lookupterm');

/* Global cart state */
var lwCart = {};

function lwAddToSidebar(domain, price) {
    var raw = parseInt(price.replace(/[^\d]/g, ''), 10) || 0;
    lwCart[domain] = { price: price, raw: raw };
    lwDrawSidebar();
}

function lwDrawSidebar() {
    var keys = Object.keys(lwCart);
    if (!keys.length) {
        jQuery('#lwCartContent').html(
            '<div class="text-center py-5 bg-light rounded mb-4" style="border:2px dashed #eee;">' +
            '<i class="fas fa-shopping-cart fa-3x text-muted mb-3" style="opacity:.3;display:block;"></i>' +
            '<p class="text-muted small mb-0">Votre panier est vide.</p></div>'
        );
        jQuery('#lwTotalsArea').html('');
        return;
    }
    var html = '', total = 0;
    jQuery.each(keys, function(i, domain) {
        var item = lwCart[domain];
        total += item.raw;
        html += '<div class="mb-2 p-3 rounded" style="background:#f8f9fa;border:1px solid #eef0f3;">' +
            '<div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#00d1b2;margin-bottom:3px;">Enregistrement</div>' +
            '<div class="d-flex justify-content-between align-items-center">' +
            '<span style="font-weight:800;color:#1a1a2e;font-size:14px;">' + domain + '</span>' +
            '<span style="font-weight:700;color:#1a1a2e;font-size:13px;">' + item.price + '</span>' +
            '</div></div>';
    });
    jQuery('#lwCartContent').html(html);
    if (total > 0) {
        var fmt = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ' FCFA';
        jQuery('#lwTotalsArea').html(
            '<div class="d-flex justify-content-between align-items-center p-3 rounded" style="background:#f8f9fa;">' +
            '<span class="font-weight-bold">Total</span>' +
            '<span class="h5 mb-0" style="color:#50d29e;">' + fmt + '</span></div>'
        );
    }
}

(function($) {
    $(document).ready(function() {
        var webRoot = lwWebRoot;

        /* Normalise price: 7,872 FCFA → 7 872 FCFA */
        function normPrice(s) {
            return (s || '').trim().replace(/(\d),(\d{3})/g, '$1 $2');
        }

        /* Extract price from WHMCS domainoptions HTML response */
        function extractPrice(html) {
            var $wrap = $('<div>').html(html);
            var el = $wrap.find('.lw-ajax-price').first();
            if (el.length) return normPrice(el.text().trim());
            var m = html.match(/[\d,\. ]+\s*FCFA/i);
            return m ? normPrice(m[0].trim()) : '';
        }

        /* Check one TLD */
        function checkTld(sld, tld, isPrimary, callback) {
            $.ajax({
                url: webRoot + '/cart.php',
                type: 'POST',
                data: { a: 'domainoptions', checktype: 'register', ajax: '1', sld: sld, tld: tld },
                timeout: 15000,
                success: function(html) {
                    var ok  = html.indexOf('domain-checker-available') !== -1;
                    var bad = html.indexOf('domain-checker-unavailable') !== -1;
                    callback({ domain: sld + tld, available: ok, taken: bad, price: ok ? extractPrice(html) : '', primary: isPrimary });
                },
                error: function() {
                    callback({ domain: sld + tld, available: false, taken: false, price: '', primary: isPrimary, error: true });
                }
            });
        }

        /* Build result card */
        function buildCard(res) {
            var parts = res.domain.split('.');
            var sld = parts[0];
            var tld = '.' + parts.slice(1).join('.');
            var statusCls  = res.available ? 'lw-status-available' : 'lw-status-taken';
            var statusIcon = res.available ? 'fa-check-circle' : 'fa-times-circle';
            var statusTxt  = res.available ? 'Disponible' : (res.error ? 'Erreur' : 'Non disponible');
            var cardCls    = 'lw-domain-item ' + (res.available ? 'available' : 'unavailable') + (res.primary ? ' primary' : '');

            var btn = res.available
                ? '<button class="lw-btn-add" data-sld="' + sld + '" data-tld="' + tld + '" data-domain="' + res.domain + '" data-price="' + res.price + '">' +
                  '<i class="fas fa-cart-plus mr-1"></i> Ajouter</button>'
                : '<button class="lw-btn-add" disabled>Non disponible</button>';

            return '<div class="' + cardCls + '">' +
                '<div class="lw-domain-info">' +
                    '<div class="lw-domain-name">' + sld + '<span class="lw-domain-tld">' + tld + '</span></div>' +
                    '<div class="lw-domain-status ' + statusCls + '"><i class="fas ' + statusIcon + ' mr-1"></i>' + statusTxt + '</div>' +
                '</div>' +
                '<div class="lw-domain-actions">' +
                    (res.price ? '<div><span class="lw-price-amount">' + res.price + '</span><span class="lw-price-period">/ an</span></div>' : '') +
                    btn +
                '</div></div>';
        }

        /* Main search */
        function performSearch(input) {
            if (!input || input.length < 2) return;
            input = input.trim().toLowerCase().replace(/^https?:\/\//, '').replace(/^www\./, '');
            var dot = input.lastIndexOf('.');
            var sld = (dot > 0 ? input.substring(0, dot) : input).replace(/[^a-z0-9\-]/g, '');
            var detectedTld = dot > 0 ? input.substring(dot) : '.com';
            if (!sld) return;

            lwCart = {};
            lwDrawSidebar();

            var tlds = ['.com', '.ml', '.sn', '.ci'];
            if (tlds.indexOf(detectedTld) === -1) tlds.unshift(detectedTld);
            else { tlds.splice(tlds.indexOf(detectedTld), 1); tlds.unshift(detectedTld); }

            $('#lwLoading').show();
            $('#lwResultsList').empty();

            var done = 0;
            var cards = new Array(tlds.length);

            function renderAll() {
                var html = '';
                $.each(cards, function(i, card) {
                    if (i === 1) html += '<div class="lw-section-title">Autres extensions</div>';
                    if (card) html += card;
                });
                $('#lwResultsList').html(html);
            }

            $.each(tlds, function(i, tld) {
                checkTld(sld, tld, i === 0, function(res) {
                    cards[i] = buildCard(res);
                    done++;
                    if (done === 1) $('#lwLoading').hide();
                    renderAll();
                });
            });
        }

        /* Add to cart via cart_add_domain.php — no redirect, then go to panier.php */
        $(document).on('click', '.lw-btn-add:not(:disabled):not(.added)', function() {
            var btn    = $(this);
            var sld    = btn.data('sld');
            var tld    = btn.data('tld');
            var domain = btn.data('domain');
            var price  = btn.data('price');

            btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> ...').prop('disabled', true);

            $.post(webRoot + '/cart_add_domain.php',
                { action: 'add', domain: domain, regperiod: 1 },
                function(res) {
                    if (res.status === 'success' || res.status === 'exists') {
                        lwAddToSidebar(domain, price);
                        btn.html('<i class="fas fa-check mr-1"></i> Ajouté').addClass('added');
                        /* Redirect to cart after short delay */
                        setTimeout(function() {
                            window.location.href = webRoot + '/panier.php';
                        }, 800);
                    } else {
                        btn.html('<i class="fas fa-cart-plus mr-1"></i> Ajouter').prop('disabled', false);
                    }
                }, 'json'
            ).fail(function() {
                btn.html('<i class="fas fa-cart-plus mr-1"></i> Ajouter').prop('disabled', false);
            });
        });

        /* Events */
        $('#btnSearch').on('click', function() { performSearch($('#inputDomain').val()); });
        $('#inputDomain').on('keydown', function(e) { if (e.which === 13) performSearch($(this).val()); });

        /* Auto-search */
        if (lwLookupTerm) performSearch(lwLookupTerm);
    });
})(jQuery);
{/literal}
</script>
