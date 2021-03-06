# Laravel 5 Utilities

Utilities for **Laravel 5**. View helpers and other usefull classes.

## Table of contents

* [Known issues](#known-issues)
* [Todo](#todo)
* [Changes](#changes)
* [Installation](#installation)
* [Views](#views)
* [Classes](#classes)
* [Traits](#traits)
* [Middleware](#middleware)
* [Helpers](#helpers)

## Known issues

None

---
[Back to top][top]

## Todo

* Fix incoming bugs
* Finish documentation

---
[Back to top][top]

## Changes

Version 2.1

- The **Seeder** class functionality replaced by **ConsoleProgressbar** trait

Version 2.0

- **Laravel 5** support (requirement)
- **Controller** class removed (Laravel 5 supports validation via **FormRequest** classes)
- New middleware features (**IsAjax**)
- Code optimization with Laravel 5 new features and conventions

---
[Back to top][top]

## Installation

### Base

To your `composer.json` file add following lines:

```javascript
// to your "require" object
"vi-kon/laravel-utilities": "2.*"
```
In your Laravel 5 project add following lines to `app.php`:
```php
// to your providers array
'ViKon\Utilities\UtilitiesServiceProvider',
```

## Middleware

To use middleware class assigned to route need to assign short-hand key to `middleware` property of your `app/Providers/RouteServiceProvider` class:
```php
// to your middleware array
'ajax' => 'ViKon\Utilities\Middleware\IsAjax',
```

---
[Back to top][top]

## Views

* [html5-layout](#html5-layout) - HTML 5 layout

---
[Back to top][top]

### html5-layout

There are two templates. One for **Blade** template engine and one for **Smarty** template engine.

**Note:** html5-layout.tpl requires Smarty functions implemented in **vi-kon/laravel-smarty-view** package.

#### Avalaible blocks / sections:

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

##### author

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

##### body

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

##### description

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

##### head

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

##### scripts

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

##### scripts-head

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

##### styles

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

##### title

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

##### viewport

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

---
[Back to top][top]

#### Usage

##### Example "app-layout.tpl"

```smarty
{extends file="view:utilities::html5-layout"}


{block name="title"}{strip}
    {lang}app.title{/lang}
{/strip}{/block}


{block name="description"}{strip}
    {lang}app.description{/lang}
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
                    <h1>{lang}app.header.title{/lang}</h1>
                    <p class="lead text-muted">{lang}app.header.title-lead{/lang}</p>
                </div>

                {if $user !== null}
                    <div class="col-sm-4 text-right">
                        {$user['username']}
                        &nbsp;|&nbsp;
                        <a href="{url _name="user.ajax.modal.edit"}" type="button"
                           rel="tooltip" data-toggle="modal" data-target="#modal">
                            {lang}app.header.btn.settings{/lang}
                        </a>
                        &nbsp;|&nbsp;
                        <a href="{url _name="auth.logout"}">{lang}app.header.btn.logout{/lang}</a>
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

---
[Back to top][top]

## Classes

* [Migration](#migrationclass) - helper methods for **database migration**

---
[Back to top][top]

## Traits

* [ConsoleProgressbar](#consoleprogressbartrait) - progressbar for console applications

### ConsoleProgress trait

This trait help display a progressbar on console:

**Output**

```bash
############--------------------------------------  24.54% (124,752/508,331)
```

**Usage**

```php
// Initialize progressbar
$this->initProgressbar();
// Reset progress and output a message
$this->startProgress('Seed agt_agent_types table');
// Set progressbar elements
$this->setProgressMax(12);

// ...

// Make step in progressbar
$this->progress();
```

---
[Back to top][top]

## Middleware

Utilities middleware classes allow different features.

* [IsAjax](#isajax-middleware) - check if current request is ajax request or not

---
[Back to top][top]

### IsAjax middleware

Check if current request is ajax request or not. If request is not ajax request, then throws `NotFoundHttpException` exception.

#### Usage

```php
$options = [
    'middleware' => 'ajax',
];
Route::get('URL', $options);
```

---
[Back to top][top]

## Helpers

Helper functions are shortcuts or aliases for app functions and methods.

* [json_response](#json_response-function)
* [view_response](#view_response-function)

### json_response function

`json_response` function is alias for `new JsonResponse`.

---
[Back to top][top]

## License

This package is licensed under the MIT License


[top]: #laravel-5-parser-and-lexer