{include file="orderforms/fillsbase/common.tpl"}

<script>
    var statesTab = 10;
    var stateNotRequired = true;
    window.langPasswordStrength = "{$LANG.pwstrength}";
    window.langPasswordWeak = "{$LANG.pwstrengthweak}";
    window.langPasswordModerate = "{$LANG.pwstrengthmoderate}";
    window.langPasswordStrong = "{$LANG.pwstrengthstrong}";
    window.langVatErrorInvalidFormat = "{$LANG.tax.errorVatInvalidFormat}";
</script>
<script type="text/javascript" src="{$BASE_PATH_JS}/StatesDropdown.js"></script>
<script type="text/javascript" src="{$BASE_PATH_JS}/PasswordStrength.js"></script>
<script type="text/javascript" src="{$BASE_PATH_JS}/VatValidator.js"></script>

<!-- Intl Tel Input -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>

<div id="order-standard_cart" class="modern-checkout-page py-5" style="background: #fdfdfd; min-height: 100vh;">
    <!-- Toastr for Notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <div class="container">

        <div class="row">
            <!-- Left Column: Full WHMCS Checkout Logic -->
            <div class="col-lg-8">
                <div class="checkout-main-content pr-lg-4">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="font-weight-bold" style="color: #1a1a2e; font-size: 32px;">{$LANG.orderForm.checkout}</h2>
                        {if !$loggedin}
                        <div class="login-toggle-actions">
                             <button type="button" class="btn btn-outline-primary btn-sm px-3 {if $loggedin || !$loggedin && $custtype eq "existing"} d-none{/if}" id="btnAlreadyRegistered" style="border-radius: 8px;">{$LANG.orderForm.alreadyRegistered}</button>
                             <button type="button" class="btn btn-outline-warning btn-sm px-3 {if $loggedin || $custtype neq "existing"} d-none{/if}" id="btnNewUserSignup" style="border-radius: 8px;">{$LANG.orderForm.createAccount}</button>
                        </div>
                        {/if}
                    </div>

                    <div class="alert alert-danger checkout-error-feedback {if !$errormessage}d-none{/if}" style="border-radius: 12px;">
                        <h6 class="font-weight-bold"><i class="fas fa-exclamation-circle mr-2"></i> {$LANG.orderForm.correctErrors}:</h6>
                        <ul class="mb-0 small">
                            {if $errormessage}{$errormessage}{/if}
                            <li class="vat-error d-none"></li>
                        </ul>
                    </div>

                    <form method="post" action="{$smarty.server.PHP_SELF}?a=checkout" name="orderfrm" id="frmCheckout">
                        <input type="hidden" name="token" value="{$csrfToken}" />
                        <input type="hidden" name="checkout" value="true" />
                        <input type="hidden" name="custtype" id="inputCustType" value="{$custtype}" />
                        {if $taxIdValidationEnabled}<input type="hidden" id="validation_tax_id" value="true">{/if}
                        {if $isTaxEUTaxExempt}<input type="hidden" id="isTaxEUTaxExempt" value="true">{/if}
                        {if $taxType !== ''}<input type="hidden" id="taxType" value="{$taxType}">{/if}
                        {if $isTaxInclusiveDeduct}<input type="hidden" id="isTaxInclusiveDeduct" value="true">{/if}

                        <!-- Existing Account Selection -->
                        {if $custtype neq "new" && $loggedin}
                            <div class="checkout-section mb-5 p-4 bg-white rounded-20 shadow-sm border">
                                <div class="section-header d-flex align-items-center mb-4">
                                    <div class="step-num mr-3">A</div>
                                    <h5 class="font-weight-bold mb-0">{lang key='switchAccount.title'}</h5>
                                </div>
                                <div id="containerExistingAccountSelect" class="row account-select-container">
                                    {foreach $accounts as $account}
                                        <div class="col-sm-{if $accounts->count() == 1}12{else}6{/if} mb-3">
                                            <div class="account-card {if $selectedAccountId == $account->id} active{/if} p-3 border rounded-15">
                                                <label class="d-flex align-items-start mb-0 cursor-pointer" for="account{$account->id}">
                                                    <input id="account{$account->id}" class="account-select mt-1 mr-3 {if $account->isClosed || $account->noPermission || $inExpressCheckout} disabled{/if}" type="radio" name="account_id" value="{$account->id}"{if $account->isClosed || $account->noPermission || $inExpressCheckout} disabled="disabled"{/if}{if $selectedAccountId == $account->id} checked="checked"{/if}>
                                                    <div class="address-info">
                                                        <strong class="d-block">{if $account->company}{$account->company}{else}{$account->fullName}{/if}</strong>
                                                        <span class="small text-muted">
                                                            {$account->address1}, {$account->city}, {$account->countryName}
                                                        </span>
                                                        {if $account->currencyCode}<span class="badge badge-info ml-2">{$account->currencyCode}</span>{/if}
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    {/foreach}
                                    <div class="col-sm-12">
                                        <div class="account-card {if !$selectedAccountId || !is_numeric($selectedAccountId)} active{/if} p-3 border rounded-15 mt-2">
                                            <label class="mb-0 cursor-pointer w-100">
                                                <input class="account-select mr-2" type="radio" name="account_id" value="new"{if !$selectedAccountId || !is_numeric($selectedAccountId)} checked="checked"{/if}{if $inExpressCheckout} disabled="disabled"{/if}>
                                                <span class="font-weight-bold">{lang key='orderForm.createAccount'}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {/if}

                        <!-- Existing User Login -->
                        <div id="containerExistingUserSignin" class="checkout-section mb-5 p-4 bg-white rounded-20 shadow-sm border {if $loggedin || $custtype neq "existing"} d-none{/if}" style="border: 1px solid #eef0f3 !important;">
                            <div class="section-header d-flex align-items-center mb-4">
                                <div class="step-num mr-3">L</div>
                                <h5 class="font-weight-bold mb-0">Connexion client existant</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="small font-weight-bold text-muted mb-1">Adresse Email</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-envelope input-icon"></i>
                                        <input type="text" name="loginemail" id="inputLoginEmail" class="form-control" placeholder="{$LANG.orderForm.emailAddress}" value="{$loginemail}">
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="small font-weight-bold text-muted mb-1">Mot de passe</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-lock input-icon"></i>
                                        <input type="password" name="loginpassword" id="inputLoginPassword" class="form-control" placeholder="{$LANG.clientareapassword}">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <button type="button" id="btnExistingLogin" class="btn btn-primary px-5 font-weight-bold" style="border-radius: 12px; height: 50px; min-width: 180px;">
                                    <span id="existingLoginButton">Se connecter</span>
                                    <span id="existingLoginPleaseWait" class="d-none"><i class="fas fa-spinner fa-spin mr-2"></i> Patientez...</span>
                                </button>
                            </div>
                            {include file="orderforms/standard_cart/linkedaccounts.tpl" linkContext="checkout-existing"}
                        </div>

                        <!-- Personal Information (New User) -->
                        <div id="containerNewUserSignup" class="{if $custtype === 'existing' || (is_numeric($selectedAccountId) && $selectedAccountId > 0) || ($loggedin && $selectedAccountId !== 'new' && $custtype !== 'add')} d-none{/if}">
                            
                            <div class="checkout-section mb-5 p-4 bg-white rounded-20 shadow-sm border">
                                <div class="section-header d-flex align-items-center mb-4">
                                    <div class="step-num mr-3">1</div>
                                    <h5 class="font-weight-bold mb-0">{$LANG.orderForm.personalInformation}</h5>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label class="small font-weight-bold text-muted">{$LANG.orderForm.firstName}</label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-user-edit input-icon"></i>
                                            <input type="text" name="firstname" id="inputFirstName" class="form-control" placeholder="John" value="{$clientsdetails.firstname}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="small font-weight-bold text-muted">{$LANG.orderForm.lastName}</label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-user-edit input-icon"></i>
                                            <input type="text" name="lastname" id="inputLastName" class="form-control" placeholder="Doe" value="{$clientsdetails.lastname}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="small font-weight-bold text-muted">{$LANG.orderForm.emailAddress}</label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-envelope input-icon"></i>
                                            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="email@example.com" value="{$clientsdetails.email}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="small font-weight-bold text-muted">{$LANG.orderForm.phoneNumber}</label>
                                        <input type="tel" name="phonenumber" id="inputPhone" class="form-control w-100" placeholder="444444444" value="{$clientsdetails.phonenumber}">
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-section mb-5 p-4 bg-white rounded-20 shadow-sm border" style="border: 1px solid #eef0f3 !important;">
                                <div class="section-header d-flex align-items-center mb-4">
                                    <div class="step-num mr-3">2</div>
                                    <h5 class="font-weight-bold mb-0">Adresse de facturation</h5>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <label class="small font-weight-bold text-muted mb-1">Nom de l'entreprise (Optionnel)</label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-building input-icon"></i>
                                            <input type="text" name="companyname" id="inputCompanyName" class="form-control" value="{$clientsdetails.companyname}" placeholder="Ex: {$companyname} SARL">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <label class="small font-weight-bold text-muted mb-1">Adresse</label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-map-marker-alt input-icon"></i>
                                            <input type="text" name="address1" id="inputAddress1" class="form-control" value="{$clientsdetails.address1}" placeholder="Ex: 123 Rue de la Liberté">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <label class="small font-weight-bold text-muted mb-1">Adresse 2</label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-home input-icon"></i>
                                            <input type="text" name="address2" id="inputAddress2" class="form-control" value="{$clientsdetails.address2}" placeholder="Appartement, bureau, etc.">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <label class="small font-weight-bold text-muted mb-1">Ville</label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-city input-icon"></i>
                                            <input type="text" name="city" id="inputCity" class="form-control" value="{$clientsdetails.city}" placeholder="Bamako">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <label class="small font-weight-bold text-muted mb-1">Province</label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-map input-icon"></i>
                                            <input type="text" name="state" id="inputState" class="form-control" value="{$clientsdetails.state}" placeholder="Région">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <label class="small font-weight-bold text-muted mb-1">Code postal</label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-mail-bulk input-icon"></i>
                                            <input type="text" name="postcode" id="inputPostcode" class="form-control" value="{$clientsdetails.postcode}" placeholder="00000">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <label class="small font-weight-bold text-muted mb-1">Pays</label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-globe-africa input-icon"></i>
                                            <select name="country" id="inputCountry" class="form-control" style="background: #fff; height: 50px;">
                                                {foreach $countries as $countrycode => $countrylabel}
                                                    <option value="{$countrycode}"{if $countrycode eq "ML"} selected{elseif (!$country && $countrycode == $defaultcountry) || $countrycode eq $country} selected{/if}>{$countrylabel}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                    {if $showTaxIdField}
                                    <div class="col-sm-12 mb-3">
                                        <label class="small font-weight-bold text-muted">{$taxLabel}</label>
                                        <input type="text" name="tax_id" id="inputTaxId" class="form-control" value="{$clientsdetails.tax_id}">
                                    </div>
                                    {/if}
                                </div>
                            </div>

                            {if $customfields}
                                <div class="checkout-section mb-5 p-4 bg-white rounded-20 shadow-sm border">
                                    <h6 class="font-weight-bold mb-4">{$LANG.orderadditionalrequiredinfo}</h6>
                                    <div class="row">
                                        {foreach $customfields as $customfield}
                                            <div class="col-sm-6 mb-3">
                                                <label class="small font-weight-bold text-muted">{$customfield.name} {$customfield.required}</label>
                                                {$customfield.input}
                                                {if $customfield.description}<span class="very-small text-muted d-block mt-1">{$customfield.description}</span>{/if}
                                            </div>
                                        {/foreach}
                                    </div>
                                </div>
                            {/if}
                        </div>

                        <!-- Extra Fields -->
                        {if isset($checkoutExtraFields) && !empty($checkoutExtraFields)}
                            <div class="checkout-section mb-5 p-4 bg-white rounded-20 shadow-sm border">
                                <h6 class="font-weight-bold mb-4">{lang key='orderForm.additionalInformation'}</h6>
                                <div class="row">
                                    {foreach $checkoutExtraFields as $field}
                                        <div class="col-sm-6 mb-3">
                                            <label class="small font-weight-bold text-muted">{$field.label} {if $field.required}*{/if}</label>
                                            {$field.input}
                                        </div>
                                    {/foreach}
                                </div>
                            </div>
                        {/if}

                        <!-- Domain Registrant Info -->
                        {if $domainsinorder}
                            <div class="checkout-section mb-5 p-4 bg-white rounded-20 shadow-sm border" style="border: 1px solid #eef0f3 !important;">
                                <div class="section-header d-flex align-items-center mb-4">
                                    <div class="step-num mr-3">3</div>
                                    <h5 class="font-weight-bold mb-0">Information sur le propriétaire du domaine</h5>
                                </div>
                                <p class="text-muted small mb-4">Vous pouvez spécifier des informations de contact différentes pour l'enregistrement du nom de domaine. Sinon, vous pouvez ignorer cette section.</p>
                                
                                <div class="input-with-icon mb-4">
                                    <i class="fas fa-address-card input-icon"></i>
                                    <select name="contact" id="inputDomainContact" class="form-control" style="background: #fff; height: 50px;">
                                        <option value="">Utiliser le contact par défaut</option>
                                        {foreach $domaincontacts as $domcontact}
                                            <option value="{$domcontact.id}"{if $contact == $domcontact.id} selected{/if}>{$domcontact.name}</option>
                                        {/foreach}
                                        <option value="addingnew"{if $contact == "addingnew"} selected{/if}>Ajouter un nouveau contact...</option>
                                    </select>
                                </div>

                                <div id="domainRegistrantInputFields" class="{if $contact neq "addingnew"} d-none{/if} mt-4 pt-4 border-top">
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label class="small font-weight-bold text-muted mb-1">Prénom</label>
                                            <div class="input-with-icon">
                                                <i class="fas fa-user input-icon"></i>
                                                <input type="text" name="domaincontactfirstname" class="form-control" placeholder="Prénom">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="small font-weight-bold text-muted mb-1">Nom</label>
                                            <div class="input-with-icon">
                                                <i class="fas fa-user input-icon"></i>
                                                <input type="text" name="domaincontactlastname" class="form-control" placeholder="Nom">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="small font-weight-bold text-muted mb-1">Email</label>
                                            <div class="input-with-icon">
                                                <i class="fas fa-envelope input-icon"></i>
                                                <input type="email" name="domaincontactemail" class="form-control" placeholder="email@exemple.com">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="small font-weight-bold text-muted mb-1">Téléphone</label>
                                            <div class="input-with-icon">
                                                <i class="fas fa-phone input-icon"></i>
                                                <input type="tel" name="domaincontactphonenumber" class="form-control" placeholder="Numéro de téléphone">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <label class="small font-weight-bold text-muted mb-1">Adresse</label>
                                            <div class="input-with-icon">
                                                <i class="fas fa-map-marker-alt input-icon"></i>
                                                <input type="text" name="domaincontactaddress1" class="form-control" placeholder="Adresse">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                            <label class="small font-weight-bold text-muted mb-1">Ville</label>
                                            <div class="input-with-icon">
                                                <i class="fas fa-city input-icon"></i>
                                                <input type="text" name="domaincontactcity" class="form-control" placeholder="Ville">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                            <label class="small font-weight-bold text-muted mb-1">Province</label>
                                            <div class="input-with-icon">
                                                <i class="fas fa-map input-icon"></i>
                                                <input type="text" name="domaincontactstate" class="form-control" placeholder="Province">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-3">
                                            <label class="small font-weight-bold text-muted mb-1">Code postal</label>
                                            <div class="input-with-icon">
                                                <i class="fas fa-mail-bulk input-icon"></i>
                                                <input type="text" name="domaincontactpostcode" class="form-control" placeholder="00000">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <label class="small font-weight-bold text-muted mb-1">Pays</label>
                                            <div class="input-with-icon">
                                                <i class="fas fa-globe-africa input-icon"></i>
                                                <select name="domaincontactcountry" class="form-control" style="background: #fff; height: 50px;">
                                                    {foreach $countries as $countrycode => $countrylabel}
                                                        <option value="{$countrycode}"{if $countrycode eq "ML"} selected{elseif (!$country && $countrycode == $defaultcountry) || $countrycode eq $country} selected{/if}>{$countrylabel}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {/if}

                        <!-- Account Security (New User) -->
                        {if !$loggedin}
                        <div id="containerNewUserSecurity" class="checkout-section mb-5 p-4 bg-white rounded-20 shadow-sm border {if (!$loggedin && $custtype eq "existing") || ($remote_auth_prelinked && !$securityquestions)} d-none{/if}">
                            <h6 class="font-weight-bold mb-4" style="color: #1a1a2e;">Sécurité du compte</h6>
                            <div id="containerPassword" class="row {if $remote_auth_prelinked && $securityquestions} d-none{/if}">
                                <div class="col-sm-6 mb-3">
                                    <label class="small font-weight-bold text-muted mb-1">{$LANG.clientareapassword}</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-lock input-icon"></i>
                                        <input type="password" name="password" id="inputNewPassword1" class="form-control" placeholder="Min. 8 characters">
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="small font-weight-bold text-muted mb-1">Confirmer le mot de passe</label>
                                    <div class="input-with-icon">
                                        <i class="fas fa-lock input-icon"></i>
                                        <input type="password" name="password2" id="inputNewPassword2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="password-strength-meter mt-2">
                                        <div class="progress" style="height: 6px; border-radius: 3px; background: #eee;">
                                            <div class="progress-bar" id="passwordStrengthMeterBar" role="progressbar"></div>
                                        </div>
                                        <p class="very-small text-muted mt-2" id="passwordStrengthTextLabel">{$LANG.pwstrength}: {$LANG.pwstrengthenter}</p>
                                    </div>
                                </div>
                            </div>
                            {if $securityquestions}
                                <div class="row mt-3">
                                    <div class="col-sm-6 mb-3">
                                        <select name="securityqid" class="form-control">
                                            {foreach $securityquestions as $question}<option value="{$question.id}">{$question.question}</option>{/foreach}
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mb-3"><input type="password" name="securityqans" class="form-control" placeholder="{$LANG.clientareasecurityanswer}"></div>
                                </div>
                            {/if}
                        </div>
                        {/if}

                        <!-- Credit Balance -->
                        <div id="applyCreditContainer" class="checkout-section mb-5 p-4 bg-white rounded-20 shadow-sm border {if !$canUseCreditOnCheckout} d-none{/if}" data-apply-credit="{$applyCredit}">
                             <h6 class="font-weight-bold text-success mb-3"><i class="fas fa-wallet mr-2"></i> {lang key='cart.availableCreditBalance' amount=$creditBalance}</h6>
                             <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="useCreditOnCheckout" name="applycredit" value="1" class="custom-control-input" {if $applyCredit} checked{/if}>
                                <label class="custom-control-label small" for="useCreditOnCheckout">
                                    <span id="spanFullCredit" class="{if !($creditBalance->toNumeric() >= $total->toNumeric())} d-none{/if}">{lang key='cart.applyCreditAmountNoFurtherPayment' amount=$total}</span>
                                    <span id="spanUseCredit" class="{if $creditBalance->toNumeric() >= $total->toNumeric()} d-none{/if}">{lang key='cart.applyCreditAmount' amount=$creditBalance}</span>
                                </label>
                             </div>
                             <div class="custom-control custom-radio">
                                <input type="radio" id="skipCreditOnCheckout" name="applycredit" value="0" class="custom-control-input" {if !$applyCredit} checked{/if}>
                                <label class="custom-control-label small" for="skipCreditOnCheckout">{lang key='cart.applyCreditSkip' amount=$creditBalance}</label>
                             </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="checkout-section mb-5 p-4 bg-white rounded-20 shadow-sm border" style="border: 1px solid #eef0f3 !important;">
                            <h5 class="font-weight-bold mb-4" style="color: #1a1a2e;">Informations de paiement</h5>
                            
                            <div class="alert alert-light text-center py-4 mb-4" style="border-radius: 16px; background: #f8fbff; border: 1px solid #e1e9f5;">
                                <span class="text-muted small">Total à payer aujourd'hui:</span>
                                <h2 class="font-weight-bold text-primary mt-1 mb-0" style="font-size: 36px;" id="totalCartPrice">{$total}</h2>
                            </div>

                            {if !$inExpressCheckout}
                                <p class="small font-weight-bold text-muted mb-3">Veuillez choisir votre mode de paiement.</p>
                                <div class="payment-methods-grid mb-5">
                                    {foreach $gateways as $gateway}
                                        <label class="gateway-option {if $selectedgateway eq $gateway.sysname}active{/if} mb-0">
                                            <input type="radio" name="paymentmethod" value="{$gateway.sysname}" 
                                                   class="payment-methods no-icheck"
                                                   style="display: none !important; position: absolute; visibility: hidden; width: 0; height: 0;"
                                                   {if $selectedgateway eq $gateway.sysname} checked{/if}>
                                            <div class="gateway-card">
                                                <div class="check-indicator"><i class="fas fa-check-circle"></i></div>
                                                <div class="gateway-icon mb-3">
                                                    {if $gateway.sysname eq "paypalpayment" || $gateway.type eq "CC"}
                                                        <i class="fas fa-credit-card"></i>
                                                    {elseif $gateway.sysname|lower|strstr:"paypal"}
                                                        <i class="fab fa-paypal"></i>
                                                    {else}
                                                        <i class="fas fa-wallet"></i>
                                                    {/if}
                                                </div>
                                                <span class="font-weight-bold text-center d-block" style="font-size: 13px; color: #1a1a2e; line-height: 1.4;">{$gateway.name}</span>
                                            </div>
                                        </label>
                                    {/foreach}
                                </div>

                                <div id="paymentGatewayInput"></div>

                                <div class="cc-input-container {if $selectedgatewaytype neq "CC"} d-none{/if}" id="creditCardInputFields">
                                    {if $client}
                                        <div id="existingCardsContainer" class="mb-4">
                                            {include file="orderforms/standard_cart/includes/existing-paymethods.tpl"}
                                        </div>
                                    {/if}
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" name="ccinfo" value="new" id="new" class="custom-control-input" {if !$client || $client->payMethods->count() === 0} checked="checked"{/if}>
                                        <label class="custom-control-label font-weight-bold" for="new">{lang key='creditcardenternewcard'}</label>
                                    </div>
                                    <div id="newCardInfo" class="row p-3 bg-light rounded-15 mx-0">
                                        <div class="col-sm-12 mb-3">
                                            <input type="tel" name="ccnumber" id="inputCardNumber" class="form-control" placeholder="{$LANG.orderForm.cardNumber}">
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <input type="tel" name="ccexpirydate" id="inputCardExpiry" class="form-control" placeholder="MM / YY">
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <input type="tel" name="cccvv" id="inputCardCVV" class="form-control" placeholder="CVV">
                                        </div>
                                    </div>
                                </div>
                            {/if}
                        </div>

                        <!-- Notes & TOS -->
                        <div class="checkout-section mb-5 p-4 bg-white rounded-20 shadow-sm border" style="border: 1px solid #eef0f3 !important;">
                            <h6 class="font-weight-bold mb-4" style="color: #1a1a2e;">Autres infos</h6>
                            
                            <div class="input-with-icon mb-4">
                                <i class="fas fa-pen input-icon" style="top: 25px;"></i>
                                <textarea name="notes" class="form-control" rows="3" placeholder="Saisissez ici vos notes supplémentaires ou les informations nécessaires au traitement de votre commande." style="padding-top: 15px; min-height: 100px;">{$orderNotes}</textarea>
                            </div>

                            <div class="tos-check mb-5">
                                <label class="checkbox-container-modern d-flex align-items-center cursor-pointer mb-0">
                                    <input type="checkbox" name="accepttos" id="accepttos" class="d-none no-icheck" style="display: none !important; position: absolute; visibility: hidden;">
                                    <div class="custom-checkbox mr-3">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="small text-muted" style="font-size: 14px;">
                                        J'ai lu et j'accepte les <a href="{$tosurl}" target="_blank" class="text-primary font-weight-bold">Conditions d'utilisation</a>
                                    </span>
                                </label>
                            </div>

                            <button type="submit" id="btnCompleteOrder" class="btn btn-primary btn-block py-3 disable-on-click spinner-on-click" style="border-radius: 14px; font-weight: 700; background: #50d29e; border: none; font-size: 18px; box-shadow: 0 10px 25px rgba(80, 210, 158, 0.3); transition: 0.3s;">
                                {if $inExpressCheckout}Régler la commande{else}Régler la commande{/if} <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Right Column: Premium Sidebar -->
            <div class="col-lg-4">
                <div class="checkout-sidebar sticky-top" style="top: 20px;">
                    <div class="order-summary-card" style="background: #fff; border-radius: 24px; border: 1px solid #eee; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                        <h5 class="font-weight-bold mb-4" style="color: #1a1a2e;">{$LANG.ordersummary}</h5>
                        
                        <div id="checkoutCartContent">
                            {foreach $products as $num => $product}
                                <div class="summary-item d-flex justify-content-between mb-3 pb-3 border-bottom">
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bold text-dark small">{$product.productinfo.name}</span>
                                        <span class="text-muted very-small">{$product.billingcyclefriendly}</span>
                                        {if $product.domain}<span class="text-primary very-small">{$product.domain}</span>{/if}
                                    </div>
                                    <span class="font-weight-bold text-dark">{$product.pricing.totalTodayExcludingTaxSetup}</span>
                                </div>
                            {/foreach}
                            {foreach $domains as $num => $domain}
                                <div class="summary-item d-flex justify-content-between mb-3 pb-3 border-bottom">
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bold text-dark small">{$domain.domain}</span>
                                        <span class="text-muted very-small">{if $domain.type eq "register"}Registration{else}Transfer{/if} - {$domain.regperiod} yr</span>
                                    </div>
                                    <span class="font-weight-bold text-dark">{$domain.price}</span>
                                </div>
                            {/foreach}
                        </div>

                        <div class="summary-totals mt-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">{$LANG.ordersubtotal}</span>
                                <span class="text-dark font-weight-bold">{$subtotal}</span>
                            </div>
                            {if $promotioncode}
                                <div class="d-flex justify-content-between mb-2 text-success">
                                    <span class="small">Promo: {$promotiondescription}</span>
                                    <span class="font-weight-bold">{$discount}</span>
                                </div>
                            {/if}
                            {if $taxrate}
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">{$taxname} ({$taxrate}%)</span>
                                    <span class="text-dark font-weight-bold">{$taxtotal}</span>
                                </div>
                            {/if}
                            <div class="total-box mt-4 p-4 rounded-xl text-center" style="background: #f8fffb; border: 1px solid #e2f4ea; border-radius: 16px;">
                                <span class="d-block text-muted small mb-1">{$LANG.ordertotalduetoday}</span>
                                <span class="h2 font-weight-bold text-primary mb-0">{$total}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rounded-20 { border-radius: 20px; }
