{strip}
    <!DOCTYPE html>
    {* @formatter:off *}
    <!--[if lt IE 7]>
    <html class="lt-ie9 lt-ie8 lt-ie7" lang="{config key=" app.locale"}"> <![endif]-->
    <!--[if IE 7]>
    <html class="lt-ie9 lt-ie8" lang="{config key=" app.locale"}"> <![endif]-->
    <!--[if IE 8]>
    <html class="lt-ie9" lang="{config key=" app.locale"}"> <![endif]-->
    <!--[if gt IE 8]><!-->
    {* @formatter:on *}
    <html lang="{config key="app.locale"}"><!--<![endif]-->
    <head>
        <meta charset="utf-8">

        {block name="viewport"}
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        {/block}

        <meta name="author" content="Kovács Vince">
        <meta name="description" content="">

        <title>{block name="title"}HTML 5 Layout{/block}</title>

        {block name="styles"}{/block}

        {block name="scripts-head"}{/block}

        {block name="head"}{/block}

    </head>
    <body>

    {block name="body"}{/block}

    </body>

    {block name="scripts"}{/block}

    </html>
{/strip}