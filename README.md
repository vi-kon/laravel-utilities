Laravel 4 Utilities
=================

Utilities for Laravel 4

# Views

| Name                  | Description                           |
|-----------------------|---------------------------------------|
| **html5-layout**      | HTML 5 layout                         |

## html5-layout

There are two templates. One for **Blade** template engine and one for **Smarty** template engine.

**Note:** html5-layout.tpl requires Smarty functions implemented in **vi-kon/laravel-smarty-view** package.

### Avalaible blocks / sections:

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

Block / section definitions:

#### author

```blade
<!-- ... other head stuff ... -->
<meta name="author" content="@yield('author', 'Kovács Vince')"/>
<!-- ... other head stuff ... -->
```

```smarty
<!-- ... other head stuff ... -->
<meta name="author" content="{block name="author"}Kovács Vince{/block}">
<!-- ... other head stuff ... -->
```

#### body

```blade
<body>
    @yield('body')
</body>
```

```smarty
<body>
    {block name="body"}{/block}
</body>
```

#### description

```blade
<!-- ... other head stuff ... -->
<meta name="description" content="@yield('description')"/>
<!-- ... other head stuff ... -->
```

or

```smarty
<!-- ... other head stuff ... -->
<meta name="description" content="{block name="description"}{/block}">
<!-- ... other head stuff ... -->
```

#### head

```blade
<head>
    <!-- ... other head stuff ... -->
    @yield('head')
</head>
```

or

```smarty
<head>
    <!-- ... other head stuff ... -->
    {block name="head"}{/block}
</head>
```

#### scripts

```blade
        <!-- ... body inner ... -->
    </body>
    @yield('scripts')
</html>
```

or

```smarty
        <!-- ... body inner ... -->
    </body>
    {block name="scripts"}{/block}
</html>
```

#### scripts-head

```blade
<head>
    <!-- ... other head stuff ... -->
    @yield('scripts-head')
    <!-- ... other head stuff ... -->
</head>
```

or

```smarty
<head>
    <!-- ... other head stuff ... -->
    {block name="scripts-head"}{/block}
    <!-- ... other head stuff ... -->
</head>
```

#### styles

```blade
<head>
    <!-- ... other head stuff ... -->
    @yield('styles')
    <!-- ... other head stuff ... -->
</head>
```

or

```smarty
<head>
    <!-- ... other head stuff ... -->
    {block name="styles"}{/block}
    <!-- ... other head stuff ... -->
</head>
```

#### title

```blade
<!-- ... other head stuff ... -->
<title>@yield('title', 'HTML 5 Layout')</title>
<!-- ... other head stuff ... -->
```

or

```smarty
<!-- ... other head stuff ... -->
<title>{block name="title"}HTML 5 Layout{/block}</title>
<!-- ... other head stuff ... -->
```

#### viewport

```blade
<head>
    <!-- ... other header stuff ... -->
    @section('viewport')
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    @show
    <!-- ... other header stuff ... -->
</head>
```

or

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