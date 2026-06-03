<?php
/* Smarty version 4.5.3, created on 2026-06-03 20:45:06
  from '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6a209252b34672_36890039',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f5aca96fe7846aa1b52e4b16718880796a8fb5a' => 
    array (
      0 => '/Users/mac/Desktop/filsbase_Projects/fillsbase-website/templates/fillsbase/footer.tpl',
      1 => 1780432728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a209252b34672_36890039 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['loginpage']->value == 0 && $_smarty_tpl->tpl_vars['templatefile']->value != "clientregister") {?>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.wrapper -->
    </div><!-- /.box-container -->

<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?><span id="gravataremail" style="display:none!important;"><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['email'];?>
</span><?php }?>



<!--
*******************
FOOTER
*******************
-->
<footer id="footer" class="footer">
  <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/footer_sync.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</footer>

<div class="modal system-modal fade" id="modalAjax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                    <span class="sr-only"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['close'];?>
</span>
                </button>
                <h4 class="modal-title">Title</h4>
            </div>
            <div class="modal-body panel-body">
                Loading...
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['loading'];?>

            </div>
            <div class="modal-footer panel-footer">
                <div class="pull-left loader">
                    <i class="fas fa-circle-notch fa-spin"></i> Loading...
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['close'];?>

                </button>
                <button type="button" class="btn btn-primary modal-submit">
                    Submit
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['submit'];?>

                </button>
            </div>
        </div>
    </div>
</div>
<?php }?>

<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/generate-password.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
echo $_smarty_tpl->tpl_vars['footeroutput']->value;?>


<?php echo '<script'; ?>
>
 if ($("p:contains('Powered by')").length) {
 $("p:contains('Powered by')").hide();
 }
<?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
