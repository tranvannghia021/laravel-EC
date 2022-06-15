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

      <div class="text-center">
          <h1>Thêm mã giảm giá</h1>
      </div>
    
    @if(Session::has('error'))
    <div class="text-center">
      <p class="alert alert-dangger">{{Session::get('error')}}</p>
    </div>
    @endif
    <form action="" method="POST" class="m-2" id="form-add-discount">
   
        
          @csrf
          <div class="form-group">
            <label for="Dis_name">Tên mã giảm</label>
            <input type="text" class="form-control" value="{{old('dis_name')}}" id="Dis_name" name="dis_name" placeholder="Nhập tên mã giảm..." >
           <span class="form-message"></span>
          </div>

          <div class="form-group">
            <label for="Dis_value">Phần trăm giảm</label>
            <input type="text" class="form-control" value="{{old('dis_value')}}" id="Dis_value" name="dis_value" placeholder="Nhập phần trăm giảm..." >
            <span class="form-message"></span>

          </div>

          <div class="form-group">
            <label for="Dis_description">Chi tiết mã giảm</label>
            <input type="text" class="form-control" value="{{old('dis_description')}}" id="Dis_description" name="dis_description" placeholder="Nhập chi tiết mã giảm..." >
            <span class="form-message"></span>

          </div>
            <div class="row form-group">
              <div class="form-group col-sm-6">
                <label for="Start_date">Thời gian bắt đầu</label>
                <input type="date" class="form-control" value="{{old('start_date')}}" id="Start_date" name="start_date" placeholder="Nhập ngày bất đầu...">
                <span class="form-message"></span>
    
              </div>
    
              <div class="form-group col-sm-6">
                <label for="End_date">Thời gian kết thúc</label>
                <input type="date" class="form-control" value="{{old('end_date')}}" id="End_date" name="end_date" placeholder="Nhập ngày kết thúc..." >
                <span class="form-message"></span>
    
              </div>
            </div>
         


          <div class="form-group">
            <label>Trạng thái</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="status" name="status" checked="">
                <label for="status" class="custom-control-label">Còn hoạt động</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="no_status" name="status">
                <label for="no_status" class="custom-control-label">Không hoạt động</label>
            </div>
        </div>
          <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
@endsection 
<script>
   const obj_discount=JSON.parse('<?= $discounts?>')
  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-add-discount',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
              Validator.isRequired('#Dis_name', 'Vui lòng nhập tên mã giảm'),
              Validator.minLength('#Dis_name',4),
              Validator.isCheck('#Dis_name',obj_discount,'Tên mã giảm đã tồn tại'),
              Validator.isRequired('#Dis_value', 'Vui lòng nhập phần trăm giảm'),
              Validator.isNumber('#Dis_value','Phần trăm giảm phải là số dương'),
              Validator.isRequired('#Dis_description','Vui lòng nhập chi tiết mã giảm'),
              Validator.isRequired('#Start_date','Vui lòng nhập ngày bắt đầu giảm'),
              Validator.isRequired('#End_date','Vui lòng nhập ngày kết thúc giảm'),
              Validator.isEndDate('#End_date', function () {
                    return document.querySelector('#form-add-discount #Start_date').value;
                  }, 'Mã giảm phải tối thiểu 2 tuần')


          ],

      })
  });
</script>