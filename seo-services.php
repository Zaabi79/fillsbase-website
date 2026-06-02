<?php
if (file_exists('init.php')) {
    require_once('init.php');
}
require_once('includes/fillsbase_helpers.php');
$standardPrice = formatFillsbasePrice(getFillsbaseProductPrice(305, 'monthly')) . ' /mo';
$enhancedPrice = formatFillsbasePrice(getFillsbaseProductPrice(306, 'monthly')) . ' /mo';
$ultimatePrice = formatFillsbasePrice(getFillsbaseProductPrice(307, 'monthly')) . ' /mo';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillsbase.com provides premium web hosting, VPS, dedicated servers, and domain registration services.">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
    <title>SEO Services - Fillsbase.com | Professional Search Engine Optimization</title>
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
    <link href="assets/css/fillsbase_custom.css?v=4.0" rel="stylesheet">
    <!-- Javascript -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/gdpr-cookie.min.js"></script>
    <script defer type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script defer type="text/javascript" src="assets/js/slick.min.js"></script>
    <script defer type="text/javascript" src="assets/js/aos.min.js"></script>
    <script defer type="text/javascript" src="assets/js/swiper.min.js"></script>
    <script defer type="text/javascript" src="assets/js/jquery.lazyload-any.min.js"></script>
    <script defer type="text/javascript" src="assets/js/scripts.min.js"></script>
    <script defer type="text/javascript" src="assets/js/settings-init.js"></script>
  </head>
  <body >
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
  <header id="header"> </header>
  <!-- ***** SLIDER ***** -->
  <div class="main-container slider">
    <div class="silder-container">
      <div class="carousel header-main-slider">
        <!-- 1 Slider -->
        <div class="carousel-cell overlay">
          <div class="slider-content">
            <div class="container">
              <div class="col-sm-12 col-md-8 px-0">
                <h1 data-aos="fade-up">SEO services to get your website across top search engines</h1>
                <p data-aos="fade-up">Grow leads for your business by using recommended SEO strategies that will help your audience <b class="c-pink">discover your website more easily.</b></p>
                <a href="#seoplans" class="btn btn-default-pink-fill mb-2">See Plan Details</a>
              </div>
            </div>
          </div>
          <div class="full-slider">
            <img src="./assets/img/seo-banner.png" alt="SEO Services"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** WHY CHOOSE FILLSBASE ***** -->
  <section class="services sec-normal motpath toppadding bg-colorstyle">
    <div class="container">
      <div class="service-wrap">
        <div class="row">
          <div class="col-sm-12 text-center">
            <h2 class="section-heading mergecolor">A Great Website Deserves To Be In The Limelight!</h2>
            <p class="section-subheading mergecolor">Let the SEO Experts get your website ranking on top search sites like Google, Yahoo and Bing!</p>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="service-section bg-seccolorstyle noshadow">
              <div class="plans badge feat bg-purple">Campaigns</div>
              <div class="lazyload">
              </div>
              <div class="title mergecolor">Dedicated SEO Manager</div>
              <p class="subtitle seccolor">
                Our SEO managers work closely with you to understand your business goals and implement a custom strategy that drives organic traffic and increases conversions.
              </p>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="service-section bg-seccolorstyle noshadow">
              <div class="lazyload">
              </div>
              <div class="title mergecolor">Keyword Targeting</div>
              <p class="subtitle seccolor">
                We identify the high-value keywords your customers are searching for and optimize your content to ensure you rank for the most relevant search terms.
              </p>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="service-section bg-seccolorstyle noshadow">
              <div class="lazyload">
              </div>
              <div class="title mergecolor">Link Building</div>
              <p class="subtitle seccolor">
                Improve your domain authority with high-quality, relevant backlinks from trusted sources in your industry, managed by our experienced SEO team.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** PRICING TABLES ***** -->
  <section id="seoplans" class="pricing special sec-normal bg-seccolorstyle">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="section-heading mergecolor">Professional SEO Services for Your Business</h2>
          <p class="section-subheading mergecolor">Add Managed SEO Services to your hosting plan to boost your ranking on search engines!</p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4" data-aos="fade-up" data-aos-duration="1200">
          <div class="wrapper first text-start noshadow">
            <div class="top-content bg-colorstyle topradius">
              <div class="lazyload">
              </div>
              <div class="title">Standard SEO</div>
              <div class="fromer seccolor m-0">Perfect for local businesses and startups</div>
              <div class="price mergecolor"><sup></sup><?php echo $standardPrice; ?></div>
              <a href="cart.php?a=add&pid=305" class="btn btn-default-yellow-fill">Order Now</a>
            </div>
            <ul class="list-info bg-purple">
              <li><i class="icon-index"></i> <div>INDEX<br> <span>5 Optimized Keywords</span></div></li>
              <li><i class="icon-key"></i> <div>KEY<br> <span>Monthly Action Plan</span></div></li>
              <li><i class="icon-report"></i> <div>REPORT<br> <span>Monthly Reporting</span></div></li>
              <li><i class="icon-domainserver"></i> <div>LOCAL<br> <span>1 Local SEO Setup</span></div></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4" data-aos="fade-up" data-aos-duration="900">
          <div class="wrapper text-start noshadow">
            <div class="top-content bg-colorstyle topradius">
              <div class="plans badge feat bg-purple">Recommended</div>
              <div class="lazyload">
              </div>
              <div class="title">Enhanced SEO</div>
              <div class="fromer seccolor m-0">Ideal for growing businesses and e-commerce</div>
              <div class="price mergecolor"><sup></sup><?php echo $enhancedPrice; ?></div>
              <a href="cart.php?a=add&pid=306" class="btn btn-default-yellow-fill">Order Now</a>
            </div>
            <ul class="list-info bg-purple">
              <li><i class="icon-index"></i> <div>INDEX<br><span>15 Optimized Keywords</span></div></li>
              <li><i class="icon-key"></i> <div>KEY<br><span>Weekly Strategy Updates</span></div></li>
              <li><i class="icon-report"></i> <div>REPORT<br><span>Detailed Monthly Reports</span></div></li>
              <li><i class="icon-domainserver"></i> <div>LOCAL<br><span>3 Local SEO Listings</span></div></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4" data-aos="fade-up" data-aos-duration="1200">
          <div class="wrapper third text-start noshadow">
            <div class="top-content bg-colorstyle topradius">
              <div class="lazyload">
              </div>
              <div class="title">Ultimate SEO</div>
              <div class="fromer seccolor m-0">The ultimate package for enterprise-level growth</div>
              <div class="price mergecolor"><sup></sup><?php echo $ultimatePrice; ?></div>
              <a href="cart.php?a=add&pid=307" class="btn btn-default-yellow-fill">Order Now</a>
            </div>
            <ul class="list-info bg-purple">
              <li><i class="icon-index"></i> <div>INDEX<br><span>50 Optimized Keywords</span></div></li>
              <li><i class="icon-key"></i> <div>KEY<br><span>Daily Rank Tracking</span></div></li>
              <li><i class="icon-report"></i> <div>REPORT<br><span>Priority Bi-Weekly Reports</span></div></li>
              <li><i class="icon-domainserver"></i> <div>LOCAL<br><span>Global & Local SEO</span></div></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** FEATURES ***** -->
  <section id="scroll" class="history-section feat01 sec-normal bg-colorstyle">
    <div class="container">
      <div class="randomline">
        <div class="bigline"></div>
        <div class="smallline"></div>
      </div>
      <div class="sec-main sec-bg1 bg-colorstyle noshadow nopadding">
        <div class="row">
          <div class="col-md-12 col-lg-5">
            <div class="lazyload">
              <!-- <svg class="svg" viewBox="0 0 646.6 652.5" style="enable-background:new 0 0 646.6 652.5" xml:space="preserve"><style>.domainmanage1{stroke-width:2}.domainmanage1,.domainmanage2,.domainmanage3{fill:none;stroke:gray;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10}.domainmanage3{stroke:#ee5586;stroke-width:2}.domainmanage5{fill:#ee5586}</style><radialGradient id="SVGID_1_" cx="210.3" cy="-71.6" r="0" gradientTransform="translate(0 274.1)" gradientUnits="userSpaceOnUse"><stop offset="0" style="stop-color:#27aae1"/><stop offset=".2" style="stop-color:#2aabe1"/><stop offset=".3" style="stop-color:#33aee1"/><stop offset=".5" style="stop-color:#44b3e2"/><stop offset=".6" style="stop-color:#5abae3"/><stop offset=".7" style="stop-color:#78c4e4"/><stop offset=".8" style="stop-color:#9ccfe5"/><stop offset=".9" style="stop-color:#c6dde7"/><stop offset="1" style="stop-color:#e6e7e8"/></radialGradient><path d="M210.3 202.5c-.1 0-.1 0 0 0z" style="fill:url(#SVGID_1_)"/><path class="domainmanage1" d="M363 2.7v307.7M642.3 281.1h-562M127.5 128.5c84.9 86.5 376.4 85.7 467.7 0"/><path class="domainmanage1" d="m234.8 310.4-.2-27.2c0-154.9 58.1-280.5 129.7-280.5S494 128.3 494 283.2c0 6.3-.1 21-.3 27.2"/><path class="domainmanage2" d="M361.3 587c-36.6 23.4-81.5 40.5-128.9 40.5-126.5 0-229.1-97.3-229.1-217.2 0-46.6-7.3-108.1 44.1-129.4"/><path class="domainmanage2" d="M361.3 587c-42 45.7-81.5 62.4-128.9 62.4A228.7 228.7 0 0 1 3.6 420.9M58.4 286.6h-8.6c-1.3 0-2.3-1-2.3-2.3v-5.1c0-1.3 1-2.3 2.3-2.3h8.7"/><path class="domainmanage2" d="M80.7 295.7h-13a9.3 9.3 0 0 1-9.3-9.3v-9.1c0-5.1 4.2-9.3 9.3-9.3h13"/><path class="domainmanage2" d="M150.7 468.4a281 281 0 1 1 491.6-186h0c0 72.2-27.3 138.1-72 187.9"/><path id="svg-concept" class="domainmanage3" d="M202.4 442.7h59.2"/><path class="domainmanage2" d="M445.6 442.7h59.2m-180.8 0h59.2m-180.8 36.9h59.2"/><path id="svg-concept" class="domainmanage3" d="M445.6 479.6h59.2"/><path class="domainmanage2" d="M324 479.6h59.2m-180.8 36.8h59.2m184 0h59.2"/><path id="svg-concept" class="domainmanage3" d="M324 516.4h59.2"/><path class="domainmanage2" d="M202.4 553.3h59.2m184 0h59.2m-180.8 0h59.2m89-155.1H235a3 3 0 0 1-3-3v-17.6a3 3 0 0 1 3-3h237.2a3 3 0 0 1 3 3v17.6a3 3 0 0 1-3 3zM152.9 349.8h416.9"/><path id="svg-concept" d="M167.7 317.7h387.2a15 15 0 0 1 14.9 14.9v239.7a15 15 0 0 1-14.9 14.9H167.7a15 15 0 0 1-14.9-14.9V332.5a15 15 0 0 1 14.9-14.8z" style="fill:none;stroke-width:3;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10"/><g><path id="svg-ico" class="domainmanage5" d="M330 442.7c0 3.3-2.7 6-6 6s-6-2.7-6-6 2.7-6 6-6c3.3.1 6 2.8 6 6z"/><animateMotion accumulate="none" additive="replace" begin="0s" calcMode="paced" dur="2s" fill="remove" path="M55, 0 0 0 0 0 55 0" repeatCount="indefinite" restart="always"/></g><g><path id="svg-ico" class="domainmanage5" d="M208.4 516.4c0 3.3-2.7 6-6 6s-6-2.7-6-6 2.7-6 6-6 6 2.7 6 6z"/><animateMotion accumulate="none" additive="replace" begin="1s" calcMode="paced" dur="3s" fill="remove" path="M55, 0 0 0 0 0 55 0" repeatCount="indefinite" restart="always"/></g><g><path id="svg-ico" class="domainmanage5" d="M510.8 553.2c0 3.3-2.7 6-6 6s-6-2.7-6-6 2.7-6 6-6c3.3.1 6 2.8 6 6z"/><animateMotion accumulate="none" additive="replace" begin="2s" calcMode="paced" dur="2s" fill="remove" path="M0, 0 -55 0 0 0 0 0" repeatCount="indefinite" restart="always"/></g></svg> -->
            </div>
          </div>
          <div class="col-md-12 col-lg-6 offset-lg-1">
            <div class="info-content">
              <h1 class="fw-bold mb-3 mergecolor">In-depth Keyword Research For Your Business</h1>
              <p class="seccolor">Get a competitive edge with a comprehensive SEO strategy that focuses on keyword optimization, technical SEO, and content creation to help your business grow.</p>
              <p class="seccolor">We monitor your search engine rankings and provide detailed insights to ensure your website remains optimized for performance and growth in a competitive landscape.</p>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12 col-lg-6">
            <div class="info-content">
              <h1 class="fw-bold mb-3 mergecolor">Comprehensive Monthly Website Reviews</h1>
              <p class="seccolor">Our team provides monthly website reviews to ensure your site is running at peak performance and following the latest SEO best practices.</p>
              <p class="seccolor">Stay informed with transparent reporting that shows your progress and identifies new opportunities for ranking and traffic growth.</p>
            </div>
          </div>
          <div class="col-md-12 col-lg-5 offset-lg-1">
            <div class="lazyload">
              <!-- <svg class="svg" x="0" y="0" style="enable-background:new 0 0 524.8 419.6" version="1.1" viewBox="0 0 525 420"><style>.emailcalendar0,.emailcalendar1{stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10}.emailcalendar0{fill:none;stroke:#ee5586;stroke-width:3}.emailcalendar1{fill:#fff;stroke:gray}.emailcalendar2{stroke:gray}.emailcalendar2,.emailcalendar3{stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10}.emailcalendar2,.emailcalendar3{fill:none}.emailcalendar3{stroke:#ee5586;stroke-width:2}.emailcalendar4{fill:#ee5586}</style><path id="svg-concept" d="M411 290v109c0 8-6 14-13 14H17c-7 0-13-6-13-14V19c0-8 6-14 13-14h380c8 0 14 6 14 14v56" class="emailcalendar0"/><path d="M4 276h286M3 209h287M3 343h407M4 140h286m-150 1v272m135-272v272M91 222l-41 41m180 25-41 41" class="emailcalendar1"/><g><path d="M483 78h21v210H316V78h136m-8 133h-70m45 28h-45m91-55h-91" class="emailcalendar2"/><path id="svg-concept" d="M466 156h-92m46-27h-46m78-51v47l15-13 16 13V78s2-9-10-9h-17s-14-1-14 9m-84 51a6 6 0 1 1-6-6c3 0 6 2 6 6zm0 27a6 6 0 1 1-12 0c0-3 3-6 6-6s6 3 6 6z" class="emailcalendar3"/><path d="M358 183a6 6 0 1 1-12 0c0-3 3-5 6-5s6 2 6 5zm0 28a6 6 0 1 1-12 0c0-4 3-6 6-6s6 3 6 6zm0 27a6 6 0 1 1-12 0c0-3 3-6 6-6s6 3 6 6z" class="emailcalendar2"/><animateMotion fill="remove" accumulate="none" additive="replace" begin="0s" calcMode="paced" dur="3s" path="M0, 0 -15 0 0 0" repeatCount="indefinite" restart="always"/></g><g><circle id="svg-ico" cx="250.9" cy="163.6" r="6" class="emailcalendar4"/><animate fill="remove" accumulate="none" additive="replace" attributeName="opacity" calcMode="linear" dur="1s" repeatCount="indefinite" restart="always" values="0;1;0"/></g><g><circle id="svg-ico" cx="115.7" cy="299.9" r="6" class="emailcalendar4"/><animate fill="remove" accumulate="none" additive="replace" attributeName="opacity" calcMode="linear" dur="2s" repeatCount="indefinite" restart="always" values="0;1;0"/></g><g><circle id="svg-ico" cx="386.8" cy="366.9" r="6" class="emailcalendar4"/><animate fill="remove" accumulate="none" additive="replace" attributeName="opacity" calcMode="linear" dur="0.5s" repeatCount="indefinite" restart="always" values="0;1;0"/></g></svg> -->
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12 col-lg-5">
            <div class="lazyload">
              <!-- <svg class="svg" x="0" y="0" style="enable-background:new 0 0 543.5 398.4" version="1.1" viewBox="0 0 544 398"><style>.ranking0{fill:none;stroke:gray;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10}.ranking1{stroke:#ee5586;stroke-width:2}.ranking1,.ranking2,.ranking3{fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10}.ranking2{stroke:gray;stroke-dasharray:5}.ranking3{stroke:#ee5586;stroke-width:3}</style><path d="m456 286 61 18-244 90-244-90 61-18" class="ranking0"/><path id="svg-concept" d="m320 188 223 67-270 98L3 255l169-51" class="ranking1"/><path d="M373 255h164m-525 0h185m76 95v-67" class="ranking2"/><g><path id="svg-concept" d="M263 113V31l-45-16-44 16v215l44 17 9-4M174 31l44 17m0 0 45-17m-45 17v215" class="ranking3"/><animate attributeName="opacity" begin="0s" dur="2s" repeatCount="indefinite" values="0;1;0"/></g><path d="M284 286v-63l45-16 44 16v63l-44 16-45-16z" class="ranking0"/><path d="m329 207-45 16 45 16" class="ranking0"/><path d="m274 282-45-15V127l45-16 44 16v84m11 28 44-16m-44 16v63M229 127l45 16m44-16-44 16" class="ranking0"/><path d="M274 143v139l10-5" class="ranking0"/></svg> -->
            </div>
          </div>
          <div class="col-md-12 col-lg-6 offset-lg-1">
            <div class="info-content">
              <h1 class="fw-bold mb-3 mergecolor">Stand-out Website and SEO Reports</h1>
              <p class="seccolor">Our SEO reports provide a clear overview of your website performance, keyword rankings, and competitor analysis, helping you make data-driven decisions for your business.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** FAQ. ***** -->
  <section class="sec-normal sec-bg1 bg-seccolorstyle">
    <div class="faq">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 text-center">
            <h2 class="section-heading mergecolor">SEO Services FAQ</h2>
            <p class="section-subheading mergecolor">We provide monthly and quarterly ranking reports, so you can check your ranking changes for your SEO keywords.</p>
          </div>
          <div class="col-sm-12">
            <div class="accordion faq pt-5">
              <div class="panel-wrap">
                <div class="panel-title seccolor active">
                  <span>What is the SEO Services?</span>
                  <div class="float-end">
                    <i class="fa fa-plus"></i>
                    <i class="fa fa-minus c-pink"></i>
                  </div>
                </div>
                <div class="panel-collapse" style="display: block;">
                  <div class="wrapper-collapse">
                    <div class="info">
                      <ul class="list seccolor">
                        <li>
                          <p>Our SEO service is a comprehensive solution designed to improve your website visibility on search engines. We handle keyword research, on-page optimization, and technical SEO so you can focus on running your business.</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-wrap">
                <div class="panel-title seccolor">
                  <span>Why should I choose Fillsbase for SEO?</span>
                  <div class="float-end">
                    <i class="fa fa-plus"></i>
                    <i class="fa fa-minus c-pink"></i>
                  </div>
                </div>
                <div class="panel-collapse">
                  <div class="wrapper-collapse">
                    <div class="info">
                      <ul class="list seccolor">
                        <li>
                          <p>Fillsbase.com offers specialized SEO services backed by years of industry experience. We combine technical expertise with data-driven strategies to deliver measurable results and long-term growth for your brand. </p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-wrap">
                <div class="panel-title seccolor">
                  <span>Will You Implement the On-Page Changes for Me?</span>
                  <div class="float-end">
                    <i class="fa fa-plus"></i>
                    <i class="fa fa-minus c-pink"></i>
                  </div>
                </div>
                <div class="panel-collapse">
                  <div class="wrapper-collapse">
                    <div class="info">
                      <ul class="list seccolor">
                        <li>
                          <p>Yes, our team of experts can implement technical and on-page SEO changes directly on your website, ensuring everything is optimized correctly for search engines.</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-wrap">
                <div class="panel-title seccolor">
                  <span>Should I use SEO or Google Ads?</span>
                  <div class="float-end">
                    <i class="fa fa-plus"></i>
                    <i class="fa fa-minus c-pink"></i>
                  </div>
                </div>
                <div class="panel-collapse">
                  <div class="wrapper-collapse">
                    <div class="info">
                      <ul class="list seccolor">
                        <li>
                          <p>While Google Ads provide immediate results, SEO builds long-term organic authority and trust. A balanced strategy often uses both to maximize visibility and cost-effectiveness over time.</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** CONTACT FORM ***** -->
  <section id="requestconsult" class="sec-normal bg-colorstyle">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 cd-filter-block mb-0">
          <div class="form-contact cd-filter-content p-0 sec-bx">
            <div class="text-center">
              <h2 class="section-heading mergecolor">Contact Us And Request A Consultation</h2>
              <p class="mergecolor">Schedule a call today and one of our experts will be happy to help you decide!</p>
            </div>
            <form id="contactForm" method="POST">
              <div class="row">
                <div class="col-md-6 position-relative">
                  <label><i class="fas fa-user-tie"></i></label>
                  <input id="name" type="text" name="name" placeholder="Full Name" required="">
                </div>
                <div class="col-md-6 position-relative">
                  <label><i class="fas fa-envelope"></i></label>
                  <input id="email" type="email" name="email" placeholder="Email Address" required="">
                </div>
                <div class="col-md-6 position-relative">
                  <label><i class="fas fa-file-alt"></i></label>
                  <input id="subject" type="text" name="subject" placeholder="Subject" required>
                </div>
                <div class="col-md-6 position-relative">
                  <div class="cd-select mt-4">
                    <label class="db"></label>
                    <select id="department" name="department" class="select-filter" aria-label="Choose Department">
                      <option value="">Choose Department</option>
                      <option value="Support/Help Desk">Support/Help Desk</option>
                      <option value="Commercial Department">Commercial Department</option>
                      <option value="Sales Department">Sales Department</option>
                      <option value="Schedule Metings">Schedule Metings</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6 position-relative">
                  <div class="form-group mt-4">
                    <textarea id="message" name="message" class="form-control" rows="5" placeholder="Message..."></textarea>
                  </div>
                </div>
                <div class="col-md-6 position-relative mt-5">
                  <input name="newsletter" type="checkbox" id="checkbox" class="filter">
                  <label for="checkbox" class="checkbox-label c-grey mb-4 seccolor" ><span>I have read and accept the terms of the privacy policy - <a href="legal" class="golink">RGPD</a></span></label>
                  <button type="submit" value="Submit" class="btn btn-default-yellow-fill float-start me-3">Submit Ticket</button>
                  <button type="reset" value="reset" class="btn btn-default-fill mt-0 mb-3 me-3">Reset</button><br>
                </div>
                <div id="msgSubmit" class="col-md-12 mt-4">
                  <h3 class="c-pink"> Message Submitted!</h3>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** UPLOADED FOOTER FROM FOOTER.HTML ***** -->
<footer id="footer"> </footer>
</div>
<!-- ***** BUTTON GO TOP ***** -->
<a href="#0" class="cd-top" title="Go Top"> <i class="fas fa-angle-up"></i> </a>
</body>
</html>