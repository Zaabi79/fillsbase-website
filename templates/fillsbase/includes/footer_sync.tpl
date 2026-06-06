{if $verifyemail}
    {include file="$template/includes/verifyemail.tpl"}
{/if}

<footer class="footer">
  <div class="container">
    <div class="footer-top">
      <div class="row">

        <!-- Col 1: Hosting -->
        <div class="col-sm-6 col-md-2">
          <div class="heading">Hosting</div>
          <ul class="footer-menu">
            <li class="menu-item"><a href="{$WEB_ROOT}/hosting" title="Shared Hosting">Shared Hosting</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/wordpress" title="WordPress Hosting">WordPress Hosting</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/emailsecurity" title="Professional Email">Professional Email</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/domainchecker" title="Domains">Domain Names</a></li>
          </ul>
        </div>

        <!-- Col 2: Development -->
        <div class="col-sm-6 col-md-2">
          <div class="heading">Development</div>
          <ul class="footer-menu">
            <li class="menu-item"><a href="{$WEB_ROOT}/ecommerce" title="E-commerce">E-commerce</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/wordpress" title="WordPress">WordPress</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/reactdev" title="React / Custom">React / Custom</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/mobileapps" title="Mobile Apps">Mobile Apps</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/saas" title="SaaS">SaaS Dev</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/customsoftware" title="Custom Software">Custom Software</a></li>
          </ul>
        </div>

        <!-- Col 3: Marketing & AI -->
        <div class="col-sm-6 col-md-2">
          <div class="heading">Marketing & AI</div>
          <ul class="footer-menu">
            <li class="menu-item"><a href="{$WEB_ROOT}/seo" title="SEO">SEO &amp; Search</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/digital-marketing" title="Digital Marketing">Digital Marketing</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/google-ads" title="Google Ads">Google Ads</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/smm" title="Social Media">Social Media (SMM)</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/aiagents" title="AI Agents">AI Agents</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/ai-automation" title="AI Automation">AI Automation</a></li>
          </ul>
        </div>

        <!-- Col 4: Support & Account -->
        <div class="col-sm-6 col-md-2">
          <div class="heading">Support</div>
          <ul class="footer-menu">
            <li class="menu-item"><a href="{$WEB_ROOT}/clientarea.php" title="Client Area">Client Area</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/knowledgebase.php" title="Knowledge Base">Knowledge Base</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/submitticket.php" title="Open a Ticket">Open a Ticket</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/supporttickets.php" title="My Tickets">My Tickets</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/contact" title="Contact">Contact Us</a></li>
            <li class="menu-item"><a href="{$WEB_ROOT}/announcements.php" title="Announcements">Announcements</a></li>
          </ul>
        </div>

        <!-- Col 5: Company + Social -->
        <div class="col-sm-6 col-md-4">
          <img class="logo-footer d-block" src="{$WEB_ROOT}/assets/img/fillsbase.png" alt="logo {$companyname}" width="180">
          <img class="logo-footer d-none"  src="{$WEB_ROOT}/assets/img/fillsbase.png" alt="logo {$companyname}" width="180">
          <div class="copyright" style="margin-top:12px;">Fillsbase.com is your trusted partner for web hosting, custom development, AI automation, and digital marketing in Africa and beyond.</div>
          <div class="soc-icons">
            <a href="#" title="Facebook"><i class="fab fa-facebook-f withborder noshadow"></i></a>
            <a href="#" title="YouTube"><i class="fab fa-youtube withborder noshadow"></i></a>
            <a href="#" title="Twitter / X"><i class="fab fa-x-twitter withborder noshadow"></i></a>
            <a href="#" title="Instagram"><i class="fab fa-instagram withborder noshadow"></i></a>
            <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in withborder noshadow"></i></a>
            <a href="#" title="WhatsApp"><i class="fab fa-whatsapp withborder noshadow"></i></a>
          </div>
          <div style="margin-top:14px;">
            <ul class="footer-menu" style="columns:2;column-gap:16px;">
              <li class="menu-item"><a href="{$WEB_ROOT}/about" title="About Us">About Us</a></li>
              <li class="menu-item"><a href="{$WEB_ROOT}/blog-details" title="Blog">Blog</a></li>
              <li class="menu-item"><a href="{$WEB_ROOT}/legal" title="Legal Notice">Legal Notice</a></li>
              <li class="menu-item"><a href="{$WEB_ROOT}/promos" title="Promotions">Promotions</a></li>
              <li class="menu-item"><a href="{$WEB_ROOT}/vpn" title="VPN">VPN Solutions</a></li>
              <li class="menu-item"><a href="{$WEB_ROOT}/gsuite" title="Google Workspace">Google Workspace</a></li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="subcribe news">
    <div class="container">
      <div class="row">
        <form action="#" class="w-100">
          <div class="col-md-6 offset-md-3">
            <div class="general-input">
              <input class="fill-input" type="email" name="email" data-i18n="[placeholder]header.login">
              <input type="submit" value="SUBSCRIBE" class="btn btn-default-yellow-fill initial-transform">
            </div>
          </div>
          <div class="col-md-6 offset-md-3 text-center pt-4">
            <p>Subscribe our newsletter to receive news and updates</p>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="footer-legal">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center" style="padding:18px 0 10px;font-size:0.82rem;color:#aaa;line-height:1.8;">
          <span>FILLSBASE operates through licensed business entities in the UAE and the USA.</span><br>
          <span><strong>UAE Operations:</strong> LISTIWO ONLINE SERVICES PORTAL (License No. 1605427), Dubai, UAE</span> &nbsp;|&nbsp;
          <span><strong>US Presence:</strong> FILLSBASE E-STORE LLC (EIN: 61-2183317), United States</span><br>
          <span><i class="fas fa-phone-alt" style="margin-right:4px;"></i>UAE: <a href="tel:+971505442538" style="color:#aaa;">+971-50-544-2538</a></span>
          &nbsp;&nbsp;
          <span><i class="fas fa-phone-alt" style="margin-right:4px;"></i>US: <a href="tel:+18333224404" style="color:#aaa;">+1 (833) 322-4404</a></span>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <ul class="footer-menu">
            <li id="drop-lng" class="btn-lang-footer btn-group btn-group-toggle">
              <label data-lng="en-US" for="option1" class="btn btn-secondary me-1 styletextDirection" data-value="ltr">
                <input type="radio" name="options" id="option1" checked> EN
              </label>
              <label data-lng="fr-FR" for="option_fr" class="btn btn-secondary me-1 styletextDirection" data-value="ltr">
                <input type="radio" name="options" id="option_fr"> FR
              </label>
              <label data-lng="pt-PT" for="option2" class="btn btn-secondary me-1 styletextDirection" data-value="ltr">
                <input type="radio" name="options" id="option2"> PT
              </label>
              <label data-lng="ar-AR" for="option3" class="btn btn-secondary me-1 styletextDirection" data-value="rtl">
                <input type="radio" name="options" id="option3"> AR
              </label>
              <label data-lng="es-ES" for="option4" class="btn btn-secondary me-1 styletextDirection" data-value="ltr">
                <input type="radio" name="options" id="option4"> ES
              </label>
            </li>
            <li class="menu-item by">© Copyright 2007 - 2026 | Fillsbase. All rights reserved</li>
        </ul>
      </div>
      <div class="col-lg-6">
        <ul class="payment-list">
          <li><p>Payments We Accept</p></li>
          <li><i class="fab fa-cc-paypal"></i></li>
          <li><i class="fab fa-cc-visa"></i></li>
          <li><i class="fab fa-cc-mastercard"></i></li>
          <li><i class="fab fa-cc-apple-pay"></i></li>
          <li><i class="fab fa-cc-discover"></i></li>
          <li><i class="fab fa-cc-amazon-pay"></i></li>
        </ul>
      </div>
    </div>
  </div>
</div>
</footer>

<script>
if (typeof $.gdprcookie !== 'undefined') {
    $.gdprcookie.init({});
}
</script>
