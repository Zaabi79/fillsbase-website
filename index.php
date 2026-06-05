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
$comPrice = formatFillsbasePrice(getFillsbaseTldPrice('com'));
$mlPrice  = formatFillsbasePrice(getFillsbaseTldPrice('ml'));
$snPrice  = formatFillsbasePrice(getFillsbaseTldPrice('sn'));
$ciPrice  = formatFillsbasePrice(getFillsbaseTldPrice('ci'));

// Fetch product prices (using IDs from database)
$sharedPrice  = formatFillsbasePrice(getFillsbaseProductPrice(291, 'annually')) . ' /yr';
$businessPrice = formatFillsbasePrice(getFillsbaseProductPrice(292, 'annually')) . ' /yr';
$proPrice      = formatFillsbasePrice(getFillsbaseProductPrice(293, 'annually')) . ' /yr';
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillsbase.com offers premium web hosting, VPS, dedicated servers, and domain name registration worldwide.">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
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

  /* ── PRICING SECTION ── */
  .pricing.special { background: linear-gradient(to right, #ffffff 0%, #f0f4ff 25%, #c8d8f0 55%, #f5b8a0 80%, #f9cfa0 100%) !important; }
  .pricing .wrapper .top-content { background: rgba(255,255,255,0.85) !important; }
  .pricing .wrapper .list-info { background: var(--fb-navy) !important; }
  .pricing .wrapper.recommended .top-content { background: var(--fb-navy) !important; }
  .pricing .wrapper.recommended .title,
  .pricing .wrapper.recommended .price .discount { color: #fff !important; }

  /* ── WHY CHOOSE SECTION ── */
  .why-choose-new { background: var(--fb-red-light) !important; }
  .why-box { background: var(--fb-white) !important; border: 1px solid var(--fb-red-soft) !important; border-radius: 16px; }
  .why-box:hover { border-color: var(--fb-navy) !important; box-shadow: 0 12px 40px rgba(27,54,115,0.1) !important; }
  .why-box .icon-wrap { background: var(--fb-navy-light) !important; color: var(--fb-navy) !important; }

  /* ── DATA CENTERS MAP SECTION ── */
  .services.maping { background: var(--fb-navy) !important; }

  /* ── SOLUTIONS SECTION ── */
  .sol-section { background: linear-gradient(180deg, var(--fb-navy-light) 0%, var(--fb-white) 50%, var(--fb-red-light) 100%) !important; }
  .sol-divider { background: linear-gradient(90deg, transparent, var(--fb-navy-soft), transparent) !important; }

  /* ── HELP / SUPPORT SECTION ── */
  .services.help { background: var(--fb-navy-light) !important; }
  .help-container { background: var(--fb-white) !important; border: 1px solid var(--fb-navy-soft) !important; border-radius: 16px; transition: all .25s; }
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
  .sol-btn-primary { background: linear-gradient(135deg, var(--fb-red), #a32f2d) !important; }
  .sol-btn-ghost { border-color: var(--fb-navy-soft) !important; color: var(--fb-navy) !important; }
  .sol-btn-ghost:hover { border-color: var(--fb-red) !important; color: var(--fb-red) !important; }

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
    <canvas id="heroParticleCanvas"></canvas>
    <div class="hero-bg-orb hero-orb-1"></div>
    <div class="hero-bg-orb hero-orb-2"></div>
    <div class="hero-bg-orb hero-orb-3"></div>
    <div class="container" style="position:relative;z-index:2;">
      <!-- Hero Top: Pill Badge + Headline -->
      <div class="hero-top-text text-center mb-4">
        <a href="/promos" class="hero-pill-badge">
          <i class="fas fa-tags me-1"></i> Special Offers Live Now &nbsp;<i class="fas fa-arrow-right"></i>
        </a>
        <h1 class="hero-main-title" data-i18n="hero.main_title">Grow Your Business with Our Digital Business Ecosystem</h1>
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
            <span class="badge-promo">-25%</span>
            <span class="tld-name">.com</span>
            <span class="tld-price"><?php echo $comPrice; ?> /an</span>
          </div>
          <div class="tld-card" onclick="$('#domainSearchInput').val('domain.ml').focus();">
            <span class="tld-name">.ml</span>
            <span class="tld-price"><?php echo $mlPrice; ?> /an</span>
          </div>
          <div class="tld-card" onclick="$('#domainSearchInput').val('domain.sn').focus();">
            <span class="tld-name">.sn</span>
            <span class="tld-price"><?php echo $snPrice; ?> /an</span>
          </div>
          <div class="tld-card" onclick="$('#domainSearchInput').val('domain.ci').focus();">
            <span class="tld-name">.ci</span>
            <span class="tld-price"><?php echo $ciPrice; ?> /an</span>
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
          <canvas class="ai-particles-canvas" id="aiCanvas"></canvas>
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

  <!-- ***** PRICING TABLES ***** -->
  <section class="pricing special sec-up-slider bg-colorstyle specialposition">
    <div class="container">
      <div class="row">
        <!-- Personal Plan -->
        <div class="col-sm-12 col-md-4 col-lg-4">
          <div class="wrapper first text-start noshadow">
            <div class="top-content bg-seccolorstyle topradius">
              <div class="lazyload"></div>
              <div class="title">Personal Plan</div>
              <div class="fromer seccolor">1 Free Domain Name</div>
              <div class="price seccolor"><?php echo $sharedPrice; ?></div>
              <a href="hosting" class="btn btn-default-yellow-fill">All Plans</a>
            </div>
            <ul class="list-info bg-purple">
              <li><i class="icon-drives"></i> <div>DISK<br> <span>10 GB</span></div></li>
              <li><i class="icon-speed"></i> <div>BANDWIDTH<br> <span>100 GB</span></div></li>
              <li><i class="icon-emailopen"></i> <div>EMAIL<br> <span>10 Accounts</span></div></li>
              <li><i class="icon-domains"></i> <div>SUBDOMAINS<br> <span>10</span></div></li>
            </ul>
          </div>
        </div>
        <!-- Business Plan -->
        <div class="col-sm-12 col-md-4 col-lg-4">
          <div class="wrapper text-start noshadow">
            <div class="plans badge feat bg-purple">recommended</div>
            <div class="top-content bg-seccolorstyle topradius">
              <div class="lazyload"></div>
              <div class="title">Business Plan</div>
              <div class="fromer seccolor">3 Free Domain Names</div>
              <div class="price seccolor"><?php echo $businessPrice; ?></div>
              <a href="hosting" class="btn btn-default-yellow-fill">All Plans</a>
            </div>
            <ul class="list-info bg-purple">
              <li><i class="icon-drives"></i> <div>DISK<br> <span>50 GB</span></div></li>
              <li><i class="icon-speed"></i> <div>BANDWIDTH<br> <span>500 GB</span></div></li>
              <li><i class="icon-emailopen"></i> <div>EMAIL<br> <span>Unlimited</span></div></li>
              <li><i class="icon-domains"></i> <div>SUBDOMAINS<br> <span>Unlimited</span></div></li>
            </ul>
          </div>
        </div>
        <!-- Pro Plan -->
        <div class="col-sm-12 col-md-4 col-lg-4">
          <div class="wrapper third text-start noshadow">
            <div class="top-content bg-seccolorstyle topradius">
              <div class="lazyload"></div>
              <div class="title">Pro Plan</div>
              <div class="fromer seccolor">5 Free Domain Names</div>
              <div class="price seccolor"><?php echo $proPrice; ?></div>
              <a href="hosting" class="btn btn-default-yellow-fill">All Plans</a>
            </div>
            <ul class="list-info bg-purple">
              <li><i class="icon-drives"></i> <div>DISK<br> <span>100 GB</span></div></li>
              <li><i class="icon-speed"></i> <div>BANDWIDTH<br> <span>Unlimited</span></div></li>
              <li><i class="icon-emailopen"></i> <div>EMAIL<br> <span>Unlimited</span></div></li>
              <li><i class="icon-domains"></i> <div>SUBDOMAINS<br> <span>Unlimited</span></div></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
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

      <!-- Header -->
      <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="600">
        <div class="sol-pill" style="background:rgba(238,85,134,0.1);color:#ee5586;border:1px solid rgba(238,85,134,0.25);margin:0 auto 16px;">
          <i class="fas fa-cube"></i> Our Solutions
        </div>
        <h2 class="section-heading mergecolor" style="font-size:2.4rem;font-weight:900;">Powerful Platforms Built<br>for Your Industry</h2>
        <p class="section-subheading text-muted mergecolor">Ready-to-deploy software solutions with AI at the core</p>
      </div>

      <!-- X Dairy -->
      <div class="row align-items-center g-5 mb-0" data-aos="fade-up" data-aos-duration="800">
        <div class="col-lg-6">
          <div class="sol-img-wrap sol-glow-green">
            <div class="sol-number">01</div>
            <img src="assets/img/xdairy.png" alt="X Dairy">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="sol-pill" style="background:rgba(22,163,74,0.1);color:#16a34a;border:1px solid rgba(22,163,74,0.25);">
            <i class="fas fa-microchip"></i> AI-Powered
          </div>
          <h3 class="mergecolor" style="font-size:2.2rem;font-weight:900;margin-bottom:6px;">X Dairy</h3>
          <p style="color:#ee5586;font-weight:700;font-size:1rem;margin-bottom:18px;">Smart Dairy Farm Management System</p>
          <p class="text-muted seccolor" style="font-size:0.92rem;line-height:1.9;margin-bottom:24px;">AI-powered, all-in-one dairy farm management system that simplifies daily operations with intelligent automation. Track animal records, milk production, breeding, calving, and finances from a single smart dashboard.</p>
          <div style="margin-bottom:28px;">
            <div class="sol-feature seccolor"><i class="fas fa-check-circle" style="color:#16a34a;"></i> 10+ Integrated Modules</div>
            <div class="sol-feature seccolor"><i class="fas fa-check-circle" style="color:#16a34a;"></i> AI-driven analytics & herd health insights</div>
            <div class="sol-feature seccolor"><i class="fas fa-check-circle" style="color:#16a34a;"></i> Automated alerts for vaccinations & breeding</div>
            <div class="sol-feature seccolor"><i class="fas fa-check-circle" style="color:#16a34a;"></i> Milk, Finance, Stock & Employee Management</div>
          </div>
          <div class="d-flex flex-wrap gap-3">
            <a href="https://xdairy.fillsbase.com/" target="_blank" class="sol-btn-primary"><i class="fas fa-play"></i> Live Demo</a>
            <a href="/x-dairy" class="sol-btn-ghost mergecolor"><i class="fas fa-arrow-right"></i> Learn More</a>
          </div>
        </div>
      </div>

      <div class="sol-divider"></div>

      <!-- X Music -->
      <div class="row align-items-center g-5 flex-lg-row-reverse mb-0" data-aos="fade-up" data-aos-duration="800">
        <div class="col-lg-6">
          <div class="sol-img-wrap sol-glow-purple">
            <div class="sol-number">02</div>
            <img src="assets/img/xdairy.png" alt="X Music">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="sol-pill" style="background:rgba(124,58,237,0.1);color:#7c3aed;border:1px solid rgba(124,58,237,0.25);">
            <i class="fas fa-music"></i> All-in-One Platform
          </div>
          <h3 class="mergecolor" style="font-size:2.2rem;font-weight:900;margin-bottom:6px;">X Music</h3>
          <p style="color:#ee5586;font-weight:700;font-size:1rem;margin-bottom:18px;">AI-Powered Music Streaming Platform</p>
          <p class="text-muted seccolor" style="font-size:0.92rem;line-height:1.9;margin-bottom:24px;">Launch your own Spotify-like streaming service across Android, iOS, and web. Complete entertainment ecosystem with AI-powered recommendations, live concerts, radio, and full monetization built in.</p>
          <div style="margin-bottom:28px;">
            <div class="sol-feature seccolor"><i class="fas fa-check-circle" style="color:#7c3aed;"></i> Android, iOS & Web apps included</div>
            <div class="sol-feature seccolor"><i class="fas fa-check-circle" style="color:#7c3aed;"></i> Songs, Albums, Playlists & Podcasts</div>
            <div class="sol-feature seccolor"><i class="fas fa-check-circle" style="color:#7c3aed;"></i> Live streaming & concert events</div>
            <div class="sol-feature seccolor"><i class="fas fa-check-circle" style="color:#7c3aed;"></i> Premium plans, ads & in-app purchases</div>
          </div>
          <div class="d-flex flex-wrap gap-3">
            <a href="/x-music" class="sol-btn-primary"><i class="fas fa-arrow-right"></i> Learn More</a>
            <a href="#" class="sol-btn-ghost mergecolor"><i class="fas fa-tag"></i> Get Pricing</a>
          </div>
        </div>
      </div>

      <div class="sol-divider"></div>

      <!-- X Booking -->
      <div class="row align-items-center g-5" data-aos="fade-up" data-aos-duration="800">
        <div class="col-lg-6">
          <div class="sol-img-wrap sol-glow-blue">
            <div class="sol-number">03</div>
            <img src="assets/img/xbooking.png" alt="X Booking">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="sol-pill" style="background:rgba(37,99,235,0.1);color:#2563eb;border:1px solid rgba(37,99,235,0.25);">
            <i class="fas fa-microchip"></i> AI-Powered
          </div>
          <h3 class="mergecolor" style="font-size:2.2rem;font-weight:900;margin-bottom:6px;">X Booking</h3>
          <p style="color:#ee5586;font-weight:700;font-size:1rem;margin-bottom:18px;">AI-Powered Travel &amp; Booking Platform</p>
          <p class="text-muted seccolor" style="font-size:0.92rem;line-height:1.9;margin-bottom:24px;">All-in-one travel and booking management — manage Hotels, Tours, Cars, Events, Flights, Boats, Spaces &amp; Visa from a single smart dashboard. AI analytics, real-time availability &amp; multi-currency support.</p>
          <div style="margin-bottom:28px;">
            <div class="sol-feature seccolor"><i class="fas fa-check-circle" style="color:#2563eb;"></i> 9+ booking categories in one platform</div>
            <div class="sol-feature seccolor"><i class="fas fa-check-circle" style="color:#2563eb;"></i> AI-driven revenue & occupancy analytics</div>
            <div class="sol-feature seccolor"><i class="fas fa-check-circle" style="color:#2563eb;"></i> Multi-currency & multilingual search</div>
            <div class="sol-feature seccolor"><i class="fas fa-check-circle" style="color:#2563eb;"></i> Smart automation for confirmations & reminders</div>
          </div>
          <div class="d-flex flex-wrap gap-3">
            <a href="/x-booking" class="sol-btn-primary"><i class="fas fa-arrow-right"></i> Learn More</a>
            <a href="#" class="sol-btn-ghost mergecolor"><i class="fas fa-tag"></i> Get Pricing</a>
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
            $list.html('<div class="suggestion-loading"><i class="fas fa-spinner fa-spin"></i> Recherche en cours...</div>');

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
                                statusBadge  = `<span style="background:#d4edda;color:#155724;font-size:11px;font-weight:600;padding:3px 8px;border-radius:4px;white-space:nowrap;">✓ Disponible</span>`;
                                actionIcon   = `<i class="fas fa-cart-plus" style="color:var(--primary-color);font-size:15px;"></i>`;
                                itemClass    = '';
                                priceStyle   = 'color:#155724;';
                                onclickAttr  = `addDomainFromSearch('${item.domain}', '${item.price}', this)`;
                            } else if (item.status === 'taken') {
                                statusBadge  = `<span style="background:#f8d7da;color:#721c24;font-size:11px;font-weight:600;padding:3px 8px;border-radius:4px;white-space:nowrap;">✗ Non disponible</span>`;
                                actionIcon   = `<i class="fas fa-times-circle" style="color:#ccc;font-size:15px;"></i>`;
                                itemClass    = 'disabled';
                                priceStyle   = 'text-decoration:line-through;opacity:0.4;';
                                onclickAttr  = '';
                            } else {
                                statusBadge  = `<span style="background:#e2e3e5;color:#383d41;font-size:11px;font-weight:600;padding:3px 8px;border-radius:4px;white-space:nowrap;">? Inconnu</span>`;
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
                    setTimeout(function() { window.location.href = '/panier.php'; }, 400);
                } else {
                    btn.css('pointer-events', '');
                    alert(res.message || 'Erreur');
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
<script>
/* ── Hero section full-background particle network ── */
(function() {
  var canvas = document.getElementById('heroParticleCanvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var W, H, dots = [];

  function resize() {
    var sec = canvas.parentElement;
    W = canvas.width  = sec.offsetWidth;
    H = canvas.height = sec.offsetHeight;
  }
  resize();
  window.addEventListener('resize', function(){ resize(); dots=[]; init(); });

  function init() {
    dots = [];
    var count = Math.floor(W / 18);
    for (var i = 0; i < count; i++) {
      dots.push({
        x:  Math.random() * W,
        y:  Math.random() * H,
        vx: (Math.random() - 0.5) * 0.45,
        vy: (Math.random() - 0.5) * 0.45,
        r:  Math.random() * 2.2 + 0.8
      });
    }
  }
  init();

  var mouse = {x: -9999, y: -9999};
  canvas.parentElement.addEventListener('mousemove', function(e) {
    var r = canvas.getBoundingClientRect();
    mouse.x = e.clientX - r.left;
    mouse.y = e.clientY - r.top;
  });

  function draw() {
    ctx.clearRect(0, 0, W, H);
    var LINK = 130, REPEL = 80;

    dots.forEach(function(d) {
      /* mouse repel */
      var mx = d.x - mouse.x, my = d.y - mouse.y;
      var md = Math.sqrt(mx*mx + my*my);
      if (md < REPEL) {
        var force = (REPEL - md) / REPEL * 0.6;
        d.vx += (mx / md) * force;
        d.vy += (my / md) * force;
      }
      /* damping */
      d.vx *= 0.99; d.vy *= 0.99;
      d.x += d.vx; d.y += d.vy;
      if (d.x < 0 || d.x > W) d.vx *= -1;
      if (d.y < 0 || d.y > H) d.vy *= -1;

      ctx.beginPath();
      ctx.arc(d.x, d.y, d.r, 0, Math.PI * 2);
      ctx.fillStyle = 'rgba(80,210,158,0.65)';
      ctx.fill();
    });

    for (var i = 0; i < dots.length; i++) {
      for (var j = i + 1; j < dots.length; j++) {
        var dx = dots[i].x - dots[j].x, dy = dots[i].y - dots[j].y;
        var dist = Math.sqrt(dx*dx + dy*dy);
        if (dist < LINK) {
          ctx.beginPath();
          ctx.moveTo(dots[i].x, dots[i].y);
          ctx.lineTo(dots[j].x, dots[j].y);
          ctx.strokeStyle = 'rgba(80,210,158,' + (0.2 * (1 - dist/LINK)) + ')';
          ctx.lineWidth = 0.8;
          ctx.stroke();
        }
      }
    }
    requestAnimationFrame(draw);
  }
  draw();
})();

/* ── AI card mini canvas ── */
(function() {
  var canvas = document.getElementById('aiCanvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var W, H, dots = [];
  function resize() { W = canvas.width = canvas.offsetWidth; H = canvas.height = canvas.offsetHeight; }
  resize();
  for (var i = 0; i < 30; i++) {
    dots.push({ x: Math.random()*W, y: Math.random()*H, vx:(Math.random()-.5)*.5, vy:(Math.random()-.5)*.5, r:Math.random()*1.8+.6 });
  }
  (function draw() {
    ctx.clearRect(0,0,W,H);
    dots.forEach(function(d){
      d.x+=d.vx; d.y+=d.vy;
      if(d.x<0||d.x>W)d.vx*=-1; if(d.y<0||d.y>H)d.vy*=-1;
      ctx.beginPath(); ctx.arc(d.x,d.y,d.r,0,Math.PI*2);
      ctx.fillStyle='rgba(80,210,158,0.8)'; ctx.fill();
    });
    for(var i=0;i<dots.length;i++) for(var j=i+1;j<dots.length;j++){
      var dx=dots[i].x-dots[j].x,dy=dots[i].y-dots[j].y,dist=Math.sqrt(dx*dx+dy*dy);
      if(dist<80){ ctx.beginPath(); ctx.moveTo(dots[i].x,dots[i].y); ctx.lineTo(dots[j].x,dots[j].y);
        ctx.strokeStyle='rgba(80,210,158,'+(0.25*(1-dist/80))+')'; ctx.lineWidth=.7; ctx.stroke(); }
    }
    requestAnimationFrame(draw);
  })();
})();
</script>
</body>
</html>