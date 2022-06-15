@extends('admin.layout.layout') 
@section('title')
{{$title}}
@endsection 
 {{-- content  --}}
 @section('infoStaff')
<a href="#" class="d-block">{{$staff->first_name }} {{ $staff->last_name }}</a>

@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
  {{-- code --}}
  
  <div class="card card-success  " style="padding:1em 8em;min-height: ">
    <div class="text-center"><h1>Chi tiết hóa đơn</h1></div>
        
        <div class="card-header">
          <h3 class="card-title">Thông tin khách hàng</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
        </div>
      
        <div class="card-body">
          <div class="">
        
              <p>TÊN : {{$orderItems[0]['first_name'].' '.$orderItems[0]['last_name']}}</p>
              <p>SỐ ĐIỆN THOẠT :{{$orderItems[0]['phone']}} </p>
              <p>EMAIL :{{$orderItems[0]['email']}} </p>
              <p>ĐỊA CHỈ :{{$orderItems[0]['address_orders']}} </p>
              <p>NGÀY ĐẶT :{{$orderItems[0]['created_at']->toDayDateTimeString()}}</p>

          </div>
        </div>
      </div>
   
  @php $sum=0; @endphp
    <table id="order_details" class="table table-bordered">
      <tbody><tr height="40px">
        <th class="">Tên sản phẩm</th>
       
        <th class="text-center">Giá</th>
        <th class="text-center">Số lượng</th>
        <th class="total text-right">Tổng cộng</th>
      </tr>

      @foreach ($orderItems as $key => $order_detail)
      <tr height="40px" id="1191685316" class="odd">
        <td class="" style="max-width:300px">
          <a href="{{asset('storage/uploads/'.$order_detail->img)}}" target="_blank" title="">{{$order_detail->name}}</a> <br> 
          
        </td>
  
        <td class="money text-center">{{number_format($order_detail->price)}}</td>
        <td class="quantity center text-center">{{$order_detail->amount_detail}}</td>
        <td class="total money text-right">{{number_format($order_detail->price*$order_detail->amount_detail)}}đ</td>
      </tr>
      @php
          
          $a=$order_detail->price*$order_detail->amount_detail;
          $sum=$sum + $a;
          $discount=($order_detail->discount_value/100)*$sum;
          $discount_value=$order_detail->discount_value;

       
        @endphp
      @endforeach
      
      <tr height="40px" class="order_summary">
        <td class="text-right" colspan="3"><b>Tổng chưa giảm</b></td>
        <td class="total money text-right"><b>{{number_format($sum)}}</b></td>
      </tr>   
      
      <tr height="40px" class="order_summary order_total">
        <td class="text-right" colspan="3"><b>Giảm giá({{$discount_value}}%)</b></td>
        <td class="total money text-right"><b>{{number_format($discount)}}₫</b></td>
      </tr> 

      
      <tr height="40px" class="order_summary ">
        <td class="text-right" colspan="3"><b>Vận chuyển Giao hàng tiết kiệm</b></td>
        <td class="total money text-right"><b>0₫</b></td>
      </tr>
      

          

      <tr height="40px" class="order_summary order_total">
        <td class="text-right" colspan="3"><b>Tổng tiền</b></td>
        <td class="total money text-right"><b>{{number_format($sum - $discount)}}₫ </b></td>
      </tr>    
    </tbody></table>
    <a href="{{Route('admin.orders')}}" class="btn btn-success ">Quay lại</a>
    <a href="/admin/orders/print/{{$id_print}}" class="btn btn-info ">IN</a>
@endsection