<?php
/* Smarty version 4.5.3, created on 2026-06-03 17:18:52
  from '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/includes/generate-password.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6a2061fc0e62b8_58635556',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0f41131245b38daa9f6893f3c1ae80ed98fe1c51' => 
    array (
      0 => '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/includes/generate-password.tpl',
      1 => 1780432728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a2061fc0e62b8_58635556 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="#" id="frmGeneratePassword" class="form-horizontal">
    <div class="modal fade" id="modalGeneratePassword">
        <div class="modal-dialog generatepassword">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ico-plus"></i></button>
                    <h4 class="modal-title">
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['title'];?>

                    </h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger hidden" id="generatePwLengthError">
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['lengthValidationError'];?>

                    </div>
                    <div class="form-group">
                        <label for="generatePwLength" class="col-sm-4 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['pwLength'];?>
</label>
                        <div class="col-sm-8">
                            <input type="number" min="8" max="64" value="12" step="1" class="form-control input-inline input-inline-100" id="inputGeneratePasswordLength">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="generatePwOutput" class="col-sm-4 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['generatedPw'];?>
</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputGeneratePasswordOutput">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-success btn-extrasmall">
                            <i class="fas fa-plus fa-fw"></i>
                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['generateNew'];?>

                            </button>
                            <button type="button" class="btn btn-sm btn-default-yellow-fill copy-to-clipboard" data-clipboard-target="#inputGeneratePasswordOutput">
                            <i class="fas fa-copy fa-fw"></i>
                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['copy'];?>

                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-small" data-dismiss="modal">
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['close'];?>

                    </button>
                    <button type="button" class="btn btn-md btn-default-yellow-fill" id="btnGeneratePasswordInsert" data-clipboard-target="#inputGeneratePasswordOutput">
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['copyAndInsert'];?>

                    </button>
                </div>
            </div>
        </div>
    </div>
</form><?php }
}
