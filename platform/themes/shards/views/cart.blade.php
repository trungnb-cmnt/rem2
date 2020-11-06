<?php
$cart = Cart::getContent();
//echo "<pre>";
//print_r($cart);
//    Cart::clear();
$subTotal = Cart::getSubTotal();
//echo $subTotal;
?>
<div class="container">
    <div class="row cart top bottom">
        <div class="col-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('success'))
            <div class="alert message alert-success alert-dismissible fade show" role="alert">
                {{ session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (session('errors'))
            <div class="alert message alert-danger alert-dismissible fade show" role="alert">
                {{ session('errors')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form action="{{ url('checkout') }}" method="POST" id="cart-form">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="thong-tin py-2 text-center">
                            <h4 class="font-weight-bold text-white mb-0">BUYER INFORMATION</h4>
                        </div>
                        <div class="form-group py-2">
                            <div class="my-3">
                                <input type="text" required name="name" value="{{ old('name') }}"
                                    class="form-control py-2" placeholder="Name">
                            </div>
                            <div class="d-flex align-items-center pl-3">
                                <span class="gender pr-4">Gender:</span>
                                <input class="radio-input" id="male" type="radio" name="gender" value="0" checked>
                                <label class="radio-label m-0" for="male">Male</label>
                                <input class="radio-input" id="female" type="radio" name="gender" value="1">
                                <label class="radio-label m-0 ml-4" for="female">Female</label>
                            </div>
                            <div class="my-3">
                                <input type="text" required class="form-control py-2" name="phone" placeholder="Phone"
                                    value="{{ old('phone_save_point') }}">
                            </div>
                            <div class="my-3">
                                <input type="email" required class="form-control py-2" name="email" placeholder="Email"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="my-3 arrowSelect">
                                <select name="country" class="form-control" id="Country" required>
                                    <option value=""><span>-- Country -- </span></option>
                                    @if(!empty($countries))
                                    @foreach($countries as $k=> $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="my-3 arrowSelect">
                                <select name="province" class="form-control" id="province">
                                    <option value=""><span>-- Province --</span></option>
                                </select>
                            </div>
                            <div class="my-3">
                                <select name="district" class="form-control" id="District">
                                    <option value="">-- District --</option>
                                </select>
                            </div>
                            <div class="my-3">
                                <input type="text" name="address" class="form-control py-2" placeholder="Address">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="thong-tin py-2 text-center">
                            <h4 class="font-weight-bold text-white mb-0">TIME RECEIVING GOODS</h4>
                        </div>
                        <div class="form-group">
                            <div v="my-3">
                                <div class="d-flex py-2 align-items-center">
                                    <input class="radio-input" id="out_office_hour" type="radio" name="time_to_delivery"
                                        value="0" checked>
                                    <label class="radio-label m-0 font-16 m-0" for="out_office_hour">Out office
                                        hours</label>
                                </div>
                                <div class="d-flex py-2 align-items-center">
                                    <input class="radio-input" id="in_office_hour" type="radio" name="time_to_delivery"
                                        value="1">
                                    <label class="radio-label m-0 font-16 m-0" for="in_office_hour">During office
                                        hours</label>
                                </div>
                            </div>
                            <div class="my-4">
                                <div class="py-2 pl-3 thanh-toan">
                                    <span class="font-weight-bold text-uppercase font-16">PAYMENTS</span>
                                </div>
                            </div>
                            <div class="my-4">
                                <div class="d-flex py-2 align-items-center">
                                    <input class="radio-input" id="payment_type_cod" type="radio" name="payment_type"
                                        checked value="Payment on delivery">
                                    <label class="radio-label m-0 font-16 m-0" for="payment_type_cod">Payment on
                                        delivery</label>
                                    <input type="hidden" name="totalPrice" value="{{ ($subTotal) }}" />
                                </div>
                            </div>
                            <div class="mt-4">
                                <textarea name="description" id="note" class="form-control w-100"
                                    placeholder="Description..." rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="thong-tin py-2 text-center">
                            <h4 class="font-weight-bold text-white mb-0">ORDER </h4>
                        </div>
                        <div class="form-group don-hang px-4 pt-2 pb-3 position-relative">
                            @if($subTotal > 0)
                            @if(!empty($cart))
                            @foreach($cart as $item)
                            <div class="cart-item">
                                <div class="my-3 d-flex">
                                    <div class="cart-img p-1 h-100 d-flex justify-content-center align-items-center">
                                        <img class="lazy" src="{{ get_object_image( $item['attributes']->image ) }}"
                                            alt="{{ $item['name'] }}">
                                    </div>
                                    <div class="pl-3 flex-1">
                                        <p class="font-weight-bold font-16 m-0">{{ $item['name'] }}</p>
                                        <p class="m-0 font-weight-bold">
                                            $ {{ ($item['price'] ) }}</p>
                                        <div class="d-flex align-items-center position-relative product-qty pt-2">
                                            <p class="mb-0"></p>
                                            <button type="button" class="px-2 decrease update-cart action-update-cart">-
                                            </button>
                                            <input type="number" data-product-id="{{ $item['id'] }}" min="1" step="1"
                                                value="{{ $item['quantity'] }}" class="qty text-center">
                                            <button type="button" class="px-2 increase update-cart action-update-cart">+
                                            </button>
                                            <button class="text-center d-flex cart-delete-item position-absolute">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            <div class="empty">
                                <p class="d-flex align-items-center font-weight-bold  m-0 pb-2 pt-3"
                                    id="total-price-wrapper">
                                    Total: <span id="total-price" class="d-block pl-4">$ {{ ($subTotal) }}</span>
                                </p>
                                <div class="pt-3">
                                    <button class="py-2 w-100 border-0 add-cart font-weight-bold" id="checkout-button">
                                        <h4>ORDER</h4>
                                    </button>
                                </div>
                            </div>
                            @endif
                            @if($subTotal == 0)
                            <div class="mt-3 font-weight-bold" id="cart-no-item">
                                There are currently no products in the cart!
                            </div>
                            @endif
                            <div id="message-no-item" class="font-weight-bold"></div>
                        </div>
                    </div>
                </div>

            </form>
            <?php /*
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog h-100 d-flex align-items-center" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center pb-5">
                            <div><span class="ion-succes icon-success"></span></div>
                            <p class="message m-0 font-weight-bold py-3">Đặt hàng thành công !</p>
                            <div class="px-4">
                                <p class="m-0 py-2">Cảm ơn quý khách đã quan tâm tới sản phẩm của chúng tôi </p>
                                <p class="m-0 py-2 font-weight-bold text-right">Quay về <a class="font-weight-bold xem-them" href="{{ url('/') }}">trang chủ >></a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            */ ?>
        </div>
    </div>
</div>
<div class="spinner">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
</div>
<div class="justify-content-center loading-order">
    <div class="spinner-border text-light" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>