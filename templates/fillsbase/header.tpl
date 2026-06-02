<!DOCTYPE html>
<html lang="{$language}">
<head>
    <meta charset="{$charset}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <meta http-equiv="Content-Language" content="en">
    <link rel="icon" href="{$WEB_ROOT}/assets/img/favicon.ico">
    <title>{if $kbarticle.title}{$kbarticle.title} - {/if}{$pagetitle} - {$companyname}</title>
    {include file="$template/includes/head.tpl"} 
    {$headoutput}
    {assign var="assetLogoPath" value="{$WEB_ROOT}/fillsbase.png?v=1.0"}
</head>

<body data-layout="wideboxed" data-background="origin" data-color="green" data-header="" data-textDirection="ltr" data-radius="sixradius">

    <div class="box-container limit-width">
        <header id="header">
           {include file="$template/includes/header_sync.tpl"}
        </header>

        <div class="wrapper sec-normal bg-colorstyle">
            <div class="container">
                {$headeroutput}
                {if $loggedin && ($templatefile|substr:0:10 == 'clientarea' || $templatefile == 'supporttickets' || $templatefile == 'viewticket' || $templatefile == 'submitticket')}
                {* Sidebar layout only on client area and support pages *}
                {if $templatefile != "clientareahome"}
                {include file="$template/includes/breadcrumb.tpl"}
                {/if}
                <div class="row ca-layout" style="margin-top:24px;">
                    <div class="col-md-3 col-lg-3 ca-sidebar-col">
                        {include file="$template/includes/sidebar.tpl"}
                    </div>
                    <div class="col-md-9 col-lg-9 ca-content-col">
                {else}
                <div class="row">
                    <div class="col-md-12">
                {/if}
