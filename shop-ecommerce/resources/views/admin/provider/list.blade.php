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
            <h3 class="card-title">Thêm nhà cung cấp</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          
          <form id="form-add-provider" method="post">

            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name_provider">Tên nhà cung cấp</label>
                <input type="text" class="form-control" id="name_provider" value="{{$name}}" name="name" placeholder="Tên nhà cung cấp...">
                <span class="form-message"></span>
              </div>
              <div class="form-group">
                <label for="address_provider">Địa chỉ</label>
                <input type="text" class="form-control" id="address_provider" value="{{$address}}" name="address" placeholder="Địa chỉ...">
                <span class="form-message"></span>

              </div>
              <div class="form-group">
                <label for="phone_provider">Số điện thoại</label>
                <input type="text" class="form-control" id="phone_provider" value="{{$phones}}" name="phone" placeholder="Số điện thoại...">
                <span class="form-message"></span>

              </div>
           
            </div>
            <!-- /.card-body -->
            <input type="hidden" name="id" value="{{$id_provider}}">
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">{{$name_btn}}</button>
            </div>
          </form>
         
        </div>
       

      </div>
      <div class="card card-primary col-md-8">
        <div class="card-header">
          <h3 class="card-title">Danh sách nhà cung cấp</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 10px">STT</th>
                <th>Tên nhà cung cấp</th>
                <th>Số điện thoại</th>
                <th >địa chỉ</th>
                <th >#</th>
              </tr>
            </thead>
            <tbody id="body">
              @foreach($providers as $key => $provider)
              <tr>
                <td>{{++$key}}</td>
                <td>{{$provider->name}}</td>
                <td>{{$provider->phones}}</td>
                
              <td>{{$provider->address}}</td>
              <td>
                <a class="btn btn-primary btn-sm" href="/admin/providers/list/{{ $provider->id }}">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{ $provider->id }}, '/admin/providers/destroy')">
                 <i class="fas fa-trash"></i>
                </a>
              </td>
              </tr>
             @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>

<script>

const obj_product=JSON.parse('<?= $providers ?>');

</script>
@if($id_cript==0)
<script>

  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-add-provider',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
              Validator.isRequired('#name_provider', 'Vui lòng nhập tên nhà cung cấp'),
              Validator.isCheck('#name_provider',obj_product,'Tên nhà cung cấp đã có'),
              Validator.minLength('#name_provider',6),
              Validator.isRequired('#address_provider', 'Vui lòng nhập địa chỉ'),
              Validator.isRequired('#phone_provider', 'Vui lòng nhập số điện thoại'),
              Validator.isPhoneNumber('#phone_provider'),
              
          ],
          onSubmit: function (data) {    
              $.ajax({
              type: 'POST',
              datatype: 'JSON',
              data: $('#form-add-provider').serialize(),
              url: '/admin/providers/add',
              success: function (respond) {
                  

                  if (respond.error !== true ) {                       
                      swal("Thêm Thành Công",respond.message, "success");
                     //setTimeout(() => {console.log(respond.providers);}, 1200);
                     const body=document.getElementById('body');
                     document.getElementById("form-add-provider").reset();
                     var i=0;
                     var html=respond.providers.map(e=>{
                      i++;
                            return `  <tr>
                      <td>${i}</td>
                      <td>${e.name}</td>
                      <td>${e.phones}</td>
                      
                    <td>${e.address}</td>
                    <td>
                      <a class="btn btn-primary btn-sm" href="/admin/providers/list/${e.id}">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="#" class="btn btn-danger btn-sm" onclick="removeRow(${e.id}, '/admin/providers/destroy')">
                      <i class="fas fa-trash"></i>
                      </a>
                    </td>
                    </tr>`;
                  
                     });
                     body.innerHTML=html.join('')
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
@else
<script>
  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-add-provider',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
              Validator.isRequired('#name_provider', 'Vui lòng nhập tên nhà cung cấp'),
              Validator.minLength('#name_provider',6),
              Validator.isRequired('#address_provider', 'Vui lòng nhập địa chỉ'),
              Validator.isRequired('#phone_provider', 'Vui lòng nhập số điện thoại'),
              Validator.isPhoneNumber('#phone_provider'),
              
          ],
          onSubmit: function (data) {    
              $.ajax({
              type: 'POST',
              datatype: 'JSON',
              data: $('#form-add-provider').serialize(),
              url: '/admin/providers/list/{id}',
              success: function (respond) {
                  

                  if (respond.error !== true ) {                       
                      swal("Cập nhập Thành Công",respond.message, "success");
                     setTimeout(() => {window.location.href='/admin/providers/list'}, 1200);
                  } 
                  else  {
                      swal("Cập nhập Thất Bại", respond.message, "error");
                     
                  }
              }
          })

          }
      });
  });
</script>
@endif
@endsection


