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
        <p class="hero-sub-title" data-i18n="hero.sub_title">Website &bull; Domain &bull; Hosting &bull; CRM &bull; Business Dashboard &bull; SEO &bull; Booking &bull; Mobile Apps &bull; Social Media &bull; Custom Software</p>
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
            <span class="card-tag" data-i18n="hero.tag_hosting"></span>
            <h3 data-i18n="hero.hosting_title"></h3>
            <a href="hosting" class="card-btn" data-i18n="hero.btn_get_started"></a>
          </div>
          <img src="assets/img/hero-hosting.png" alt="Hosting Mockup" class="card-mockup-img">
        </div>

        <!-- Card 2: Websites -->
        <div class="feature-card teal">
          <div class="card-text">
            <span class="card-tag" data-i18n="hero.tag_development"></span>
            <h3 data-i18n="hero.websites_title"></h3>
            <a href="aiagents" class="card-btn" data-i18n="hero.btn_get_started"></a>
          </div>
          <img src="assets/img/hero-website.png" alt="Website Mockup" class="card-mockup-img">
        </div>

        <!-- Card 3: SEO -->
        <div class="feature-card white">
          <div class="card-text">
            <span class="card-tag" data-i18n="hero.tag_seo"></span>
            <h3 data-i18n="hero.seo_title"></h3>
            <a href="seo" class="card-btn" data-i18n="hero.btn_explore"></a>
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

  <!-- ***** PROCESS ANIMATION SECTION ***** -->
  <section class="process-section sec-normal">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="section-heading">Your Path to Success</h2>
          <p class="section-subheading">A simple 4-step process to get your site online and ready for the world.</p>
        </div>
      </div>
      
      <div class="process-container mt-5">
        <!-- Connecting Line -->
        <div class="process-line d-none d-lg-block">
          <div class="process-line-fill"></div>
        </div>
        
        <div class="row gy-5">
          <!-- Step 1 -->
          <div class="col-lg-3 col-md-6 process-step" data-step="1">
            <div class="process-icon-wrap">
              <div class="process-number">1</div>
              <div class="process-icon">
                <i class="fas fa-globe"></i>
              </div>
            </div>
            <div class="process-content">
              <h4>Register a Domain</h4>
              <p>Find your unique identity with our powerful domain search tool.</p>
            </div>
          </div>
          
          <!-- Step 2 -->
          <div class="col-lg-3 col-md-6 process-step" data-step="2">
            <div class="process-icon-wrap">
              <div class="process-number">2</div>
              <div class="process-icon">
                <i class="fas fa-server"></i>
              </div>
            </div>
            <div class="process-content">
              <h4>Choose Hosting</h4>
              <p>Host your project on our fast and secure cloud infrastructure.</p>
            </div>
          </div>
          
          <!-- Step 3 -->
          <div class="col-lg-3 col-md-6 process-step" data-step="3">
            <div class="process-icon-wrap">
              <div class="process-number">3</div>
              <div class="process-icon">
                <i class="fas fa-tools"></i>
              </div>
            </div>
            <div class="process-content">
              <h4>Development & Testing</h4>
              <p>Build and refine your project in a robust development environment.</p>
            </div>
          </div>
          
          <!-- Step 4 -->
          <div class="col-lg-3 col-md-6 process-step" data-step="4">
            <div class="process-icon-wrap">
              <div class="process-number">4</div>
              <div class="process-icon">
                <i class="fas fa-paper-plane"></i>
              </div>
            </div>
            <div class="process-content">
              <h4>Ready to Launch</h4>
              <p>Go live with confidence and reach your global audience instantly.</p>
            </div>
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
  <section class="services maping sec-normal item17 overlay bg-colorstyle">
    <div class="container">
      <div class="service-wrap">
        <div class="row">
          <div class="col-sm-12 text-center">
            <h2 class="section-heading text-white">Our Data Centers Across 7 Regions</h2>
            <p class="section-subheading text-light"><span class="golink">Fillsbase.com</span> provides premium and reliable web hosting solutions <span class="c-pink">tailored to your success</span> and performance</p>
          </div>
          <div class="col-md-12 pt-5 position-relative">
            <div class="lazyload">
            </div>
            <span class="datacenters montreal" data-bs-toggle="popover" data-bs-container="body" data-bs-trigger="hover" data-bs-placement="top" title="Montreal" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." role="button" aria-label="Montreal"></span>
            <span class="datacenters newyork" data-bs-toggle="popover" data-bs-container="body" data-bs-trigger="hover" data-bs-placement="top" title="New York" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." role="button" aria-label="New York"></span>
            <span class="datacenters portugal"  data-bs-toggle="popover" data-bs-container="body" data-bs-trigger="hover" data-bs-placement="top" title="Portugal" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." role="button" aria-label="Portugal"></span>
            <span class="datacenters london" data-bs-toggle="popover" data-bs-container="body" data-bs-trigger="hover" data-bs-placement="top" title="London" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." role="button" aria-label="London"></span>
            <span class="datacenters moskow" data-bs-toggle="popover" data-bs-container="body" data-bs-trigger="hover" data-bs-placement="top" title="Moskow"  data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." role="button" aria-label="Moskow"></span>
            <span class="datacenters hongkong" data-bs-toggle="popover" data-bs-container="body" data-bs-trigger="hover" data-bs-placement="top" title="Hong Kong" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." role="button" aria-label="Hong Kong"></span>
            <span class="datacenters singapure" data-bs-toggle="popover" data-bs-container="body" data-bs-trigger="hover" data-bs-placement="top" title="Singapure" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." role="button" aria-label="Singapure"></span>
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