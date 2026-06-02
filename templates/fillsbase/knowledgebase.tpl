</div></div>{* close container/wrapper opened by header.tpl *}

<!-- HERO -->
<div class="kb-hero-bar">
    <div class="container">
        <h1 class="kb-hero-title">Base de connaissances</h1>
        <p class="kb-hero-sub">Trouvez des réponses, guides et tutoriels pour tous nos services.</p>
        <form role="form" method="post" action="{routePath('knowledgebase-search')}" class="kb-search-form">
            <input type="text" name="search" id="inputKnowledgebaseSearch"
                   placeholder="Rechercher un article..."
                   value="{if $searchterm}{$searchterm}{/if}" />
            <button type="submit"><i class="fas fa-search"></i> Rechercher</button>
        </form>
    </div>
</div>

<!-- MAIN -->
<div class="wrapper sec-normal bg-colorstyle">
<div class="container">
<div class="kb-wrap">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3">
            <div class="kb-sidebar">
                <h5 class="kb-sidebar-title"><i class="fas fa-folder-open"></i> {$LANG.knowledgebasecategories}</h5>
                {if $kbcats}
                    <a href="{routePath('knowledgebase-home')}" class="kb-cat-link">
                        <span><i class="fas fa-th-large"></i> Toutes les catégories</span>
                    </a>
                    {foreach from=$kbcats item=kbcat}
                    <a href="{routePath('knowledgebase-category-view', {$kbcat.id}, {$kbcat.urlfriendlyname})}" class="kb-cat-link">
                        <span><i class="far fa-folder"></i> {$kbcat.name}</span>
                        <span class="kb-badge">{$kbcat.numarticles}</span>
                    </a>
                    {/foreach}
                {else}
                    <p class="kb-no-cats">{$LANG.knowledgebasenoarticles}</p>
                {/if}

                <hr class="kb-divider">
                <h5 class="kb-sidebar-title"><i class="fas fa-link"></i> Liens rapides</h5>
                <a href="{$WEB_ROOT}/contact" class="kb-cat-link"><i class="fas fa-headset"></i> Ouvrir un ticket</a>
                <a href="{$WEB_ROOT}/supporttickets.php" class="kb-cat-link"><i class="fas fa-ticket-alt"></i> Mes tickets</a>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="col-md-9">

            {* ── Articles by category (home view) ── *}
            {if $kbcats && !$searchterm}
            <div class="kb-card">
                <div class="kb-card-title">
                    <i class="fas fa-book-open" style="color:#50d29e;"></i>
                    Tous les articles
                    {if $kbarticles}<span class="kb-count">{$kbarticles|@count} articles</span>{/if}
                </div>

                {foreach from=$kbcats item=kbcat}
                {if $kbcat.articles}
                <div class="kb-cat-group">
                    <div class="kb-cat-head">
                        <i class="far fa-folder" style="color:#50d29e;"></i>
                        <a href="{routePath('knowledgebase-category-view', {$kbcat.id}, {$kbcat.urlfriendlyname})}">{$kbcat.name}</a>
                        <span class="kb-cat-count">{$kbcat.numarticles} article(s)</span>
                    </div>
                    {foreach from=$kbcat.articles item=art name=arts}
                    {if $arts@iteration <= 4}
                    <div class="kb-article-item">
                        <a class="kb-art-title" href="{routePath('knowledgebase-article-view', {$art.id}, {$art.urlfriendlyname})}">
                            <i class="far fa-file-alt"></i> {$art.title}
                        </a>
                        {if $art.article}
                        <p class="kb-art-excerpt">{$art.article|strip_tags|truncate:160:"..."}</p>
                        {/if}
                        <div class="kb-art-meta"><i class="far fa-calendar-alt"></i> {$art.date}</div>
                    </div>
                    {/if}
                    {/foreach}
                    {if $kbcat.numarticles > 4}
                    <a href="{routePath('knowledgebase-category-view', {$kbcat.id}, {$kbcat.urlfriendlyname})}" class="kb-more-link">
                        Voir tous les {$kbcat.numarticles} articles <i class="fas fa-arrow-right"></i>
                    </a>
                    {/if}
                </div>
                {/if}
                {/foreach}

                {* fallback: flat kbarticles list if kbcat.articles not populated *}
                {if $kbarticles}
                {foreach from=$kbarticles item=kbarticle}
                <div class="kb-article-item">
                    <a class="kb-art-title" href="{routePath('knowledgebase-article-view', {$kbarticle.id}, {$kbarticle.urlfriendlyname})}">
                        <i class="far fa-file-alt"></i> {$kbarticle.title}
                    </a>
                    {if $kbarticle.article}
                    <p class="kb-art-excerpt">{$kbarticle.article|strip_tags|truncate:160:"..."}</p>
                    {/if}
                    <div class="kb-art-meta"><i class="far fa-calendar-alt"></i> {$kbarticle.date}</div>
                </div>
                {/foreach}
                {/if}
            </div>
            {/if}

            {* ── Most popular ── *}
            {if $kbmostviews}
            <div class="kb-card">
                <div class="kb-card-title">
                    <i class="fas fa-fire" style="color:#f59e0b;"></i>
                    {$LANG.knowledgebasepopular}
                    <span class="kb-count">{$kbmostviews|@count}</span>
                </div>
                {foreach from=$kbmostviews item=kbarticle}
                <div class="kb-article-item">
                    <a class="kb-art-title" href="{routePath('knowledgebase-article-view', {$kbarticle.id}, {$kbarticle.urlfriendlyname})}">
                        <i class="far fa-file-alt"></i> {$kbarticle.title}
                    </a>
                    {if $kbarticle.article}
                    <p class="kb-art-excerpt">{$kbarticle.article|strip_tags|truncate:160:"..."}</p>
                    {/if}
                    <div class="kb-art-meta">
                        <i class="far fa-calendar-alt"></i> {$kbarticle.date}
                        {if $kbarticle.views}&nbsp;·&nbsp;<i class="fas fa-eye"></i> {$kbarticle.views} vues{/if}
                    </div>
                </div>
                {/foreach}
            </div>
            {/if}

            {* ── Newest articles ── *}
            {if $kbnewest}
            <div class="kb-card">
                <div class="kb-card-title">
                    <i class="fas fa-clock" style="color:#3b82f6;"></i>
                    {$LANG.knowledgebasenewest}
                    <span class="kb-count">{$kbnewest|@count}</span>
                </div>
                {foreach from=$kbnewest item=kbarticle}
                <div class="kb-article-item">
                    <a class="kb-art-title" href="{routePath('knowledgebase-article-view', {$kbarticle.id}, {$kbarticle.urlfriendlyname})}">
                        <i class="far fa-file-alt"></i> {$kbarticle.title}
                    </a>
                    {if $kbarticle.article}
                    <p class="kb-art-excerpt">{$kbarticle.article|strip_tags|truncate:160:"..."}</p>
                    {/if}
                    <div class="kb-art-meta"><i class="far fa-calendar-alt"></i> {$kbarticle.date}</div>
                </div>
                {/foreach}
            </div>
            {/if}

            {* ── Search results ── *}
            {if $searchterm}
            <div class="kb-card">
                <div class="kb-card-title">
                    <i class="fas fa-search" style="color:#6366f1;"></i>
                    Résultats pour "<strong>{$searchterm}</strong>"
                </div>
                {if $kbarticles}
                {foreach from=$kbarticles item=kbarticle}
                <div class="kb-article-item">
                    <a class="kb-art-title" href="{routePath('knowledgebase-article-view', {$kbarticle.id}, {$kbarticle.urlfriendlyname})}">
                        <i class="far fa-file-alt"></i> {$kbarticle.title}
                    </a>
                    {if $kbarticle.article}
                    <p class="kb-art-excerpt">{$kbarticle.article|strip_tags|truncate:160:"..."}</p>
                    {/if}
                    <div class="kb-art-meta"><i class="far fa-calendar-alt"></i> {$kbarticle.date}</div>
                </div>
                {/foreach}
                {else}
                <div class="kb-empty">
                    <i class="fas fa-search"></i>
                    <p>Aucun article trouvé pour "<strong>{$searchterm}</strong>".</p>
                </div>
                {/if}
            </div>
            {/if}

            {* ── Empty state ── *}
            {if !$kbcats && !$kbmostviews && !$kbnewest && !$searchterm}
            <div class="kb-card">
                <div class="kb-empty">
                    <i class="fas fa-book"></i>
                    <p>{$LANG.knowledgebasenoarticles}<br>
                    <a href="{$WEB_ROOT}/contact" style="color:#50d29e;">Contactez notre support</a> si vous avez des questions.</p>
                </div>
            </div>
            {/if}

        </div><!-- /.col-md-9 -->
    </div><!-- /.row -->
