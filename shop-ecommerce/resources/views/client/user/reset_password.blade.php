<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng Nhập</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--===============================================================================================-->	
        <link rel="icon" type="image/png" href="{{asset('template/images/icons/favicon.ico')}}"/>
        <link rel="stylesheet"href="{{asset('template/css/login_style.css')}}">
        <script src="{{asset('template/vendor/jquery/jquery-3.2.1.min.js')}}"></script> 
        <script src="{{asset('/template/vendor/sweetalert/sweetalert.min.js')}}"></script>
        
    </head>
    <body>
        <div class="main">

            <form  method="POST" class="form" id="form-reset-password">
              <h3 class="heading">Quên Mật Khẩu</h3>
              <p class="desc">Vui Lòng Cung Cấp Thông Tin Trung Thực</p>
        
              <div class="spacer"></div>
        
              
              <div class="form-group">
                <label for="email" class="form-label">Nhập Lại Email Đăng Ký Tài Khoản:</label>
                <input id="email" name="email" type="text" placeholder="VD: email@domain.com" class="form-control">
                <span class="form-message"></span>
            </div>
              <div class="form-group">
                <label for="new_password" class="form-label">Mật Khẩu Mới</label>
                <input id="new_password" name="new_password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                <span class="form-message"></span>
              </div>
        
              <div class="form-group">
                <label for="password_confirmation" class="form-label">Nhập Lại Mật Khẩu Mới</label>
                <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" type="password" class="form-control">
                <span class="form-message"></span>
              </div>
        
              <button type="submit" class="form-submit" >Đổi Mật Khẩu</button>
           
            </form>
            
        
          </div>
          <script src="{{asset('template/js/validator.js')}}"></script>
          <script>
        
            document.addEventListener('DOMContentLoaded', function () {
        
             Validator({
                form: '#form-reset-password',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                  Validator.isRequired('#new_password'),
                  Validator.isRequired('#password_confirmation'),
                  Validator.minLength('#new_password', 6),
                  Validator.isConfirmed('#password_confirmation', function () {
                    return document.querySelector('#form-reset-password #new_password').value;
                  }, 'Mật khẩu nhập lại không chính xác')
                ],
                onSubmit: function(data) {
                    $.ajax({
                        type: 'POST',
                        datatype: 'JSON',
                        data: $('#form-reset-password').serialize(),
                        url: '/login/reset-password/',
                        success: function(respond) {

                            if (respond.error === true ) {
                                swal("Ôi Không",
                                    "Dường Mã Không Thể Đổi Mật Khẩu Mới",
                                    "error");
                            } else 
                                swal("Thành Công",
                                    "Đổi Mật Khẩu Thành Công", "success");
                                    setTimeout(() => {window.location="/login"}, 1200)
                           
                        }
                    })
                }
                
              });

            });
        
          </script>
           <script src="{{asset('template/js/ajax.js')}}"></script>
    </body>
</html>