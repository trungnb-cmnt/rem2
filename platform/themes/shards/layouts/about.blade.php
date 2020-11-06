<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="{{ config('app.locale') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (!empty($additional_meta['canonical']))
    <link rel="canonical" href="{{ $additional_meta['canonical'] }}" />
    @else
    <link rel="canonical" href="{{ url()->current() }}" />
    @endif
    <meta name="keywords" content="@yield('keywords')">
    @if (!empty($additional_meta['pagination']))
    {!! $additional_meta['pagination'] !!}
    @endif

    <!-- LD JSON -->
    @if (!empty($additional_meta['local_business']))
    {!! $additional_meta['local_business'] !!}
    @else
    {!! local_business() !!}
    @endif

    {!! Theme::header() !!}
    <style>
    <?php include(public_path() . '/themes/'. Theme::getThemeName() . '/css/app.css');
    ?>
    </style>
</head>

<body class="@if (Request::url() == url('/')) homepage @endif">
    <div id="loading">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    {!! Theme::partial('header') !!}

    {!! Theme::content() !!}

    {!! Theme::partial('footer') !!}

</body>

</html>