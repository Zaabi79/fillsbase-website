{include file="orderforms/fillsbase/common.tpl"}

<div id="order-standard_cart">

    <div class="text-white mergecolor text-center">
        <h1 class="section-heading mergecolor">
            {if $totalResults > 1}
                {lang key='renewService.titlePlural'}
            {else}
                {lang key='renewService.titleSingular'}
            {/if}
            <button id="hideShowServiceRenewalButton" class="btn btn-sm btn-default service-renewals-quick-filter">
                <span class="to-hide">
                    {lang key='renewService.hideShowServices.hide'}
                </span>
                <span class="to-show">
                    {lang key='renewService.hideShowServices.show'}
                </span>
            </button>
            {if $totalResults > 5}
                <input style="background-color: #101920!important;" id="serviceRenewalFilter" type="search" class="service-renewals-filter form-control mt-5" placeholder="{lang key='renewService.searchPlaceholder'}">
            {/if}
        </h1>
    </div>

    <div class="header-lined">
        <div class="text-center">
            <h2 class="section-heading mergecolor">
                {if $productGroup.headline}
                {$productGroup.headline}
                {else}
                {$productGroup.name}
                {/if}
            </h2>
            {if $productGroup.tagline}
                <p class="section-subheading mergecolor">{$productGroup.tagline}</p>
            {/if}
        </div>
        <div class="dropnav-header-lined">
            <button id="dropside-content" type="button" class="drop-down-btn dropside-content" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="ico-more-vertical d-block f-20"></span>
            </button>
            <div class="dropdown-menu bg-seccolorstyle" aria-labelledby="dropside-content">
                {include file="orderforms/fillsbase/sidebar-categories.tpl"}
            </div>
        </div>
    </div>


        

    {include file="orderforms/fillsbase/sidebar-categories-collapsed.tpl"}

    {if $totalServiceCount == 0}
        <div id="no-services" class="alert alert-warning text-center" role="alert">
            {lang key='renewService.noServices'}
        </div>
        <p class="text-center">
            <a href="" class="btn btn-default">
                <i class="fas fa-arrow-circle-left"></i>
                {lang key='orderForm.returnToClientArea'}
            </a>
        </p>
    {else}
        <div class="row bg-seccolorstyle bg-white br-12 p-50 mt-5 noshadow">
            <div class="secondary-cart-body text-white mergecolor">
                {if $totalResults < $totalServiceCount}
                    <div class="text-center">
                        {lang key='renewService.showingServices' showing=$totalResults totalCount=$totalServiceCount}
                        <a id="linkShowAll" href="{routePath('service-renewals')}">
                            {lang key='domainRenewal.showAll'}
                        </a>
                    </div>
                {/if}
                <div id="serviceRenewals" class="service-renewals">
                    {include file="orderforms/standard_cart/service-renewal-item.tpl" renewableItems=$renewableServices prefix=''}
                </div>
            </div>
            <div class="secondary-cart-sidebar" id="scrollingPanelContainer">
                <div id="orderSummary">
                    <div class="order-summary">
                        <div class="loader" id="orderSummaryLoader">
                            <i class="fas fa-fw fa-sync fa-spin"></i>
                        </div>
                        <h2 class="font-size-30">
                            {lang key='ordersummary'}
                        </h2>
                        <div class="summary-container" id="producttotal"></div>
                    </div>
                    <a id="btnGoToCart" class="btn btn-primary btn-lg" href="{$WEB_ROOT}/cart.php?a=view">
                        {lang key='viewcart'}
                        <i class="far fa-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </div>
    {/if}

    <form id="removeRenewalForm" method="post" action="{$WEB_ROOT}/cart.php" data-renew-type="service">
        <input type="hidden" name="a" value="remove">
        <input type="hidden" name="r" value="" id="inputRemoveItemType">
        <input type="hidden" name="i" value="" id="inputRemoveItemRef">
        <input type="hidden" name="rt" value="service" id="inputRemoveItemRenewalType">
        <div class="modal fade modal-remove-item" id="modalRemoveItem" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-block">
                        <h4 class="modal-title">
                            <button type="button" class="close" data-dismiss="modal" aria-label="{lang key='orderForm.close'}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="fas fa-times fa-3x"></i>
                            <span>{lang key='orderForm.removeItem'}</span>
                        </h4>
                    </div>
                    <div class="modal-body">
                        {lang key='cartremoveitemconfirm'}
                    </div>
                    <div class="modal-footer d-block">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{lang key='no'}</button>
                        <button type="submit" class="btn btn-primary">{lang key='yes'}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>recalculateRenewalTotals();</script>
