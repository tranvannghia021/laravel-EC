@extends('client.main')

@section('content')

<div class="bg0 m-t-23 p-b-140 fix-space-header">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    Tất Cả Sản Phẩm
                </button>
                @foreach($group_products as $cate)
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{$cate->id}}">
                    {{$cate->name}}
                </button>
                @endforeach

                
            </div>

            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                     Lọc
                </div>

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Tìm Kiếm
                </div>
            </div>
            
            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <form method="get" action=""class="bor8 dis-flex p-l-15">
                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Tìm Theo Tên Sản Phẩm">
                    
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                </form>	
            </div>

            <!-- Filter -->
            <div class="dis-none panel-filter w-full p-t-10">
                <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Lọc Theo
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="{{request()->url()}}" class="filter-link stext-106 trans-04">
                                    Tất Cả
                                </a>
                            </li>

                           
                            <li class="p-b-6">
                                <a href="{{request()->fullUrlWithQuery(['price' => 'asc']);}}" class="filter-link stext-106 trans-04">
                                    Giá: Thấp đến Cao
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{request()->fullUrlWithQuery(['price' => 'desc']);}}" class="filter-link stext-106 trans-04">
                                    Giá: Cao đến Thấp
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-col2 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Giá Tiền
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="{{request()->url()}}" class="filter-link stext-106 trans-04 filter">
                                    Tất Cả
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{request()->fullUrlWithQuery(['price_start' => '100000','price_end' => '300000']);}}" class="filter-link stext-106 trans-04">
                                    100.000 VNĐ - 300.000 VNĐ
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{request()->fullUrlWithQuery(['price_start' => '300000','price_end' => '500000']);}}" class="filter-link stext-106 trans-04">
                                    300.000 VNĐ - 500.000 VNĐ
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{request()->fullUrlWithQuery(['price_start' => '500000','price_end' => '1000000']);}}" class="filter-link stext-106 trans-04">
                                    500.000 VNĐ - 1000.000 VNĐ
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{request()->fullUrlWithQuery(['price_start' => '1000000']);}}" class="filter-link stext-106 trans-04">
                                   > 1000.000 VNĐ
                                </a>
                            </li>

                          
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="row isotope-grid" style="position: relative; height: 2269.93px;">
            {!! \App\Helpers\Helper::renderListProducts($products)!!}

        </div>
        <!-- 
        <div class="flex-c-m flex-w w-full p-t-65">
            <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Load More
            </a>
        </div>Load more -->
    </div>
    
   
</div>
 {!! $products->links() !!}
@section('content')