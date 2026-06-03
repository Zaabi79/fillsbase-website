<?php
/* Smarty version 4.5.3, created on 2026-06-03 21:26:15
  from '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/includes/flashmessage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6a209bf748b4e1_64285969',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '00396cb6824b476b98bb8d5f86792301f272ace8' => 
    array (
      0 => '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/includes/flashmessage.tpl',
      1 => 1780521578,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a209bf748b4e1_64285969 (Smarty_Internal_Template $_smarty_tpl) {
$_prefixVariable1 = get_flash_message();
$_smarty_tpl->_assignInScope('message', $_prefixVariable1);
if ($_prefixVariable1) {?>
    <div class="alert alert-<?php if ($_smarty_tpl->tpl_vars['message']->value['type'] == "error") {?>danger<?php } elseif ($_smarty_tpl->tpl_vars['message']->value['type'] == 'success') {?>success<?php } elseif ($_smarty_tpl->tpl_vars['message']->value['type'] == 'warning') {?>warning<?php } else { ?>info<?php }
if ((isset($_smarty_tpl->tpl_vars['align']->value))) {?> text-<?php echo $_smarty_tpl->tpl_vars['align']->value;
}?>">
        <?php echo $_smarty_tpl->tpl_vars['message']->value['text'];?>

    </div>
<?php }
}
}
