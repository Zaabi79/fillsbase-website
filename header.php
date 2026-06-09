<!-- ***** NEWS ***** -->
<div class="sec-bg3 infonews">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-7 news d-none d-md-block">
        <span class="badge bg-purple me-2">news</span>
        <span>SSD Storage with increased flexibility.</span>
      </div>
      <div class="col-12 col-md-5 link">
        <div class="infonews-nav float-end">
          <a href="/promos" class="iconews" title="Specials"><i class="fas fa-tags f-14 w-icon pe-1"></i> Specials</a>
          <a href="/announcements" class="iconews" title="Notifications"><i class="ico-bell f-18 w-icon"></i></a>
          <a href="cart.php?a=view" class="iconews" title="Cart"><i class="ico-shopping-cart f-18 w-icon"></i></a>
          <a href="tel:+971505442538" class="iconews tabphone" title="Phone Number">+971-50-544-2538</a>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .infonews { overflow: visible !important; position: relative; z-index: 100000 !important; }
  @media (max-width: 767px) {
    .infonews .infonews-nav { float: none !important; display: flex !important; justify-content: center; flex-wrap: wrap; gap: 12px; padding: 4px 8px; }
    .infonews .infonews-nav .iconews { margin: 0 4px !important; }
    .infonews .tabphone { display: none !important; }
  }
  .lng-drop { position: static; display: inline-block; cursor: pointer; vertical-align: middle; }
  .lng-drop .lng-list {
    display: none;
    position: fixed;
    right: 20px;
    top: 38px;
    min-width: 150px;
    list-style: none !important;
    padding: 6px 0 !important;
    margin: 0 !important;
    border-radius: 6px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.25);
    z-index: 100001;
    flex-direction: column !important;
  }
  .lng-drop.lng-open .lng-list { display: flex !important; flex-direction: column !important; }
  .lng-drop .lng-list li {
    display: block !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    float: none !important;
  }
  .lng-drop .lng-list li label {
    display: block !important;
    width: 100% !important;
    padding: 8px 16px !important;
    cursor: pointer;
    font-size: 13px !important;
    white-space: nowrap;
    margin: 0 !important;
    font-weight: 400 !important;
  }
  .lng-drop .lng-list li label:hover,
  .lng-drop .lng-list li label.active { color: #ee5586 !important; font-weight: 700 !important; }
</style>
<?php
if (file_exists('init.php')) {
  require_once('init.php');
}
$whmcsLogo = '';
$companyName = 'Fillsbase';
if (class_exists('\WHMCS\Config\Setting')) {
  $whmcsLogo = \WHMCS\Config\Setting::getValue('LogoURL');
  $companyName = \WHMCS\Config\Setting::getValue('CompanyName');
}
$displayLogo = './assets/img/fillsbase_logo.png';
?>
<div class="menu-wrap">
  <div class="nav-menu">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-2 col-md-2">
          <a href="/" title="Logo <?php echo $companyName; ?>">
            <img class="logo-menu d-block" src="<?php echo $displayLogo; ?>" alt="logo <?php echo $companyName; ?>"
              width="200">
            <img class="logo-menu d-none" src="<?php echo $displayLogo; ?>" alt="logo <?php echo $companyName; ?>"
              width="200">
          </a>
        </div>
        <nav id="menu" class="col-10 col-md-10">
          <div class="navigation float-end">
            <button class="menu-toggle" title="Meunu Nav">
              <span class="icon"></span>
              <span class="icon"></span>
              <span class="icon"></span>
            </button>
            <div class="main-menu nav navbar-nav navbar-right">
              <div class="menu-item">
                <a href="/" title="Home">Home</a>
              </div>
              <div class="menu-item menu-item-has-children">
                <a href="#">Hosting</a>
                
                <div class="sub-menu menu-large bg-colorstyle">
                  <div class="service-list">
                    <div class="service">
                      <div class="media-body">
                        <a href="/hosting" class="menu-item mergecolor" title="Web Hosting">Web Hosting</a>
                        <p class="text-muted">Optimized LiteSpeed + CloudLinux hosting</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="menu-item menu-item-has-children">
                <a href="#" class="mergecolor">Domains</a>
                <ul class="sub-menu dropdown bg-colorstyle">
                  <li class="menu-item"><a href="/domainchecker" class="mergecolor" title="Domain Search">Domain Search</a></li>
                  <li class="menu-item"><a href="cart.php?a=add&domain=register" class="mergecolor" title="Register a Domain">Register a Domain</a></li>
                  <li class="menu-item"><a href="cart.php?a=add&domain=transfer" class="mergecolor" title="Transfer a Domain">Transfer a Domain</a></li>
                  <li class="menu-item"><a href="/whois" class="mergecolor" title="WHOIS Lookup">WHOIS Lookup</a></li>
                </ul>
              </div>
              <div class="menu-item menu-item-has-children">
                <a href="#" class="mergecolor">Marketing</a>
                <ul class="sub-menu dropdown bg-colorstyle">
                  <li class="menu-item"><a href="/digital-marketing" class="mergecolor" title="360 Degree Digital Marketing">360° Digital Marketing <span class="badge inside bg-pink">NEW</span></a></li>
                  <li class="menu-item"><a href="/seo" class="mergecolor" title="SEO">SEO</a></li>
                  <li class="menu-item"><a href="/google-ads" class="mergecolor" title="Google Ads">Google Ads <span class="badge inside bg-pink">NEW</span></a></li>
                  <li class="menu-item"><a href="/smm" class="mergecolor" title="Social Media Marketing">SMM <span class="badge inside bg-pink">NEW</span></a></li>
                  <li class="menu-item"><a href="/content-writing" class="mergecolor" title="Content Writing">Content Writing <span class="badge inside bg-pink">NEW</span></a></li>
                </ul>
              </div>
              <!-- SOLUTIONS -->
              <div class="menu-item menu-item-has-children">
                <a href="#" class="mergecolor">Solutions</a>
                <ul class="sub-menu dropdown bg-colorstyle">
                  <li class="menu-item">
                    <a href="/x-dairy" class="mergecolor" title="X Dairy">
                      <strong>X Dairy</strong>
                      <p class="text-muted" style="margin:0;font-size:12px;">Smart dairy farm management platform</p>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="/x-music" class="mergecolor" title="X Music">
                      <strong>X Music</strong>
                      <p class="text-muted" style="margin:0;font-size:12px;">AI-powered music management platform</p>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="/x-booking" class="mergecolor" title="X Booking">
                      <strong>X Booking</strong>
                      <p class="text-muted" style="margin:0;font-size:12px;">AI-powered travel &amp; booking platform</p>
                    </a>
                  </li>
                </ul>
              </div>

              <div class="menu-item menu-item-has-children menu-last">
                <a href="#">Development</a>
                <div class="sub-menu megamenu-list">
                  <div class="container">
                    <div class="row">
                      <div class="service-list col-md-9 bg-colorstyle">
                        <div class="row">
                          <div class="col-4 service">
                            <div class="media-body">
                              <div class="top-head">
                                <div class="menu-item c-grey mergecolor">Website Creation</div>
                              </div>
                              <hr>
                              <a href="/fashion" class="mergecolor" title="Fashion Store">Fashion Store</a>
                              <a href="/ecommerce" class="mergecolor" title="Ecommerce">Ecommerce <span class="badge inside bg-pink">NEW</span></a>
                              <a href="/classifieds" class="mergecolor" title="Classifieds">Classifieds <span class="badge inside bg-pink">NEW</span></a>
                              <a href="/news-blogging" class="mergecolor" title="Blog & News">Blog & News</a>
                              <a href="/elearning" class="mergecolor" title="eLearning">eLearning</a>
                              <a href="/business-portfolio" class="mergecolor" title="Portfolio">Portfolio</a>
                              <a href="/event" class="mergecolor" title="Event Platform">Event Platform</a>
                              <a href="/food-grocery" class="mergecolor" title="Food & Grocery">Food & Grocery <span class="badge inside bg-pink">NEW</span></a>
                              <a href="/radio" class="mergecolor" title="Radio Streaming">Radio Streaming</a>
                            </div>
                          </div>
                          <div class="col-4 service">
                            <div class="media-body">
                              <div class="top-head">
                                <div class="menu-item c-grey mergecolor">Tech & Dev</div>
                              </div>
                              <hr>
                              <a href="/cryptotrading" class="mergecolor" title="Laravel / Custom">Laravel / Custom <span class="badge inside bg-pink">NEW</span></a>
                              <a href="/wordpress" class="mergecolor" title="WordPress">WordPress <span class="badge inside bg-pink">NEW</span></a>
                              <a href="/reactdev" class="mergecolor" title="React">React <span class="badge inside bg-pink">NEW</span></a>
                              <a href="aiagents" class="mergecolor" title="AI Automation &amp; Agents">AI Automation &amp; Agents <span
                                  class="badge inside bg-pink">NEW</span></a>
                              <a href="saas" class="mergecolor" title="SaaS Development">SaaS Development <span
                                  class="badge inside bg-pink">NEW</span></a>
                              <a href="agentic-ai" class="mergecolor" title="AI Agents / Agentic AI">AI Agents / Agentic AI <span
                                  class="badge inside bg-pink">NEW</span></a>
                              <a href="ai-automation" class="mergecolor" title="AI Automation">AI Automation <span
                                  class="badge inside bg-pink">NEW</span></a>
                              <a href="customsoftware" class="mergecolor" title="Custom Software Development"> <span
                                  data-i18n="[html]submenu.customsoftware"> </span> <span
                                  class="badge inside bg-pink">NEW</span></a>
                              <a href="mobileapps" class="mergecolor" title="Mobile Apps"> <span
                                  data-i18n="[html]submenu.mobileapps"> </span> <span
                                  class="badge inside bg-pink">NEW</span></a>
                            </div>
                          </div>
                          <div class="col-4 service">
                            <div class="media-body">
                              <div class="top-head">
                                <div class="menu-item c-grey mergecolor">Other Services</div>
                              </div>
                              <hr>
                              <a href="/vpn" class="mergecolor" title="VPN">VPN Solutions <span class="badge inside bg-pink">NEW</span></a>
                              <a href="/seo" class="mergecolor" title="SEO">SEO <span class="badge inside bg-pink">NEW</span></a>
                              <a href="/gsuite" class="mergecolor" title="Google Suite">Google Suite</a>
                              <a href="/emailsecurity" class="mergecolor" title="Email Security">Email Security</a>


                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- VPS promo block hidden -->
                    </div>
                  </div>
                </div>
              </div>

              <div class="menu-item">
                <a href="/login" class="pe-0 me-0" title="Client Area">
                  <div class="btn btn-default-yellow-fill question">Client Area <i class="fas fa-lock ps-1"></i></div>
                </a>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</div>
<!-- ***** NAV MENU MOBILE ****** -->
<div class="menu-wrap mobile">
  <div style="display:flex;align-items:center;justify-content:space-between;padding:8px 15px;">
    <a href="/" style="display:block;flex-shrink:0;">
      <img src="<?php echo $displayLogo; ?>" alt="logo <?php echo $companyName; ?>" style="width:200px;height:auto;display:block;">
    </a>
    <div style="flex-shrink:0;">
        <nav class="nav-menu float-end d-flex">
          <button id="nav-toggle" class="menu-toggle" aria-label="Dropdown Menu">
            <span class="icon"></span>
            <span class="icon"></span>
            <span class="icon"></span>
          </button>
          <div class="main-menu bg-seccolorstyle">
            <div class="menu-item">
              <a href="#" class="mergecolor" data-bs-toggle="dropdown" title="Home Page">Home <div
                  class="badge bg-purple">new</div></a>
              <div class="dropdown-menu">
                <a href="." class="dropdown-item menu-item" title="Home Default">Home Default</a>
                <a href="food-grocery" class="dropdown-item menu-item" title="Home Gaming">Home Gaming <div
                    class="badge inside bg-purple ms-2">NEW</div></a>
              </div>
            </div>
            <div class="menu-item">
              <a href="#" class="mergecolor" data-bs-toggle="dropdown">Hosting</a>
              <div class="dropdown-menu">
                <a href="/hosting" class="dropdown-item menu-item" title="Shared Hosting">Shared Hosting</a>
                <!-- Dedicated & VPS hidden -->
                <a href="wordpress" class="dropdown-item menu-item" title="WordPress Hosting">WordPress Hosting</a>
              </div>
            </div>
            <div class="menu-item">
              <a href="#" class="mergecolor" data-bs-toggle="dropdown">Domains</a>
              <div class="dropdown-menu">
                <a href="/domainchecker" class="dropdown-item menu-item" title="Domain Search">Domain Search</a>
                <a href="cart.php?a=add&domain=register" class="dropdown-item menu-item" title="Register a Domain">Register a Domain</a>
                <a href="cart.php?a=add&domain=transfer" class="dropdown-item menu-item" title="Transfer a Domain">Transfer a Domain</a>
                <a href="/whois" class="dropdown-item menu-item" title="WHOIS Lookup">WHOIS Lookup</a>
              </div>
            </div>
            <div class="menu-item">
              <a href="#" class="mergecolor" data-bs-toggle="dropdown">Solutions</a>
              <div class="dropdown-menu">
                <a href="/x-dairy" class="dropdown-item menu-item" title="X Dairy">X Dairy</a>
                <a href="/x-music" class="dropdown-item menu-item" title="X Music">X Music</a>
                <a href="/x-booking" class="dropdown-item menu-item" title="X Booking">X Booking</a>
              </div>
            </div>
            <div class="menu-item menu-last">
              <a href="#" class="mergecolor" data-bs-toggle="dropdown">Services</a>
              <div class="dropdown-menu">
                <a href="emailsecurity" class="dropdown-item menu-item" alt="Email Security">Email Security</a>
                <a href="fashion" class="dropdown-item menu-item" title="Fashion Store Development">Fashion Store</a>
                <a href="ecommerce" class="dropdown-item menu-item" title="Ecommerce Store Development">Ecommerce Store Development</a>
                <a href="classifieds" class="dropdown-item menu-item" title="Classified Ads & Marketplace">Classified Ads & Marketplace <div
                    class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="news-blogging" class="dropdown-item menu-item" title="News & Blogging Platform">News & Blogging Platform</a>
                <a href="elearning" class="dropdown-item menu-item" title="Educational & eLearning Platform">Educational & eLearning Platform</a>
                <a href="business-portfolio" class="dropdown-item menu-item" title="Business Portfolio Website">Business Portfolio Website</a>
                <a href="event" class="dropdown-item menu-item" title="Event Platform Development">Event Platform Development</a>
                <a href="food-grocery" class="dropdown-item menu-item" title="Food & Grocery Platform">Food & Grocery Platform</a>
                <a href="radio" class="dropdown-item menu-item" title="Radio Platform Development">Radio Platform Development</a>
                <a href="cryptotrading" class="dropdown-item menu-item" title="Laravel / Custom Website">Laravel / Custom Website <div
                    class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="aiagents" class="dropdown-item menu-item" title="AI Automation &amp; Agents">AI Automation &amp; Agents <div
                    class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="saas" class="dropdown-item menu-item" title="SaaS Development">SaaS Development <div
                    class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="agentic-ai" class="dropdown-item menu-item" title="AI Agents / Agentic AI">AI Agents / Agentic AI <div
                    class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="ai-automation" class="dropdown-item menu-item" title="AI Automation">AI Automation <div
                    class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="gsuite" class="dropdown-item menu-item" title="Suite - Google"> Suite - Google</a>
                <a href="vpn" class="dropdown-item menu-item" title="VPN Solutions">VPN Solutions <div
                    class="badge inside bg-pink ms-2">NEW</div></a>

                <a href="/seo" class="dropdown-item menu-item" title="Managed SEO Services">Managed SEO Services <div
                    class="badge inside bg-pink ms-2">NEW</div></a>

                <a href="/promos" class="dropdown-item menu-item" title="Promotions">Promotions</a>
              </div>
            </div>

            <div class="menu-item menu-last">
              <a href="#" class="mergecolor" data-bs-toggle="dropdown">Marketing</a>
              <div class="dropdown-menu">
                <a href="/digital-marketing" class="dropdown-item menu-item" title="360 Degree Digital Marketing">360° Digital Marketing <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="/seo" class="dropdown-item menu-item" title="SEO">SEO</a>
                <a href="/google-ads" class="dropdown-item menu-item" title="Google Ads">Google Ads <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="/smm" class="dropdown-item menu-item" title="Social Media Marketing">SMM <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="/content-writing" class="dropdown-item menu-item" title="Content Writing">Content Writing <div class="badge inside bg-pink ms-2">NEW</div></a>
              </div>
            </div>

            <div class="float-start w-100 mt-3">
              <p class="c-grey-light seccolor"> <small> Phone: + (123) 1300-656-1046</small> </p>
              <p class="c-grey-light seccolor"><small>Email: antler@mail.com</small> </p>
            </div>
            <div>
              <a href="/login">
                <div class="btn btn-default-yellow-fill mt-3" title="Client Area">CLIENT AREA</div>
              </a>
            </div>
          </div>
        </nav>
    </div>
  </div>
</div>
<!-- ***** TRANSLATION REMOVED ****** -->
<!-- Javascript -->
<script>
  $("#nav-toggle").click(function () {
    $(".menu-wrap.mobile, .menu-toggle").toggleClass("active");
  });
</script>
<script>
  function load(img) {
    img.fadeOut(0, function () {
      img.fadeIn(1000);
    });
  }
  $('.lazyload').lazyload({ load: load });
</script>

</html>