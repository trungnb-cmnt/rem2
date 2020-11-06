<div class="row">
    <div class="col-12 col-md-5 fs-14">
        <h3 class="font-weight-bold fs-18 text-uppercase my-0 my-md-4 text-red">{{ setting('company_name') }}</h3>
        @if (setting('company_phone'))
            <?php
            $phoneHtml = [];
            $phones = explode(',', setting('company_phone'));
            foreach ($phones as $phone) {
                $phoneHtml[] = '<a href="tel:' . $phone . '">' . $phone . '</a>';
            }
            $phoneHtml = implode(' - ', $phoneHtml);
            ?>
        @endif
        @if (setting('company_address')) <p><strong>{{ __('Địa chỉ') }}</strong>: {{ setting('company_address') }}</p> @endif
        @if ($phoneHtml) <p><strong>{{ __('Điện thoại') }}</strong>: {!! $phoneHtml !!}</p> @endif
        @if (setting('company_fax')) <p><strong>{{ __('Fax') }}</strong>: {{ setting('company_email') }}</p> @endif
        @if (setting('company_email')) <p><strong>{{ __('Email') }}</strong>: <a href="mailto:{{ setting('company_email') }}">{{ setting('company_email') }}</a></p> @endif
        <p><strong>{{ __('Website') }}</strong>: {{ url('/') }}</p>
    </div>
    <div class="col-12 col-md-7">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1869.5968469977763!2d106.1685982581925!3d20.41610891030787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135e0ae3f00b057%3A0x9546f934e09760a1!2zQ8O0bmcgVHkgQ-G7lSBQaOG6p24gRMOieSBMxrDhu5tpIFRow6lwIE5hbSDEkOG7i25o!5e0!3m2!1svi!2s!4v1560329220269!5m2!1svi!2s" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>
