{{-- {{dd($products->toArray())}} --}}
@extends('admin.layout.layout') 
@section('title')
{{$title}}
@endsection 
@section('infoStaff')
<a href="#" class="d-block">{{$staff->first_name }} {{ $staff->last_name }}</a>

@endsection
 {{-- content  --}}
 
@section('main-content')
  <!-- Content Wrapper. Contains page content -->
    {{-- code --}}
    <div class="text-center">
      <h3>Danh sách khuyến mãi</h3>
      <div class="card-tools">
        @if(Session::has('success'))
        <div class="text-center">
          <p class="alert alert-success">{{Session::get('success')}}</p>
        </div>
        @endif
        <div class="input-group input-group-sm search-input" style="width: 150px;">
          <form action="" method="post" id="form-search-discount">

              <div class="form-group input-group-append">
                <div class="">

                  <input type="date" name="start_date" id="start_date"   >
                </div>
                  <div class="">
                    <input type="date" name="end_date" id="end_date"   >
                    <span class="form-message"></span>
                  </div>
                  @csrf
                  <button id="search_rating" type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
          </form>

        </div>
      </div>
    </div>
 
    
    <table class="table">
      <thead>
        <tr>
          <th style="width:50px" scope="col">STT</th>
          <th scope="col">Tên mã giảm</th>
          <th scope="col">phần trăm giảm</th>
          <th scope="col">Chi tiết mã giảm</th>
          <th scope="col">Ngày bắt đầu</th>
          <th scope="col">Ngày kết thúc</th>
          <th scope="col">Trạng thái</th>
          <th scope="col">#</th>
        </tr>
        
      </thead>
      <tbody>
        @if(count($discounts)==0)
        
        <tr>
          <td colspan="9" class="text-center">
            <h5>Không có mã giảm</h5>
          </td>
        </tr>
    
      @else
      
        @foreach ($discounts as $key => $discount)
        <tr>
          <th scope="row">{{++$key}}</th>
          <td>{{$discount->name}}</td>
          <td>{{$discount->value.'%'}}</td>
          <td>{{$discount->description}}</td>
          <td>{{$discount->start_date}}</td>
          <td>{{$discount->end_date}}</td>
          <td>{{$discount->status==1 ?'còn hoạt động':'không hoạt động'}}</td>
        
       
          <td>
        <a class="btn btn-primary btn-sm" href="/admin/discounts/edit/{{ $discount->id }}">
            <i class="fas fa-edit"></i>
        </a>
            <a href="#" class="btn btn-danger btn-sm"
              onclick="removeRow({{ $discount->id }}, '/admin/discounts/destroy')">
                <i class="fas fa-trash"></i>
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
          form: '#form-search-discount',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
             
          
              Validator.isTommorrow('#end_date', function () {
                    return document.querySelector('#form-search-discount #start_date').value;
                  }, 'Ngày chọn không hợp lệ')


          ],

      })
  });
</script>