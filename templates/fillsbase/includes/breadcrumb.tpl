<nav aria-label="breadcrumb" style="margin-bottom:0;">
    <ol class="breadcrumb lw-breadcrumb">
        {foreach $breadcrumb as $item}
            <li class="breadcrumb-item{if $item@last} active{/if}">
                {if !$item@last}
                    <a href="{$item.link}">{$item.label}</a>
                {else}
                    {$item.label}
                {/if}
            </li>
        {/foreach}
    </ol>
</nav>
<style>
.lw-breadcrumb {
    background: transparent;
    padding: 8px 0;
    margin: 0;
    font-size: 13px;
}
.lw-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
    content: "/";
    color: #9ca3af;
    padding: 0 6px;
}
.lw-breadcrumb .breadcrumb-item a {
    color: #50d29e;
    text-decoration: none;
}
.lw-breadcrumb .breadcrumb-item a:hover { text-decoration: underline; }
.lw-breadcrumb .breadcrumb-item.active { color: #6b7280; }
</style>
