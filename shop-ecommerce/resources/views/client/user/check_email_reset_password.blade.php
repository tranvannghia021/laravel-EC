<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('template/images/icons/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('template/css/login_style.css') }}">
    <script src="{{ asset('template/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/template/vendor/sweetalert/sweetalert.min.js') }}"></script>

</head>

<body>
    <div class="main">

        <form method="POST" class="form" id="form-forgot-password2">
            <h3 class="heading">Nhập Mã Xác Thực</h3>
            <p class="desc">Vui Lòng Cung Cấp Thông Tin Trung Thực</p>

            <div class="spacer"></div>

            <div class="form-group">
                <label for="otp" class="form-label">Nhập Xác Thực:</label>
                <input id="otp" name="otp" type="text" placeholder="VD: email@domain.com" class="form-control">
                <span class="form-message"></span>
                @csrf
                <button type="submit" class="form-submit" >Xác Thực</button>

        </form>


    </div>
    <script src="{{ asset('template/js/validator.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            Validator({
                form: '#form-forgot-password2',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#otp'),
                ],
                onSubmit: function(data) {
                    $.ajax({
                        type: 'POST',
                        datatype: 'JSON',
                        data: $('#form-forgot-password2').serialize(),
                        url: '/login/forgot-password/send-otp',
                        success: function(respond) {

                            if (respond.error === true ) {
                                swal("Ôi Không",
                                    "Dường Mã Xác Thực Không Đúng",
                                    "error");
                            } else 
                                swal("Mã Xác Thực Chính Xác",
                                    "Tiến Hành Nhập Mật Khẩu Mới", "success");
                                    setTimeout(() => {window.location="/login/reset-password/"}, 1200)
                           
                        }
                    })
                }

            })

        })
    </script>
    <script src="{{ asset('template/js/ajax.js') }}"></script>
</body>

</html>
