<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Giỏ Hàng
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                @php $total=0; @endphp
                @if (count($product_cart) > 0)

                    @foreach ($product_cart as $cart)
                        @php
                            $price = $cart->price;
                            $price_product = $price * (int) $cart_qty[$cart->id];
                            $total += $price_product;
                            
                        @endphp
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="/storage/uploads/{{ $cart->img }}" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="/detail-product/{{ $cart->id }}-{{ \Str::slug($cart->name_product, '-') }}.html"
                                    class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    {{ $cart->name_product }}
                                </a>

                                <span class="header-cart-item-info">
                                    {{ $cart_qty[$cart->id] }} x {{ number_format($price) }} VNĐ
                                </span>
                            </div>
                        </li>
                    @endforeach
                  
                @else
                    <img class="img-no-cart-notify" src="{{ asset('./template/images/no-cart-notify.png') }}">
                    <h2 class="header-cart-item flex-w flex-t m-b-12 title-no-cart-notify"> Không Có Sản Phẩm Nào Trong
                        Giỏ Hàng</h2>

                      
                @endif

            </ul>
            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Tổng Số Tiền: {{ number_format($total) }} VNĐ
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="/carts" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Xem Giỏ Hàng
                    </a>

                    <a href="/checkout" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Đặt Hàng
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
