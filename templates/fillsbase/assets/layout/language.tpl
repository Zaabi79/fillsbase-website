<style>
.lang-drop {
    display: inline-block;
    position: relative;
}
.lang-drop .dropdown-menu {
    position: absolute !important;
    top: 100% !important;
    right: 0 !important;
    left: auto !important;
    min-width: 160px;
    padding: 10px 0;
    margin: 2px 0 0;
    background-color: #1a1a1a;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 4px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.175);
    z-index: 1000;
    display: none;
}
.lang-drop.show .dropdown-menu {
    display: block;
}
.lang-drop ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.lang-drop ul li a {
    display: block;
    padding: 8px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #fff !important;
    white-space: nowrap;
    text-decoration: none;
}
.lang-drop ul li a:hover {
    background-color: rgba(255,255,255,0.05);
}
.lang-drop img {
    vertical-align: middle;
    margin-right: 8px;
}
</style>
<div class="dropdown lang-drop">
	<a href="#" class="iconews" data-toggle="dropdown" >
		<img src="{$WEB_ROOT}/templates/{$template}/assets/img/flags/{$language}.svg" class="br-50 img-19 f-18" alt="{$activeLocale.localisedName}">
	</a>
	<div class="dropdown-menu dropdown-menu-right notification lang-container">
		<div class="notify-header">
			<h6>{$LANG.chooselanguage}</h6>
			<a class="bg-colorstyle">{$activeLocale.localisedName}</a>
		</div>
		<ul class="bg-colorstyle">
			{foreach $locales as $locale}
			<li><a href="{$currentpagelinkback}language={$locale.language}"><img src="{$WEB_ROOT}/templates/{$template}/assets/img/flags/{$locale.language}.svg" width="18" class="me-2"> {$locale.localisedName}</a></li>
			{/foreach}
		</ul>
	</div>
</div>
<script>
$(document).ready(function() {
    $(".lang-drop > a").on("click", function(e) {
        e.preventDefault();
        $(this).parent().toggleClass("show");
    });
    $(document).on("click", function(e) {
        if (!$(e.target).closest(".lang-drop").length) {
            $(".lang-drop").removeClass("show");
        }
    });
});
</script>