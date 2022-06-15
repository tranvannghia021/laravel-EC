@extends('admin.layout.layout')
@section('title')
    {{ $title }}
@endsection

@section('main-content')

    <div class=" row">
        <div class="col-md-7 card">
          <div class="card-header">
            <h3 class="card-title">Danh Sách Các Quyền</h3>
            <div class="card-tools">
              <button class="btn btn-dark" onclick="document.getElementById('form-add-role').style.display='block'">Thêm Quyền</button>
          
          </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 15%" >Mã Quyền</th>
                  <th style="width: 50%" >Tên QUyền</th>
                  <th style="width: 35%">Thao Tác</th>
                </tr>
              </thead>
              <tbody>
                {!! \App\Helpers\Helper::renderListRoles($listRoles)!!}
         
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-5 card">
          <div class="card-header">
            <h3 class="card-title">Danh Sách Các Chức Vụ</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 25%" >Mã </th>
                  <th style="width: 70%" >Tên Chức Vụ</th>
                
                </tr>
              </thead>
              <tbody>
                {!! \App\Helpers\Helper::renderListPermissions($listPermissions)!!}
         
              </tbody>
            </table>
          </div>
        </div>
        {!! \App\Helpers\Helper::renderPopupViewItemRole($listRoles) !!}

        <form id="form-add-role" class="modal" data-staff=" popup-detail-staff-2" style="display: none;" method="post">

          <div class="modal-content animate  card card-primary">

          <div class="card-header">
            <h3 class="card-title admin-popup-title">Thêm Quyền</h3>
            <span onclick="document.getElementById('form-add-role').style.display='none'" class="close" title="Close Modal">×</span>
          </div>

            <div class="card-body pd-45 row">
              <div class="form-group col-md-12">
                <label for="name">Tên Quyền</label>
                <input type="text" class="form-control" name="name"  id="name" placeholder="Nhập tên quyền">
                <span class="form-message"></span>
              </div>
              <div class="form-group">
                <label for="name-permission">Chức Năng</label>
                {!! \App\Helpers\Helper::renderOptionPermission($listPermissions) !!}
             
               
              </div>            

             
            </div>
            @csrf
            <div class="card-footer row">
              <div class="col-md-5"></div>
              <button type="submit" class="btn btn-success col-md-2">Thêm</button>
              <div class="col-md-5"></div>
            </div>
            <!-- /.card-body -->
          
        </div>
             
      </form>

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
              url: '/admin/roles/add',
              success: function (respond) {
                  console.log(respond.message)

                  if (respond.error !== true ) {                       
                      swal("Thêm Thành Công", "Quyền Đã Được Thêm", "success");
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