<div class="loginpage sec-bg3 motpath fullrock-content bg-colorstyle">
    <div class="container">


        <div class="logincontent">
            <div class="login-wrapper">
                <div class="login-form-container sec-main sec-bg1 tabs bg-seccolorstyle noshadow">
                    {include file="$template/includes/flashmessage.tpl"}

                    <div class="text-center">
                        <h2 class="section-heading whitecolor mergecolor">{$LANG.pwreset}</h2>
                    </div>

                    <div class="mt-50">
                        {if $loggedin && $innerTemplate}
                            {include file="$template/includes/alert.tpl" type="error" msg=$LANG.noPasswordResetWhenLoggedIn textcenter=true}
                        {elseif $successMessage}
                            {include file="$template/includes/alert.tpl" type="success" msg=$successTitle textcenter=true}
                            <p class="text-center mergecolor">{$successMessage}</p>
                            <div class="text-center mt-4">
                                <a href="{routePath('login')}" class="btn btn-default-yellow-fill">
                                    <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                                </a>
                            </div>
                        {else}
                            {if $errorMessage}
                                {include file="$template/includes/alert.tpl" type="error" msg=$errorMessage textcenter=true}
                            {/if}
                            {if $innerTemplate}
                                {include file="$template/password-reset-$innerTemplate.tpl"}
                            {/if}
                        {/if}
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
