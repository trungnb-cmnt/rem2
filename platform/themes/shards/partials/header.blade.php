<?php
$url = Request::url()
?>
<header class="header" id="header">
    <div class="d-none d-lg-block">
        <div class="header-top">
            <div class="container">
                <div class="row d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center">
                        <a href="tel:{{ theme_option('phone') }}"><i class="icon-phone icon-border"></i></a>
                        @if(theme_option('phone'))
                        <a class="pl-4" href="tel:{{ theme_option('phone') }}">
                            <p class="mb-0">Điện thoại: </p>
                            <strong><a href="tel:{{ theme_option('phone') }}">{{ theme_option('phone') }}</a></strong>
                        </a>
                        @endif
                    </div>
                    <div>
                        @if($url == url('/'))
                        <h1>
                            <a href="/">
                                <img src="{{ url(theme_option('logo')) }}" alt="Logo" class="logo" id="header-logo">
                            </a>
                        </h1>
                        @else
                        <a href="/">
                            <img src="{{ url(theme_option('logo')) }}" alt="Logo" class="logo" id="header-logo">
                        </a>
                        @endif
                    </div>
                    <div>
                        <ul class="contact">
                            @if (theme_option('email'))
                            <li>
                                <i class="icon-email font-20"></i>
                                <span>Email: {{ theme_option('email') }}</span>
                            </li>
                            @endif
                            @if(theme_option('cskh'))
                            <li>
                                <i class="icon-phone font-20"></i>
                                <span>CSKH: {{ theme_option('cskh') }}</span>
                            </li>
                            @endif
                            <li>
                                <i class="fas fa-cube font-19"></i>
                                @if(theme_option('facebook'))
                                <a href="{{ theme_option('facebook') }}" target="__bank"><span><i
                                            class="fab fa-facebook-square"></i></span></a>
                                @endif
                                @if(theme_option('zalo'))
                                <span><a href="{{ theme_option('zalo') }}"><img
                                            src="{{ Theme::asset()->url('images/zalo.png') }}" class="zalo-header"
                                            alt="Zalo"></a></span>
                                @endif
                                @if(theme_option('email'))
                                <a href="mailto:{{ theme_option('email') }}"><span><i
                                            class="fab fa-google-plus-square"></i></span><a>
                                        @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-menu">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-expand-lg navbar-light mb-0 w-100">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="collapse navbar-collapse" id="main-menu">
                                {!!
                                Menu::renderMenuLocation('main-menu', [
                                'theme' => true,
                                'view' => 'menus.main-menu',
                                ])
                                !!}
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="d-block d-lg-none">
        <div class="m-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-12 ">
                        <div class="py-2 font-weight-bold d-flex align-items-center justify-content-center"><i
                                class="icon-phone font-20 pr-2"></i>Hotline: <a
                                href="tel:{{ theme_option('cskh') }}">{{ theme_option('cskh') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-header-menu">
            <div class="container position-static">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-between position-static">
                        <div>
                            @if($url == url('/'))
                            <h1>
                                <a href="/">
                                    <img src="{{ url(theme_option('logo')) }}" alt="Logo" class="logo"
                                        id="mb-header-logo">
                                </a>
                            </h1>
                            @else
                            <a href="/">
                                <img src="{{ url(theme_option('logo')) }}" alt="Logo" class="logo" id="mb-header-logo">
                            </a>
                            @endif
                        </div>
                        <nav class="navbar navbar-expand-lg navbar-light mb-0 position-static">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#m-navbarSupportedContent" aria-controls="m-navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="m-navbarSupportedContent">
                                {!!
                                Menu::renderMenuLocation('main-menu', [
                                'theme' => true,
                                'view' => 'menus.main-menu',
                                ])
                                !!}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>