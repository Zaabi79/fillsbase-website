<aside class="lw-sidebar">

    <!-- User card -->
    <div class="lw-sb-user">
        <div class="lw-sb-avatar">{$clientsdetails.firstname|substr:0:1}{$clientsdetails.lastname|substr:0:1}</div>
        <div class="lw-sb-info">
            <div class="lw-sb-name">{$clientsdetails.firstname} {$clientsdetails.lastname}</div>
            <div class="lw-sb-email">{$clientsdetails.email}</div>
        </div>
    </div>

    <!-- Nav items from WHMCS sidebar -->
    <nav class="lw-sb-nav">
        {foreach $sidebar as $item}
            {if $item->hasChildren()}
                <div class="lw-sb-section">{$item->getLabel()}</div>
                {foreach $item->getChildren() as $child}
                    {if $child->getUri()}
                        <a href="{$child->getUri()}"
                           class="lw-sb-link{if $child->isCurrent()} active{/if}{if $child->isDisabled()} disabled{/if}"
                           menuItemName="{$child->getName()}">
                            {if $child->hasIcon()}
                                <i class="{$child->getIcon()}"></i>
                            {else}
                                <i class="fas fa-circle" style="font-size:6px;opacity:.5;"></i>
                            {/if}
                            <span>{$child->getLabel()}</span>
                            {if $child->hasBadge()}<span class="lw-sb-badge">{$child->getBadge()}</span>{/if}
                        </a>
                    {/if}
                {/foreach}
            {elseif $item->getUri()}
                <a href="{$item->getUri()}"
                   class="lw-sb-link{if $item->isCurrent()} active{/if}"
                   menuItemName="{$item->getName()}">
                    {if $item->hasIcon()}<i class="{$item->getIcon()}"></i>{else}<i class="fas fa-chevron-right"></i>{/if}
                    <span>{$item->getLabel()}</span>
                    {if $item->hasBadge()}<span class="lw-sb-badge">{$item->getBadge()}</span>{/if}
                </a>
            {/if}
        {/foreach}
    </nav>

    <!-- Quick links always visible -->
    <div class="lw-sb-quick">
        <a href="{$WEB_ROOT}/clientarea.php" class="lw-sb-link{if $templatefile eq 'clientareahome'} active{/if}">
            <i class="fas fa-home"></i><span>Tableau de bord</span>
        </a>
        <a href="{$WEB_ROOT}/clientarea.php?action=services" class="lw-sb-link{if $templatefile eq 'clientareaservices'} active{/if}">
            <i class="fas fa-server"></i><span>Mes services</span>
        </a>
        <a href="{$WEB_ROOT}/clientarea.php?action=domains" class="lw-sb-link{if $templatefile eq 'clientareadomains'} active{/if}">
            <i class="fas fa-globe"></i><span>Mes domaines</span>
        </a>
        <a href="{$WEB_ROOT}/clientarea.php?action=invoices" class="lw-sb-link{if $templatefile eq 'clientareainvoices'} active{/if}">
            <i class="fas fa-file-invoice-dollar"></i><span>Factures</span>
            {if $clientsstats.numunpaidinvoices > 0}<span class="lw-sb-badge">{$clientsstats.numunpaidinvoices}</span>{/if}
        </a>
        <a href="{$WEB_ROOT}/supporttickets.php" class="lw-sb-link">
            <i class="fas fa-headset"></i><span>Support</span>
            {if $clientsstats.numactivetickets > 0}<span class="lw-sb-badge">{$clientsstats.numactivetickets}</span>{/if}
        </a>
        <a href="{$WEB_ROOT}/clientarea.php?action=details" class="lw-sb-link">
            <i class="fas fa-user-cog"></i><span>Mon profil</span>
        </a>
        <a href="{$WEB_ROOT}/clientarea.php?action=security" class="lw-sb-link">
            <i class="fas fa-shield-alt"></i><span>Sécurité</span>
        </a>
        <a href="{$WEB_ROOT}/clientarea.php?action=addfunds" class="lw-sb-link">
            <i class="fas fa-wallet"></i><span>Ajouter des fonds</span>
        </a>
        <a href="{$WEB_ROOT}/knowledgebase.php" class="lw-sb-link">
            <i class="fas fa-book"></i><span>Base de connaissances</span>
        </a>
    </div>

    <!-- Logout -->
    <div class="lw-sb-footer">
        <a href="{$WEB_ROOT}/logout.php" class="lw-sb-logout">
            <i class="fas fa-sign-out-alt"></i><span>Déconnexion</span>
        </a>
    </div>

</aside>

<style>
.lw-sidebar {
    width: 100%;
    background: #111827;
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    gap: 0;
    position: sticky;
    top: 20px;
}

/* User card */
.lw-sb-user {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 18px;
    background: #1f2937;
    border-bottom: 1px solid rgba(255,255,255,.06);
}
.lw-sb-avatar {
    width: 42px; height: 42px;
    background: linear-gradient(135deg, #50d29e, #38b584);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 14px; color: #fff;
    flex-shrink: 0;
    text-transform: uppercase;
}
.lw-sb-info { min-width: 0; }
.lw-sb-name { font-size: 13px; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.lw-sb-email { font-size: 11px; color: #6b7280; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 2px; }

/* Section label */
.lw-sb-section {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: #4b5563;
    padding: 14px 18px 4px;
}

/* Links */
.lw-sb-nav, .lw-sb-quick { padding: 8px 10px; }
.lw-sb-nav { border-bottom: 1px solid rgba(255,255,255,.05); }

.lw-sb-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 10px;
    border-radius: 8px;
    color: #9ca3af;
    text-decoration: none !important;
    font-size: 13px;
    font-weight: 500;
    transition: background .15s, color .15s;
    position: relative;
    margin-bottom: 2px;
}
.lw-sb-link i {
    width: 18px;
    text-align: center;
    font-size: 14px;
    flex-shrink: 0;
    color: #6b7280;
    transition: color .15s;
}
.lw-sb-link:hover {
    background: #1f2937;
    color: #fff;
}
.lw-sb-link:hover i { color: #50d29e; }
.lw-sb-link.active {
    background: rgba(80,210,158,.12);
    color: #50d29e;
}
.lw-sb-link.active i { color: #50d29e; }
.lw-sb-link.disabled { opacity: .4; pointer-events: none; }

/* Badge */
.lw-sb-badge {
    margin-left: auto;
    background: #ef4444;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    padding: 1px 6px;
    border-radius: 10px;
    min-width: 18px;
    text-align: center;
}

/* Footer / logout */
.lw-sb-footer {
    padding: 8px 10px 12px;
    border-top: 1px solid rgba(255,255,255,.05);
}
.lw-sb-logout {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 10px;
    border-radius: 8px;
    color: #ef4444;
    text-decoration: none !important;
    font-size: 13px;
    font-weight: 500;
    transition: background .15s;
}
.lw-sb-logout i { width: 18px; text-align: center; font-size: 14px; }
.lw-sb-logout:hover { background: rgba(239,68,68,.1); color: #ef4444; }

/* Adjust column layout */
.ca-sidebar-col { padding-right: 8px; }
.ca-content-col { padding-left: 8px; }
</style>
