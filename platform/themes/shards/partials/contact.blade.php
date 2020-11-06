<section class="home-section about-page page-section">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <img src="{{ theme_option('banner-page-contact') }}" alt="banner page contact">
        </div>
    </div>
    <div class="container page-contact py-5">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <p> {{ session('status')}}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-5 offset-md-1 text-center pb-5 pb-md-0">
                <?php if (!empty(theme_option('Call-us'))) : ?>
                <div class="pb-3">
                    <h5>Have any questions?</h5>
                    <p class="info pt-1">{{ theme_option('email') }}</p>
                </div>
                <?php endif; ?>
                <?php if (!empty(theme_option('Call-us'))) : ?>
                <div class="pb-3">
                    <h5>Call us</h5>
                    <p class="info pt-1">{{ theme_option('Call-us') }}</p>
                </div>
                <?php endif; ?>
                <?php if (!empty(theme_option('Office-Phone'))) : ?>
                <div class="pb-3">
                    <h5>Office Phone</h5>
                    <p class="info pt-1">{{ theme_option('Office-Phone') }}</p>
                </div>
                <?php endif; ?>
                <div class="pb-4">
                    <p class="word-message">Write a message</p>
                    <p>If you got any questions, please do not hesitate to send us a message. We reply within 24 hours !
                    </p>
                    <p>Our profiles in social media:</p>
                </div>
                <div>
                    <?php if (!empty(theme_option('Facebook')) && !empty(theme_option('Google'))  && !empty(theme_option('instagram')) && !empty(theme_option('twitter')) && !empty(theme_option('linkedin'))) : ?>
                    <ul class="footerSocial d-flex">
                        <?php if (!empty(theme_option('Facebook'))) : ?>
                        <li class="px-2"><a href="{{ theme_option('Facebook') }}"><i class="icon-facebook"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty(theme_option('Google'))) : ?>
                        <li class="px-2"><a href="{{ theme_option('Google') }}"><i class="icon-google"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty(theme_option('instagram'))) : ?>
                        <li class="px-2"><a href="{{ theme_option('instagram') }}"><i class="icon-instagram"></i></a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty(theme_option('twitter'))) : ?>
                        <li class="px-2"><a href="{{ theme_option('twitter') }}"><i class="icon-linkedin"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty(theme_option('linkedin'))) : ?>
                        <li class="px-2"><a href="{{ theme_option('linkedin') }}"><i class="icon-twitter"></i></a></li>
                        <?php endif; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-5 offset-md-1">
                <form method="post" action="/postMessage">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control inputValidate" id="name" name="txtName"
                            placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputValidate" type="text" name="txtPhone" pattern="^[0-9]*$"
                            placeholder="Your Phone" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control inputValidate" id="email" name="txtEmail"
                            placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="message" name="txtSubject" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <textarea name="txtMessage" id="Your Message" rows="4" class="form-control inputValidate"
                            required></textarea>
                    </div>
                    <button type="submit" class="form-control btn-send btn-submit py-2">SEND</button>
                </form>
            </div>
            <?php if (!empty(theme_option('script-maps'))) : ?>
            <div class="col-12 pt-5">
                <div class="maps">
                    {!! theme_option('script-maps') !!}
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>