@extends('client.main')

@section('content')
    <br><br><br>
    <br><br><br>
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a class="stext-109 cl8 hov-cl1 trans-04">
                Trang Cá Nhân
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a class="stext-109 cl8 hov-cl1 trans-04">
                Đơn Hàng
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>


        </div>
    </div>
    <div class="detail-order-table"> <br><br>

        <div class="wrapper table-responsive-lg ">
            <table class="table table-bordered order_summary">
                <thead>
                    <tr>
                        <th class="txt-center bold">STT</th>
                        <th class="order_product txt-center bold">HÌNH ẢNH</th>
                        <th class="txt-center bold">SẢN PHẨM</th>
                        <th class="txt-center bold">SỐ LƯỢNG</th>
                        <th class="txt-center bold">ĐƠN GIÁ</th>
                        <th class="txt-center bold">TỔNG TIỀN</th>

                    </tr>
                </thead>

                {!! \App\Helpers\Helper::renderOrderDetailsCustomer($order_details) !!}


            </table>

        </div>
    </div>
    <br><br><br>
    <br><br><br>
@endsection
