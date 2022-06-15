@extends('admin.layout.layout') 
@section('title')
{{$title}}
@endsection 

@section('main-content')

  <div class="row">
    <div class="col-md-4">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Chi tiết nhập hàng</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          
          <form id="form-add-import" method="post">

            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name_provider">Tên nhà cung cấp</label>
                <select name="name_provider" class="form-control" id="name_provider">
                  <option value="">Chọn nhà cung cấp</option>
                    @foreach($providers as $provider)
                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                    @endforeach
                </select>
               <span class="form-message"></span>

              </div>
              <div class="form-group">
                <label for="category">Loại sản phẩm</label>
                <select name="category"  class="form-control" id="category" onchange="searchProduct(this.value);">
                  <option value="">Chọn loại sản phẩm</option>
                    @foreach($categorys as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
               <span class="form-message"></span>


              </div>
              <div class="form-group">
                <label for="product">Sản phẩm</label>
                <select name="product" class="dataload form-control" id="product">
               
                </select>
                <span class="form-message"></span>

              </div>
              <div class="form-group">
                <label for="amount">Số lượng</label>
               <input type="number" min="0"  class="form-control" id="amount" placeholder="Số lượng..." name="amount">
                <span class="form-message"></span>
              </div>
              
              <div class="form-group">
                <label for="price">Giá nhập về</label>
               <input type="text"  class="form-control" id="price" placeholder="Giá..." name="price">
               <span class="form-message"></span>
                
              </div>
           
            </div>
            <!-- /.card-body -->
            
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
          </form>
         
        </div>
       

      </div>
      <div class="card card-primary col-md-8">
        <div class="card-header">
          <h3 class="card-title">Hóa đơn nhập hàng</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                
                <th style="width: 10px">STT</th>
                <th>Tên nhà cung cấp</th>
                <th>Loại sản phẩm</th>
                <th >Tên sản phẩm</th>
                <th >Số lượng</th>
                <th >giá nhập</th>
                <th >#</th>
              </tr>
            </thead>
            <tbody id="js_show_import">
          
            {!! \App\Helpers\Helper::renderImports($imports)!!}
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer float-right">
          <form action="" method="post" id="form-add-importdb">
            <button type="submit"  class="btn btn-primary">nhập hàng</button>

          </form>
        </div>
      </div>
     
</div>


<script>  

const obj_product =JSON.parse('<?= $productsAll ; ?>')
const product=document.getElementById('product')
console.log(obj_product);


var html=obj_product.map(o =>{
    return `<option value="${o.id}">${o.name}</option>`;
  });
 var str= html.join('');
 product.innerHTML=str;

</script>

@endsection
<script>
  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-add-import',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isRequired('#name_provider', 'Vui lòng chọn nhà cung cấp'),
            Validator.isRequired('#category', 'Vui lòng chọn loại sản phẩm'),
            Validator.isRequired('#product', 'Vui lòng chọn sản phẩms'),
            Validator.isRequired('#amount', 'Vui lòng nhập số lượng'),
            Validator.isRequired('#price', 'Vui lòng nhập giá'),
            Validator.isNumber('#price','Vui lòng nhập giá không âm'),
          ],
          onSubmit: function (data) {    
              $.ajax({
              type: 'POST',
              datatype: 'JSON',
              data: $('#form-add-import').serialize(),
              url: '/admin/imports/add',
              success: function (respond) {
                  

                  if (respond.error !== true ) {                       
                      swal("Thêm Thành Công",respond.message, "success");
                     setTimeout(() => {location.reload()}, 1200);
                  } 
                  else  {
                      swal("Thêm Thất Bại", respond.message, "error");
                     
                  }
              }
          })

          }
      });
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-add-importdb',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
           
          ],
          onSubmit: function (data) {    
              $.ajax({
              type: 'POST',
              datatype: 'JSON',
              data: null,
              url: '/admin/imports/addDB',
              success: function (respond) {
                  

                  if (respond.error !== true ) {                       
                      swal("Thành Công",respond.message, "success");
                     setTimeout(() => {window.location.href='/admin/imports/list'}, 1200);
                  } 
                  else  {
                      swal("Thất Bại", respond.message, "error");
                     
                  }
              }
          })

          }
      });
  });
</script>