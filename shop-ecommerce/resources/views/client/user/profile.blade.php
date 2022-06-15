@extends('client.main')

@section('content')
    <br><br><br>
    <div class="user-content row">
        <div class="side-menu col-md-3 sol-sm-12">
            <h4 class="mtext-109 cl2 p-b-30 p-l-25-ssm ">
                {{ $customer->first_name }}    {{ $customer->last_name }}             
            </h4>
            
            <div class="submenu">
                <ul>
                    <li class="subc font tab-item active " id="submenu-myprofile">Thông Tin Chung</li>
                    <li class="subc font tab-item " id="submenu-myprofile">Đơn Hàng Của Tôi</li>
                    <li class="subc font tab-item " id="submenu-myprofile">Đổi Mật
                        Khẩu</li>


                </ul>
            </div>
        </div>
       
            <div class="bor10 p-lr-30 p-t-30 p-b-40   m-lr-0-xl p-lr-15-sm col-md-7 tab-pane active " id='panel-info'>
                <h4 class="mtext-109 cl2 p-b-30 p-l-20">
                    THÔNG TIN CỦA TÔI
                    
                </h4>
                <div class="form-group"><span class="font title-infor mtext-100 cl2">Họ Và Tên:</span> {{ $customer->first_name }}
                    {{ $customer->last_name }}</div>
                <div class="form-group"><span class="font title-infor mtext-100 cl2">Email:</span> {{ $customer->email }}</div>
                <div class="form-group"><span class="font title-infor mtext-100 cl2 ">Giới Tính:</span> {{ $customer->gender }}</div>
                <div class="form-group"><span class="font title-infor mtext-100 cl2">Điện Thoại:</span>{{ $customer->phone }}</div>
                <div class="form-group"><span class="font title-infor mtext-100 cl2">Địa Chỉ:</span> {{ $customer->address }} </div>
            
            <br>
            <button type="button" class="flex-c-m stext-101 cl0 size-101 bg3 bor1 hov-btn3 p-lr-15 trans-04 "
                onclick="document.getElementById('id01').style.display='block'">Cập Nhật Thông Tin Cá Nhân</button>

            </div>


        

        <div class=" table-order col-md-9 sol-sm-12 tab-pane " id='panel-info'>
            <br>
            <div class="table-responsive-md" id="donhang">
                <h4 class="mtext-109 cl2 p-b-30 p-l-20">Các Đơn Hàng Đã Đặt:</h4>
                <table class="table table-hover  table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="tr">Mã Đơn Hàng</th>
                            <th class="tr">Ngày Đặt</th>
                            <th class="tr">Tên Sản Phẩm</th>
                            <th class="tr">Tổng Tiền</th>
                            <th class="tr">Phương Thức Thanh Toán</th>
                            <th class="tr" style="width: 10%;">Trạng Thái Đơn Hàng</th>                            
                        </tr>
                    </thead>

                    <tbody>

                        {!! \App\Helpers\Helper::renderListOrderCustomer($order_customer) !!}
                    </tbody>
                </table>
            </div>
        </div>
        <div class=" bor10 p-lr-30 p-t-30 p-b-40   m-lr-0-xl p-lr-15-sm col-md-7 tab-pane " id='panel-info'>
            <h4 class="mtext-109 cl2 p-b-30 p-l-20">
                    ĐỔI MẬT KHẨU </h4>
            <form class="information-user-change-password-form col-md-12 col-sm-12 bordered" method="post" action="" id="form-change-password">
                <input type="hidden" name="customer_id" value="{{ $customer->id }}" class="form-control">
                <div class="form-group-change-password">
                    <label for="old_password" class="form-label mtext-100 cl2">Mật Khẩu Hiện Tại</label>
                    <input id="old_password" name="old_password" type="text" placeholder="VD: 123456"
                        class="form-control stext-111 cl2 plh3 size-116 p-l-10 p-r-30">
                    <span class="form-message"></span>
                </div>
                <div class="form-group-change-password">
                    <label for="password" class="form-label mtext-100 cl2">Mật Khẩu Mới</label>
                    <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control stext-111 cl2 plh3 size-116 p-l-10 p-r-30">
                    <span class="form-message"></span>
                </div>

                <div class="form-group-change-password">
                    <label for="password_confirmation" class="form-label mtext-100 cl2">Nhập Lại Mật Khẩu Mới</label>
                    <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu"
                        type="password" class="form-control stext-111 cl2 plh3 size-116 p-l-10 p-r-30">
                    <span class="form-message"></span>
                </div>
                @csrf
                <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg3 bor1 hov-btn3 p-lr-15 trans-04  ">Đổi Mật Khẩu</button>

            </form>
        </div>


    </div>
    <div id="id01" class="modal" style="z-index:12">

        <form class="modal-content animate" action="/myprofile/store" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close"
                    title="Close Modal">×</span>
            </div>

            <div class="input-content">
                <input type="hidden" name="customer_id" value="{{ $customer->id }}" class="form-control">
                <label for="fullname"><b>Họ Khách Hàng:</b></label>
                <input class="login-input" type="text" placeholder="VD:Nguyễn Văn A" name="first_name" id="uname"
                    value="{{ $customer->first_name }} " required="">
                <label for="fullname"><b>Tên Khách Hàng:</b></label>
                <input class="login-input" type="text" placeholder="VD:Nguyễn Văn A" name="last_name" id="uname"
                    value="{{ $customer->last_name }}" required="">
                <label for="phone"><b>Số Điện Thoại:</b></label>
                <input class="login-input" type="text" placeholder="Nhập Số Điện Thoại:" name="phone" id="psw"
                    value="{{ $customer->phone }}" required="">

                <label for="gender"><b>Giới Tính:</b></label>
                <input class="login-input" type="text" placeholder="Nhập Giới Tính:" name="gender" id="psw" required=""
                    value="{{ $customer->gender }}">

                <label for="address"><b>Địa Chỉ:</b></label>
                <textarea class="login-input" name="address" id="psw">{{ $customer->address }}</textarea>

            </div>
            @csrf
            <div class="group-button row">
                <div class="col-md-2 col-sm-0"></div>
                <button type="button" class="btn btn-outline-danger col-md-3"
                    onclick="document.getElementById('id01').style.display='none'">Huỷ</button>
                <div class="col-md-2 col-sm-0"></div>
                <button type="submit" class="btn btn-success col-md-3">Cập Nhật</button>
                <div class="col-md-2 col-sm-0"></div>
            </div>
        </form>
    </div>
@endsection

