{if $sent}
    {include file="$template/includes/alert.tpl" type="success" msg=$LANG.contactsent textcenter=true}
{/if}
{if $errormessage}
    {include file="$template/includes/alert.tpl" type="error" errorshtml=$errormessage}
{/if}

</div></div> {* Close container and wrapper from header.tpl *}

<!-- ***** BANNER ***** -->
<div class="top-header overlay" style="background: #111 url('{$WEB_ROOT}/assets/img/about-bg.png?v=1.1') no-repeat center center / cover !important; min-height: 400px; position: relative;">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="wrapper">
          <h1 class="heading">{$LANG.contacttitle}</h1>
          <div class="subheading">Notre équipe est disponible 24h/24, 7j/7 pour vous accompagner. Contactez-nous!</div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="wrapper sec-normal bg-colorstyle">
<div class="container">

<!-- ***** LOCATION ***** -->
<section class="services pt-4 sec-normal bg-seccolorstyle">
  <div class="container">
    <div class="service-wrap">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <div class="service-section bg-colorstyle noshadow">
            <div class="title mergecolor">Dubai, UAE</div>
            <div class="subtitle seccolor">Call us: +971-50-544-2538 <br>LISTIWO ONLINE SERVICES PORTAL, Dubai, UAE</div>
            <a class="btn btn-default-yellow-fill popup-gmaps"
            href="https://maps.google.com/maps?q=Dubai,+UAE&amp;hl=en&amp;t=v">Google Maps</a>
          </div>
        </div>
        <div class="col-sm-12 col-md-6">
          <div class="service-section bg-colorstyle noshadow">
            <div class="plans badge feat bg-purple">office</div>
            <div class="title mergecolor">United States</div>
            <div class="subtitle seccolor">Call us: +1 (833) 322-4404 <br>FILLSBASE E-STORE LLC, United States</div>
            <a class="btn btn-default-yellow-fill popup-gmaps"
            href="https://maps.google.com/maps?q=United+States&amp;hl=en&amp;t=v">Google Maps</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ***** HELP ***** -->
<section class="services help pt-4 pb-80 sec-bg4 bottompadding tophalfpadding">
  <div class="container">
    <div class="service-wrap">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4">
          <div class="help-container bg-colorstyle">
            <a href="#" class="help-item">
              <div class="img"><div class="lazyload"></div></div>
              <div class="inform">
                <div class="title mergecolor">Live Chat</div>
                <div class="description seccolor">Email us at: info@fillsbase.com</div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
          <div class="help-container bg-colorstyle">
            <a href="submitticket.php" class="help-item gocheck">
              <div class="img"><div class="lazyload"></div></div>
              <div class="inform">
                <div class="title mergecolor">Send Ticket</div>
                <div class="description seccolor">Open a support ticket for technical assistance.</div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
          <div class="help-container bg-colorstyle">
            <a href="tel:+971505442538" class="help-item">
              <div class="img"><div class="lazyload"></div></div>
              <div class="inform">
                <div class="title mergecolor">Phone Now</div>
                <div class="description seccolor">Call our support team at +971-50-544-2538.</div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{if !$sent}
<div class="bg-seccolorstyle bg-white noshadow mt-50 p-50 br-12">
    <div class="text-center mb-4">
        <h2 class="section-heading mergecolor">{$LANG.contactsend}</h2>
        <p class="mergecolor">We Will Help You To Choose The Best Plan!</p>
    </div>
    <form method="post" action="contact.php" class="form-horizontal" role="form">
        <input type="hidden" name="action" value="send" />

            <div class="form-group">
                <div class="row px-5">
                    <div class="col-md-6 mb-3">
                        <label for="inputName" class="control-label mb-0 mergecolor">{$LANG.supportticketsclientname}</label>
                        <input type="text" name="name" value="{$name}" class="form-control br-8" id="inputName" placeholder="Full Name" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputEmail" class="control-label mb-0 mergecolor">{$LANG.supportticketsclientemail}</label>
                        <input type="email" name="email" value="{$email}" class="form-control br-8" id="inputEmail" placeholder="Email Address" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="inputSubject" class="control-label mb-0 mergecolor">{$LANG.supportticketsticketsubject}</label>
                        <input type="text" name="subject" value="{$subject}" class="form-control br-8" id="inputSubject" placeholder="Subject" />
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="inputMessage" class="control-label mb-0 mergecolor">{$LANG.contactmessage}</label>
                        <textarea name="message" rows="5" class="form-control br-12" id="inputMessage" placeholder="Message...">{$message}</textarea>
                    </div>
                </div>

                {if $captcha}
                    <div class="text-center margin-bottom mb-4">
                        {include file="$template/includes/captcha.tpl"}
                    </div>
                {/if}

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-default-yellow-fill {$captcha->getButtonClass($captchaForm)}">{$LANG.contactsend}</button>
                    </div>
                </div>
            </div>
    </form>
</div>
{/if}
