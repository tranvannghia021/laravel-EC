@extends('admin.layout.layout') 
@section('title')
{{$title}}
@endsection 
@section('infoStaff')
<a href="#" class="d-block">{{$staff->first_name }} {{ $staff->last_name }}</a>

@endsection

@section('js-ckeditor')
<script src="{{asset('ckeditor/ckeditor.js')}}">
</script>
<script>
    CKEDITOR.replace( 'description' );

</script>
@endsection
 {{-- content  --}}
 
@section('main-content')
  <!-- Content Wrapper. Contains page content -->
    {{-- code --}}
        
        <div class="text-center ">
          <h1>Thêm sản phẩm</h1>
        </div>
      
            @if(Session::has('error'))
            <div class="text-center">
              <p class="alert alert-dangger">{{Session::get('error')}}</p>
            </div>
            @endif
        <form action="" method="POST" class="m-2"  id="form-add-product" enctype="multipart/form-data" >
          
            @csrf
              <div class="form-group">
                <label for="product_name">Tên sản phẩm</label>
                <input type="text" class="form-control" value="{{old('Product_name')}}" id="product_name" name="Product_name" placeholder="Tên sản phẩm...">
                <span class="form-message"></span>

              </div>
              
            <div class="form-group">
              <label  >Tên danh mục</label>
              <select class="form-control" id="category" name="Category" value="{{old('Category')}}">
                  @foreach ($categorys as $key => $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                      
                  @endforeach
              </select>
              <span class="form-message"></span>

            </div>

            
            <div class=" row form-group">
              <div class="form-group col-sm-4">
                        <label for="code_color">Màu</label>
                        <input type="color" class="form-control" id="code_color" value="{{old('Code_color')}}" name="Code_color" >
                        <span class="form-message"></span>

                    </div>
                    <div class="form-group col-sm-4">
                        <label for="amount">Số lượng</label>
                        <input type="text" class="form-control" id="amount" value="{{old('Amount')}}" placeholder="Số lượng..." name="Amount" >
                        <span class="form-message"></span>

                    </div>
                    <div class="form-group col-sm-4">
                        <label for="price">Giá</label>
                        <input type="text" class="form-control" id="price" value="{{old('Price')}}" placeholder="Giá sản phẩm..." name="Price" >
                        <span class="form-message"></span>

                    </div>
               
            </div>
            
            <div class="form-group">
                <label for="description">Chi tiết sản phẩm</label>
                <textarea  class="form-control" id="description" name="Description" >{{old('Description')}}</textarea>
            </div>
            
            <div class="form-group">
                <label for="">Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="1" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" >
                    <label for="no_active" class="custom-control-label">Không</label>
                  </div>
            </div>
            
              <div class="form-group">
                <label for="img_link">Hình ảnh</label>
                <input type="file"  value="{{old('Img_link')}}" onchange="ImagesFileAsURL('img_link','displayImg');" class="form-control" id="img_link" name="Img_link"  placeholder="" >
                <span class="form-message"></span>
                <div id="displayImg">

                </div>
                
              </div>
              
              <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
      

@endsection 

<script>
 
 const obj_product=JSON.parse('<?= $products?>');
 console.log(obj_product);
  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-add-product',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
              Validator.isRequired('#product_name', 'Vui lòng nhập tên sản phẩm'),
              Validator.minLength('#product_name',3),
             Validator.isCheck('#product_name',obj_product,'Tên sản phẩm đã tồn tại'),
              Validator.isRequired('#category', 'Vui lòng chọn danh mục'),
              Validator.isRequired('#amount','Vui lòng nhập số lượng'),
              Validator.isNumber('#amount','Số lượng phải là số dương'),
              Validator.isRequired('#price','Vui lòng nhập giá'),
              Validator.isNumber('#price','Giá phải là số dương'),
              Validator.isRequired('#img_link','Vui lòng chọn ảnh'),
              Validator.isImage('#img_link','Hình ảnh phải là jpg,jpeg hoặc png'),



          ],

      })
  });
</script>
