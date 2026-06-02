<div class="loginpage sec-bg3 motpath fullrock-content bg-colorstyle">
    <div class="container">

        <div class="row login-page-header">
            <a class="navbar-brand" href="{$WEB_ROOT}/index.php">
                <img class="svg logo-menu d-block" src="{$WEB_ROOT}/assets/img/fillsbase_logo.png" alt="{$companyname}" width="180">
            </a>
            <a href="{$WEB_ROOT}/login"><i class="fas fa-arrow-left" style="font-size:18px;color:inherit;"></i></a>
        </div>

        <div class="logincontent">
            <div class="login-wrapper">
                <div class="login-form-container sec-main sec-bg1 tabs bg-seccolorstyle noshadow">
                    {include file="$template/includes/flashmessage.tpl"}

                    <div class="text-center">
                        <h2 class="section-heading whitecolor mergecolor">Réinitialiser le mot de passe</h2>
                        <p class="section-subheading whitecolor mergecolor">Saisissez votre adresse e-mail pour recevoir un lien de réinitialisation.</p>
                    </div>

                    <div class="mt-50">
                        <form method="post" action="{routePath('password-reset-process')}" role="form" class="login-form">
                            {if isset($token)}<input type="hidden" name="token" value="{$token}" />{/if}
                            <input type="hidden" name="action" value="reset" />

                            <div class="col-md-8 offset-md-2">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="inputEmail"
                                        placeholder="Votre adresse e-mail" autofocus required>
                                </div>
                            </div>

                            <div class="col-md-12 mt-5 position-relative aitems-center">
                                <button type="submit" class="btn btn-default-yellow-fill mt-0 me-5">
                                    <span class="me-2">Envoyer le lien</span>
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                                <a class="golink me-5 position-relative" href="{$WEB_ROOT}/login">
                                    <i class="fas fa-arrow-left me-1"></i> Retour à la connexion
                                </a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
