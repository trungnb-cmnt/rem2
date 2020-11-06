<footer data-background="{{ Theme::asset()->url('images/page-intro-01.png') }}" class="page-footer bg-dark pt-50 bg-parallax">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <aside class="widget widget--transparent widget__footer widget__about">
                    <div class="widget__content">
                        <header class="person-info">
                            <div class="person-info__thumbnail">
                                <a href="{{ url('/') }}">
                                    @if (!theme_option('logo'))
                                        {{ setting('site_title') }}
                                    @else
                                        <img src="{{ url(theme_option('logo')) }}" alt="{{ setting('site_title') }}">
                                    @endif
                                </a>
                            </div>
                        </header>
                    </div>
                </aside>
            </div>
            {!! dynamic_sidebar('footer_sidebar') !!}
        </div>
    </div>
    <div class="page-footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="page-copyright">
                        <p>{!! __(theme_option('copyright')) !!}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="page-footer__social">
                        <ul class="social social--simple">
                            <li><a href="{{ setting('facebook') }}" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ setting('twitter') }}" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{ setting('google_plus') }}" title="Google"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="back2top"><i class="fa fa-angle-up"></i></div>
</div>

<!-- JS Library-->
{!! Theme::footer() !!}

@if (session()->has('success_msg'))
    <script type="text/javascript">
        swal('{{ __('Success') }}', "{{ session('success_msg', '') }}", 'success');
    </script>
@endif

@if (session()->has('error_msg'))
    <script type="text/javascript">
        swal('{{ __('Success') }}', "{{ session('error_msg', '') }}", 'error');
    </script>
@endif


</body>
</html>
