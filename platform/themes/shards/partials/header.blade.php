<header class="header" id="header">
    <div class="d-none d-lg-block">
        <div class="header-top">
            <div class="container">
                <div class="row d-flex align-items-center justify-content-between py-4">
                    <div class="d-flex align-items-center">
                        <i class="icon-phone icon-border"></i>
                        <a class="pl-4" href="tel:1900 1009">
                            <p class="mb-1">Hotline</p>
                            <strong>1900 1009</strong>
                        </a>
                    </div>
                    <div>
                        <img src="{{ Theme::asset()->url('images/logo.png') }}">
                    </div>
                    <div>
                        <ul class="contact">
                            <li>
                                <i class="icon-email font-20"></i>
                                <span>Email: minhphuong@gmail.com</span>
                            </li>
                            <li>
                                <i class="icon-phone font-20"></i>
                                <span>CSKH: 036661287</span>
                            </li>
                            <li>
                                <i class="fas fa-cube font-19"></i>
                                <span><i class="fab fa-facebook-square"></i></span>
                                <span><i class="fab fa-youtube"></i></span>
                                <span><i class="fab fa-google-plus-square"></i></span>
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
                                class="icon-phone font-20 pr-2"></i>Hotline: 1900 1009
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
                            <img src="{{ Theme::asset()->url('images/m-logo.png') }}" alt="Logo" />
                        </div>
                        <nav class="navbar navbar-expand-lg navbar-light mb-0 position-static">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#m-navbarSupportedContent" aria-controls="m-navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="m-navbarSupportedContent">
                                <ul class="navbar-nav d-flex align-items-start justify-content-center px-4">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Trang Chủ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Giới Thiệu</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Danh Mục
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="#">Rèm vải</a>
                                            <a class="dropdown-item" href="#">Rèm tâm cổ điển</a>
                                            <a class="dropdown-item" href="#">Rèm sáo gỗ</a>
                                            <a class="dropdown-item" href="#">Rèm sáo gỗ</a>
                                            <a class="dropdown-item" href="#">Rèm cầu vồng</a>
                                            <a class="dropdown-item" href="#">Rèm cửa sổ</a>
                                            <a class="dropdown-item" href="#">Rèm cửa sổ</a>
                                            <a class="dropdown-item" href="#">Rèm cửa sổ</a>
                                            <a class="dropdown-item" href="#">Rèm cửa sổ</a>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Dự Án</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Tư Vấn</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Liên Hệ</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>