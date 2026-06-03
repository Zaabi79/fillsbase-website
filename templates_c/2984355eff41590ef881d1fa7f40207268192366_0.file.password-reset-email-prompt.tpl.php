<?php
/* Smarty version 4.5.3, created on 2026-06-03 22:51:05
  from '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/password-reset-email-prompt.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6a20afd94229a1_33310696',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2984355eff41590ef881d1fa7f40207268192366' => 
    array (
      0 => '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/password-reset-email-prompt.tpl',
      1 => 1780521637,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a20afd94229a1_33310696 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="text-center">
    <p class="section-subheading whitecolor mergecolor"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwresetemailneeded'];?>
</p>
</div>

<div class="mt-50">
    <form method="post" action="<?php echo routePath('password-reset-validate-email');?>
" role="form">
        <input type="hidden" name="action" value="reset" />

        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['enteremail'];?>
" autofocus>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <button type="submit" class="btn btn-default-yellow-fill <?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
">
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwresetsubmit'];?>

                    </button>
                </div>
            </div>

            <?php if ($_smarty_tpl->tpl_vars['captcha']->value && $_smarty_tpl->tpl_vars['captcha']->value->isEnabled() && $_smarty_tpl->tpl_vars['showCaptchaAfterLimit']->value) {?>
                <div class="text-center margin-bottom">
                    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                </div>
            <?php }?>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary<?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
">
                <button type="submit" id="resetPasswordButton" <?php if ($_smarty_tpl->tpl_vars['showCaptchaAfterLimit']->value) {?>data-captcha-required="true"<?php }?> class="btn btn-primary<?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
">
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwresetsubmit'];?>

                </button>
            </div>

        </div>
    </form>
</div>


<?php }
}
