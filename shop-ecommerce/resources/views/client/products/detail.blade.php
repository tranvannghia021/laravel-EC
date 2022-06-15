@extends('client.main')

@section('content')
    <br><br><br><br>
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Trang Chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
                Cửa Hàng
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $product->name_product }}
            </span>
        </div>
    </div>

    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="/storage/uploads/{{ $product->img }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="/storage/uploads/{{ $product->img }}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="/storage/uploads/{{ $product->img }}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $product->name_product }}
                        </h4>

                        <span class="mtext-106 cl2">
                            <strong style="color:red">{{ number_format($product->price) }} VNĐ</strong>
                        </span>

                        <div class="stext-102 cl3 p-t-23">
                            {!! $product->description !!} 
                        </div>

                        <!--  -->
                        <div class="p-t-33">

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <form action="" method="post" id="product-cart">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number" id="num-product"
                                                name="num-product" value="1" min="1" max="10">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" value="{{ $product->id }}" name="product-id">
                                           <span class="form-message"></span>
                                        </div>
                                      
                                        @csrf
                                        <button
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                            Thêm Vào Giỏ Hàng
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--
                            <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                                <div class="flex-m bor9 p-r-10 m-r-11">
                                    <a href="#"
                                        class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                        data-tooltip="Add to Wishlist">
                                        <i class="zmdi zmdi-favorite"></i>
                                    </a>
                                </div>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>-->
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Mô Tả</a>
                        </li>

                       
                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Đánh Giá</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {!! $product->description !!} 
                                </p>
                            </div>
                        </div>

                        <!-- - -->
                      
                    
                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        {{-- {{dd($ratings->toArray())}} --}}
                                        @foreach($ratings as $rating)
                                        <div class="flex-w flex-t p-b-68">
                                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="AVATAR">
                                            </div>

                                            <div class="size-207">
                                                <div class="flex-w flex-sb-m p-b-17">
                                                    <span class="mtext-107 cl2 p-r-20">
                                                        {{$rating->first_name.' '.$rating->last_name}}
                                                    </span>
                                                   
                                                    <span class="fs-18 cl11">
                                                       @for($i=1;$i<=5;$i++)
                                                        @php
                                                            if ($i<=$rating->point) {
                                                                $class='zmdi-star';
                                                            }else{
                                                                $class=' zmdi-star-outline';
                                                            }
                                                        @endphp
                                                        <i class="zmdi {{$class}} "></i>
                                                        @endfor
                                                    </span>
                                              
                                                </div>

                                                <p class="stext-102 cl6">
                                                        {{$rating->context}}
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach

                                        <!-- Add review -->
                                        <form class="w-full" id="form-add-rating">
                                            <h5 class="mtext-108 cl2 p-b-7">
                                                Thêm Đánh Giá
                                            </h5>

                                          

                                            <div class=" rating_point flex-w flex-m p-t-50 p-b-23">
                                                <span class="stext-102 cl3 m-r-16">
                                                    Số Sao:
                                                </span>
                                                
                                                <span class="wrap-rating fs-18 cl11 pointer">
                                                   
                                                        <i class="item-rating pointer zmdi zmdi-star"></i>
                                                        <i class="item-rating pointer zmdi zmdi-star"></i>
                                                        <i class="item-rating pointer zmdi zmdi-star"></i>
                                                        <i class="item-rating pointer zmdi zmdi-star"></i>
                                                        <i class="item-rating pointer zmdi zmdi-star"></i>
                                                    
                                                 
                                                </span>
                                         
                                            
                                             
                                            </div>

                                            <div class="row p-b-25">
                                                <div class="form-group col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="review">Nhận Xét:</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                                                    <span class="form-message"></span>
                                                </div>

                                            
                                            </div>
                                            <input type="hidden" id="_token" value="{{ csrf_token() }}" />
                                            <input type="hidden" id="product_id" value="{{$product->id}}" />
                                           
                                            <button
                                            id="btn-rating"
                                            type="submit"
                                                class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                Gửi Đánh Giá
                                            </button>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
    </section>


    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    SẢN PHẨM LIÊN QUAN
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">

                    {!! \App\Helpers\Helper::renderRelativeProducts($relative_products) !!}


                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Validator({
            form: '#product-cart',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
             
               // Validator.isNumber('#num-product',"Số Lượng Lớn Hơn 0"),
             
            ],
            onSubmit: function (data) {    
                $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: $('#product-cart').serialize(),
                url: '/add-cart',
                success: function (respond) {
                    console.log(respond.message)

                    if (respond.error !== true ) {                       
                        swal("Thêm Thành Công", "Sản Phẩm Đã Được Thêm Vào Giỏ Hàng", "success");
                       setTimeout(() => {window.location="/carts"}, 1200);
                    } 
                    else  {
                        swal("Thêm Thất Bại", "Số Lượng Không Hợp Lệ", "error");
                       
                    }
                }
            })

            }//nếu 
            //nếu muốn submit theo hành vi mặc định của form thì rào cái này lại
        });
    });
</script>

