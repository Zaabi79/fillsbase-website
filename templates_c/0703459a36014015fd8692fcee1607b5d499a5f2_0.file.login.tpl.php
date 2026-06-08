<?php
/* Smarty version 4.5.3, created on 2026-06-04 00:13:28
  from '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6a20c328363024_56868245',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0703459a36014015fd8692fcee1607b5d499a5f2' => 
    array (
      0 => '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/login.tpl',
      1 => 1780525349,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a20c328363024_56868245 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="loginpage sec-bg3 motpath fullrock-content bg-colorstyle">
    <div class="container">
        
        <div class="row login-page-header">
            <a class="navbar-brand" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/index.php">
              <img class="svg logo-menu d-block" src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/img/fillsbase_logo.png" alt="<?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
" style="width:160px;height:auto;">
              <img class="svg logo-menu d-none" src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/assets/img/fillsbase_logo.png" alt="<?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
" style="width:160px;height:auto;">
            </a>
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/register.php"> <i class="ico-user-plus" data-toggle="tooltip" data-placement="left" title="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['registerintro'];?>
"></i> </a>
        </div>

        <div class="logincontent">
            <div class="login-wrapper">
                <div class="login-form-container sec-main sec-bg1 tabs bg-seccolorstyle noshadow">
                    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/flashmessage.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                    
                    <div class="text-center">
                        <h2 class="section-heading whitecolor mergecolor"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareahomeloginbtn'];?>
</h2>
                        <p class="section-subheading whitecolor mergecolor"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['restrictedpage'];?>
</p>
                    </div>

                    <div class="mt-50">
                        <div class="<?php if (!$_smarty_tpl->tpl_vars['linkableProviders']->value) {?>hidden<?php }?>">
                            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/linkedaccounts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('linkContext'=>"login",'customFeedback'=>true), 0, true);
?>
                            <div class="divider">
                                <span></span>
                                <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['remoteAuthn']['titleOr'];?>
</span>
                                <span></span>
                            </div>
                        </div>
                        <div class="providerLinkingFeedback mx-3"></div>
                        <form method="post" action="<?php echo routePath('login-validate');?>
" class="login-form" role="form">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="username" class="form-control" id="inputEmail" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwresetemailrequired'];?>
" autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['twofaconfirmpw'];?>
" autocomplete="off" >
                                </div>
                            </div>

                            <div class="col-md-12 mt-5 position-relative aitems-center">
                                <button type="submit" id="login" value="login" class="btn btn-default-yellow-fill mt-0 me-5 <?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
"> 
                                    <span class="me-2"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginbutton'];?>
</span>
                                    <i class="fas fa-lock"></i>
                                </button>
                                <a class="golink me-5 position-relative forgotpw-txt" href="<?php echo routePath('password-reset-begin');?>
"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['forgotpw'];?>
</a>
                                <div class="list d-inline custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="rememberme" id="rememberme">
                                    <label class="custom-control-label mb-0" for="rememberme"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginrememberme'];?>
</label>
                                </div>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['captcha']->value->isEnabled()) {?>
                            <div class="text-center margin-bottom">
                                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                            </div>
                            <?php }?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php }
}
