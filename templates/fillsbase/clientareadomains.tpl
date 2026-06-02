{if $warnings}
    {include file="$template/includes/alert.tpl" type="warning" msg=$warnings textcenter=true}
{/if}

<div style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <h4 style="margin:0;font-weight:700;color:#111827;">Mes domaines</h4>
    <a href="{$WEB_ROOT}/cart.php?a=add&domain=register" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Enregistrer un domaine
    </a>
</div>

{if $domains}
<div class="lw-domains-list">
    {foreach key=num item=domain from=$domains}
    <div class="lw-domain-row" onclick="window.location.href='clientarea.php?action=domaindetails&id={$domain.id}'" style="cursor:pointer;">
        <div class="lw-domain-icon">
            <i class="fas fa-globe"></i>
        </div>
        <div class="lw-domain-info">
            <div class="lw-domain-name">{$domain.domain}</div>
            <div class="lw-domain-dates">
                Enregistré: {$domain.registrationdate} &nbsp;·&nbsp; Expire: {$domain.nextduedate}
            </div>
        </div>
        <div class="lw-domain-meta">
            {if $domain.autorenew}
                <span class="lw-tag lw-tag-green"><i class="fas fa-sync-alt"></i> Auto-renouvellement</span>
            {/if}
            <span class="lw-tag lw-tag-status-{$domain.statusClass}">{$domain.statustext}</span>
        </div>
        <div class="lw-domain-actions" onclick="event.stopPropagation();">
            <a href="clientarea.php?action=domaindetails&id={$domain.id}" class="lw-act-btn" title="Gérer">
                <i class="fas fa-cog"></i>
            </a>
            {if $allowrenew && $domain.canDomainBeManaged}
            <a href="{routePath('domain-renewal', $domain.domain)}" class="lw-act-btn" title="Renouveler">
                <i class="fas fa-redo"></i>
            </a>
            {/if}
        </div>
    </div>
    {/foreach}
</div>
{else}
<div class="lw-empty-state">
    <i class="fas fa-globe"></i>
    <h5>Aucun domaine enregistré</h5>
    <p>Vous n'avez pas encore de domaines dans votre compte.</p>
    <a href="{$WEB_ROOT}/cart.php?a=add&domain=register" class="btn btn-primary">Rechercher un domaine</a>
</div>
{/if}

<style>
.lw-domains-list { display:flex; flex-direction:column; gap:8px; }
.lw-domain-row {
    display:flex; align-items:center; gap:14px;
    background:#fff; border:1px solid #e5e7eb; border-radius:10px;
    padding:14px 16px; transition:box-shadow .15s, border-color .15s;
}
.lw-domain-row:hover { box-shadow:0 2px 8px rgba(0,0,0,.08); border-color:#d1d5db; }
.lw-domain-icon {
    width:38px; height:38px; border-radius:50%; background:#f0fdf4;
    display:flex; align-items:center; justify-content:center;
    color:#16a34a; font-size:16px; flex-shrink:0;
}
.lw-domain-info { flex:1; min-width:0; }
.lw-domain-name { font-weight:700; font-size:14px; color:#111827; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.lw-domain-dates { font-size:12px; color:#6b7280; margin-top:2px; }
.lw-domain-meta { display:flex; gap:6px; flex-wrap:wrap; align-items:center; }
.lw-tag {
    font-size:11px; font-weight:600; padding:3px 8px; border-radius:20px;
    white-space:nowrap;
}
.lw-tag-green { background:#d1fae5; color:#065f46; }
.lw-tag-status-active { background:#d1fae5; color:#065f46; }
.lw-tag-status-expired { background:#fee2e2; color:#991b1b; }
.lw-tag-status-pending { background:#fef3c7; color:#92400e; }
.lw-tag-status-cancelled { background:#f3f4f6; color:#6b7280; }
.lw-domain-actions { display:flex; gap:6px; flex-shrink:0; }
.lw-act-btn {
    width:32px; height:32px; border-radius:8px; background:#f3f4f6;
    display:flex; align-items:center; justify-content:center;
    color:#6b7280; text-decoration:none; transition:background .15s, color .15s;
    font-size:13px;
}
.lw-act-btn:hover { background:#e5e7eb; color:#111827; }
.lw-empty-state {
    text-align:center; padding:60px 20px;
    background:#fff; border:1px dashed #d1d5db; border-radius:12px;
}
.lw-empty-state i { font-size:48px; color:#d1d5db; display:block; margin-bottom:16px; }
.lw-empty-state h5 { color:#374151; font-weight:700; margin-bottom:8px; }
.lw-empty-state p { color:#9ca3af; margin-bottom:20px; }
</style>
