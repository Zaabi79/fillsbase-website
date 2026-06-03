<?php
/* Smarty version 4.5.3, created on 2026-06-03 22:51:05
  from '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/includes/pageheader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6a20afd9412827_18873071',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '33197e22ac1fc431ab3877a1206ce3c0f6f689b8' => 
    array (
      0 => '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/includes/pageheader.tpl',
      1 => 1780432728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a20afd9412827_18873071 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container">
	
	<div class="row text-center">
		<h2 class="section-heading mergecolor text-center w-100"><?php echo $_smarty_tpl->tpl_vars['title']->value;
if ($_smarty_tpl->tpl_vars['desc']->value) {?></h2>
		<p class="section-subheading mergecolor"><?php echo $_smarty_tpl->tpl_vars['desc']->value;?>
</p><?php }?>
	</div>

	<?php if (!$_smarty_tpl->tpl_vars['inShoppingCart']->value && ($_smarty_tpl->tpl_vars['primarySidebar']->value->hasChildren() || $_smarty_tpl->tpl_vars['secondarySidebar']->value->hasChildren())) {?>
	<div class="dropnav-header-lined">
		<button id="dropside-content" type="button" class="drop-down-btn dropside-content" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa-solid fa-ellipsis-vertical"></i>
		</button>
		<div class="dropdown-menu bg-seccolorstyle" aria-labelledby="dropside-content">
			<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('sidebar'=>$_smarty_tpl->tpl_vars['primarySidebar']->value), 0, true);
?>
			<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('sidebar'=>$_smarty_tpl->tpl_vars['secondarySidebar']->value), 0, true);
?>
		</div>
	</div>
	<?php }?>

</div><?php }
}
