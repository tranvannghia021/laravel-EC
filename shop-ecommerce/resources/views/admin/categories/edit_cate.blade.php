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
        <h1>Sửa danh mục</h1>
      </div>
       
      @if(Session::has('error'))
      <div class="text-center">
        <p class="alert alert-dangger">{{Session::get('error')}}</p>
      </div>
      @endif
    @foreach($cates as $cate)
    <form action="" method="POST" class="m-2" id="form-edit-category" enctype="multipart/form-data">
      @include('admin.user.messeger')
        @csrf
        <div class="form-group">
          <label for="Cate_name">Tên danh mục</label>
          <input type="text" class="form-control" value="{{$cate->name}}" id="Cate_name" name="Cate_name" placeholder="Tên danh mục...">
          <span class="form-message"></span>
        </div>

        <div class="form-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="thumb" name="thumb"  onchange="ImagesFileAsURL('thumb','displayImg');GetValuefile('thumb','js-show-file');">
            <label class="custom-file-label"id="js-show-file" for="thumb">{{$cate->thumb}}</label>
           </div>
           <span class="form-message"></span>
          <div id="displayImg">
          
            <a href="{{asset('storage/categories/'.$cate->thumb)}}" target="_blank">
              <img src="{{asset('storage/categories/'.$cate->thumb)}}" width="100px">
            </a>
          </div>
          <input type="hidden" name="img" value="{{$cate->thumb}}" id="img">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhập</button>
      </form>
 @endforeach
@endsection 
<script>
  
  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-edit-category',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
              Validator.isRequired('#Cate_name', 'Vui lòng nhập tên danh mục'),
             
              
             // Validator.isRequired('#thumb', 'Vui lòng chọn ảnh'),
              //Validator.isImage('#thumb','Hình ảnh phải là jpg,jpeg hoặc png')
          ],

      })
  });
</script>