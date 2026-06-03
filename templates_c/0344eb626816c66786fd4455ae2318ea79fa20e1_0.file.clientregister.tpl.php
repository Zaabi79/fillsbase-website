<?php
/* Smarty version 4.5.3, created on 2026-06-03 20:49:40
  from '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/clientregister.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6a2093647f48b0_29612886',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0344eb626816c66786fd4455ae2318ea79fa20e1' => 
    array (
      0 => '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/clientregister.tpl',
      1 => 1780432728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a2093647f48b0_29612886 (Smarty_Internal_Template $_smarty_tpl) {
if (in_array('state',$_smarty_tpl->tpl_vars['optionalFields']->value)) {
echo '<script'; ?>
>
var statesTab = 10;
var stateNotRequired = true;
<?php echo '</script'; ?>
>
<?php }
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/StatesDropdown.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/PasswordStrength.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
window.langPasswordStrength = "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrength'];?>
";
window.langPasswordWeak = "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrengthweak'];?>
";
window.langPasswordModerate = "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrengthmoderate'];?>
";
window.langPasswordStrong = "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrengthstrong'];?>
";
jQuery(document).ready(function()
{
jQuery("#inputNewPassword1").keyup(registerFormPasswordStrengthFeedback);
});
<?php echo '</script'; ?>
>
<div class="loginpage sec-bg3 motpath fullrock-content bg-colorstyle">
    <div class="container">
        <div class="row login-page-header">
            <a class="navbar-brand" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/index.php">
                <img class="svg logo-menu d-block" src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/img/fillsbase_logo.png" alt="<?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
">
                <img class="svg logo-menu d-none" src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/img/fillsbase_logo.png" alt="<?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
">
            </a>
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/login.php"> <i class="ico-unlock" data-toggle="tooltip" data-placement="left" title="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['alreadyregistered'];?>
"></i> </a>
        </div>

        <div class="logincontent">
            <div class="login-wrapper">
                <div class="login-form-container sec-main sec-bg1 tabs bg-seccolorstyle noshadow">
                    <?php if ($_smarty_tpl->tpl_vars['registrationDisabled']->value) {?>
                    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>((((($_smarty_tpl->tpl_vars['LANG']->value['registerCreateAccount']).(' <strong><a href="')).(((string)$_smarty_tpl->tpl_vars['WEB_ROOT']->value))).('/cart.php" class="alert-link">')).($_smarty_tpl->tpl_vars['LANG']->value['registerCreateAccountOrder'])).('</a></strong>')), 0, true);
?>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
                    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'errorshtml'=>$_smarty_tpl->tpl_vars['errormessage']->value), 0, true);
?>
                    <?php }?>
                    <?php if (!$_smarty_tpl->tpl_vars['registrationDisabled']->value) {?>
                    
                    <div class="text-center">
                        <h2 class="section-heading whitecolor mergecolor"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['registerintro'];?>
</h2>
                        <p class="section-subheading whitecolor mergecolor"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['restrictedpage'];?>
</p>
                    </div>
                    
                    <div id="registration" class="mt-50">
                        <form method="post" class="using-password-strength" action="<?php echo $_SERVER['PHP_SELF'];?>
" role="form" name="orderfrm" id="frmCheckout">
                            
                            <input type="hidden" name="register" value="true"/>
                            <div id="containerNewUserSignup">
                                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/linkedaccounts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('linkContext'=>"registration"), 0, true);
?>
                                
                                <div class="divider mb-15">
                                    <span></span>
                                    <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['personalInformation'];?>
</span>
                                    <span></span>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="firstname" id="inputFirstName" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['firstName'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientfirstname']->value;?>
" <?php if (!in_array('firstname',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?> autofocus>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="lastname" id="inputLastName" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['lastName'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientlastname']->value;?>
" <?php if (!in_array('lastname',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="email" name="email" id="inputEmail" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['emailAddress'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientemail']->value;?>
">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="tel" name="phonenumber" id="inputPhone" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['phoneNumber'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientphonenumber']->value;?>
">
                                        </div>
                                    </div>
                                </div>

                                <div class="divider mb-15">
                                    <span></span>
                                    <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['billingAddress'];?>
</span>
                                    <span></span>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="companyname" id="inputCompanyName" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['companyName'];?>
 (<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['optional'];?>
)" value="<?php echo $_smarty_tpl->tpl_vars['clientcompanyname']->value;?>
">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="address1" id="inputAddress1" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientaddress1']->value;?>
"  <?php if (!in_array('address1',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="address2" id="inputAddress2" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress2'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientaddress2']->value;?>
">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" name="city" id="inputCity" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['city'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientcity']->value;?>
"  <?php if (!in_array('city',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input type="text" name="state" id="state" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['state'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientstate']->value;?>
"  <?php if (!in_array('state',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" name="postcode" id="inputPostcode" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['postcode'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientpostcode']->value;?>
" <?php if (!in_array('postcode',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <select name="country" id="inputCountry" class="field form-control">
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clientcountries']->value, 'countryName', false, 'countryCode');
$_smarty_tpl->tpl_vars['countryName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['countryCode']->value => $_smarty_tpl->tpl_vars['countryName']->value) {
$_smarty_tpl->tpl_vars['countryName']->do_else = false;
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['countryCode']->value;?>
"<?php if ((!$_smarty_tpl->tpl_vars['clientcountry']->value && $_smarty_tpl->tpl_vars['countryCode']->value == $_smarty_tpl->tpl_vars['defaultCountry']->value) || ($_smarty_tpl->tpl_vars['countryCode']->value == $_smarty_tpl->tpl_vars['clientcountry']->value)) {?> selected="selected"<?php }?>>
                                                    <?php echo $_smarty_tpl->tpl_vars['countryName']->value;?>

                                                </option>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if ($_smarty_tpl->tpl_vars['showTaxIdField']->value) {?>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="tax_id" id="inputTaxId" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['taxLabel']->value;?>
 (<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['optional'];?>
)" value="<?php echo $_smarty_tpl->tpl_vars['clientTaxId']->value;?>
">
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['customfields']->value || $_smarty_tpl->tpl_vars['currencies']->value) {?>

                            <div class="divider mb-15">
                                <span></span>
                                <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderadditionalrequiredinfo'];?>
<br><i><small><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'orderForm.requiredField'),$_smarty_tpl ) );?>
</small></i></span>
                                <span></span>
                            </div>

                            <div class="row">
                                <?php if ($_smarty_tpl->tpl_vars['customfields']->value) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customfields']->value, 'customfield');
$_smarty_tpl->tpl_vars['customfield']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customfield']->value) {
$_smarty_tpl->tpl_vars['customfield']->do_else = false;
?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customfield<?php echo $_smarty_tpl->tpl_vars['customfield']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['customfield']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['customfield']->value['required'];?>
</label>
                                        <div class="control">
                                            <?php echo $_smarty_tpl->tpl_vars['customfield']->value['input'];?>

                                            <?php if ($_smarty_tpl->tpl_vars['customfield']->value['description']) {?>
                                            <span class="field-help-text"><?php echo $_smarty_tpl->tpl_vars['customfield']->value['description'];?>
</span>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['customfields']->value && count($_smarty_tpl->tpl_vars['customfields']->value)%2 > 0) {?>
                                <div class="clearfix"></div>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['currencies']->value) {?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select id="inputCurrency" name="currency" class="field form-control">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currencies']->value, 'curr');
$_smarty_tpl->tpl_vars['curr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['curr']->value) {
$_smarty_tpl->tpl_vars['curr']->do_else = false;
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['curr']->value['id'];?>
"<?php if (!$_POST['currency'] && $_smarty_tpl->tpl_vars['curr']->value['default'] || $_POST['currency'] == $_smarty_tpl->tpl_vars['curr']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['curr']->value['code'];?>
</option>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </select>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                            <?php }?>

                            <?php if ((isset($_smarty_tpl->tpl_vars['accountDetailsExtraFields']->value)) && !empty($_smarty_tpl->tpl_vars['accountDetailsExtraFields']->value)) {?>
                                <div class="sub-heading">
                                    <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'orderForm.additionalInformation'),$_smarty_tpl ) );?>
</span>
                                </div>
                                <div class="row">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['accountDetailsExtraFields']->value, 'field');
$_smarty_tpl->tpl_vars['field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field']->value) {
$_smarty_tpl->tpl_vars['field']->do_else = false;
?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <?php echo $_smarty_tpl->tpl_vars['field']->value['input'];?>

                                            </div>
                                        </div>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </div>
                            <?php }?>
            
                            <div id="containerNewUserSecurity" <?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value && !$_smarty_tpl->tpl_vars['securityquestions']->value) {?> class="hidden"<?php }?>>

                                <div class="divider mb-15">
                                    <span></span>
                                    <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['accountSecurity'];?>
</span>
                                    <span></span>
                                </div>

                                <div id="containerPassword" class="row<?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value && $_smarty_tpl->tpl_vars['securityquestions']->value) {?> hidden<?php }?>">
                                    <div id="passwdFeedback" style="display: none;" class="alert alert-info text-center col-sm-12"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="password" name="password" id="inputNewPassword1" data-error-threshold="<?php echo $_smarty_tpl->tpl_vars['pwStrengthErrorThreshold']->value;?>
" data-warning-threshold="<?php echo $_smarty_tpl->tpl_vars['pwStrengthWarningThreshold']->value;?>
" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];?>
" autocomplete="off"<?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value) {?> value="<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
"<?php }?>>
                                            <button data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['btnLabel'];?>
" type="button" class="generate-password" data-targetfields="inputNewPassword1,inputNewPassword2"><i class="icon-lock"></i></button>
                                            <div class="password-strength-meter">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="passwordStrengthMeterBar">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="password" name="password2" id="inputNewPassword2" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaconfirmpassword'];?>
" autocomplete="off"<?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value) {?> value="<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
"<?php }?>>
                                        </div>
                                    </div>
                                    
                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['securityquestions']->value) {?>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <select name="securityqid" id="inputSecurityQId" class="field form-control">
                                            <option value=""><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareasecurityquestion'];?>
</option>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['securityquestions']->value, 'question');
$_smarty_tpl->tpl_vars['question']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['question']->value) {
$_smarty_tpl->tpl_vars['question']->do_else = false;
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['question']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['question']->value['id'] == $_smarty_tpl->tpl_vars['securityqid']->value) {?> selected<?php }?>>
                                                <?php echo $_smarty_tpl->tpl_vars['question']->value['question'];?>

                                            </option>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="password" name="securityqans" id="inputSecurityQAns" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareasecurityanswer'];?>
" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['showMarketingEmailOptIn']->value) {?>
                            <div class="marketing-email-optin bg-colorstyle">
                                <h2 class="mergecolor"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'emailMarketing.joinOurMailingList'),$_smarty_tpl ) );?>
</h2>
                                <p class="mergecolor"><?php echo $_smarty_tpl->tpl_vars['marketingEmailOptInMessage']->value;?>
</p>
                                <input type="checkbox" name="marketingoptin" value="1"<?php if ($_smarty_tpl->tpl_vars['marketingEmailOptIn']->value) {?> checked<?php }?> class="no-icheck toggle-switch-success" data-size="small" data-on-text="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'yes'),$_smarty_tpl ) );?>
" data-off-text="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'no'),$_smarty_tpl ) );?>
">
                            </div>
                            <?php }?>
                            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                            <br/>
                            <?php if ($_smarty_tpl->tpl_vars['accepttos']->value) {?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-danger tospanel border-0">
                                        <div class="panel-heading bg-colorstyle">
                                            <h3 class="panel-title mergecolor"><span class="fas fa-exclamation-triangle tosicon"></span> &nbsp; <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordertos'];?>
</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="list d-inline custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input accepttos" name="accepttos" id="rememberme">
                                                <label class="custom-control-label" for="rememberme"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordertosagreement'];?>
</label>
                                                <a class="c-pink" href="<?php echo $_smarty_tpl->tpl_vars['tosurl']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordertos'];?>
</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <input class="btn btn-default-yellow-fill <?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientregistertitle'];?>
"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }
}
}
