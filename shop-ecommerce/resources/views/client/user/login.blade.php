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

        <form method="POST" class="form" id="form-login">
            <h3 class="heading">Đăng Nhập</h3>
            <p class="desc">Chào Quý Khách</p>

            <div class="spacer"></div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="text" placeholder="VD: email@domain.com" class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật Khẩu</label>
                <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                <span class="form-message"></span>
            </div>

            <button type="submit" class="form-submit" >Đăng Nhập</button>
            <div class="footer">
                <a href="{{ Route('forgot_password') }}" class="link-item">Quên Mật Khẩu</a>
                <a href="/registery" class="link-item">Đăng Ký</a>
            </div>
        </form>


    </div>
    <script src="{{ asset('template/js/validator.js') }}"></script>
    <script>
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        document.addEventListener('DOMContentLoaded', function() {

            Validator({
                form: '#form-login',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isEmail('#email'),
                    Validator.isRequired('#password'),
                    Validator.minLength('#password', 6),
                ],
                onSubmit: function(data) {
                    $.ajax({
                        type: 'POST',
                        datatype: 'JSON',
                        data: $('#form-login').serialize(),
                        url: '/login/store/',
                        success: function(respond) {

                            if (respond.error === true && respond.fail_node === 'email') {
                                swal("Ôi Không",
                                    "Dường Như Email Của Bạn Không Tồn Tại hoặc Bị Khoá Rồi!",
                                    "error");
                            } else if (respond.error === true && respond.fail_node ===
                                'password') {
                                swal("Đăng Nhập Thất Bại",
                                    "Mật Khẩu Của Bạn Không Chính Xác!", "error");
                            } else {
                                swal("Thật Tuyệt", "Bạn Đã Đăng Nhập Thành Công!",
                                    "success");
                                setTimeout(() => {
                                    window.location = "/"
                                }, 2000);
                            }
                        }
                    })
                }

            });

        });
    </script>
    
</body>

</html>
