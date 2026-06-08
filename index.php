<?php
// WHMCS client area routes
if (!empty($_GET["rp"])) { require_once __DIR__ . "/whmcs.php"; exit; }
/**
 * Fillsbase Route Dispatcher Fallback
 * Ensures that clean URLs (e.g., /hosting) correctly load their respective template files
 * if the server defaults to index.php as a fallback.
 */
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = rtrim($requestUri, '/');

if ($requestUri !== '' && $requestUri !== '/index.php' && $requestUri !== '/index' && $requestUri !== '/home') {
    $cleanPath = strtolower(ltrim($requestUri, '/'));
    
    // Aliases for renamed pages
    if ($cleanPath === 'gaming' || $cleanPath === 'homegaming') {
        $cleanPath = 'food-grocery';
    }
    if ($cleanPath === 'iptv') {
        $cleanPath = 'event';
    }
    if ($cleanPath === 'radiostream') {
        $cleanPath = 'radio';
    }
    if ($cleanPath === 'magento') {
        $cleanPath = 'ecommerce';
    }
    if ($cleanPath === 'ssl') {
        $cleanPath = 'fashion';
    }
    
    // 1. Check for exact file match (e.g., /hosting.html)
    if (file_exists(__DIR__ . '/' . $cleanPath) && !is_dir(__DIR__ . '/' . $cleanPath)) {
        $ext = pathinfo($cleanPath, PATHINFO_EXTENSION);
        if ($ext === 'html' || $ext === 'php') {
            include __DIR__ . '/' . $cleanPath;
            exit;
        }
    }
    
    // 2. Check for .html template match (e.g., /hosting -> hosting.html)
    if (file_exists(__DIR__ . '/' . $cleanPath . '.html')) {
        include __DIR__ . '/' . $cleanPath . '.html';
        exit;
    }
    
    // 3. Check for .php file match (e.g., /hosting -> hosting.php)
    if (file_exists(__DIR__ . '/' . $cleanPath . '.php')) {
        include __DIR__ . '/' . $cleanPath . '.php';
        exit;
    }
}

if (file_exists('init.php')) {
    require_once('init.php');
}
require_once __DIR__ . '/includes/fillsbase_helpers.php';

use WHMCS\Database\Capsule;

// Fetch TLD prices
$netPrice  = formatFillsbasePrice(getFillsbaseTldPrice('net'));
$orgPrice  = formatFillsbasePrice(getFillsbaseTldPrice('org'));
$infoPrice = formatFillsbasePrice(getFillsbaseTldPrice('info'));
$comPrice  = formatFillsbasePrice(getFillsbaseTldPrice('com'));

