<?php
/* Smarty version 4.5.3, created on 2026-06-03 17:18:52
  from '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/includes/header_sync.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6a2061fc0b4eb8_20928459',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7dc18f02e4a2533a3eb68f1d015853d7b1f5b767' => 
    array (
      0 => '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/includes/header_sync.tpl',
      1 => 1780432728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a2061fc0b4eb8_20928459 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- ===== TOP INFO BAR ===== -->
<div class="sec-bg3 infonews">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-7 news d-none d-md-block">
        <span class="badge bg-purple me-2">news</span>
        <span>SSD Storage with maximum flexibility.</span>
      </div>
      <div class="col-12 col-md-5 link">
        <div class="infonews-nav float-end">
          <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/promos" class="iconews" title="Promotions"><i class="fas fa-tags f-14 w-icon pe-1"></i> Promotions</a>
          <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/blackfriday" class="iconews" title="Black Friday"><i class="fas fa-fire f-14 w-icon pe-1"></i> Black Friday</a>
          <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/announcements.php" class="iconews" title="Notifications"><i class="ico-bell f-18 w-icon"></i></a>
          <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/panier.php" class="iconews" title="Cart"><i class="ico-shopping-cart f-18 w-icon"></i></a>
          <a href="tel:+971505442538" class="iconews tabphone" title="+971-50-544-2538">+971-50-544-2538</a>
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
    display: none; position: fixed; right: 20px; top: 38px; min-width: 150px;
    list-style: none !important; padding: 6px 0 !important; margin: 0 !important;
    border-radius: 6px; box-shadow: 0 6px 20px rgba(0,0,0,0.25); z-index: 100001; flex-direction: column !important;
  }
  .lng-drop.lng-open .lng-list { display: flex !important; flex-direction: column !important; }
  .lng-drop .lng-list li { display: block !important; width: 100% !important; margin: 0 !important; padding: 0 !important; float: none !important; }
  .lng-drop .lng-list li label { display: block !important; width: 100% !important; padding: 8px 16px !important; cursor: pointer; font-size: 13px !important; white-space: nowrap; margin: 0 !important; font-weight: 400 !important; }
  .lng-drop .lng-list li label:hover,
  .lng-drop .lng-list li label.active { color: #ee5586 !important; font-weight: 700 !important; }
  @media (max-width: 768px) {
    .menu-wrap.mobile .logo-menu, .menu-wrap.mobile img.logo-menu {
      width: 160px !important; max-width: 160px !important; max-height: none !important; height: auto !important; top: 0 !important; display: block !important;
    }
    .menu-wrap.mobile .col-8 { flex: 0 0 70% !important; max-width: 70% !important; display: flex; align-items: center; }
    .menu-wrap.mobile .col-4 { flex: 0 0 30% !important; max-width: 30% !important; }
  }
</style>

<!-- ===== MAIN NAV (DESKTOP) ===== -->
<div class="menu-wrap">
  <div class="nav-menu">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-2 col-md-2">
          <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/" title="Logo FILLSBASE">
            <img class="logo-menu d-block" src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/assets/img/fillsbase.png" alt="logo FILLSBASE" width="200">
            <img class="logo-menu d-none"  src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/assets/img/fillsbase.png" alt="logo FILLSBASE" width="200">
          </a>
        </div>
        <nav id="menu" class="col-10 col-md-10">
          <div class="navigation float-end">
            <button class="menu-toggle" title="Menu">
              <span class="icon"></span><span class="icon"></span><span class="icon"></span>
            </button>
            <div class="main-menu nav navbar-nav navbar-right">

              <div class="menu-item">
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/" title="Home">Home</a>
              </div>

              <!-- HOSTING -->
              <div class="menu-item menu-item-has-children">
                <a href="#">Hosting</a>
                <div class="badge bg-grey align-middle">pro</div>
                <div class="sub-menu menu-large bg-colorstyle">
                  <div class="service-list">
                    <div class="service">
                      <div class="media-body">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/hosting" class="menu-item mergecolor" title="Web Hosting">Web Hosting</a>
                        <p class="text-muted">Optimized LiteSpeed + CloudLinux hosting</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- DOMAINS -->
              <div class="menu-item menu-item-has-children">
                <a href="#" class="mergecolor">Domains</a>
                <ul class="sub-menu dropdown bg-colorstyle">
                  <li class="menu-item"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/domainchecker" class="mergecolor" title="Domain Search">Domain Search</a></li>
                  <li class="menu-item"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?a=add&domain=register" class="mergecolor" title="Register a Domain">Register a Domain</a></li>
                  <li class="menu-item"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?a=add&domain=transfer" class="mergecolor" title="Transfer a Domain">Transfer a Domain</a></li>
                  <li class="menu-item"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/whois" class="mergecolor" title="WHOIS Lookup">WHOIS Lookup</a></li>
                </ul>
              </div>

              <!-- MARKETING -->
              <div class="menu-item menu-item-has-children">
                <a href="#" class="mergecolor">Marketing</a>
                <ul class="sub-menu dropdown bg-colorstyle">
                  <li class="menu-item"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/digital-marketing" class="mergecolor" title="360 Degree Digital Marketing">360° Digital Marketing <span class="badge inside bg-pink">NEW</span></a></li>
                  <li class="menu-item"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/seo" class="mergecolor" title="SEO">SEO</a></li>
                  <li class="menu-item"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/google-ads" class="mergecolor" title="Google Ads">Google Ads <span class="badge inside bg-pink">NEW</span></a></li>
                  <li class="menu-item"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/smm" class="mergecolor" title="Social Media Marketing">SMM <span class="badge inside bg-pink">NEW</span></a></li>
                  <li class="menu-item"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/content-writing" class="mergecolor" title="Content Writing">Content Writing <span class="badge inside bg-pink">NEW</span></a></li>
                </ul>
              </div>

              <!-- SOLUTIONS -->
              <div class="menu-item menu-item-has-children">
                <a href="#" class="mergecolor">Solutions</a>
                <ul class="sub-menu dropdown bg-colorstyle">
                  <li class="menu-item">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/x-dairy" class="mergecolor" title="X Dairy">
                      <strong>X Dairy</strong>
                      <p class="text-muted" style="margin:0;font-size:12px;">Smart dairy farm management platform</p>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/x-music" class="mergecolor" title="X Music">
                      <strong>X Music</strong>
                      <p class="text-muted" style="margin:0;font-size:12px;">AI-powered music management platform</p>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/x-booking" class="mergecolor" title="X Booking">
                      <strong>X Booking</strong>
                      <p class="text-muted" style="margin:0;font-size:12px;">AI-powered travel &amp; booking platform</p>
                    </a>
                  </li>
                </ul>
              </div>

              <!-- DEVELOPMENT -->
              <div class="menu-item menu-item-has-children menu-last">
                <a href="#">Development</a>
                <div class="sub-menu megamenu-list">
                  <div class="container">
                    <div class="row">
                      <div class="service-list col-md-9 bg-colorstyle">
                        <div class="row">
                          <div class="col-4 service">
                            <div class="media-body">
                              <div class="top-head"><div class="menu-item c-grey mergecolor">Website Creation</div></div>
                              <hr>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/fashion"          class="mergecolor" title="Fashion Store">Fashion Store</a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/ecommerce"        class="mergecolor" title="Ecommerce">Ecommerce <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/classifieds"      class="mergecolor" title="Classifieds">Classifieds <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/news-blogging"    class="mergecolor" title="Blog & News">Blog &amp; News</a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/elearning"        class="mergecolor" title="eLearning">eLearning</a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/business-portfolio" class="mergecolor" title="Portfolio">Portfolio</a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/event"            class="mergecolor" title="Event Platform">Event Platform</a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/food-grocery"     class="mergecolor" title="Food & Grocery">Food &amp; Grocery <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/radio"            class="mergecolor" title="Radio Streaming">Radio Streaming</a>
                            </div>
                          </div>
                          <div class="col-4 service">
                            <div class="media-body">
                              <div class="top-head"><div class="menu-item c-grey mergecolor">Tech &amp; Dev</div></div>
                              <hr>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cryptotrading"   class="mergecolor" title="Laravel / Custom">Laravel / Custom <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/wordpress"       class="mergecolor" title="WordPress">WordPress <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/reactdev"        class="mergecolor" title="React">React <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/aiagents"        class="mergecolor" title="AI Automation & Agents">AI Automation &amp; Agents <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/saas"            class="mergecolor" title="SaaS Development">SaaS Development <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/agentic-ai"      class="mergecolor" title="AI Agents / Agentic AI">AI Agents / Agentic AI <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/ai-automation"   class="mergecolor" title="AI Automation">AI Automation <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/customsoftware"  class="mergecolor" title="Custom Software">Custom Software <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/mobileapps"      class="mergecolor" title="Mobile Apps">Mobile Apps <span class="badge inside bg-pink">NEW</span></a>
                            </div>
                          </div>
                          <div class="col-4 service">
                            <div class="media-body">
                              <div class="top-head"><div class="menu-item c-grey mergecolor">Other Services</div></div>
                              <hr>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/vpn"             class="mergecolor" title="VPN">VPN Solutions <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/seo"             class="mergecolor" title="SEO">SEO <span class="badge inside bg-pink">NEW</span></a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/gsuite"          class="mergecolor" title="Google Suite">Google Suite</a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/emailsecurity"   class="mergecolor" title="Email Security">Email Security</a>
                              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/press"           class="mergecolor" title="Blog">Blog</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- CLIENT AREA -->
              <div class="menu-item">
                <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php" class="pe-0 me-0" title="Client Area">
                  <div class="btn btn-default-yellow-fill question">Client Area <i class="fas fa-user ps-1"></i></div>
                </a>
                <?php } else { ?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/login" class="pe-0 me-0" title="Client Area">
                  <div class="btn btn-default-yellow-fill question">Client Area <i class="fas fa-lock ps-1"></i></div>
                </a>
                <?php }?>
              </div>

            </div><!-- /.main-menu -->
          </div><!-- /.navigation -->
        </nav>
      </div>
    </div>
  </div>
</div>

<!-- ===== MOBILE NAV ===== -->
<div class="menu-wrap mobile">
  <div style="display:flex;align-items:center;justify-content:space-between;padding:8px 15px;">
    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/" style="display:block;flex-shrink:0;">
      <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/assets/img/fillsbase.png" alt="logo FILLSBASE" style="width:200px;height:auto;display:block;">
    </a>
    <div style="flex-shrink:0;">
        <nav class="nav-menu float-end d-flex">
          <button id="nav-toggle" class="menu-toggle" aria-label="Dropdown Menu">
            <span class="icon"></span><span class="icon"></span><span class="icon"></span>
          </button>
          <div class="main-menu bg-seccolorstyle">
            <div class="menu-item">
              <a href="#" class="mergecolor" data-bs-toggle="dropdown">Hosting <div class="badge bg-grey">pro</div></a>
              <div class="dropdown-menu">
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/hosting"       class="dropdown-item menu-item" title="Shared Hosting">Shared Hosting</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/wordpress"     class="dropdown-item menu-item" title="WordPress Hosting">WordPress Hosting</a>
              </div>
            </div>
            <div class="menu-item">
              <a href="#" class="mergecolor" data-bs-toggle="dropdown">Domains</a>
              <div class="dropdown-menu">
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/domainchecker"                       class="dropdown-item menu-item" title="Domain Search">Domain Search</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?a=add&domain=register"      class="dropdown-item menu-item" title="Register a Domain">Register a Domain</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?a=add&domain=transfer"      class="dropdown-item menu-item" title="Transfer a Domain">Transfer a Domain</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/whois"                               class="dropdown-item menu-item" title="WHOIS Lookup">WHOIS Lookup</a>
              </div>
            </div>
            <div class="menu-item">
              <a href="#" class="mergecolor" data-bs-toggle="dropdown">Solutions</a>
              <div class="dropdown-menu">
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/x-dairy" class="dropdown-item menu-item" title="X Dairy">X Dairy</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/x-music" class="dropdown-item menu-item" title="X Music">X Music</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/x-booking" class="dropdown-item menu-item" title="X Booking">X Booking</a>
              </div>
            </div>
            <div class="menu-item menu-last">
              <a href="#" class="mergecolor" data-bs-toggle="dropdown">Services</a>
              <div class="dropdown-menu">
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/emailsecurity"   class="dropdown-item menu-item" title="Email Security">Email Security</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/fashion"         class="dropdown-item menu-item" title="Fashion Store">Fashion Store</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/ecommerce"       class="dropdown-item menu-item" title="Ecommerce">Ecommerce Store <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/classifieds"     class="dropdown-item menu-item" title="Classified Ads">Classified Ads <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/news-blogging"   class="dropdown-item menu-item" title="News & Blogging">News &amp; Blogging</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/elearning"       class="dropdown-item menu-item" title="eLearning">eLearning</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/business-portfolio" class="dropdown-item menu-item" title="Portfolio">Business Portfolio</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/event"           class="dropdown-item menu-item" title="Event Platform">Event Platform</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/food-grocery"    class="dropdown-item menu-item" title="Food & Grocery">Food &amp; Grocery</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/radio"           class="dropdown-item menu-item" title="Radio Streaming">Radio Streaming</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cryptotrading"   class="dropdown-item menu-item" title="Laravel / Custom">Laravel / Custom <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/aiagents"        class="dropdown-item menu-item" title="AI Automation & Agents">AI Automation &amp; Agents <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/saas"            class="dropdown-item menu-item" title="SaaS Development">SaaS Development <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/agentic-ai"      class="dropdown-item menu-item" title="AI Agents">AI Agents / Agentic AI <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/ai-automation"   class="dropdown-item menu-item" title="AI Automation">AI Automation <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/gsuite"          class="dropdown-item menu-item" title="Google Suite">Suite - Google</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/vpn"             class="dropdown-item menu-item" title="VPN Solutions">VPN Solutions <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/seo"             class="dropdown-item menu-item" title="Managed SEO">Managed SEO Services <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/promos"          class="dropdown-item menu-item" title="Promotions">Promotions</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/blackfriday"     class="dropdown-item menu-item" title="Black Friday">Blackfriday <div class="badge inside bg-pink ms-2">HOT</div></a>
              </div>
            </div>
            <div class="menu-item menu-last">
              <a href="#" class="mergecolor" data-bs-toggle="dropdown">Marketing</a>
              <div class="dropdown-menu">
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/digital-marketing" class="dropdown-item menu-item" title="360 Digital Marketing">360° Digital Marketing <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/seo"               class="dropdown-item menu-item" title="SEO">SEO</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/google-ads"        class="dropdown-item menu-item" title="Google Ads">Google Ads <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/smm"               class="dropdown-item menu-item" title="SMM">SMM <div class="badge inside bg-pink ms-2">NEW</div></a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/content-writing"   class="dropdown-item menu-item" title="Content Writing">Content Writing <div class="badge inside bg-pink ms-2">NEW</div></a>
              </div>
            </div>
            <div class="float-start w-100 mt-3">
              <p class="c-grey-light seccolor"><small>Tel: +971-50-544-2538</small></p>
              <p class="c-grey-light seccolor"><small>Email: info@fillsbase.com</small></p>
            </div>
            <div>
              <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php"><div class="btn btn-default-yellow-fill mt-3">CLIENT AREA</div></a>
              <?php } else { ?>
              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/login"><div class="btn btn-default-yellow-fill mt-3">CLIENT AREA</div></a>
              <?php }?>
            </div>
          </div>
        </nav>
    </div>
  </div>
</div>

<?php echo '<script'; ?>
>
$("#nav-toggle").click(function(){
  $(".menu-wrap.mobile, .menu-toggle").toggleClass("active");
});
<?php echo '</script'; ?>
>
<?php }
}
