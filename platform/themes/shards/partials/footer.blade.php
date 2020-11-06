<footer id="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-12 px-4">
                        <div class="row welcome pt-4 pb-5">
                            <div class="col-md-4 pt-2 pb-4 pb-md-0 d-flex align-items-center justify-content-center">
                                <img src="{{ Theme::asset()->url('images/logo_footer.png') }}" alt="Logo footer">
                            </div>
                            <div class="col-md-4 pt-2 pb-4 pb-md-0">
                                <p class="mb-0 footer-title cl-default">RÈM MINH PHƯƠNG</p>
                                <div class="pt-3">
                                    <p class="mb-3">Chúng tôi luôn tiên phong và luôn trung thực trong mọi hoạt động
                                        kinh
                                        doanh. Chúng tôi luôn nỗ lực để đạt đạt được mục tiêu : Được công nhận là một
                                        trong
                                        những tập đoàn lớn mạnh hàng đầu. </p>
                                </div>
                            </div>
                            <div class="col-md-4 pt-2 pb-4 pb-md-0">
                                <p class="mb-0 footer-title">LIÊN HỆ</p>
                                <div class="pt-3">
                                    <ul class="contact">
                                        <li>
                                            <i class="icon-phone font-20"></i>
                                            <span>Điện Thoại: 036661287</span>
                                        </li>
                                        <li>
                                            <i class="icon-email font-20"></i>
                                            <span>Email: minhphuong@gmail.com</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-cube font-19 pr-4"></i>
                                            <span class="pr-3"><i class="fab fa-facebook-square"></i></span>
                                            <span class="pr-3"><i class="fab fa-youtube"></i></span>
                                            <span class="pr-3"><i class="fab fa-google-plus-square"></i></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 py-4">
                                <div class="hr"></div>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-0 footer-title">ĐIỀU KHOẢN CHÍNH SÁCH</p>
                                <div class="pt-3">
                                    <ul>
                                        <li><span class="icon-next pr-2"></span><a href="">Chăm sóc khách hàng - Khiếu
                                                nại</a>
                                        </li>
                                        <li><span class="icon-next pr-2"></span><a href="">Chăm sóc khách hàng - Khiếu
                                                nại</a>
                                        </li>
                                        <li><span class="icon-next pr-2"></span><a href="">Chăm sóc khách hàng - Khiếu
                                                nại</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-0 footer-title">VỀ CHÚNG TÔI</p>
                                <div class="pt-3">
                                    <ul>
                                        <li><span class="icon-next pr-2"></span><a href="">Giới thiệu</a>
                                        </li>
                                        <li><span class="icon-next pr-2"></span><a href="">Sản phẩm</a>
                                        </li>
                                        <li><span class="icon-next pr-2"></span><a href="">Dự án</a>
                                        </li>
                                        <li><span class="icon-next pr-2"></span><a href="">Dịch vụ</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous"
                                    src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=858378181289123&autoLogAppEvents=1"
                                    nonce="i9ygNcSK"></script>
                                <div class="fb-page" data-href="https://www.facebook.com/facebook" data-width="380"
                                    data-hide-cover="false" data-show-facepile="false"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row copyright">
            <div class="container">
                <div class="row">
                    <div class="col-12  py-3">
                        <span>© Copyright 2019 Created by Minh Phương</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="{{ asset('/themes/' . Theme::getThemeName() . '/js/app.js?v=1.2') }}"></script>
<div id="fb-root"></div>
<script>
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>