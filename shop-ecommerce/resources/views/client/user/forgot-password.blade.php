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

        <form method="POST" class="form" id="form-forgot-password">
            <h3 class="heading">Quên Mật Khẩu</h3>
            <p class="desc">Vui Lòng Cung Cấp Thông Tin Trung Thực</p>

            <div class="spacer"></div>

            <div class="form-group">
                <label for="email" class="form-label">Nhập Email Đăng Ký</label>
                <input id="email" name="email" type="text" placeholder="VD: email@domain.com" class="form-control">
                <span class="form-message"></span>
            </div>
                @csrf
                <button type="submit" class="form-submit" >Gửi Mã Xác Nhận</button>

        </form>


    </div>
    <script src="{{ asset('template/js/validator.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            Validator({
                form: '#form-forgot-password',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isEmail('#email'),
                    Validator.isRequired('#email'),
                ],
                onSubmit: function(data) {
                    $.ajax({
                        type: 'POST',
                        datatype: 'JSON',
                        data: $('#form-forgot-password').serialize(),
                        url: '/login/forgot-password/',
                        success: function(respond) {

                            if (respond.error === true ) {
                                swal("Ôi Không",
                                    "Dường Như Email Của Bạn Không Tồn Tại hoặc Bị Khoá Rồi!",
                                    "error");
                            } else 
                                swal("Email Chính Xác",
                                    "Mã Xác Nhận Đã Được Gửi Đến Email Của Bạn", "success");
                                    setTimeout(() => {window.location="/login/forgot-password/send-otp"}, 1100)
                           
                        }
                    })
                }

            })

        })
    </script>
    <script src="{{ asset('template/js/ajax.js') }}"></script>
</body>

</html>
