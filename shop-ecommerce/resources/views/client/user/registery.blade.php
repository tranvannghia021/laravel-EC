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

        <form class="form" id="form-registery">
            <h3 class="heading">ĐĂNG KÝ TÀI KHOẢN</h3>
            <p class="desc">TRESOR ❤️</p>

            <div class="spacer"></div>

            <div class="form-group">
                <label for="firstname" class="form-label">Họ</label>
                <input id="firstname" name="firstname" type="text" placeholder="VD: Nguyễn" class="form-control">
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <label for="lastname" class="form-label">Tên</label>
                <input id="lastname" name="lastname" type="text" placeholder="VD: Minh Huy" class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="text" placeholder="VD: email@domain.com"
                    class="form-control from-email-registery">
                <span class="form-message form-message-email"></span>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu</label>
                <input id="password" name="password" type="password" placeholder="Nhập Mật Khẩu" class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                <input id="password_confirmation" name="password_confirmation" placeholder="Nhập Lại Mật Khẩu"
                    type="password" class="form-control">
                <span class="form-message"></span>
            </div>
            @csrf
            <button type="submit" class="form-submit" id="form-submit-registery">Đăng Ký</button>
        </form>



    </div>

    <script src="{{ asset('template/js/validator.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mong muốn của chúng ta
            Validator({
                form: '#form-registery',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#firstname', 'Vui lòng nhập họ đầy đủ của bạn'),
                    Validator.isRequired('#lastname', 'Vui lòng nhập tên đầy đủ của bạn'),
                    Validator.isEmail('#email'),
                    Validator.minLength('#password', 6),
                    Validator.isRequired('#password_confirmation'),
                    Validator.isConfirmed('#password_confirmation', function() {
                        return document.querySelector('#form-registery #password').value;
                    }, 'Mật khẩu nhập lại không chính xác')
                ],
                onSubmit: function(data) {
                    $.ajax({
                        type: 'POST',
                        datatype: 'JSON',
                        data: $('#form-registery').serialize(),
                        url: '/registery/store/',
                        success: function(respond) {

                            if (respond.error === true && respond.fail_node === 'email') {
                                let input = document.querySelector(
                                    '.form-group .form-message-email');
                                input.innerText = respond.message
                                input.classList.add('invalid-email')

                            } else if (respond.error === false) {
                                swal("Chào Bạn", "Bạn Đã Đăng Ký Tài Khoản Thành Công",
                                    "success");
                                setTimeout(() => {
                                    window.location = "/login"
                                }, 1600);
                            }
                        }
                    })
                }

            });

        });
    </script>
    <script src="{{ asset('template/js/ajax.js') }}"></script>
</body>

</html>
