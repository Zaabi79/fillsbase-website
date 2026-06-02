<!-- Fonts Assets -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Josefin+Sans:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
<link href="{$WEB_ROOT}/assets/fonts/fontawesome/css/all.min.css" rel="stylesheet">
<link href="{$WEB_ROOT}/assets/fonts/fonts.min.css" rel="stylesheet">
<link href="{$WEB_ROOT}/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="{$WEB_ROOT}/assets/css/aos.min.css" rel="stylesheet">
<link href="{$WEB_ROOT}/assets/css/vendors.min.css" rel="stylesheet">
<link href="{$WEB_ROOT}/assets/css/theme.min.css" rel="stylesheet">
<link href="{$WEB_ROOT}/assets/css/fillsbase_custom.css?v=5.2" rel="stylesheet">


<script type="text/javascript" src="{$WEB_ROOT}/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="{$WEB_ROOT}/assets/js/gdpr-cookie.min.js"></script>
<script type="text/javascript" src="{$WEB_ROOT}/assets/js/flickity.pkgd.min.js"></script>
<script type="text/javascript" src="{$WEB_ROOT}/assets/js/flickity-fade.min.js"></script>
<script type="text/javascript" src="{$WEB_ROOT}/assets/js/popper.min.js"></script>
<script type="text/javascript" src="{$WEB_ROOT}/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{$WEB_ROOT}/assets/js/slick.min.js"></script>
<script type="text/javascript" src="{$WEB_ROOT}/assets/js/aos.min.js"></script>
<script type="text/javascript" src="{$WEB_ROOT}/assets/js/swiper.min.js"></script>
<script type="text/javascript" src="{$WEB_ROOT}/assets/js/jquery.lazyload-any.min.js"></script>
<script type="text/javascript" src="{$WEB_ROOT}/assets/js/scripts.min.js?v={time()}"></script>
<script type="text/javascript" src="{$WEB_ROOT}/assets/js/settings-init.js?v={time()}"></script>

<!-- Safeguard against missing libraries -->
<script type="text/javascript">
    if (typeof jQuery !== 'undefined') {
        if (!jQuery.fn.multiselect) {
            jQuery.fn.multiselect = function() { console.warn('multiselect placeholder called'); return this; };
        }
        // AOS Safeguard
        window.AOS = window.AOS || { init: function() { console.warn('AOS mock init'); } };
    }
</script>

<script type="text/javascript">
    var csrfToken = '{$token}',
        whmcsBaseUrl = "{\WHMCS\Utility\Environment\WebHelper::getBaseUrl()}";
</script>

<!-- Loader Safety & Theme Fix -->
<script type="text/javascript">
    $(window).on('load', function() {
        $('#spinner-area').fadeOut('slow');
    });
    // Fallback for stuck loader
    setTimeout(function() {
        $('#spinner-area').fadeOut('slow');
    }, 2000);
</script>
