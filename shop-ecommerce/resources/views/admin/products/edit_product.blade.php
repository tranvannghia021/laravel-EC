
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
        <h1>Cập nhập sản phẩm</h1>
      </div>
    
      @if(Session::has('error'))
      <div class="text-center">
        <p class="alert alert-dangger">{{Session::get('error')}}</p>
      </div>
      @endif
    <form action="" method="POST" id="form-edit-product" class="m-2" enctype="multipart/form-data">

        @csrf
        <div class="form-group">
          <label for="product_name">Tên sản phẩm</label>
          <input type="text" class="form-control" value="{{$product['name_product']}}" id="product_name" name="Product_name" placeholder="Tên sản phẩm...">
        <span class="form-message"></span>
        </div>
        <div class="form-group">
          <label  >Tên danh mục</label>
          <select class="form-control" name="Category" id="category">
            @foreach ($categorys as $category)
            <option value="{{$category->id}}"{{$product['cate_id']==$category->id ?'selected': ''}}>{{$category->name}}</option>
                
            @endforeach
        </select>
        <span class="form-message"></span>

        </div>

        
        <div class="row form-group">
         
           
                <div class="form-group col-sm-4">
                    <label for="code_color">Màu</label>
                     <input type="color" class="form-control" id="code_color" value="{{$product['code_color']}}" name="Code_color" >
                     <span class="form-message"></span>

                </div>
                <div class="form-group col-sm-4">
                    <label for="amount">Số lượng</label>
                    <input type="text" class="form-control" id="amount" value="{{$product['amount']}}" placeholder="Số lượng..." name="Amount" >
                    <span class="form-message"></span>

                 </div>
                 <div class="form-group col-sm-4">
                    <label for="price">Giá</label>
                    <input type="text" class="form-control" id="price" value="{{$product['price']}}" placeholder="Giá sản phẩm..." name="Price" >
                    <span class="form-message"></span>

                 </div>
           
            </div>

        <div class="form-group">
            <label for="description">Chi tiết sản phẩm</label>
            <textarea  class="form-control" id="description" name="Description" >{{$product['description']}}</textarea>
        </div>
        <div class="form-group">
            <label>Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                    {{ $product['active'] == 1 ? ' checked=""' : '' }}>
                <label for="active" class="custom-control-label">có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                    {{ $product['active'] == 0 ? ' checked=""' : '' }}>
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>

        
      
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="img_link" name="Img_link"  onchange="ImagesFileAsURL('img_link','displayImg');GetValuefile('img_link','js-show-file');">
              <label class="custom-file-label"id="js-show-file" for="img_link">{{$thums}}</label>
             </div>
            <span class="form-message"></span>

            <div id="displayImg">
            
              <a href="{{asset('storage/uploads/'.$thums)}}" target="_blank">
                <img src="{{asset('storage/uploads/'.$thums)}}" width="100px">
              </a>
            </div>
            <input type="hidden" name="thumb" value="{{$thums}}" id="thumb">
           
          </div>
        <button type="submit" class="btn btn-primary">Cập nhập</button>
      </form>

  
@endsection 
<script>
  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-edit-product',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
              Validator.isRequired('#product_name', 'Vui lòng nhập tên sản phẩm'),
              Validator.minLength('#product_name',3),
              Validator.isRequired('#category', 'Vui lòng chọn danh mục'),
              Validator.isRequired('#amount','Vui lòng nhập số lượng'),
              Validator.isNumber('#amount','Số lượng phải là số dương'),
              Validator.isRequired('#price','Vui lòng nhập giá'),
              Validator.isNumber('#price','Giá phải là số dương'),
             // Validator.isRequired('#img_link','Vui lòng chọn ảnh'),
             // Validator.isImage('#img_link','Hình ảnh phải là jpg,jpeg hoặc png'),



          ],

      })
  });
</script>