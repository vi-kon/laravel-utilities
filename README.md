Laravel Utilities
=================

Utilities for Laravel 4

# Views

| Name                  | Description                           |
|-----------------------|---------------------------------------|
| **html5-layout.tpl**  | Smarty base template for HTML 5 pages |

## html5-layout.tpl

**Note:** This layout requires Smarty functions implemented in **vi-kon/laravel-smarty-view** package.

### Avalaible blocks:

| Name                  | Description                           |
|-----------------------|---------------------------------------|
| **author**            | Author metadata                       |
| **body**              | Empty block in body root              |
| **description**       | Description metadata                  |
| **head**              | Empty block for other head stuff      |
| **scripts**           | Scripts at after closing body tag     |
| **scripts-head**      | Empty block to include header scripts |
| **styles**            | Empty block to include stylesheets    |
| **title**             | Page title                            |
| **viewport**          | Viewport meta data                    |

#### author

```smarty
<!-- ... other head stuff ... -->
<meta name="author" content="{block name="author"}Kovács Vince{/block}">
<!-- ... other head stuff ... -->
```

#### body

```smarty
<body>
    {block name="body"}{/block}
</body>
```

#### description

```smarty
<!-- ... other head stuff ... -->
<meta name="description" content="{block name="description"}{/block}">
<!-- ... other head stuff ... -->
```

#### head

```smarty
<head>
    <!-- ... other head stuff ... -->
    {block name="head"}{/block}
</head>
```

#### scripts

```smarty
        <!-- ... body inner ... -->
    </body>
    {block name="scripts"}{/block}
</html>
```

#### scripts-head

```smarty
<head>
    <!-- ... other head stuff ... -->
    {block name="scripts-head"}{/block}
    <!-- ... other head stuff ... -->
</head>
```

#### styles

```smarty
<head>
    <!-- ... other head stuff ... -->
    {block name="styles"}{/block}
    <!-- ... other head stuff ... -->
</head>
```

#### title

```smarty
<!-- ... other head stuff ... -->
<title>{block name="title"}HTML 5 Layout{/block}</title>
<!-- ... other head stuff ... -->
```

#### viewport

```smarty
<head>
    <!-- ... other header stuff ... -->
    {block name="viewport"}
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    {/block}
    <!-- ... other header stuff ... -->
</head>
```

### Usage

#### Example "site-layout.tpl"

```smarty
{extends file="view:utilities::html5-layout"}


{block name="title"}{strip}
    {lang}site.title{/lang}
{/strip}{/block}


{block name="description"}{strip}
    {lang}site.description{/lang}
{/strip}{/block}


{block name="styles"}{strip}
    {html_style _url="vendor/bootstrap/css/bootstrap.min.css"}
    {html_style _url="vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.css"}
{/strip}{/block}


{block name="scripts-head" append}{strip}
    {html_script _url="vendor/jquery/jquery-2.1.0.min.js"}
    {html_script _url="vendor/bootstrap/js/bootstrap.min.js"}
    {html_script _url="vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.js"}
{/strip}{/block}


{block name="scripts" append}{strip}
    {html_script _url="js/bootstrap-setup.js"}
{/strip}{/block}


{block name="body"}{strip}
    <div class="container">
        {* Page menu *}
        <div class="page-header">
            <div class="row">
                <div class="col-sm-8">
                    <h1>{lang}site.header.title{/lang}</h1>
                    <p class="lead text-muted">{lang}site.header.title-lead{/lang}</p>
                </div>

                {if $user !== null}
                    <div class="col-sm-4 text-right">
                        {$user['username']}
                        &nbsp;|&nbsp;
                        <a href="{url _name="user.ajax.modal.edit"}" type="button"
                           rel="tooltip" data-toggle="modal" data-target="#modal">
                            {lang}site.header.btn.settings{/lang}
                        </a>
                        &nbsp;|&nbsp;
                        <a href="{url _name="auth.logout"}">{lang}site.header.btn.logout{/lang}</a>
                    </div>
                {/if}
            </div>
        </div>
    </div>
    <div class="container">
        {* Block container for subpage content *}
        {block name="container"}{/block}	
    </div>
{/strip}{/block}
```

# Classes

| Name                            | Description                               |
|---------------------------------|-------------------------------------------|
| **ViKon\Utilities\Controller**  | Helper methods for **Controller**         |
| **ViKon\Utilities\Migration**   | Helper methods for **database migration** |
| **ViKon\Utilities\Seeder**      | Helper methods for **database seeder**    |

## Controller

Helper methods for controller classes. Extends base `\Controller` class.

### Methods

| Type                         | Name           | Description                                           |
| ---------------------------- | -------------- | ----------------------------------------------------- |
| `RedirectResponse` or `null` | `validate`     | Validate input data via validation rules              |
| `JsonResponse` or `null`     | `validateAjax` | Validate ajax request input data via validation rules |

#### validate

Validate input data via validation rules.

```php
validate(array $rules, array $input = null)
```

| Type                | Name     | Description                                            |
| ------------------- | -------- | ------------------------------------------------------ |
| `string[]`          | `$rules` | validator rules                                        |
| `mixed[]` or `null` | `$input` | input data, if null `Input::all()` result will be used |

#### validateAjax

```php
validateAjax(array $rules, \Closure $view, array $input = null, $data = array())
```

| Type                | Name     | Description                                                                  |
| ------------------- | -------- | ---------------------------------------------------------------------------- |
| `string[]`          | `$rules` | validator rules                                                              |
| `\Closure`          | `$view`  | view renderer callback in case of validation failure (have to return `View`) |
| `mixed[]` or `null` | `$input` | input data, if null `Input::all()` result will be used                       |
| `mixed[]`           | `$data`  | additional data for response                                                 |

Return array in JSON format. Returns array with merged `$data` parameter:

```php
array(
  'success' => true,
);

// or

array(
  'success' => false,
  'content' => $view(),
);
```

## License

This package is licensed under the MIT License