{include file="$template/includes/flashmessage.tpl"}

<style>
/* ── Dashboard wrapper ─────────────────────────────── */
.ca-wrap { padding: 8px 0 50px; }

/* ── Welcome banner ───────────────────────────────── */
.ca-banner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
    border-radius: 16px;
    padding: 28px 32px;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 16px;
    box-shadow: 0 4px 20px rgba(15,23,42,.15);
}
.ca-banner-left { display: flex; align-items: center; gap: 18px; }
.ca-banner-avatar {
    width: 54px; height: 54px; border-radius: 50%;
    background: linear-gradient(135deg, #50d29e, #38b584);
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; color: #fff; font-weight: 800;
    flex-shrink: 0; text-transform: uppercase;
    box-shadow: 0 0 0 3px rgba(80,210,158,.25);
}
.ca-banner-info h4 { margin: 0 0 4px; color: #fff; font-size: 19px; font-weight: 700; }
.ca-banner-info p  { margin: 0; color: #94a3b8; font-size: 13px; }
.ca-banner-actions { display: flex; gap: 10px; flex-wrap: wrap; }
.ca-action-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 18px; border-radius: 9px; font-size: 13px;
    font-weight: 600; text-decoration: none; transition: all .18s;
    border: 1px solid transparent; white-space: nowrap;
}
.ca-action-btn.green  { background: #50d29e; color: #fff; }
.ca-action-btn.green:hover  { background: #3dbf8b; color: #fff; text-decoration: none; }
.ca-action-btn.ghost  { border-color: rgba(255,255,255,.2); color: #cbd5e1; background: rgba(255,255,255,.06); }
.ca-action-btn.ghost:hover  { border-color: rgba(255,255,255,.45); color: #fff; background: rgba(255,255,255,.12); text-decoration: none; }

/* ── Stat cards ───────────────────────────────────── */
.ca-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 28px; }
@media(max-width:992px){ .ca-stats { grid-template-columns: repeat(2,1fr); } }
@media(max-width:576px){ .ca-stats { grid-template-columns: 1fr; } }

.ca-stat {
    border-radius: 16px;
    padding: 22px 22px 20px;
    display: flex; flex-direction: column; gap: 10px;
    text-decoration: none;
    transition: all .18s;
    border: none;
    box-shadow: 0 2px 10px rgba(15,23,42,.08);
    position: relative; overflow: hidden;
}
.ca-stat::after {
    content: '';
    position: absolute;
    right: -14px; bottom: -18px;
    width: 90px; height: 90px;
    border-radius: 50%;
    background: rgba(255,255,255,.18);
    pointer-events: none;
}
.ca-stat:hover { box-shadow: 0 8px 24px rgba(15,23,42,.14); transform: translateY(-3px); text-decoration: none; }
.ca-stat-icon {
    width: 44px; height: 44px; border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; background: rgba(255,255,255,.35);
    align-self: flex-end;
    position: absolute; top: 20px; right: 20px;
}
.ca-stat.teal  { background: linear-gradient(135deg, #b8f0e0 0%, #d4f5ec 100%); }
.ca-stat.blue  { background: linear-gradient(135deg, #fde9a8 0%, #fef3c7 100%); }
.ca-stat.amber { background: linear-gradient(135deg, #ffc8c8 0%, #ffe0e0 100%); }
.ca-stat.violet{ background: linear-gradient(135deg, #d4c5f9 0%, #e8e0fc 100%); }
.ca-stat-icon.teal  { color: #059669; }
.ca-stat-icon.blue  { color: #d97706; }
.ca-stat-icon.amber { color: #dc2626; }
.ca-stat-icon.violet{ color: #7c3aed; }
.ca-stat-num   { font-size: 34px; font-weight: 800; color: #0f172a; line-height: 1; margin-top: 4px; }
.ca-stat-trend {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 12px; font-weight: 600;
}
.ca-stat-trend.green { color: #059669; }
.ca-stat-trend.red   { color: #dc2626; }
.ca-stat-label { font-size: 11px; color: #475569; font-weight: 500; text-transform: uppercase; letter-spacing: .04em; }

/* ── Panels grid ──────────────────────────────────── */
.ca-section-title { color: #0f172a; font-size: 16px; font-weight: 700; margin: 0 0 16px; letter-spacing: -.01em; }

.ca-panels { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; }
@media(max-width:992px){ .ca-panels { grid-template-columns: repeat(2,1fr); } }
@media(max-width:576px){ .ca-panels { grid-template-columns: 1fr; } }

.ca-panel {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e5e9f0;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(15,23,42,.06);
}
.ca-panel-head {
    padding: 14px 18px;
    border-bottom: 1px solid #f1f4f9;
    font-size: 13px; font-weight: 700; color: #0f172a;
    display: flex; align-items: center; justify-content: space-between;
    background: #f8fafc;
}
.ca-panel-head .badge {
    background: #50d29e; color: #fff;
    font-size: 10px; padding: 2px 8px; border-radius: 20px;
    font-weight: 700;
}
.ca-panel-body { padding: 4px 0; }
.ca-panel-item {
    display: flex; align-items: center; justify-content: space-between;
    padding: 10px 18px; font-size: 13px; color: #374151;
    border-bottom: 1px solid #f3f4f6;
    text-decoration: none; transition: background .12s;
}
.ca-panel-item:last-child { border-bottom: none; }
.ca-panel-item:hover { background: #f8fafc; color: #0f172a; text-decoration: none; }
.ca-panel-item span { color: #94a3b8; font-size: 12px; }
.ca-panel-empty {
    padding: 28px 18px; text-align: center;
    color: #9ca3af; font-size: 13px;
}
.ca-panel-empty i { font-size: 24px; color: #d1d5db; display: block; margin-bottom: 10px; }
.ca-panel-body-html { padding: 14px 18px; font-size: 13px; color: #374151; line-height: 1.6; }
.ca-panel-body-html a { color: #3b82f6; }

/* Domain registration panel fix */
.ca-panel-body-html .input-group,
.ca-panel-body-html form { display: flex; flex-direction: column; gap: 10px; }
.ca-panel-body-html input[type="text"],
.ca-panel-body-html input[type="search"] {
    width: 100%; padding: 10px 14px; border-radius: 9px;
    border: 1px solid #e2e8f0; font-size: 13px;
    background: #f8fafc; color: #0f172a;
    outline: none; box-sizing: border-box;
}
.ca-panel-body-html input[type="text"]:focus,
.ca-panel-body-html input[type="search"]:focus { border-color: #50d29e; background: #fff; }
.ca-panel-body-html .btn-group,
.ca-panel-body-html .input-group-btn,
.ca-panel-body-html .domain-btn-group {
    display: flex !important; flex-direction: row !important;
    gap: 8px; flex-wrap: wrap;
}
.ca-panel-body-html .btn {
    flex: 1; padding: 9px 14px; border-radius: 9px;
    font-size: 13px; font-weight: 600; cursor: pointer;
    border: 1.5px solid #e2e8f0; background: #f8fafc;
    color: #374151; transition: all .15s; text-align: center;
    white-space: nowrap;
}
.ca-panel-body-html .btn:hover { background: #50d29e; color: #fff; border-color: #50d29e; }
.ca-panel-body-html .btn-primary,
.ca-panel-body-html .btn-default:first-child {
    background: #50d29e; color: #fff; border-color: #50d29e;
}
.ca-panel-body-html .btn-primary:hover { background: #3dbf8b; border-color: #3dbf8b; }
.ca-panel-footer {
    padding: 10px 18px;
    border-top: 1px solid #f1f4f9;
    background: #f8fafc;
}
.ca-panel-footer a {
    font-size: 12px; color: #50d29e; text-decoration: none; font-weight: 600;
}
.ca-panel-footer a:hover { text-decoration: underline; }
</style>

<div class="ca-wrap">

    <!-- WELCOME BANNER -->
    <div class="ca-banner">
        <div class="ca-banner-left">
            <div class="ca-banner-avatar">
                {$clientsdetails.firstname|substr:0:1|upper}{$clientsdetails.lastname|substr:0:1|upper}
            </div>
            <div class="ca-banner-info">
                <h4>Bonjour, {$clientsdetails.firstname} {$clientsdetails.lastname} 👋</h4>
                <p>{$clientsdetails.email}{if $clientsdetails.city} &nbsp;·&nbsp; {$clientsdetails.city}{/if}{if $clientsdetails.country}, {$clientsdetails.country}{/if}</p>
            </div>
        </div>
        <div class="ca-banner-actions">
            <a href="clientarea.php?action=addfunds" class="ca-action-btn green"><i class="fas fa-plus"></i> Ajouter des fonds</a>
            <a href="clientarea.php?action=details" class="ca-action-btn ghost"><i class="fas fa-user-cog"></i> Mon compte</a>
            <a href="supporttickets.php" class="ca-action-btn ghost"><i class="fas fa-headset"></i> Support</a>
        </div>
    </div>

    <!-- STAT CARDS -->
    <div class="ca-stats">
        <a href="clientarea.php?action=services" class="ca-stat teal">
            <div class="ca-stat-icon teal"><i class="fas fa-server"></i></div>
            <div class="ca-stat-label">SERVICES ACTIFS</div>
            <div class="ca-stat-num">{$clientsstats.productsnumactive}</div>
            <div class="ca-stat-trend green"><i class="fas fa-check-circle"></i> Services actifs</div>
        </a>
        <a href="clientarea.php?action=domains" class="ca-stat blue">
            <div class="ca-stat-icon blue"><i class="fas fa-globe"></i></div>
            <div class="ca-stat-label">DOMAINES ACTIFS</div>
            <div class="ca-stat-num">{$clientsstats.numactivedomains}</div>
            <div class="ca-stat-trend green"><i class="fas fa-arrow-up"></i> Domaines actifs</div>
        </a>
        <a href="supporttickets.php" class="ca-stat amber">
            <div class="ca-stat-icon amber"><i class="fas fa-ticket-alt"></i></div>
            <div class="ca-stat-label">TICKETS OUVERTS</div>
            <div class="ca-stat-num">{$clientsstats.numactivetickets}</div>
            <div class="ca-stat-trend {if $clientsstats.numactivetickets > 0}red{else}green{/if}">
                <i class="fas fa-{if $clientsstats.numactivetickets > 0}heartbeat{else}check-circle{/if}"></i> Tickets en cours
            </div>
        </a>
        <a href="clientarea.php?action=invoices" class="ca-stat violet">
            <div class="ca-stat-icon violet"><i class="fas fa-file-invoice-dollar"></i></div>
            <div class="ca-stat-label">FACTURES IMPAYÉES</div>
            <div class="ca-stat-num">{$clientsstats.numunpaidinvoices}</div>
            <div class="ca-stat-trend {if $clientsstats.numunpaidinvoices > 0}red{else}green{/if}">
                <i class="fas fa-arrow-up"></i> Factures impayées
            </div>
        </a>
    </div>

    <!-- PANELS -->
    {if $panels|@count > 0}
    <p class="ca-section-title">Aperçu du compte</p>
    <div class="ca-panels">
        {foreach $panels as $item}
        <div class="ca-panel">
            <div class="ca-panel-head">
                <span>{$item->getLabel()}</span>
                {if $item->hasBadge()}<span class="badge">{$item->getBadge()}</span>{/if}
            </div>
            {if $item->hasBodyHtml()}
            <div class="ca-panel-body-html">{$item->getBodyHtml()}</div>
            {elseif $item->hasChildren()}
            <div class="ca-panel-body">
                {foreach $item->getChildren() as $childItem}
                    {if $childItem->getUri()}
                    <a href="{$childItem->getUri()}" class="ca-panel-item"{if $childItem->getAttribute('target')} target="{$childItem->getAttribute('target')}"{/if}>
                        <span>
                            {if $childItem->hasIcon()}<i class="{$childItem->getIcon()}" style="margin-right:8px;color:#9ca3af;"></i>{/if}
                            {$childItem->getLabel()}
                        </span>
                        {if $childItem->hasBadge()}<span>{$childItem->getBadge()}</span>{/if}
                    </a>
                    {else}
                    <div class="ca-panel-item">
                        <span>
                            {if $childItem->hasIcon()}<i class="{$childItem->getIcon()}" style="margin-right:8px;color:#9ca3af;"></i>{/if}
                            {$childItem->getLabel()}
                        </span>
                        {if $childItem->hasBadge()}<span>{$childItem->getBadge()}</span>{/if}
                    </div>
                    {/if}
                {/foreach}
            </div>
            {else}
            <div class="ca-panel-empty">
                <i class="fas fa-inbox"></i>
                Aucun élément à afficher
            </div>
            {/if}
            {if $item->getExtra('btn-link') && $item->getExtra('btn-text')}
            <div class="ca-panel-footer"><a href="{$item->getExtra('btn-link')}">{$item->getExtra('btn-text')} →</a></div>
            {/if}
        </div>
        {/foreach}
    </div>
    {/if}

    {foreach from=$addons_html item=addon_html}
    <div style="margin-top:24px;">{$addon_html}</div>
    {/foreach}

</div>
