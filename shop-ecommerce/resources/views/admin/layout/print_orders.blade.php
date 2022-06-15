<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OrderDetail_bill</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dashboard/dist/css/adminlte.min.css')}}">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> Ecommerce,Inc.
          <small class="float-right">Ngày: {{date('d-m-y')}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Từ
        <address>
          <strong>Ecommerce, Inc.</strong><br>
          273 An D. Vương, Phường 3,  <br>
          Quận 5, Thành phố Hồ Chí Minh<br>
          Số điện thoạt: +84912345678<br>
          Email: nhom13@gmail.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Đến
        <address>
          <strong>{{$orderItems[0]['first_name'].' '.$orderItems[0]['last_name']}}</strong><br>
          {{$orderItems[0]['address_orders']}}<br>
         
          Số điện thoạt: {{$orderItems[0]['phone']}}<br>
          Email: {{$orderItems[0]['email']}}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Mã hóa đơn #00{{$id_print}}</b><br>
        <br>
        <b>ID đơn hàng:</b> #{{$id_print}}<br>
        <b>Ngày lập:</b> {{date('d-m-y')}}<br>
        <b>Tài khoản:</b> #{{$orderItems[0]['id'].'_'.$orderItems[0]['first_name'].''.$orderItems[0]['last_name']}}
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng</th>
          </tr>
          </thead>
          <tbody>
            @php $sum=0; @endphp
            @foreach ($orderItems as $key => $order_detail)
          <tr>
            <td>{{++$key}}</td>
            <td>{{$order_detail->name}}</td>
            <td>{{$order_detail->amount_detail}}</td>
            <td>{{number_format($order_detail->price)}}</td>
            <td>{{number_format($order_detail->price*$order_detail->amount_detail)}}</td>
          </tr>
          @php
          
          $a=$order_detail->price*$order_detail->amount_detail;
          $sum=$sum+$a;
          $discount=($order_detail->discount_value/100)*$sum;
          $discount_value=$order_detail->discount_value;
       
        @endphp
          @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        {{-- <p class="lead">Payment Methods:</p>
        <img src="{{asset('dashboard/dist/img/credit/visa.png')}}" alt="Visa">
        <img src="{{asset('dashboard/dist/img/credit/mastercard.png')}}" alt="Mastercard">
        <img src="{{asset('dashboard/dist/img/credit/american-express.png')}}" alt="American Express">
        <img src="{{asset('dashboard/dist/img/credit/paypal2.png')}}" alt="Paypal">

        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          
        </p> --}}
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead"></p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Tổng chưa giảm:</th>
              <td>{{number_format($sum)}}VNĐ</td>
            </tr>
            <tr>
              <th>Giảm giá ({{$discount_value}}%)</th>
              <td>{{number_format($discount)}}VNĐ</td>
            </tr>
            <tr>
              <th>Giao hàng:</th>
              <td>0 VNĐ</td>
            </tr>
            <tr>
              <th>Tổng Cộng:</th>
              <td>{{number_format($sum-$discount)}}VNĐ</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
window.addEventListener("load", window.print());
</script>
</body>
</html>
