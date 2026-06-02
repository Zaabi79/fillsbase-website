{if $loginpage eq 0 and $templatefile ne "clientregister"}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.wrapper -->
    </div><!-- /.box-container -->

{if $loggedin}<span id="gravataremail" style="display:none!important;">{$clientsdetails.email}</span>{/if}



<!--
*******************
FOOTER
*******************
-->
<footer id="footer" class="footer">
  {include file="$template/includes/footer_sync.tpl"}
</footer>

<div class="modal system-modal fade" id="modalAjax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                    <span class="sr-only">{$LANG.close}</span>
                </button>
                <h4 class="modal-title">Title</h4>
            </div>
            <div class="modal-body panel-body">
                Loading...
                {$LANG.loading}
            </div>
            <div class="modal-footer panel-footer">
                <div class="pull-left loader">
                    <i class="fas fa-circle-notch fa-spin"></i> Loading...
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                    {$LANG.close}
                </button>
                <button type="button" class="btn btn-primary modal-submit">
                    Submit
                    {$LANG.submit}
                </button>
            </div>
        </div>
    </div>
</div>
{/if}

{include file="$template/includes/generate-password.tpl"}
{$footeroutput}

<script>
 if ($("p:contains('Powered by')").length) {
 $("p:contains('Powered by')").hide();
 }
</script>

</body>
</html>
