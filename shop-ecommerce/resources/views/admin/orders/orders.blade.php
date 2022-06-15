@extends('admin.layout.layout') 
@section('title')
{{$title}}
@endsection 
 {{-- content  --}}
 @section('infoStaff')
<a href="#" class="d-block">{{$staff->first_name }} {{ $staff->last_name }}</a>

@endsection
@section('notifications')
{{-- {{count($status)}} --}}

@endsection
@section('main-content')
  <!-- Content Wrapper. Contains page content -->
    {{-- code --}}
    @if(Session::has('success'))

    <div class="text-center">
      <p class="alert alert-success ">{{Session::get('success') }}</p>
    </div>

    @endif
    <div class="card-header " style="background: rgb(105 ,127, 248)">
      <h3 class="tilte_order text-center">Danh sách đơn hàng</h3>
    </div>
      <div class="card-tools">
      
        <form action="" method="post" id="form-saerch-order">
          @csrf
        <div class="card-body">
          <!-- Date -->
          <div class="row form-group">
            <div class="col col-sm-6">
              <label>Tên khách hàng:</label>
              <div class="input-group date col-sm-5" id="">
                  <input type="text" class="form-control "  name="name_customer" placeholder="Tên khách hàng...">
 
              </div>
              <label>Trạng thái:</label>
              <div class="input-group date col-sm-5" id="">
                <Select class="form-control" value="" name="status">
                  <option @php if($status==0) echo 'selected' @endphp value="">Tất cả</option>
                  @php
                  for($i=1;$i<=count($a);$i++){
                    $selected='';
                    if($status==$i){
                      $selected='selected';
                    }
                   echo "<option ".$selected." value=".$i.">".$a[$i]."</option>";
                  }
              @endphp
              </Select>
                 
              </div>
            </div>
            <div class="col col-sm-6">
              <label>Phần trăm giảm giá:</label>
              <div class="input-group date col-sm-7" id="">
                <input min="0" type="number" value="" class="form-control " id="discount" name="discount" placeholder="Phần trăm giảm...">
                
                 
              </div>
              <label>Ngày đặt hàng:</label>
              <div class="input-group date col-sm-7" id="">
                 <div class="row form-group">
                   <div class="col col-sm-6">
                    <input type="date" class="form-control " name="start_date" id="start_date">
                   </div>
                   <div class="col col-sm-6">
                    <input type="date" class="form-control " name="end_date" id="end_date">
                   </div>
                   <span class="form-message"></span>
                 </div>
                 
              </div>
            </div>
          </div>
        </div>
       <div class="input-group date col-sm-12 ">
        <button type="submit" class="btn btn-success mr-2">Tìm</button>
        <button type="reset" class="btn btn-info ">Nhập lại</button>
       </div>
      </div>
      </form>
      
    
    
   
    <table class="table">
      <thead>
        <tr>
          <th style="width:50px" scope="col">STT</th>
          <th scope="col">Tên Khách hàng</th>
          <th scope="col">Trạng thái</th>
          <th scope="col">Giảm giá</th>
          <th scope="col">Tổng giá chưa giảm</th>
          <th scope="col">Tổng giá đã giảm</th>
          <th scope="col">Ngày đặt</th>
          <th scope="col">#</th>
        </tr>
        
      </thead>
      <tbody>
        @if(count($orders)==0)
        
        <tr>
          <td colspan="9" class="text-center">
            <h5>Không có đơn hàng</h5>
          </td>
        </tr>
    
      @else
        @foreach ($orders as $key => $order)
        <tr>
          <th scope="row">{{++$key}}</th>
          <td>{{$order->first_name.' '.$order->last_name}}</td>
          <td>
          
            @php

              
                
                for ($i=1; $i <=count($a) ; $i++) { 
                  if($order->status_order== $i){
                    echo $a[$i];
                  }
                }
            @endphp
          </td>
          <td>{{$order->discount_value.'%'}}</td>
          <td>{{number_format($order->total_price)}}</td>
          <td>{{number_format($order->total_price -($order->total_price*($order->discount_value/100)))}}</td>
          <td>{{$order->created_at->toDateString()}}</td>
      
          <td>
            <a class="btn btn-danger btn-sm rounded-circle" href="/admin/orders/edit/{{$order->id}}">
              <i class='fas fa-edit'></i>
            </a> 
            <a class="btn btn-primary btn-sm rounded-circle" href="/admin/orders/show/{{$order->id}}">
              <i class='fa fa-exclamation-circle'></i>
            </a>
          </td>
        </tr>
            
        @endforeach
        @endif
      
      </tbody>
    </table>

@endsection
<script>

  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-saerch-order',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
          
            Validator.isTommorrow('#end_date', function () {
                    return document.querySelector('#form-saerch-order #start_date').value;
                  }, 'Ngày chọn không hợp lệ')

          ],

      })
  });
</script>