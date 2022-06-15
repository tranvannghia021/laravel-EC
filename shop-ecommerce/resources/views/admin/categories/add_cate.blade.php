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
    <div class="text-center ">
        <h1>Thêm danh mục</h1>
      </div>
      @if(Session::has('error'))
      <div class="text-center">
        <p class="alert alert-dangger">{{Session::get('error')}}</p>
      </div>
      @endif
    <form action="" method="POST" id="form-add-category"class="m-2" enctype="multipart/form-data">
     
        @csrf
        <div class="form-group">
          <label for="Cate_name">Tên danh mục</label>
          <input type="text" class="form-control" value="{{old('Cate_name')}}" id="Cate_name" name="Cate_name" placeholder="Tên danh mục...">
         <span class="form-message"></span>
        </div>
        <div class="form-group ">
          <label>Hình ảnh</label>
          <input type="file" name="thumb" onchange="ImagesFileAsURL('thumb','displayImg');"  id='thumb' class="form-control" >
          <span class="form-message"></span>
          <div id="displayImg">

          </div>
      </div>

        <button type="submit" class="form-submit btn btn-primary">Thêm</button>
      </form>

@endsection 
<script>
   const obj_category=JSON.parse('<?= $categorys?>')
  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-add-category',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
              Validator.isRequired('#Cate_name', 'Vui lòng nhập tên danh mục'),
              
              Validator.isCheck('#Cate_name',obj_category,'Tên loại sản phẩm đã tồn tại'),
              Validator.isRequired('#thumb', 'Vui lòng chọn ảnh'),
              Validator.isImage('#thumb','Hình ảnh phải là jpg,jpeg hoặc png'),
          ],

      })
  });
</script>