.rounded-15 { border-radius: 15px; }
.cursor-pointer { cursor: pointer; }
.modern-checkout-page .form-control {
    border-radius: 12px; border: 1px solid #eef0f3; padding: 12px 15px; height: auto; font-size: 14px;
}
.modern-checkout-page .form-control:focus { border-color: #50d29e; box-shadow: 0 0 0 4px rgba(80, 210, 158, 0.1); }
.checkout-progress { height: 4px; background: #eee; margin-bottom: 40px; border-radius: 2px; width: 100%; }
.progress-step {
    width: 32px; height: 32px; background: #fff; border: 2px solid #eee; border-radius: 50%;
    display: flex; align-items: center; justify-content: center; position: relative; z-index: 2; font-weight: 700; color: #999;
}
.progress-step.active { background: #50d29e; border-color: #50d29e; color: #fff; }
.progress-step::after { content: attr(data-title); position: absolute; top: 100%; margin-top: 8px; font-size: 11px; font-weight: 700; color: #999; }
.progress-step.active::after { color: #1a1a2e; }
.progress-line { position: absolute; height: 4px; background: #50d29e; top: 0; left: 0; z-index: 1; }
.step-num { width: 30px; height: 30px; background: #1a1a2e; color: #fff; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 800; }
/* Aggressive Reset for WHMCS default inputs */
input.payment-methods, .iradio_square-blue, .icheckbox_square-blue, .iradio, .icheckbox { display: none !important; visibility: hidden !important; position: absolute !important; }

.payment-methods-grid { 
    display: grid; 
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); 
    gap: 20px; 
    align-items: stretch;
}
.gateway-option { 
    cursor: pointer; position: relative; margin-bottom: 0; 
    display: flex; flex-direction: column;
}
.gateway-option input { position: absolute; opacity: 0; display: none !important; }

.gateway-card { 
    padding: 30px 15px; border: 1px solid #eef0f3; border-radius: 20px; 
    text-align: center; background: #fff; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    min-height: 180px; height: 100%; width: 100%; position: relative; cursor: pointer;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
}
.gateway-icon { font-size: 36px; transition: 0.3s; margin-bottom: 15px; }
.gateway-icon .fa-credit-card { color: #3b82f6; }
.gateway-icon .fa-paypal { color: #0070ba; }
.gateway-icon .fa-wallet { color: #4a5568; }

.gateway-option.active .gateway-card { 
    border-color: #50d29e; background: #f8fffb; 
    box-shadow: 0 12px 30px rgba(80, 210, 158, 0.25); 
    transform: translateY(-5px);
}
.gateway-option.active .gateway-icon i { transform: scale(1.15); }
.check-indicator { 
    position: absolute; top: 15px; right: 15px; 
    color: #50d29e; opacity: 0; font-size: 22px; transition: 0.2s;
}
.gateway-option.active .check-indicator { opacity: 1; }
.gateway-card:hover { border-color: #50d29e; background: #fafafa; }
.checkbox-container { display: block; position: relative; padding-left: 30px; cursor: pointer; }
.checkbox-container input { position: absolute; opacity: 0; }
.checkmark { position: absolute; top: 0; left: 0; height: 20px; width: 20px; background-color: #eee; border-radius: 6px; }
.checkbox-container input:checked ~ .checkmark { background-color: #50d29e; }
.checkmark:after { content: ""; position: absolute; display: none; left: 7px; top: 3px; width: 6px; height: 10px; border: solid white; border-width: 0 3px 3px 0; transform: rotate(45deg); }
.checkbox-container input:checked ~ .checkmark:after { display: block; }
.very-small { font-size: 11px; }
.iti { width: 100%; }
.iti__flag-container { border-radius: 12px 0 0 12px; }
.modern-checkout-page .iti input { padding-left: 52px !important; }

/* Input Icons */
.input-with-icon { position: relative; }
.input-icon { 
    position: absolute; left: 15px; top: 50%; transform: translateY(-50%); 
    color: #a0aec0; z-index: 10; font-size: 16px;
}
.input-with-icon .form-control { padding-left: 45px !important; }
.input-with-icon select.form-control { padding-left: 45px !important; appearance: none; }

/* Modern Checkbox */
.checkbox-container-modern .custom-checkbox {
    width: 24px; height: 24px; border: 2px solid #eef0f3; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    transition: 0.3s; background: #fff;
}
.checkbox-container-modern .custom-checkbox i { color: #fff; font-size: 12px; opacity: 0; transition: 0.2s; }
.checkbox-container-modern input:checked + .custom-checkbox { background: #50d29e; border-color: #50d29e; }
.checkbox-container-modern input:checked + .custom-checkbox i { opacity: 1; }

#btnCompleteOrder:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(80, 210, 158, 0.45) !important; background: #45c08f !important; }
</style>

<script type="text/javascript" src="{$BASE_PATH_JS}/jquery.payment.js"></script>
<script type="text/javascript" src="{$BASE_PATH_JS}/CartTotalUpdater.js"></script>
<script>
    var hideCvcOnCheckoutForExistingCard = '{if $canUseCreditOnCheckout && $applyCredit && ($creditBalance->toNumeric() >= $total->toNumeric())}1{else}0{/if}';
</script>
<script>
$(document).ready(function() {
    // Initialize Intl Tel Input
    var phoneInput = document.querySelector("#inputPhone");
    var iti = window.intlTelInput(phoneInput, {
        initialCountry: "ML",
        preferredCountries: ["ML", "SN", "CI", "BF"],
        geoIpLookup: function(success, failure) {
            $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "ML";
                success(countryCode);
            });
        },
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js"
    });

    // Sync with Country Dropdown
    $('#inputCountry').on('change', function() {
        var countryCode = $(this).val();
        iti.setCountry(countryCode);
    });

    $('.payment-methods').on('change', function() {
        $('.gateway-option').removeClass('active');
        $(this).closest('.gateway-option').addClass('active');
    });

    // Handle Validation Errors on Load
    var errorFeedback = $('.checkout-error-feedback');
    if (errorFeedback.length && !errorFeedback.hasClass('d-none')) {
        var errors = errorFeedback.find('ul li');
        if (errors.length) {
            errors.each(function() {
                var txt = $(this).text().trim();
                if (txt) toastr.error(txt);
            });
        } else {
            var msg = errorFeedback.text().trim();
            if (msg) toastr.error(msg);
        }
        errorFeedback.addClass('d-none'); // Hide the static box
    }

    // Account Toggle (Login vs Register)
    $('#btnAlreadyRegistered').on('click', function() {
        $('#containerNewUserSignup').addClass('d-none');
        $('#containerExistingUserSignin').removeClass('d-none');
        $('#containerNewUserSecurity').addClass('d-none');
        $(this).addClass('d-none');
        $('#btnNewUserSignup').removeClass('d-none');
        $('#inputCustType').val('existing');
    });

    $('#btnNewUserSignup').on('click', function() {
        $('#containerNewUserSignup').removeClass('d-none');
        $('#containerExistingUserSignin').addClass('d-none');
        $('#containerNewUserSecurity').removeClass('d-none');
        $(this).addClass('d-none');
        $('#btnAlreadyRegistered').removeClass('d-none');
        $('#inputCustType').val('new');
    });

    // Toastr Configuration
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // Custom AJAX Login Handler
    $('#btnExistingLogin').on('click', function() {
        var email = $('#inputLoginEmail').val();
        var password = $('#inputLoginPassword').val();
        var btn = $(this);
        var btnText = $('#existingLoginButton');
        var btnWait = $('#existingLoginPleaseWait');
        var token = $('input[name="token"]').val();

        if (!email || !password) {
            toastr.warning('Veuillez saisir votre email et votre mot de passe.');
            return;
        }

        btnText.addClass('d-none');
        btnWait.removeClass('d-none');
        btn.prop('disabled', true);

        WHMCS.http.jqClient.post('cart.php', {
            a: 'checkout',
            dologin: true,
            loginemail: email,
            loginpassword: password,
            token: token
        }, function(data) {
            if (data.success) {
                toastr.success('Connexion réussie ! Redirection en cours...');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            } else if (data.error) {
                toastr.error(data.error || 'Identifiants invalides.');
                btnText.removeClass('d-none');
                btnWait.addClass('d-none');
                btn.prop('disabled', false);
            } else {
                window.location.reload();
            }
        }, 'json').fail(function() {
            toastr.error('Une erreur est survenue lors de la connexion au serveur.');
            btnText.removeClass('d-none');
            btnWait.addClass('d-none');
            btn.prop('disabled', false);
        });
    });

    // Domain Registrant Toggle
    $('#inputDomainContact').on('change', function() {
        if ($(this).val() == 'addingnew') {
            $('#domainRegistrantInputFields').removeClass('d-none');
        } else {
            $('#domainRegistrantInputFields').addClass('d-none');
        }
    });
});
</script>