// Fetch Digital Business Ecosystem product prices (IDs 1-4)
$basicPrice    = formatFillsbasePrice(getFillsbaseProductPrice(1, 'monthly'));
$proPrice      = formatFillsbasePrice(getFillsbaseProductPrice(2, 'monthly'));
$enterprisePrice = formatFillsbasePrice(getFillsbaseProductPrice(3, 'monthly'));
$monthlySubPrice = formatFillsbasePrice(getFillsbaseProductPrice(4, 'monthly'));
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillsbase.com offers premium web hosting, VPS, dedicated servers, and domain name registration worldwide.">
    <link href="assets/img/fillabase fvicon.png" rel="icon" type="image/png">
    <link href="assets/img/fillabase fvicon.png" rel="apple-touch-icon">
    <title>Fillsbase.com - Web Hosting, Development & Digital Marketing</title>
    <!-- Font Style -->
    <link href="assets/fonts/fontawesome/css/all.min.css" rel='stylesheet'>
    <link href="assets/fonts/fonts.min.css" rel='stylesheet'>
    <!-- RTL Style -->
    <link type="text/css" href="assets/css/rtl/bootstrap-rtl.min.css" rel='stylesheet' class="rtl" disabled>
    <link type="text/css" href="assets/css/rtl/theme-rtl.min.css" rel='stylesheet' class="rtl" disabled>
    <!-- CSS Style -->
    <link type="text/css" href="assets/css/bootstrap.min.css" rel='stylesheet' class="ltr">
    <link type="text/css" href="assets/css/aos.min.css" rel='stylesheet'>
    <link type="text/css" href="assets/css/vendors.min.css" rel='stylesheet'>
    <link type="text/css" href="assets/css/theme.min.css" rel='stylesheet'>
    <link href="assets/css/fillsbase_custom.css?v=<?php echo time(); ?>" rel="stylesheet">
  <style>
  /* ═══════════════════════════════════════════════
     FILLSBASE HOMEPAGE — 2-COLOR LIGHT SCHEME
     Navy: #1B3673  |  Red: #C83E3C
     Light Navy: #EEF2FF #DDE6FF #C5D5FF
     Light Red:  #FFF0F0 #FFE0E0 #FECDCD
  ═══════════════════════════════════════════════ */
  :root {
    --fb-navy:       #1B3673;
    --fb-navy-mid:   #2a4a99;
    --fb-navy-light: #EEF2FF;
    --fb-navy-soft:  #DDE6FF;
    --fb-red:        #C83E3C;
    --fb-red-light:  #FFF0F0;
    --fb-red-soft:   #FFE0E0;
    --fb-white:      #ffffff;
    --fb-text:       #1a2340;
    --fb-muted:      #5a6a8a;
  }

  /* Body background — clean white */
  body[data-background=origin] .box-container { background: var(--fb-white) !important; }

  /* ── ANNOUNCEMENT BAR ── */
  .infonews { background: var(--fb-navy) !important; }
  .infonews *, .infonews a, .infonews .iconews { color: #fff !important; }
  .infonews .news span { color: var(--fb-red-soft) !important; }

  /* ── HEADER / NAVBAR — restore original peach gradient ── */
  .menu-wrap:not(.mobile),
  .menu-wrap.fixed:not(.mobile) {
    background: linear-gradient(to right, #ffffff 0%, #f0f4ff 25%, #c8d8f0 55%, #f5b8a0 80%, #f9cfa0 100%) !important;
    border-bottom: none !important;
    box-shadow: none !important;
  }
  .nav-menu .main-menu .menu-item > a { color: #1a1a2e !important; }
  .nav-menu .main-menu .menu-item:hover > a { color: var(--fb-red) !important; }
  .nav-menu .menu-toggle .icon { background-color: #1a1a2e !important; }

  /* ── HERO SECTION — restore original peach gradient ── */
  .hero-new {
    background: linear-gradient(to right, #ffffff 0%, #f0f4ff 25%, #c8d8f0 55%, #f5b8a0 80%, #f9cfa0 100%) !important;
  }
  .hero-main-title { color: var(--fb-navy) !important; }
  .hero-sub-title { color: var(--fb-muted) !important; }
  .hero-pill-badge {
    background: rgba(255,255,255,0.7) !important;
    color: var(--fb-navy) !important;
    border: 1px solid rgba(27,54,115,0.15) !important;
    backdrop-filter: blur(8px);
  }
  .hero-pill-badge:hover { background: var(--fb-navy) !important; color: #fff !important; }
  .hero-cards-grid .card-item { background: rgba(255,255,255,0.85) !important; border: 1px solid rgba(255,255,255,0.6) !important; backdrop-filter: blur(10px); }
  .hero-cards-grid .card-item:hover { border-color: var(--fb-red) !important; box-shadow: 0 12px 40px rgba(200,62,60,0.12) !important; }
  .hero-cards-grid h3 { font-size: 1.25rem !important; line-height: 1.35 !important; }
  .hero-search-form { background: transparent !important; border: none !important; box-shadow: none !important; }
  .hero-search-btn { background: var(--fb-navy) !important; }
  .hero-search-btn:hover { background: var(--fb-red) !important; }

  /* ── PROCESS SECTION ── */
  .process-section { background: var(--fb-navy-light) !important; }
  .process-step-num { background: var(--fb-navy) !important; color: #fff !important; }
  .process-line { background: var(--fb-navy-soft) !important; }

  /* ══════════════════════════════════════════════
     SEAMLESS SECTION FLOW — no hard breaks
     All sections: zero margin, continuous bg
  ══════════════════════════════════════════════ */
  /* Remove all default section gaps */
  section, .section { margin-top: 0 !important; margin-bottom: 0 !important; }

  /* Unified padding for every section */
  .dbe-pricing-section   { padding-top: 80px !important; padding-bottom: 80px !important; }
  .why-choose-new        { padding-top: 72px !important; padding-bottom: 72px !important; }
  .sol-section           { padding-top: 72px !important; padding-bottom: 72px !important; }
  .services.help         { padding-top: 60px !important; padding-bottom: 60px !important; }

  /* ── 1. HERO → USE-CASES: white, no separator ── */
  .usecases-section {
    background: linear-gradient(180deg,
      #ffffff 0%,
      #ffffff 50%,
      #fdf3ec 75%,
      #fde8d8 100%
    ) !important;
  }

  /* ── 2. DBE PRICING SECTION ── */
  .dbe-pricing-section {
    padding: 80px 0 80px;
    background: linear-gradient(180deg, #fde8d8 0%, #f9ddc8 35%, #f5d0b5 65%, #fbe8d5 100%);
  }
  .dbe-eyebrow { font-size: 0.85rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: #C83E3C; margin-bottom: 6px; }
  .dbe-main-title { font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 900; color: #1B3673; line-height: 1.1; margin-bottom: 0; }

  /* Cards */
  .dbe-card { background: #fff; border-radius: 18px; border: 2px solid #e8e8e8; overflow: hidden; display: flex; flex-direction: column; height: 100%; transition: transform 0.28s ease, box-shadow 0.28s ease; }
  .dbe-card:hover { transform: translateY(-6px); box-shadow: 0 24px 56px rgba(27,54,115,0.14); }
  .dbe-card-featured { background: #1B3673; border-color: #1B3673; color: #fff; }
  .dbe-card-badge { display: inline-block; background: #fde8d8; color: #C83E3C; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.12em; padding: 6px 18px; border-radius: 50px; margin: 20px 20px 0; width: fit-content; }
  .dbe-card-featured .dbe-card-badge { background: rgba(255,255,255,0.18); color: #fff; }
  .dbe-card-top { padding: 16px 24px 20px; flex: 1; }
  .dbe-plan-subtitle { font-size: 0.78rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: #888; margin-bottom: 14px; }
  .dbe-card-featured .dbe-plan-subtitle { color: rgba(255,255,255,0.65); }
  .dbe-features { list-style: none; padding: 0; margin: 0 0 18px; }
  .dbe-features li { font-size: 0.9rem; color: #444; padding: 5px 0; display: flex; align-items: center; gap: 8px; }
  .dbe-features li i { color: #1B3673; font-size: 0.85rem; flex-shrink: 0; }
  .dbe-card-featured .dbe-features li { color: rgba(255,255,255,0.9); }
  .dbe-card-featured .dbe-features li i { color: #7dd3fc; }
  .dbe-price { font-size: 2.2rem; font-weight: 900; color: #1B3673; margin-top: 10px; }
  .dbe-price::before { content: 'AED '; font-size: 1rem; font-weight: 700; vertical-align: top; margin-top: 8px; display: inline-block; }
  .dbe-card-featured .dbe-price { color: #fff; }
  .dbe-btn { display: block; text-align: center; background: #111; color: #fff !important; font-weight: 800; font-size: 0.9rem; letter-spacing: 0.08em; padding: 14px 24px; margin: 0 20px 20px; border-radius: 50px; transition: background 0.22s ease; text-decoration: none; }
  .dbe-btn:hover { background: #1B3673; color: #fff !important; }
  .dbe-btn-featured { background: #00c6f0; color: #fff !important; }
  .dbe-btn-featured:hover { background: #00a8cf; }

  /* Legend + Contacts */
  .dbe-legend { list-style: none; padding: 0; margin: 0; }
  .dbe-legend li { font-size: 0.88rem; color: #444; padding: 4px 0; display: flex; align-items: center; gap: 8px; }
  .dbe-contacts { display: flex; flex-direction: column; gap: 8px; }
  .dbe-contact-btn { display: flex; align-items: center; gap: 10px; background: #1B3673; color: #fff !important; font-size: 0.88rem; font-weight: 700; padding: 11px 20px; border-radius: 50px; text-decoration: none; width: fit-content; transition: background 0.22s; }
  .dbe-contact-btn:hover { background: #C83E3C; }
  .dbe-contact-btn i { font-size: 1.1rem; }

  /* Monthly subscription box */
  .dbe-monthly-box { background: linear-gradient(135deg, #1B3673 0%, #2a4fa8 100%); border-radius: 18px; padding: 28px; color: #fff; }
  .dbe-monthly-title { font-size: 1.1rem; font-weight: 800; color: #fff; }
  .dbe-monthly-price { color: #7dd3fc; font-size: 1.4rem; font-weight: 900; }
  .dbe-monthly-price::before { content: 'AED '; font-size: 0.9rem; font-weight: 700; }
  .dbe-monthly-list { list-style: none; padding: 0; margin: 0; }
  .dbe-monthly-list li { font-size: 0.85rem; color: rgba(255,255,255,0.9); padding: 4px 0; display: flex; align-items: center; gap: 8px; }
  .dbe-monthly-list li i { color: #7dd3fc; font-size: 0.8rem; }
  .dbe-first-free { font-size: 1rem; font-weight: 900; color: #fff; text-align: center; margin-top: 16px; padding: 10px; border: 2px solid rgba(255,255,255,0.3); border-radius: 10px; }
  .dbe-btn-monthly { background: #fff; color: #1B3673 !important; margin: 0; }
  .dbe-btn-monthly:hover { background: #C83E3C; color: #fff !important; }

  /* ── 3. WHY CHOOSE: continues peach → fades to white ── */
  .why-choose-new {
    background: linear-gradient(180deg,
      #fbe8d5 0%,
      #fdf3ec 30%,
      #fff8f5 65%,
      #ffffff 100%
    ) !important;
  }
  .why-box { background: rgba(255,255,255,0.92) !important; border: 1px solid var(--fb-red-soft) !important; border-radius: 16px; }
  .why-box:hover { border-color: var(--fb-navy) !important; box-shadow: 0 12px 40px rgba(27,54,115,0.1) !important; }
  .why-box .icon-wrap { background: var(--fb-navy-light) !important; color: var(--fb-navy) !important; }

  /* ── 4. SOLUTIONS: white → soft blue ── */
  .sol-section {
    background: linear-gradient(180deg,
      #ffffff 0%,
      #f0f4ff 25%,
      #e8f0fb 60%,
      #eef3fc 100%
    ) !important;
  }
  .sol-divider { background: linear-gradient(90deg, transparent, var(--fb-navy-soft), transparent) !important; }

  /* ── 5. HELP: continues blue tint → fades to white ── */
  .services.help {
    background: linear-gradient(180deg,
      #eef3fc 0%,
      #f4f7ff 35%,
      #fafbff 70%,
      #ffffff 100%
    ) !important;
  }
  .help-container { background: rgba(255,255,255,0.95) !important; border: 1px solid var(--fb-navy-soft) !important; border-radius: 16px; transition: all .25s; }
  .help-container:hover { border-color: var(--fb-red) !important; box-shadow: 0 12px 32px rgba(200,62,60,0.1) !important; transform: translateY(-4px); }

  /* ── SERVICE / FEATURE CARDS ── */
  .service-section.bg-seccolorstyle { background: var(--fb-white) !important; border: 1px solid var(--fb-navy-light) !important; border-radius: 16px; }
  .service-section.bg-seccolorstyle:hover { border-color: var(--fb-navy-soft) !important; box-shadow: 0 12px 40px rgba(27,54,115,0.08) !important; }

  /* ── GLOBAL TEXT ── */
  .mergecolor { color: var(--fb-navy) !important; }
  .seccolor, .text-muted { color: var(--fb-muted) !important; }
  .section-heading { color: var(--fb-navy) !important; }

  /* ── BUTTONS ── */
  .btn-default-pink-fill, .btn-default-yellow-fill {
    background: var(--fb-red) !important;
    border-color: var(--fb-red) !important;
    color: #fff !important;
    border-radius: 50px !important;
    padding: 12px 28px !important;
    font-weight: 700 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    box-shadow: 0 8px 24px rgba(200,62,60,0.25) !important;
    transition: all 0.25s ease !important;
  }
  .btn-default-pink-fill:hover, .btn-default-yellow-fill:hover {
    background: var(--fb-navy) !important;
    border-color: var(--fb-navy) !important;
    box-shadow: 0 12px 32px rgba(27,54,115,0.3) !important;
    transform: translateY(-2px) !important;
  }
  /* ── SOLUTIONS CARDS ── */
  .sol-eyebrow { display:inline-flex; align-items:center; gap:6px; background:rgba(238,85,134,0.1); color:#ee5586; border:1px solid rgba(238,85,134,0.25); border-radius:50px; padding:5px 16px; font-size:0.8rem; font-weight:700; letter-spacing:0.06em; margin-bottom:12px; }
  .sol-title { font-size:clamp(1.5rem,3vw,2.2rem); font-weight:900; color:#1B3673; margin-bottom:8px; }
  .sol-sub { font-size:0.95rem; color:#666; max-width:520px; margin:0 auto; }
  .sol-card { border-radius:18px; border:1.5px solid #e8eaf0; background:#fff; overflow:hidden; display:flex; flex-direction:column; height:100%; transition:transform 0.26s ease, box-shadow 0.26s ease; }
  .sol-card:hover { transform:translateY(-6px); box-shadow:0 20px 48px rgba(27,54,115,0.12); }
  .sol-card-img { position:relative; height:200px; overflow:hidden; }
  .sol-mockup-bar { position:absolute; top:0; left:0; right:0; height:22px; background:rgba(0,0,0,0.35); display:flex; align-items:center; padding:0 10px; gap:5px; z-index:2; }
  .sol-mockup-bar span { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,0.35); }
  .sol-mockup-bar span:first-child { background:#ff5f57; }
  .sol-mockup-bar span:nth-child(2) { background:#febc2e; }
  .sol-mockup-bar span:nth-child(3) { background:#28c840; }
  .sol-screenshots { position:absolute; inset:22px 0 0; display:flex; align-items:flex-end; justify-content:center; gap:8px; padding:8px 10px 0; }
  .sol-ss { border-radius:8px 8px 0 0; object-fit:cover; box-shadow:0 8px 24px rgba(0,0,0,0.35); transition:transform 0.3s ease; }
  .sol-ss-main { width:58%; height:140px; }
  .sol-ss-side { width:34%; height:110px; opacity:0.85; }
  .sol-card:hover .sol-ss { transform:translateY(-4px); }
  .sol-tag { position:absolute; top:30px; right:10px; padding:4px 11px; border-radius:50px; font-size:0.7rem; font-weight:700; color:#fff; display:flex; align-items:center; gap:5px; z-index:3; }
  /* X Music visual */
  .sol-music-vis { position:absolute; inset:22px 0 0; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:10px; }
  .sol-music-icon { width:56px; height:56px; border-radius:50%; background:rgba(255,255,255,0.15); display:flex; align-items:center; justify-content:center; font-size:1.4rem; color:#fff; border:2px solid rgba(255,255,255,0.25); }
  .sol-music-bars { display:flex; align-items:flex-end; gap:4px; height:36px; }
  .sol-music-bars span { width:5px; border-radius:3px 3px 0 0; background:rgba(255,255,255,0.7); animation:solBeat 1.1s ease-in-out infinite; }
  .sol-music-bars span:nth-child(1){height:14px;animation-delay:0s}
  .sol-music-bars span:nth-child(2){height:28px;animation-delay:0.15s}
  .sol-music-bars span:nth-child(3){height:20px;animation-delay:0.3s}
  .sol-music-bars span:nth-child(4){height:36px;animation-delay:0.45s}
  .sol-music-bars span:nth-child(5){height:22px;animation-delay:0.6s}
  .sol-music-bars span:nth-child(6){height:30px;animation-delay:0.75s}
  .sol-music-bars span:nth-child(7){height:16px;animation-delay:0.9s}
  @keyframes solBeat { 0%,100%{transform:scaleY(1)}50%{transform:scaleY(0.4)} }
  .sol-music-label { font-size:0.72rem; color:rgba(255,255,255,0.6); font-weight:600; letter-spacing:0.05em; }
  .sol-card-body { padding:20px 22px 22px; flex:1; display:flex; flex-direction:column; }
  .sol-card-title { font-size:1.2rem; font-weight:800; color:#1B3673; margin-bottom:8px; }
  .sol-card-desc { font-size:0.85rem; color:#666; line-height:1.6; margin-bottom:14px; flex:1; }
  .sol-card-feats { list-style:none; padding:0; margin:0 0 18px; }
  .sol-card-feats li { font-size:0.82rem; color:#444; padding:3px 0; display:flex; align-items:center; gap:7px; }
  .sol-card-feats li i { font-size:0.75rem; flex-shrink:0; }
  .sol-card-btns { display:flex; gap:10px; flex-wrap:wrap; margin-top:auto; }
  .sol-cta-primary { display:inline-flex; align-items:center; gap:7px; background:#1B3673; color:#fff !important; padding:9px 20px; border-radius:50px; font-size:0.82rem; font-weight:700; text-decoration:none; transition:background 0.22s; }
  .sol-cta-primary:hover { background:#C83E3C; color:#fff !important; }
  .sol-cta-ghost { display:inline-flex; align-items:center; gap:7px; background:transparent; color:#1B3673 !important; padding:8px 18px; border-radius:50px; font-size:0.82rem; font-weight:700; border:1.5px solid rgba(27,54,115,0.25); text-decoration:none; transition:all 0.22s; }
  .sol-cta-ghost:hover { border-color:#C83E3C; color:#C83E3C !important; }

  /* ── HERO CTA BUTTONS ── */
  .hero-cta-btns { display:flex; gap:16px; justify-content:center; flex-wrap:wrap; margin-top:28px; margin-bottom:8px; }
  .hero-btn-primary {
    display:inline-flex; align-items:center; gap:10px;
    background: #1B3673;
    color:#fff !important; text-decoration:none;
    padding:14px 32px; border-radius:50px;
    font-weight:700; font-size:1rem;
    box-shadow:0 8px 28px rgba(27,54,115,0.3);
    transition:all 0.25s ease;
  }
  .hero-btn-primary:hover { background:#C83E3C; box-shadow:0 12px 36px rgba(200,62,60,0.4); transform:translateY(-3px); color:#fff !important; }
  .hero-btn-ghost {
    display:inline-flex; align-items:center; gap:10px;
    background:transparent;
    color:#1B3673 !important; text-decoration:none;
    padding:13px 30px; border-radius:50px;
    font-weight:700; font-size:1rem;
    border:2px solid rgba(27,54,115,0.35);
    transition:all 0.25s ease;
  }
  .hero-btn-ghost:hover { border-color:#C83E3C; color:#C83E3C !important; transform:translateY(-3px); }

  /* ── PILLS / BADGES ── */
  .badge.bg-pink { background: var(--fb-red) !important; }
  .badge.bg-purple { background: var(--fb-navy) !important; }
  .c-pink { color: var(--fb-red) !important; }
  .bg-pink { background-color: var(--fb-red) !important; }

  /* ── FOOTER ── */
  #footer { background: var(--fb-navy) !important; }
  #footer * { color: rgba(255,255,255,0.85) !important; }
  #footer .golink, #footer a:hover { color: var(--fb-red-soft) !important; }

  /* ── RANDOMLINE DECORATORS ── */
  .bigline { background: var(--fb-navy) !important; }
  .smallline { background: var(--fb-red) !important; }

  /* ── SCROLLBAR ── */
  ::-webkit-scrollbar-thumb { background: var(--fb-navy-soft) !important; }
  ::-webkit-scrollbar-thumb:hover { background: var(--fb-navy) !important; }
  </style>
  </head>
  <body data-layout="wideboxed" data-background="origin" data-color="green" data-header="" data-textDirection="ltr" data-radius="sixradius">

    <div class="box-container limit-width">
      <!-- ***** SETTINGS ****** -->
    <section id="settings"> </section>
    <!-- ***** LOADING PAGE ****** -->
    <div id="spinner-area">
      <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
        <div class="spinner-txt">Fillsbase...</div>
      </div>
    </div>
    <!-- ***** FRAME MODE ****** -->
    <div class="body-borders" data-border="20">
      <div class="top-border bg-white"></div>
      <div class="right-border bg-white"></div>
      <div class="bottom-border bg-white"></div>
      <div class="left-border bg-white"></div>
    </div>
    <!-- ***** UPLOADED MENU FROM HEADER.HTML ***** -->
  <header id="header"><?php include __DIR__ . '/header.php'; ?></header>
  <!-- ***** HERO NEW ***** -->
  <section class="main-container hero-new">
    <div class="hero-bg-orb hero-orb-1"></div>
    <div class="hero-bg-orb hero-orb-2"></div>
    <div class="hero-bg-orb hero-orb-3"></div>
    <div class="container" style="position:relative;z-index:2;">
      <!-- Hero Top: Pill Badge + Headline -->
      <div class="hero-top-text text-center mb-4">
        <a href="/promos" class="hero-pill-badge">
          <i class="fas fa-tags me-1"></i> Special Offers Live Now &nbsp;<i class="fas fa-arrow-right"></i>
        </a>
        <h1 class="hero-main-title" data-i18n="hero.main_title">Innovate Your Business with Our Ecosystem</h1>
        <p class="hero-sub-title" data-i18n="hero.sub_title" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-size:clamp(0.55rem,1.1vw,1rem);">Website &bull; Domain &bull; Hosting &bull; CRM &bull; Business Dashboard &bull; SEO &bull; Booking &bull; Mobile Apps &bull; Social Media &bull; Custom Software</p>
        <!-- Hero CTA Buttons -->
        <div class="hero-cta-btns">
          <a href="hosting" class="hero-btn-primary"><i class="fas fa-rocket"></i> Get Started</a>
          <a href="#solutions" class="hero-btn-ghost">Discover More <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <!-- Domain Search Wrapper -->
      <div class="hero-domain-wrapper">
        <form class="hero-search-form" id="heroSearchForm" action="javascript:void(0);" method="post">
          <input type="text" name="query" id="domainSearchInput" placeholder="Search your domain here..." autocapitalize="none" autocomplete="off">
          <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
          <!-- Suggestions Dropdown -->
          <div id="domainSuggestions" class="domain-suggestions-dropdown" style="display: none;">
            <div class="suggestions-list">
              <!-- Results will be injected here -->
            </div>
            <div class="suggestions-footer">
              <span data-i18n="homepage.search_more">Search more extensions...</span>
            </div>
          </div>
        </form>
        <div class="hero-tlds-list d-none d-lg-flex">
          <div class="tld-card" onclick="$('#domainSearchInput').val('domain.com').focus();">
            <span class="tld-name">.com</span>
            <span class="tld-price"><?php echo $comPrice; ?> /an</span>
          </div>
          <div class="tld-card" onclick="$('#domainSearchInput').val('domain.net').focus();">
            <span class="tld-name">.net</span>
            <span class="tld-price"><?php echo $netPrice; ?> /an</span>
          </div>
          <div class="tld-card" onclick="$('#domainSearchInput').val('domain.org').focus();">
            <span class="tld-name">.org</span>
            <span class="tld-price"><?php echo $orgPrice; ?> /an</span>
          </div>
          <div class="tld-card" onclick="$('#domainSearchInput').val('domain.info').focus();">
            <span class="tld-name">.info</span>
            <span class="tld-price"><?php echo $infoPrice; ?> /an</span>
          </div>
        </div>

      </div>

      <!-- Feature Cards Grid -->
      <div class="hero-cards-grid">
        <!-- Card 1: Hosting -->
        <div class="feature-card white">
          <div class="card-text">
            <span class="card-tag" data-i18n="hero.tag_hosting">HOSTING & DOMAIN</span>
            <h3 data-i18n="hero.hosting_title">Fast & Reliable Hosting with Free Domain!</h3>
            <a href="hosting" class="card-btn" data-i18n="hero.btn_get_started">Get Started <i class="fas fa-arrow-right"></i></a>
          </div>
          <img src="assets/img/hero-hosting.png" alt="Hosting Mockup" class="card-mockup-img">
        </div>

        <!-- Card 2: Websites -->
        <div class="feature-card teal">
          <div class="card-text">
            <span class="card-tag" data-i18n="hero.tag_development">WEB DEVELOPMENT</span>
            <h3 data-i18n="hero.websites_title">Custom Web & App Development</h3>
            <a href="aiagents" class="card-btn" data-i18n="hero.btn_get_started">Get Started <i class="fas fa-arrow-right"></i></a>
          </div>
          <img src="assets/img/hero-website.png" alt="Website Mockup" class="card-mockup-img">
        </div>

        <!-- Card 3: SEO -->
        <div class="feature-card white">
          <div class="card-text">
            <span class="card-tag" data-i18n="hero.tag_seo">SEO & MARKETING</span>
            <h3 data-i18n="hero.seo_title">Grow Your Business with Expert SEO!</h3>
            <a href="seo" class="card-btn" data-i18n="hero.btn_explore">Explore Plans <i class="fas fa-arrow-right"></i></a>
          </div>
          <img src="assets/img/hero-seo.png" alt="SEO Mockup" class="card-mockup-img">
        </div>

        <!-- Card 4: AI -->
        <div class="feature-card ai-card">
          <div class="card-text">
            <span class="card-tag ai-tag">
              <i class="fas fa-microchip me-1"></i> AI &amp; AUTOMATION
            </span>
            <h3 class="ai-title">Boost your Business with AI</h3>
            <ul class="ai-features-list">
              <li><i class="fas fa-check-circle"></i> Custom AI Agents</li>
              <li><i class="fas fa-check-circle"></i> Intelligent Automation</li>
              <li><i class="fas fa-check-circle"></i> Chatbots &amp; Assistants</li>
            </ul>
            <a href="aiagents" class="card-btn ai-btn">Discover <i class="fas fa-arrow-right ms-1"></i></a>
          </div>
          <div class="ai-orb ai-orb-1"></div>
          <div class="ai-orb ai-orb-2"></div>
          <div class="ai-circuit">
            <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="100" cy="100" r="60" stroke="rgba(80,210,158,0.15)" stroke-width="1"/>
              <circle cx="100" cy="100" r="40" stroke="rgba(80,210,158,0.2)" stroke-width="1"/>
              <circle cx="100" cy="100" r="20" stroke="rgba(80,210,158,0.3)" stroke-width="1" fill="rgba(80,210,158,0.08)"/>
              <line x1="100" y1="0" x2="100" y2="40" stroke="rgba(80,210,158,0.25)" stroke-width="1"/>
              <line x1="100" y1="160" x2="100" y2="200" stroke="rgba(80,210,158,0.25)" stroke-width="1"/>
              <line x1="0" y1="100" x2="40" y2="100" stroke="rgba(80,210,158,0.25)" stroke-width="1"/>
              <line x1="160" y1="100" x2="200" y2="100" stroke="rgba(80,210,158,0.25)" stroke-width="1"/>
              <circle cx="100" cy="0" r="4" fill="rgba(80,210,158,0.5)"/>
              <circle cx="100" cy="200" r="4" fill="rgba(80,210,158,0.5)"/>
              <circle cx="0" cy="100" r="4" fill="rgba(80,210,158,0.5)"/>
              <circle cx="200" cy="100" r="4" fill="rgba(80,210,158,0.5)"/>
              <circle cx="57" cy="57" r="3" fill="rgba(80,210,158,0.4)"/>
              <circle cx="143" cy="57" r="3" fill="rgba(80,210,158,0.4)"/>
              <circle cx="57" cy="143" r="3" fill="rgba(80,210,158,0.4)"/>
              <circle cx="143" cy="143" r="3" fill="rgba(80,210,158,0.4)"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ***** WHO IS FILLSBASE FOR ***** -->
  <style>
    .usecases-section { padding: 60px 0 40px; background: transparent; overflow: visible; position: relative; }
    .uc-heading-row { margin-bottom: 36px; }
    .uc-main-title { font-size: clamp(1.4rem, 2.5vw, 2rem); font-weight: 800; color: #111; line-height: 1.2; margin: 0; letter-spacing: -0.01em; white-space: nowrap; }
    .uc-scroll-outer { width: 100%; overflow: hidden; }
    .usecases-scroll { padding-left: max(24px, calc((100vw - 1140px) / 2)); padding-right: 24px; }
    .usecases-scroll { display:flex; gap:18px; overflow-x:auto; padding-bottom:8px; scroll-snap-type:x mandatory; -webkit-overflow-scrolling:touch; scrollbar-width:none; }
    .usecases-scroll::-webkit-scrollbar { display:none; }
    .usecase-card {
      flex: 0 0 280px;
      height: 380px;
      border-radius: 18px;
      position: relative;
      overflow: hidden;
      cursor: pointer;
      scroll-snap-align: start;
      text-decoration: none;
      display: block;
      transition: transform 0.32s ease, box-shadow 0.32s ease;
    }
    .usecase-card:hover { transform: translateY(-8px); box-shadow: 0 28px 64px rgba(0,0,0,0.22); }
    .usecase-card .uc-bg {
      position: absolute; inset: 0;
      background-size: cover !important;
      background-position: center center !important;
      transition: transform 0.55s ease;
    }
    .usecase-card:hover .uc-bg { transform: scale(1.07); }
    /* always-on dark overlay, stronger at bottom */
    .usecase-card .uc-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(to top,
        rgba(8,12,35,0.92) 0%,
        rgba(8,12,35,0.45) 45%,
        rgba(8,12,35,0.10) 100%);
      transition: background 0.32s ease;
    }
    .usecase-card:hover .uc-overlay {
      background: linear-gradient(to top,
        rgba(8,12,35,0.96) 0%,
        rgba(8,12,35,0.55) 55%,
        rgba(8,12,35,0.18) 100%);
    }
    .usecase-card .uc-badge {
      position: absolute; top: 14px; right: 14px;
      background: #C83E3C; color: #fff;
      font-size: 0.62rem; font-weight: 800; letter-spacing: 0.08em;
      padding: 3px 10px; border-radius: 50px; text-transform: uppercase;
      z-index: 3;
    }
    .usecase-card .uc-info {
      position: absolute; bottom: 0; left: 0; right: 0;
      padding: 26px 22px 24px;
      z-index: 3;
    }
    .usecase-card .uc-title {
      font-size: 1.18rem; font-weight: 700; color: #fff;
      margin: 0 0 6px; line-height: 1.3;
    }
    .usecase-card .uc-desc {
      font-size: 0.82rem; color: rgba(255,255,255,0.78);
      margin: 0; line-height: 1.55;
      max-height: 0; overflow: hidden;
      transition: max-height 0.38s ease, opacity 0.38s ease;
      opacity: 0;
    }
    .usecase-card:hover .uc-desc { max-height: 72px; opacity: 1; }
    .usecases-nav { display:flex; justify-content:center; align-items:center; gap:12px; margin-top:24px; margin-bottom:0; }
    .usecases-nav button {
      width:36px; height:36px; border-radius:50%; border:2px solid rgba(27,54,115,0.2);
      background:#fff; color:#1B3673; cursor:pointer; font-size:0.9rem;
      display:flex; align-items:center; justify-content:center;
      transition:all 0.2s;
    }
    .usecases-nav button:hover { background:#1B3673; color:#fff; border-color:#1B3673; }
    .usecases-dots { display:flex; gap:7px; align-items:center; }
    .usecases-dots span { width:7px; height:7px; border-radius:50%; background:rgba(27,54,115,0.2); cursor:pointer; transition:all 0.2s; }
    .usecases-dots span.active { background:#1B3673; width:22px; border-radius:50px; }
  </style>
  <section class="usecases-section">
    <div class="container">
      <div class="uc-heading-row">
        <h2 class="uc-main-title">Who is Fillsbase for? See for yourself</h2>
      </div>
    </div>
    <div class="uc-scroll-outer">
      <div class="usecases-scroll" id="usecasesScroll">

        <!-- Fashion Store -->
        <a href="ecommerce" class="usecase-card">
          <div class="uc-bg" style="background-image:url('assets/img/ai_merchandising_fashion_1778941238829.png');"></div>
          <div class="uc-overlay"></div>
          <div class="uc-info">
            <p class="uc-title">Fashion Store</p>
            <p class="uc-desc">Stylish online stores for clothing, accessories & lifestyle brands.</p>
          </div>
        </a>

        <!-- Ecommerce -->
        <a href="ecommerce" class="usecase-card">
          <div class="uc-bg" style="background-image:url('assets/img/ecommerce_platform_bg.png');"></div>
          <div class="uc-overlay"></div>
          <span class="uc-badge">NEW</span>
          <div class="uc-info">
            <p class="uc-title">Ecommerce</p>
            <p class="uc-desc">Full-featured online shops with payments, inventory & analytics.</p>
          </div>
        </a>

        <!-- Classifieds -->
        <a href="classifieds" class="usecase-card">
          <div class="uc-bg" style="background-image:url('assets/img/classifieds_hero_bg.png');"></div>
          <div class="uc-overlay"></div>
          <span class="uc-badge">NEW</span>
          <div class="uc-info">
            <p class="uc-title">Classifieds</p>
            <p class="uc-desc">Marketplace platforms for buying, selling and listing anything.</p>
          </div>
        </a>

        <!-- Blog & News -->
        <a href="news-blogging" class="usecase-card">
          <div class="uc-bg" style="background-image:url('assets/img/news_hero_bg.png');"></div>
          <div class="uc-overlay"></div>
          <div class="uc-info">
            <p class="uc-title">Blog & News</p>
            <p class="uc-desc">Content-rich news portals and blogs with SEO built in.</p>
          </div>
        </a>

        <!-- eLearning -->
        <a href="elearning" class="usecase-card">
          <div class="uc-bg" style="background-image:url('assets/img/elearning_hero_bg.png');"></div>
          <div class="uc-overlay"></div>
          <div class="uc-info">
            <p class="uc-title">eLearning</p>
            <p class="uc-desc">Online course platforms with video lessons, quizzes & certificates.</p>
          </div>
        </a>

        <!-- Portfolio -->
        <a href="business-portfolio" class="usecase-card">
          <div class="uc-bg" style="background-image:url('assets/img/portfolio_hero_bg.png');"></div>
          <div class="uc-overlay"></div>
          <div class="uc-info">
            <p class="uc-title">Portfolio</p>
            <p class="uc-desc">Stunning personal and agency portfolios that win clients.</p>
          </div>
        </a>

        <!-- Event Platform -->
        <a href="event" class="usecase-card">
          <div class="uc-bg" style="background-image:url('assets/img/event_platform_bg.png');"></div>
          <div class="uc-overlay"></div>
          <div class="uc-info">
            <p class="uc-title">Event Platform</p>
            <p class="uc-desc">Ticketing, RSVP & event management for any scale.</p>
          </div>
        </a>

        <!-- Food & Grocery -->
        <a href="food-grocery" class="usecase-card">
          <div class="uc-bg" style="background-image:url('assets/img/food_grocery_bg.png');"></div>
          <div class="uc-overlay"></div>
          <span class="uc-badge">NEW</span>
          <div class="uc-info">
            <p class="uc-title">Food & Grocery</p>
            <p class="uc-desc">Online ordering, delivery tracking & menu management systems.</p>
          </div>
        </a>

        <!-- Radio Streaming -->
        <a href="radio" class="usecase-card">
          <div class="uc-bg" style="background-image:url('assets/img/radio_platform_bg.png');"></div>
          <div class="uc-overlay"></div>
          <div class="uc-info">
            <p class="uc-title">Radio Streaming</p>
            <p class="uc-desc">Live audio streaming platforms with player & schedule pages.</p>
          </div>
        </a>

      </div>
    </div><!-- end uc-scroll-outer -->
    <div class="container">
      <!-- Navigation -->
      <div class="usecases-nav">
        <button id="ucPrev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
        <div class="usecases-dots" id="usecasesDots">
          <span class="active"></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
        </div>
        <button id="ucNext" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
      </div>
    </div>
  </section>
  <script>
    (function(){
      var scroll = document.getElementById('usecasesScroll');
      var dots = document.querySelectorAll('#usecasesDots span');
      var cardW = 280 + 18; // card width + gap
      if(!scroll) return;
      function updateDots(){
        var idx = Math.min(Math.round(scroll.scrollLeft / cardW), dots.length - 1);
        dots.forEach(function(d,i){ d.classList.toggle('active', i===idx); });
      }
      scroll.addEventListener('scroll', updateDots);
      dots.forEach(function(d,i){
        d.addEventListener('click', function(){ scroll.scrollTo({ left: i * cardW, behavior:'smooth' }); });
      });
      document.getElementById('ucPrev').addEventListener('click', function(){
        scroll.scrollBy({ left: -(cardW * 3), behavior:'smooth' });
      });
      document.getElementById('ucNext').addEventListener('click', function(){
        scroll.scrollBy({ left: cardW * 3, behavior:'smooth' });
      });
    })();
  </script>

  <!-- ***** PRICING TABLES ***** -->
  <!-- ===== DIGITAL BUSINESS ECOSYSTEM PRICING ===== -->
  <section class="dbe-pricing-section">
    <div class="container">
      <div class="text-center mb-5">
        <p class="dbe-eyebrow">Digital Business Ecosystem</p>
        <h2 class="dbe-main-title">Pricing Plans</h2>
      </div>

      <div class="row g-4 justify-content-center">

        <!-- Basic Plan -->
        <div class="col-sm-12 col-md-6 col-lg-4">
          <div class="dbe-card">
            <div class="dbe-card-badge">BASIC PLAN</div>
            <div class="dbe-card-top">
              <p class="dbe-plan-subtitle">BUSINESS WEBSITE</p>
              <ul class="dbe-features">
                <li><i class="fas fa-check-circle"></i> Domain</li>
                <li><i class="fas fa-check-circle"></i> Hosting &amp; SSL</li>
                <li><i class="fas fa-check-circle"></i> Website Design</li>
                <li><i class="fas fa-check-circle"></i> Booking System</li>
                <li><i class="fas fa-check-circle"></i> WhatsApp Integration</li>
                <li><i class="fas fa-check-circle"></i> Lead Collection Forms</li>
                <li><i class="fas fa-check-circle"></i> Initial Setup &amp; Branding</li>
              </ul>
              <div class="dbe-price"><?php echo $basicPrice; ?></div>
            </div>
            <a href="cart.php?a=add&pid=1" class="dbe-btn">SELECT PLAN</a>
          </div>
        </div>

        <!-- Pro Plan (featured) -->
        <div class="col-sm-12 col-md-6 col-lg-4">
          <div class="dbe-card dbe-card-featured">
            <div class="dbe-card-badge">PRO PLAN</div>
            <div class="dbe-card-top">
              <p class="dbe-plan-subtitle">WEBSITE + CRM</p>
              <ul class="dbe-features">
                <li><i class="fas fa-check-circle"></i> Domain</li>
                <li><i class="fas fa-check-circle"></i> Hosting &amp; SSL</li>
                <li><i class="fas fa-check-circle"></i> Website Design</li>
                <li><i class="fas fa-check-circle"></i> Booking System</li>
                <li><i class="fas fa-check-circle"></i> WhatsApp Integration</li>
                <li><i class="fas fa-check-circle"></i> CRM</li>
                <li><i class="fas fa-check-circle"></i> SEO</li>
                <li><i class="fas fa-check-circle"></i> Admin Access</li>
              </ul>
              <div class="dbe-price"><?php echo $proPrice; ?></div>
            </div>
            <a href="cart.php?a=add&pid=2" class="dbe-btn dbe-btn-featured">SELECT PLAN</a>
          </div>
        </div>

        <!-- Enterprise Plan -->
        <div class="col-sm-12 col-md-6 col-lg-4">
          <div class="dbe-card">
            <div class="dbe-card-badge">ENTERPRISE PLAN</div>
            <div class="dbe-card-top">
              <p class="dbe-plan-subtitle">WEB SITE + CRM + ERP</p>
              <ul class="dbe-features">
                <li><i class="fas fa-check-circle"></i> Domain</li>
                <li><i class="fas fa-check-circle"></i> Hosting &amp; SSL</li>
                <li><i class="fas fa-check-circle"></i> Website Design</li>
                <li><i class="fas fa-check-circle"></i> SEO</li>
                <li><i class="fas fa-check-circle"></i> Booking System</li>
                <li><i class="fas fa-check-circle"></i> CRM</li>
                <li><i class="fas fa-check-circle"></i> ERP</li>
                <li><i class="fas fa-check-circle"></i> Profit/Loss Analytics</li>
                <li><i class="fas fa-check-circle"></i> VAT Ready Reports</li>
                <li><i class="fas fa-check-circle"></i> WhatsApp Integration</li>
                <li><i class="fas fa-check-circle"></i> Lead Collection Forms</li>
                <li><i class="fas fa-check-circle"></i> Admin Access</li>
              </ul>
              <div class="dbe-price"><?php echo $enterprisePrice; ?></div>
            </div>
            <a href="cart.php?a=add&pid=3" class="dbe-btn">SELECT PLAN</a>
          </div>
        </div>

      </div><!-- /.row -->

      <!-- Bottom row: legend + monthly subscription -->
      <div class="row mt-4 g-4 align-items-center">
        <div class="col-md-6">
          <ul class="dbe-legend">
            <li><i class="fas fa-check-circle" style="color:#C83E3C;"></i> <strong>CRM</strong> = Customer Relationship Management</li>
            <li><i class="fas fa-check-circle" style="color:#C83E3C;"></i> <strong>ERP</strong> = Enterprise Resource Planning (Account Software)</li>
            <li><i class="fas fa-check-circle" style="color:#C83E3C;"></i> <strong>SEO</strong> = Search Engine Optimization</li>
          </ul>
          <div class="dbe-contacts mt-3">
            <a href="https://wa.me/971505442538" class="dbe-contact-btn" target="_blank"><i class="fab fa-whatsapp"></i> UAE +971-50-544-2538</a>
            <a href="tel:+18333224404" class="dbe-contact-btn mt-2"><i class="fas fa-phone"></i> USA +1 (833) 322-4404</a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="dbe-monthly-box">
            <div class="dbe-monthly-title">Monthly Subscription: <span class="dbe-monthly-price"><?php echo $monthlySubPrice; ?></span></div>
            <div class="row mt-3">
              <div class="col-6">
                <ul class="dbe-monthly-list">
                  <li><i class="fas fa-check-circle"></i> Hosting Maintenance</li>
                  <li><i class="fas fa-check-circle"></i> Technical Support</li>
                  <li><i class="fas fa-check-circle"></i> Website Updates</li>
                </ul>
              </div>
              <div class="col-6">
                <ul class="dbe-monthly-list">
                  <li><i class="fas fa-check-circle"></i> Backups</li>
                  <li><i class="fas fa-check-circle"></i> Monitoring</li>
                  <li><i class="fas fa-check-circle"></i> Minor Changes</li>
                </ul>
              </div>
            </div>
            <div class="dbe-first-free">First Month FREE</div>
            <a href="cart.php?a=add&pid=4" class="dbe-btn dbe-btn-monthly mt-3">GET STARTED</a>
          </div>
        </div>
      </div>

    </div><!-- /.container -->
  </section>

  <!-- ***** WHY CHOOSE FILLSBASE ***** -->
  <section class="why-choose-new sec-normal">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <h2 class="section-heading" data-i18n="homepage.why_choose_title"></h2>
          <p class="section-subheading" data-i18n="homepage.why_choose_subtitle"></p>
        </div>
      </div>
      
      <!-- Feature Cards Horizontal Scroll -->
      <div class="row mt-5">
        <div class="col-12">
          <div class="cards-scroll-container">
            <div class="cards-scroll">
              <!-- Card 1 -->
              <div class="why-card">
                <span class="card-badge" data-i18n="homepage.read_more"></span>
                <div class="card-icon">
                  <i class="fas fa-headset"></i>
                </div>
                <h4 data-i18n="homepage.support_title"></h4>
                <p data-i18n="homepage.support_desc"></p>
                <a href="#" class="btn-why" data-i18n="homepage.support_btn"></a>
              </div>
              
              <!-- Card 2 -->
              <div class="why-card">
                <span class="card-badge">Control Panel</span>
                <div class="card-icon">
                  <i class="fas fa-columns"></i>
                </div>
                <h4 data-i18n="homepage.panel_title"></h4>
                <p data-i18n="homepage.panel_desc"></p>
                <a href="#" class="btn-why" data-i18n="homepage.read_more"></a>
              </div>
              
              <!-- Card 3 -->
              <div class="why-card">
                <span class="card-badge">Optimized</span>
                <div class="card-icon">
                  <i class="fas fa-bolt"></i>
                </div>
                <h4 data-i18n="homepage.performance_title"></h4>
                <p data-i18n="homepage.performance_desc"></p>
                <a href="#" class="btn-why" data-i18n="homepage.read_more"></a>
              </div>

              <!-- Card 4: SSL -->
              <div class="why-card">
                <span class="card-badge">Security</span>
                <div class="card-icon">
                  <i class="fas fa-shield-alt"></i>
                </div>
                <h4 data-i18n="homepage.ssl_title"></h4>
                <p data-i18n="homepage.ssl_desc"></p>
                <a href="#" class="btn-why" data-i18n="homepage.read_more"></a>
              </div>

              <!-- Card 5: Backups -->
              <div class="why-card">
                <span class="card-badge">Data Protection</span>
                <div class="card-icon">
                  <i class="fas fa-sync-alt"></i>
                </div>
                <h4 data-i18n="homepage.backup_title"></h4>
                <p data-i18n="homepage.backup_desc"></p>
                <a href="#" class="btn-why" data-i18n="homepage.read_more"></a>
              </div>

              <!-- Card 6: Uptime -->
              <div class="why-card">
                <span class="card-badge">Reliability</span>
                <div class="card-icon">
                  <i class="fas fa-clock"></i>
                </div>
                <h4 data-i18n="homepage.uptime_title"></h4>
                <p data-i18n="homepage.uptime_desc"></p>
                <a href="#" class="btn-why" data-i18n="homepage.read_more"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** MAP ***** -->

  <!-- ***** SOLUTIONS ***** -->
  <style>
    .sol-section { padding: 100px 0; background: linear-gradient(180deg, transparent 0%, rgba(238,85,134,0.03) 50%, transparent 100%); }
    .sol-pill { display:inline-flex;align-items:center;gap:8px;border-radius:50px;padding:6px 18px;font-size:0.75rem;font-weight:800;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:16px; }
    .sol-card { border-radius:28px;overflow:hidden;position:relative;transition:transform .3s ease,box-shadow .3s ease; }
    .sol-card:hover { transform:translateY(-6px); }
    .sol-img-wrap { position:relative;border-radius:24px;overflow:hidden; }
    .sol-img-wrap::after { content:'';position:absolute;inset:0;border-radius:24px;border:1px solid rgba(255,255,255,0.08); }
    .sol-img-wrap img { width:100%;display:block;border-radius:24px;transition:transform .5s ease; }
    .sol-img-wrap:hover img { transform:scale(1.03); }
    .sol-glow-green { box-shadow:0 0 80px rgba(22,163,74,0.12),0 30px 60px rgba(0,0,0,0.12); }
    .sol-glow-purple { box-shadow:0 0 80px rgba(124,58,237,0.12),0 30px 60px rgba(0,0,0,0.12); }
    .sol-glow-blue { box-shadow:0 0 80px rgba(37,99,235,0.12),0 30px 60px rgba(0,0,0,0.12); }
    .sol-feature { display:flex;align-items:center;gap:10px;margin-bottom:10px;font-size:0.88rem; }
    .sol-feature i { width:20px;text-align:center;font-size:0.8rem; }
    .sol-divider { height:1px;background:linear-gradient(90deg,transparent,rgba(238,85,134,0.2),transparent);margin:70px 0; }
    .sol-btn-primary { display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#ee5586,#c83e3c);color:#fff;border:none;border-radius:50px;padding:12px 28px;font-size:0.88rem;font-weight:700;text-decoration:none;transition:all .2s;box-shadow:0 8px 24px rgba(238,85,134,0.3); }
    .sol-btn-primary:hover { transform:translateY(-2px);box-shadow:0 12px 32px rgba(238,85,134,0.45);color:#fff; }
    .sol-btn-ghost { display:inline-flex;align-items:center;gap:8px;background:transparent;color:inherit;border:1.5px solid rgba(128,128,128,0.3);border-radius:50px;padding:11px 26px;font-size:0.88rem;font-weight:600;text-decoration:none;transition:all .2s; }
    .sol-btn-ghost:hover { border-color:#ee5586;color:#ee5586;transform:translateY(-2px); }
    .sol-number { font-size:5rem;font-weight:900;line-height:1;opacity:0.05;position:absolute;top:-10px;right:20px;letter-spacing:-4px; }
  </style>

  <section class="sol-section" id="solutions">
    <div class="container">

      <div class="text-center mb-5">
        <span class="sol-eyebrow"><i class="fas fa-cube"></i> Our Solutions</span>
        <h2 class="sol-title">Ready-to-Deploy Platforms</h2>
        <p class="sol-sub">AI-powered software built for your industry — launch fast, scale smart.</p>
      </div>

      <div class="row g-4">

        <!-- X Dairy -->
        <div class="col-md-4">
          <div class="sol-card">
            <div class="sol-card-img" style="background:linear-gradient(150deg,#0f4c2a 0%,#166534 100%);">
              <div class="sol-mockup-bar"><span></span><span></span><span></span></div>
              <div class="sol-screenshots">
                <img class="sol-ss sol-ss-main" src="assets/img/xdairy.png" alt="X Dairy">
                <img class="sol-ss sol-ss-side" src="assets/img/x dairy milk.png" alt="X Dairy Milk">
              </div>
              <span class="sol-tag" style="background:#16a34a;"><i class="fas fa-microchip"></i> AI-Powered</span>
            </div>
            <div class="sol-card-body">
              <h3 class="sol-card-title">X Dairy</h3>
              <p class="sol-card-desc">Smart dairy farm management — track animals, milk, breeding &amp; finances from one AI dashboard.</p>
              <ul class="sol-card-feats">
                <li><i class="fas fa-check" style="color:#16a34a;"></i> 10+ Modules · Herd Health AI</li>
                <li><i class="fas fa-check" style="color:#16a34a;"></i> Milk, Finance &amp; Stock Management</li>
              </ul>
              <div class="sol-card-btns">
                <a href="https://xdairy.fillsbase.com/" target="_blank" class="sol-cta-primary"><i class="fas fa-play"></i> Live Demo</a>
                <a href="/x-dairy" class="sol-cta-ghost">Learn More <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>

        <!-- X Music -->
        <div class="col-md-4">
          <div class="sol-card">
            <div class="sol-card-img" style="background:linear-gradient(150deg,#2e1065 0%,#4c1d95 100%);">
              <div class="sol-mockup-bar"><span></span><span></span><span></span></div>
              <div class="sol-music-vis">
                <div class="sol-music-icon"><i class="fas fa-music"></i></div>
                <div class="sol-music-bars">
                  <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                </div>
                <p class="sol-music-label">Your own streaming platform</p>
              </div>
              <span class="sol-tag" style="background:#7c3aed;"><i class="fas fa-music"></i> Streaming</span>
            </div>
            <div class="sol-card-body">
              <h3 class="sol-card-title">X Music</h3>
              <p class="sol-card-desc">Launch your own Spotify-like platform with AI recommendations, live concerts &amp; full monetization.</p>
              <ul class="sol-card-feats">
                <li><i class="fas fa-check" style="color:#7c3aed;"></i> Android, iOS &amp; Web apps</li>
                <li><i class="fas fa-check" style="color:#7c3aed;"></i> Live streaming · Ads &amp; Subscriptions</li>
              </ul>
              <div class="sol-card-btns">
                <a href="/x-music" class="sol-cta-primary"><i class="fas fa-arrow-right"></i> Learn More</a>
                <a href="#" class="sol-cta-ghost">Get Pricing <i class="fas fa-tag"></i></a>
              </div>
            </div>
          </div>
        </div>

        <!-- X Booking -->
        <div class="col-md-4">
          <div class="sol-card">
            <div class="sol-card-img" style="background:linear-gradient(150deg,#0c2d6b 0%,#1e40af 100%);">
              <div class="sol-mockup-bar"><span></span><span></span><span></span></div>
              <div class="sol-screenshots">
                <img class="sol-ss sol-ss-main" src="assets/img/xbookinghome.png" alt="X Booking">
                <img class="sol-ss sol-ss-side" src="assets/img/xbookinghotelsearch.png" alt="X Booking Hotels">
              </div>
              <span class="sol-tag" style="background:#2563eb;"><i class="fas fa-calendar-check"></i> Travel</span>
            </div>
            <div class="sol-card-body">
              <h3 class="sol-card-title">X Booking</h3>
              <p class="sol-card-desc">Hotels, Tours, Cars, Flights, Boats &amp; Visa — all in one AI-powered travel management platform.</p>
              <ul class="sol-card-feats">
                <li><i class="fas fa-check" style="color:#2563eb;"></i> 9+ Booking categories in one place</li>
                <li><i class="fas fa-check" style="color:#2563eb;"></i> Multi-currency · AI revenue analytics</li>
              </ul>
              <div class="sol-card-btns">
                <a href="/x-booking" class="sol-cta-primary"><i class="fas fa-arrow-right"></i> Learn More</a>
                <a href="#" class="sol-cta-ghost">Get Pricing <i class="fas fa-tag"></i></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ***** HELP ***** -->
  <section class="services help pt-4 pb-80 bg-colorstyle">
    <div class="container">
      <div class="service-wrap">
        <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="help-container bg-seccolorstyle">
              <a href="#" class="help-item" title="Live Chat">
                <div class="img">
                  <div class="lazyload">
                  </div>
                </div>
                <div class="inform">
                  <div class="title mergecolor">Live Chat</div>
                  <div class="description seccolor">Chat with our team in real time for any question you may have.</div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="help-container bg-seccolorstyle">
              <a href="contact" class="help-item" title="Contact Us">
                <div class="img">
                  <div class="lazyload">
                  </div>
                </div>
                <div class="inform">
                  <div class="title mergecolor">Submit a Ticket</div>
                  <div class="description seccolor">Submit a support request and we will get back to you promptly.</div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="help-container bg-seccolorstyle">
              <a href="knowledgebase.php" class="help-item" title="Knowledge List">
                <div class="img">
                  <div class="lazyload">
                  </div>
                </div>
                <div class="inform">
                  <div class="title mergecolor">Knowledge Base</div>
                  <div class="description seccolor">Explore our guides, tutorials, and technical documentation.</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** UPLOADED FOOTER FROM FOOTER.HTML ***** -->
<footer id="footer"> </footer>
</div>
<!-- ***** BUTTON GO TOP ***** -->
<a href="#" class="cd-top" title="Go Top"> <i class="fas fa-angle-up"></i> </a>
<!-- ***** SCRIPTS ***** -->
<script>
$('.carousel').flickity({
fullscreen: true,
draggable: true,
prevNextButtons: false,
pageDots: true,
autoPlay: 6000,
fade: true
});
</script>
<script>
$(function() {
$('[data-bs-toggle="tooltip"]')
.tooltip()
})
</script>
<script>
$(document).ready(function() {
  $('.process-step').on('click', function() {
    let current = 1;
    const total = 4;
    
    // Clear any existing animation
    if (window.processAnimation) clearInterval(window.processAnimation);
    
    // Reset states
    $('.process-line-fill').css('width', '0%');
    $('.process-step').removeClass('active');
    
    window.processAnimation = setInterval(() => {
      const progress = ((current - 1) / (total - 1)) * 100;
      $('.process-line-fill').css('width', progress + '%');
      
      // Add active class to current and previous steps
      $('.process-step').each(function() {
        if (parseInt($(this).data('step')) <= current) {
          $(this).addClass('active');
        }
      });
      
      if (current === total) {
        clearInterval(window.processAnimation);
      }
      current++;
    }, 800); // Faster, more fluid progression
  });
});
</script>

    <!-- Javascript -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/scripts.min.js?v=<?php echo time(); ?>"></script>
    <script type="text/javascript" src="assets/js/gdpr-cookie.min.js"></script>
    <script type="text/javascript" src="assets/js/flickity.pkgd.min.js"></script>
    <script type="text/javascript" src="assets/js/flickity-fade.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script defer type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script defer type="text/javascript" src="assets/js/slick.min.js"></script>
    <script defer type="text/javascript" src="assets/js/aos.min.js"></script>
    <script defer type="text/javascript" src="assets/js/swiper.min.js"></script>
    <script defer type="text/javascript" src="assets/js/jquery.lazyload-any.min.js"></script>
    <script type="text/javascript" src="assets/js/settings-init.js"></script>

    <!-- Page Specific Scripts -->
    <script>
    $(document).ready(function() {
        if (typeof AOS !== 'undefined') {
            AOS.init();
        }
        console.log('<span class="dynamic-brand-name" data-brand="name">Fillsbase</span> Domain Search Script Loaded');
        
        let searchTimeout;
        const $searchInput = $('#domainSearchInput');
        const $suggestions = $('#domainSuggestions');
        const $list = $('.suggestions-list');
        const $form = $('#heroSearchForm');

        function performSearch(query) {
            if (!query || query.trim().length < 2) {
                $suggestions.hide();
                return;
            }

            $suggestions.show();
            $list.html('<div class="suggestion-loading"><i class="fas fa-spinner fa-spin"></i> Searching...</div>');

            $.ajax({
                url: 'domain_ajax.php',
                data: { query: query },
                dataType: 'json',
                success: function(data) {
                    if (data && data.length > 0) {
                        let html = '';
                        data.forEach(function(item) {
                            let statusBadge, actionIcon, itemClass, priceStyle, onclickAttr;

                            if (item.status === 'available') {
                                statusBadge  = `<span style="background:#d4edda;color:#155724;font-size:11px;font-weight:600;padding:3px 8px;border-radius:4px;white-space:nowrap;">✓ Available</span>`;
                                actionIcon   = `<i class="fas fa-cart-plus" style="color:var(--primary-color);font-size:15px;"></i>`;
                                itemClass    = '';
                                priceStyle   = 'color:#155724;';
                                onclickAttr  = `addDomainFromSearch('${item.domain}', '${item.price}', this)`;
                            } else if (item.status === 'taken') {
                                statusBadge  = `<span style="background:#f8d7da;color:#721c24;font-size:11px;font-weight:600;padding:3px 8px;border-radius:4px;white-space:nowrap;">✗ Taken</span>`;
                                actionIcon   = `<i class="fas fa-times-circle" style="color:#ccc;font-size:15px;"></i>`;
                                itemClass    = 'disabled';
                                priceStyle   = 'text-decoration:line-through;opacity:0.4;';
                                onclickAttr  = '';
                            } else {
                                statusBadge  = `<span style="background:#e2e3e5;color:#383d41;font-size:11px;font-weight:600;padding:3px 8px;border-radius:4px;white-space:nowrap;">? Unknown</span>`;
                                actionIcon   = `<i class="fas fa-search" style="color:#aaa;font-size:15px;"></i>`;
                                itemClass    = '';
                                priceStyle   = 'opacity:0.6;';
                                onclickAttr  = `window.location.href='cart.php?a=add&domain=register&query=${item.domain}'`;
                            }

                            html += `
                                <div class="suggestion-item ${itemClass}" style="cursor:${onclickAttr ? 'pointer' : 'default'};display:flex;align-items:center;justify-content:space-between;padding:10px 14px;gap:8px;" onclick="${onclickAttr}">
                                    <div style="display:flex;align-items:center;gap:8px;min-width:0;flex:1;">
                                        <i class="fas fa-globe" style="flex-shrink:0;color:#aaa;"></i>
                                        <span class="suggestion-domain" style="font-weight:500;white-space:nowrap;">${item.domain}</span>
                                    </div>
                                    <div style="display:flex;align-items:center;gap:10px;flex-shrink:0;">
                                        ${statusBadge}
                                        <span style="font-size:13px;font-weight:600;${priceStyle}">${item.price}</span>
                                        ${actionIcon}
                                    </div>
                                </div>
                            `;
                        });
                        $list.html(html);
                    } else {
                        $list.html('<div class="suggestion-loading">No results found.</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Domain Search Error:', error);
                    $list.html('<div class="suggestion-loading text-danger">Error fetching suggestions.</div>');
                }
            });
        }

        window.addDomainFromSearch = function(domain, price, el) {
            var btn = $(el);
            btn.css('pointer-events', 'none');
            $.post('cart_add_domain.php', { action: 'add', domain: domain, regperiod: 1 }, function(res) {
                if (res.status === 'success' || res.status === 'exists') {
                    setTimeout(function() { window.location.href = '/cart.php'; }, 400);
                } else {
                    btn.css('pointer-events', '');
                    alert(res.message || 'Error adding domain');
                }
            }, 'json').fail(function() {
                btn.css('pointer-events', '');
            });
        };

        $searchInput.on('input focus', function() {
            let query = $(this).val();
            clearTimeout(searchTimeout);
            if (query.length >= 2) {
                searchTimeout = setTimeout(() => performSearch(query), 300);
            } else {
                $suggestions.hide();
            }
        });

        $form.on('submit', function(e) {
            e.preventDefault();
            let query = $searchInput.val().trim();
            if (query) {
                window.location.href = `cart.php?a=add&domain=register&query=${encodeURIComponent(query)}`;
            }
            return false;
        });

        $('.search-btn').on('click', function(e) {
            e.preventDefault();
            $form.submit();
            return false;
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#heroSearchForm').length) {
                $suggestions.hide();
            }
        });
    });
    </script>
</body>
</html>