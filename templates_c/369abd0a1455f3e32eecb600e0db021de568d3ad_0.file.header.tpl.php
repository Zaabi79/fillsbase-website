<?php
/* Smarty version 4.5.3, created on 2026-06-03 20:45:06
  from '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6a209252b1b2a2_66804283',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '369abd0a1455f3e32eecb600e0db021de568d3ad' => 
    array (
      0 => '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/header.tpl',
      1 => 1780432728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a209252b1b2a2_66804283 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="<?php echo $_smarty_tpl->tpl_vars['language']->value;?>
">
<head>
    <meta charset="<?php echo $_smarty_tpl->tpl_vars['charset']->value;?>
" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <meta http-equiv="Content-Language" content="en">
    <link rel="icon" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/assets/img/favicon.ico">
    <title><?php if ($_smarty_tpl->tpl_vars['kbarticle']->value['title']) {
echo $_smarty_tpl->tpl_vars['kbarticle']->value['title'];?>
 - <?php }
echo $_smarty_tpl->tpl_vars['pagetitle']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
</title>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?> 
    <?php echo $_smarty_tpl->tpl_vars['headoutput']->value;?>

    <?php $_smarty_tpl->_assignInScope('assetLogoPath', ((string)$_smarty_tpl->tpl_vars['WEB_ROOT']->value)."/fillsbase.png?v=1.0");?>
</head>

<body data-layout="wideboxed" data-background="origin" data-color="green" data-header="" data-textDirection="ltr" data-radius="sixradius">

    <div class="box-container limit-width">
        <header id="header">
           <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/header_sync.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        </header>

        <div class="wrapper sec-normal bg-colorstyle">
            <div class="container">
                <?php echo $_smarty_tpl->tpl_vars['headeroutput']->value;?>

                <?php if ($_smarty_tpl->tpl_vars['loggedin']->value && (substr((string) $_smarty_tpl->tpl_vars['templatefile']->value, (int) 0, (int) 10) == 'clientarea' || $_smarty_tpl->tpl_vars['templatefile']->value == 'supporttickets' || $_smarty_tpl->tpl_vars['templatefile']->value == 'viewticket' || $_smarty_tpl->tpl_vars['templatefile']->value == 'submitticket')) {?>
                                <?php if ($_smarty_tpl->tpl_vars['templatefile']->value != "clientareahome") {?>
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                <?php }?>
                <div class="row ca-layout" style="margin-top:24px;">
                    <div class="col-md-3 col-lg-3 ca-sidebar-col">
                        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                    </div>
                    <div class="col-md-9 col-lg-9 ca-content-col">
                <?php } else { ?>
                <div class="row">
                    <div class="col-md-12">
                <?php }
}
}
