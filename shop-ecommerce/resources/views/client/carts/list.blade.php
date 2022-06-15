@extends('client.main')

@section('content')

    @if (count($products) != 0)
        <div class="container p-t-100">
            <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
                <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                    Trang Chủ
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>

                <span class="stext-109 cl4">
                    Giỏ Hàng
                </span>
            </div>
        </div>
        <form class="bg0 p-t-55 p-b-85 " method="post" id="form-add-order">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">

                                <table class="table-shopping-cart">
                                    @php
                                        $total = 0;
                                    @endphp
                                    <tbody>
                                        <tr class="table_head">
                                            <th class="column-1"  style="padding-left:30px">Sản Phẩm</th>
                                            <th class="column-2"></th>
                                            <th class="column-3">Giá</th>
                                            <th class="column-4">Số Lượng</th>
                                            <th class="column-5">Tổng Tiền</th>
                                            <th class="column-6">Thao Tác </th>
                                        </tr>
                                        @foreach ($products as $key => $product)
                                            @php
                                                $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
                                                $price_product = $price * (int) $cart_qty[$product->id];
                                                $total += $price_product;
                                            @endphp
                                            <tr class="table_row">
                                                <td class="column-1" style="padding-left:30px">
                                                    <div class="how-itemcart1">
                                                        <img src="/storage/uploads/{{ $product->img }}" alt="IMG">
                                                    </div>
                                                </td>
                                                <td class="column-2"> <a
                                                        href="/detail-product/{{ $product->id }}-{{ \Str::slug($product->name_product, '-') }}.html"
                                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">{{ $product->name_product }}
                                                </td>
                                                <td class="column-3">{{ number_format($product->price) }}</td>
                                                <td class="column-4">
                                                    <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                                        </div>

                                                        <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                            name="num_product[{{ $product->id }}]"
                                                            value="{{ $cart_qty[$product->id] }}">

                                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="column-5">{{ number_format($price_product) }}</td>
                                                <td class="p-r-15">
                                                    <a    class="flex-c-m stext-100 cl2 size-100 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"href="/cart/delete/{{ $product->id }}">Xoá</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>


                            </div>

                            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                               
                                @csrf
                                <input type="submit" formaction="/update-cart"
                                    class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"
                                    value='Cập Nhật Giỏ Hàng'>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Tổng Tiền Đơn Hàng
                            </h4>

                           
                          
                            <div class="flex-w flex-t p-t-27 p-b-33 bor12">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Tổng Tiền
                                    </span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2">
                                        {{ Number_format($total) }} VNĐ
                                    </span>
                                </div>
                            </div>
                            
                            <input class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer " style="text-align: center;"
                                id="btn-order" value="Đặt Hàng">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="text-center no-cart">
            <h2 class="title-no-cart"> Giỏ Hàng Trống</h2>
            <img class="img-no-cart" src="{{ asset('./template/images/no-cart.png') }}">
        </div>
    @endif
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        /*
                Validator({
                    form: '#form-add-order',
                    formGroupSelector: '.form-group',
                    errorSelector: '.form-message',
                    rules: [
                       Validator.isRequired('#last_name', 'Vui lòng nhập tên nhân viên'),
                        Validator.isRequired('#first_name', 'Vui lòng nhập họ nhân viên'),
                        Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại'),
                        Validator.isRequired('#email', 'Vui lòng nhập email'),
                        Validator.isRequired('#password', 'Vui lòng nhập mật khẩu'),
                        Validator.isRequired('#address', 'Vui lòng nhập địa chỉ'),
                        Validator.isRequired('#start_date', 'Vui lòng nhập ngày bắt đầu'),
                        Validator.isRequired('#end_date', 'Vui lòng nhập ngày kết thúc'),
                        Validator.isEmail('#email'),
                        Validator.isPhoneNumber('#phone'),
                        Validator.minLength('#password', 6),
                        Validator.isEndDate('#end_date', function () {
                        return document.querySelector('#form-add-products #start_date').value;
                      }, 'Hợp đồng làm việc tối thiểu 2 tuần')
                    ],
                    onSubmit: function (data) {    
                       

                    }
                });*/
    });
</script>
