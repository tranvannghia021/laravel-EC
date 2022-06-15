@extends('admin.layout.layout')
@section('title')
    {{ $title }}
@endsection

@section('main-content')
<form id="form-add-role"  data-staff=" popup-detail-staff-2" method="post">

    <div class="modal-content card card-primary">

    <div class="card-header">
      <h3 class="card-title admin-popup-title">Sửa Quyền</h3>
    </div>

      <div class="card-body pd-45 row">
        <input type="hidden" class="form-control" value="{{$Roles->id}}" name="id"   >
        <div class="form-group col-md-12">
          <label for="name">Tên Quyền</label>
          <input type="text" class="form-control" value="{{$Roles->name}}" name="name"  id="name" placeholder="Nhập tên quyền">
          <span class="form-message"></span>
        </div>
        <div class="form-group">
          <label for="name-permission">Chức Năng</label>
          {!! \App\Helpers\Helper::renderOptionPermissionEdit($listPermissions,$listPermissionschecked) !!}
       
         
        </div>            

       
      </div>
      @csrf
      <div class="card-footer row">
        <div class="col-md-5"></div>
        <button type="submit" class="btn btn-success col-md-2">Cập Nhật</button>
        <div class="col-md-5"></div>
      </div>
      <!-- /.card-body -->
    
  </div>

@endsection
<script>
  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-add-role',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
              Validator.isRequired('#name', 'Vui lòng nhập tên quyền'),
            
          ],
          onSubmit: function (data) {    
              $.ajax({
              type: 'POST',
              datatype: 'JSON',
              data: $('#form-add-role').serialize(),
              url: '/admin/roles/edit/{id}',
              success: function (respond) {
                  console.log(respond.message)

                  if (respond.error !== true ) {                       
                      swal("Cập Nhật Thành Công", "Quyền Đã Được Cập Nhật", "success");
                     setTimeout(() => {window.location="/admin/roles/list"}, 1200);
                  } 
                  else  {
                      swal("Thêm Thất Bại", "Quyền Đã Tồn Tại", "error");
                     
                  }
              }
          })

          }//nếu 
          //nếu muốn submit theo hành vi mặc định của form thì rào cái này lại
      });
  });
</script>