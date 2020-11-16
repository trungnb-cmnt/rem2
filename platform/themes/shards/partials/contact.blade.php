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
                <?php if (!empty(theme_option('email'))) : ?>
                <div class="pb-3">
                    <h5>Nếu bạn có câu hỏi?</h5>
                    <p class="info pt-1">{{ theme_option('email') }}</p>
                </div>
                <?php endif; ?>
                <?php if (!empty(theme_option('cskh'))) : ?>
                <div class="pb-3">
                    <h5>Gọi chúng tôi</h5>
                    <p class="info pt-1">{{ theme_option('cskh') }}</p>
                </div>
                <?php endif; ?>
                <div class="pb-4">
                    <p class="word-message">Hãy viết 1 tin nhắn</p>
                    <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng gửi tin nhắn cho chúng tôi. Chúng tôi trả lời trong vòng 24 giờ! !
                    </p>
                    {{-- <p>Hồ sơ của chúng tôi trên mạng xã hội:</p> --}}
                </div>
            </div>
            <div class="col-md-5 offset-md-1">
                <form method="post" action="/postMessage">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control inputValidate" id="name" name="txtName"
                            placeholder="Họ và tên" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control inputValidate" type="text" name="txtPhone" pattern="^[0-9]*$"
                            placeholder="Điện thoại" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control inputValidate" id="email" name="txtEmail"
                            placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="message" name="txtSubject" placeholder="Tiêu đề">
                    </div>
                    <div class="form-group">
                        <textarea name="txtMessage" id="Your Message" rows="4" class="form-control inputValidate" placeholder="Nội dung"
                            required></textarea>
                    </div>
                    <button type="submit" class="form-control btn-send btn-submit py-2">Gửi</button>
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