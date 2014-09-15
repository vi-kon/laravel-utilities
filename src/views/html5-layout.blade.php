<!DOCTYPE html>
{{-- @formatter:off --}}
<!--[if lt IE 7]>
<html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
{{-- @formatter:on --}}
<html lang="en"><!--<![endif]-->
<head>
    <meta charset="utf-8">

    @section('viewport')
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    @show

    <meta name="author" content="@yield('author', 'Kovács Vince')"/>
    <meta name="description" content="@yield('description')"/>

    <title>@yield('title', 'HTML 5 Layout')</title>

    @yield('styles')

    @yield('scripts-head')

    @yield('head')

</head>
<body>


@yield('body')

</body>

@yield('scripts')

</html>