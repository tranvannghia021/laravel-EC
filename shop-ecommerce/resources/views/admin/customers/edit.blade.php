@extends('admin.layout.layout')
@section('title')
    {{ $title }}
@endsection

@section('main-content')

        <div class="card card-success  " style="padding:1em 8em;min-height: ">
            <div class="card-header">
                <h3 class="card-title">Sửa Khách Hàng</h3>
    
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="" id="form-edit-products" class="row">

                    <!-- text input -->
                    <input type="hidden" class="form-control" name='id' value="{{$customer_edit->id}}">
                    <div class="form-group col-sm-6">
                        <label>Họ Khách Hàng</label>
                        <input type="text" name='first_name' id="first_name" class="form-control" value="{{$customer_edit->first_name}}">
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Tên Khách Hàng</label>
                        <input type="text" name="last_name"  id="last_name" class="form-control" value="{{$customer_edit->last_name}}">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group col-sm-6">
                        @php $genders=['Khác', 'Nữ','Nam']; @endphp
                        <label>Giới Tính</label>
                        <select class="form-control" name="gender">
                            @foreach($genders as $gender)
                            <option value="{{$gender}}"
                             {{  ($customer_edit->gender == $gender) ? 'selected' : '' }}
                            
                            >{{$gender}}</option>
                            @endforeach


                       
                       
                        </select>
                        
                        
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Số Điện Thoại:</label>
                        <input type="text" name='phone'  id='phone' class="form-control" value="{{$customer_edit->phone}}">
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Email:</label>
                        <input type="text" name="email"  id="email" class="form-control" value="{{$customer_edit->email}}">
                        <span class="form-message"></span>
                    </div>

                    <!-- text input -->
                  
                    <div class="form-group col-sm-12">
                        <label>Địa Chỉ:</label>
                        <input type="text" name="address"  id="address" class="form-control" value="{{$customer_edit->address}}">
                        <span class="form-message"></span>
                    </div>
                   
                    <div class="form-group col-sm-12">
                        <label>Hoạt Động</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" type="radio" id="active" name="status"   {{ $customer_edit->status=== 1 ? 'checked' : '' }}>
                            <label for="active" class="custom-control-label">Có</label>
                          
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" type="radio" id="no_active" name="status"   {{ $customer_edit->status === 0 ? 'checked' : '' }}>
                            <label for="no_active" class="custom-control-label"
                          
                            >Không</label>
                        </div>
                    </div>                 

                            @csrf
                            <div class="col-sm-3"></div>
                            <button type="submit" class="form-submit btn btn-success col-sm-6"> Sửa Thông Tin Khách Hàng</button>
                            <div class="col-sm-3"></div>
                </form>
                        <!-- /.card-body -->
            </div>
            
           

        </div>
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Validator({
                form: '#form-edit-products',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#last_name', 'Vui lòng nhập tên Khách Hàng'),
                    Validator.isRequired('#first_name', 'Vui lòng nhập họ Khách Hàng'),
                    Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại'),
                    Validator.isRequired('#email', 'Vui lòng nhập email'),
                    Validator.isRequired('#address', 'Vui lòng nhập địa chỉ'),
                    Validator.isEmail('#email'),
                    Validator.isPhoneNumber('#phone'),
                  
                ],
                onSubmit: function (data) {   
                    console.log(data); 
                    $.ajax({
                    type: 'POST',
                    datatype: 'JSON',
                    data: data,
                    url: '/admin/customers/edit/{id}',
                    success: function (respond) {
                        
                        console.log(respond.error)
                        console.log(respond.message)

                        if (respond.error === false ) {                       
                            swal("Cập Nhật Thành Công", "Khách Hàng Đã Được Cập Nhật", "success");
                           setTimeout(() => {window.location="/admin/customers/list"}, 1200);
                        } 
                        else  {
                            swal("Cập Nhật Thất Bại", "Email Đã Tồn Tại Vui Lòng Chọn Email Khác", "error")
                           
                        }
                    }
                })

                }//nếu 
                //nếu muốn submit theo hành vi mặc định của form thì rào cái này lại
            });
        });
    </script>
