<div style="width:700px; margin:0 auto;">
    <div style="color:blue; text-align:center">
        <h2>ĐẶT HÀNG THÀNH CÔNG</h2>
    </div>

    <div style="text-align:center; margin-botton:5px; font-size:15px; color:black">
        <h4> Xin Chào <strong>{{ $customer['last_name'] }} </strong>. </h4><br>
        Cảm ơn bạn đã mua hàng từ TRESOR ! Bạn có đặt đơn hàng với thông tin sau:
    </div>
    <div style="text-align:center; margin-botton:5px; font-size:15px; color:black">
        <strong> Số Điện Thoại:</strong>  {{ $customer['phone'] }}
    </div>
    <div style="text-align:center; margin-botton:5px; font-size:15px; color:black">
        <strong>Email:</strong>   {{ $customer['email'] }} .
    </div>
    <div style="text-align:center; margin-botton:5px; font-size:15px; color:black">
       <strong> Địa chỉ:</strong> {{ $customer['address'] }} .
    </div>
    <table cellspacing="0" cellpadding="10" border="1" style="width:100%; margin-bottom:9px; margin-top:15px">
        <thead>
            <tr>
                <th style="text-align:center">STT</th>
                <th style="text-align:center">SẢN PHẨM</th>
                <th style="text-align:center">SỐ LƯỢNG</th>
                <th style="text-align:center">ĐƠN GIÁ</th>
                <th style="text-align:center">TỔNG TIỀN</th>

            </tr>
        </thead>
        {!! \App\Helpers\Helper::renderOrderDetailsCustomerSendMail($orders) !!}

      
    </table>
    <br>
    <div style="text-align:center; margin-botton:5px; font-size:15px; color:black">
        Đơn hàng của bạn sẽ được chúng tôi nhanh chóng giao đơn vị vận chuyển và sẽ sớm giao hàng cho bạn. Mọi thông tin giao hàng đơn vị vận chuyển sẽ liên
        hệ thông qua số điện thoại {{$customer['phone']}} của bạn.

    </div>
    <div style="text-align:center; margin-botton:5px; font-size:15px; color:black;font-style:italic">
        Tiền Đơn Hàng chưa bao gồm phí giao hàng từ đơn vị vận chuyển.
    </div>
    <div style="text-align:center; margin-botton:5px;margin-top:10px; font-size:15px; color:rgb(212, 36, 36)">
        Xin Cảm Ơn Quý Khách !
    </div>
</div>
