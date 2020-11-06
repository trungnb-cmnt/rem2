<header id="header">
    <div class="container-fluid">
        <div class="container h-100">
            <div class="row d-flex align-items-center h-100">
                <div class="col-12">
                    <nav class="navbar navbar-collapse bg-white navbar-light px-0">
                        <div class="d-flex align-items-center">
                            @if (!theme_option('logo'))
                                {{ theme_option('site_title') }}
                            @else
                                @if (Request::url() == url('/'))
                                    <h1 class="mb-0">
                                        @endif
                                        <a href="{{ url('/') }}">
                                            <img class="mr-4 mr-lg-5" src="{{ url(theme_option('logo')) }}" alt="{{ theme_option('site_title') }}" height="50">
                                        </a>
                                        @if (Request::url() == url('/'))
                                    </h1>
                                @endif
                            @endif
                            <div class="d-none d-lg-block text-left">
                                <h2 class="title mb-0">Công ty cổ phần TTP Phú Yên</h2>
                            </div>
                        </div>

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid navbar-container position-absolute">
        <div class="container">
            <div class="collapse navbar-collapse py-4 py-lg-5" id="collapsibleNavbar">
                {!!
                    Menu::renderMenuLocation('main-menu', [
                        'options' => ['class' => 'row mr-auto'],
                        'view' => 'menus.main',
                    ])
                !!}
            </div>
        </div>
    </div>
</header>
