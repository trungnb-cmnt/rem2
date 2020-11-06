<footer class="d-flex align-items-center justify-content-center p-3 py-lg-4">
    <div class="copyright">
        <span>{{ theme_option('copyright') }}</span>
    </div>
</footer>

<script type="text/javascript" src="{{ asset('/themes/' . Theme::getThemeName() . '/js/app.js') }}"></script>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