</div><!-- /.kb-wrap -->

<style>
.kb-hero-bar {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
    padding: 56px 0 46px;
    margin-bottom: 0;
}
.kb-hero-title { color: #fff; font-size: 30px; font-weight: 800; margin-bottom: 8px; }
.kb-hero-sub   { color: #94a3b8; font-size: 14px; margin-bottom: 22px; }
.kb-search-form { display: flex; gap: 10px; max-width: 520px; }
.kb-search-form input {
    flex: 1; padding: 11px 16px; border-radius: 10px; border: none;
    font-size: 14px; outline: none; color: #0f172a;
}
.kb-search-form button {
    padding: 11px 22px; border-radius: 10px; background: #50d29e;
    color: #fff; border: none; font-weight: 700; cursor: pointer;
    white-space: nowrap; transition: background .15s;
}
.kb-search-form button:hover { background: #3dbf8b; }

.kb-wrap { padding: 40px 0 80px; }

/* Sidebar */
.kb-sidebar {
    background: #fff; border: 1px solid #e5e9f0; border-radius: 14px;
    padding: 20px; box-shadow: 0 1px 4px rgba(15,23,42,.06);
    position: sticky; top: 20px;
}
.kb-sidebar-title {
    font-size: 13px; font-weight: 700; color: #0f172a;
    margin-bottom: 14px; display: flex; align-items: center; gap: 8px;
}
.kb-sidebar-title i { color: #50d29e; }
.kb-cat-link {
    display: flex; align-items: center; justify-content: space-between;
    padding: 8px 10px; border-radius: 8px; color: #374151;
    text-decoration: none; font-size: 13px; margin-bottom: 3px;
    transition: background .12s; gap: 8px;
}
.kb-cat-link span:first-child, .kb-cat-link > i { display: flex; align-items: center; gap: 7px; flex: 1; }
.kb-cat-link i { font-size: 11px; color: #9ca3af; flex-shrink: 0; }
.kb-cat-link:hover { background: #f0fdf4; color: #059669; text-decoration: none; }
.kb-badge {
    background: #f3f4f6; color: #6b7280; font-size: 11px;
    font-weight: 700; padding: 2px 7px; border-radius: 20px; flex-shrink: 0;
}
.kb-divider { border-color: #f3f4f6; margin: 14px 0; }
.kb-no-cats { font-size: 13px; color: #9ca3af; }

/* Cards */
.kb-card {
    background: #fff; border: 1px solid #e5e9f0; border-radius: 14px;
    padding: 22px; margin-bottom: 18px;
    box-shadow: 0 1px 4px rgba(15,23,42,.06);
}
.kb-card-title {
    font-size: 14px; font-weight: 700; color: #0f172a;
    margin-bottom: 18px; display: flex; align-items: center; gap: 9px;
}
.kb-count {
    background: #f0fdf4; color: #059669; font-size: 11px;
    font-weight: 700; padding: 2px 8px; border-radius: 20px;
}

/* Category group */
.kb-cat-group { margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #f3f4f6; }
.kb-cat-group:last-child { margin-bottom: 0; border-bottom: none; padding-bottom: 0; }
.kb-cat-head {
    font-size: 13px; font-weight: 700; color: #0f172a;
    margin-bottom: 10px; display: flex; align-items: center; gap: 8px;
}
.kb-cat-head a { color: #0f172a; text-decoration: none; }
.kb-cat-head a:hover { color: #059669; }
.kb-cat-count { font-size: 11px; color: #9ca3af; font-weight: 500; }
.kb-more-link {
    font-size: 12px; color: #50d29e; text-decoration: none;
    display: inline-flex; align-items: center; gap: 5px; margin-top: 8px;
    font-weight: 600;
}
.kb-more-link:hover { text-decoration: underline; color: #3dbf8b; }

/* Article item */
.kb-article-item {
    padding: 11px 0; border-bottom: 1px solid #f3f4f6;
}
.kb-article-item:last-child { border-bottom: none; padding-bottom: 0; }
.kb-art-title {
    font-size: 13px; font-weight: 600; color: #1d4ed8;
    text-decoration: none; display: flex; align-items: flex-start; gap: 8px;
    margin-bottom: 4px;
}
.kb-art-title i { color: #9ca3af; flex-shrink: 0; margin-top: 2px; }
.kb-art-title:hover { color: #1e40af; text-decoration: underline; }
.kb-art-excerpt { font-size: 12px; color: #6b7280; margin: 0 0 4px 20px; line-height: 1.5; }
.kb-art-meta { font-size: 11px; color: #9ca3af; margin-left: 20px; }
.kb-art-meta i { margin-right: 4px; }

/* Empty state */
.kb-empty { text-align: center; padding: 40px 20px; color: #9ca3af; }
.kb-empty i { font-size: 40px; color: #d1d5db; display: block; margin-bottom: 14px; }
.kb-empty p { font-size: 14px; }
</style>
