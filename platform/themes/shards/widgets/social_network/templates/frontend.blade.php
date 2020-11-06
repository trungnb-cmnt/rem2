<div class="col-md-4 pb-2 order-0 order-md-2">
    <?php if (!empty(theme_option('Facebook')) && !empty(theme_option('Google')) && !empty(theme_option('instagram')) && !empty(theme_option('twitter')) && !empty(theme_option('linkedin'))) : ?>
    <ul class="footerSocial d-flex">
        <?php if (!empty(__($config['facebook']))) : ?>
        <li class="px-2"><a href="{{ __($config['facebook']) }}" target="_bank"><i class="icon-facebook"></i></a>
        </li>
        <?php endif; ?>
        <?php if (!empty(__($config['telegram']))) : ?>
        <li class="px-2"><a href="{{ __($config['telegram']) }}" target="_bank"><i class="fab fa-telegram"></i></a></li>
        <?php endif; ?>
        <?php if (!empty(__($config['instagram']))) : ?>
        <li class="px-2"><a href="{{ __($config['instagram']) }}" target="_bank"><i class="icon-instagram"></i></a></li>
        <?php endif; ?>
        <?php if (!empty(__($config['linkedin']))) : ?>
        <li class="px-2"><a href="{{ __($config['linkedin']) }}" target="_bank"><i class="icon-linkedin"></i></a>
        </li>
        <?php endif; ?>
        <?php if (!empty(__($config['twitter']))) : ?>
        <li class="px-2"><a href="{{ __($config['twitter']) }}" target="_bank"><i class="icon-twitter"></i></a>
        </li>
        <?php endif; ?>
    </ul>
    <?php endif; ?>
</div>