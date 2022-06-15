
<!DOCTYPE html>
<html lang="en">
<head>
	@include('admin.user.head')
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178 form" id="form-login-admin" >
					<span class="login100-form-title">
						ĐĂNG NHẬP
					</span>

					<div class=" form-group wrap-input100 validate-input m-b-16 email-message-error " data-validate="Vui lòng nhập email" data-error="Email Không Tồn Tại hoặc Bị Khoá">
						<input class="input100" type="email" name="email" id="email" placeholder="Email">
						<span class="focus-input100"></span>			
					</div>
					<div class="form-group wrap-input100 validate-input password-message-error" data-validate = "Vui lòng nhập mật khẩu"  data-error="Mật Khẩu Không Chính Xác">
						<input class="input100" type="password" id="password" name="password" placeholder="Mật Khẩu">
						<span class="focus-input100"></span>

					</div>
					@csrf 
					
					<div class="container-login100-form-btn">
						<button type="button" class="login100-form-btn" id="btn-form-login-admin">
							Đăng Nhập
						</button>
					</div>
					<div class="flex-col-c p-t-100 p-b-40">
						
					</div>
				
				</form>
			</div>
		</div>
	</div>
	
	@include('admin.user.footer')
	<script type="text/javascript">
	
		
 		 /*
	  document.addEventListener('DOMContentLoaded', function () {
		// Mong muốn của chúng ta
		Validator({
		  form: '#form-login-admin',
		  formGroupSelector: '.form-group',
		  errorSelector: '.form-message',
		  rules: [
			//Validator.isRequired('#username', 'Vui lòng nhập đúng tên đăng nhập'),
			Validator.minLength('#password', 6),
			Validator.isRequired('#username',"Vui lòng nhập trường này"),
			Validator.isRequired('#password',"Vui lòng nhập trường này"),
		  ],
		  onSubmit: function (data) {
			// Call API
			console.log(data);
		  }//nếu muốn submit theo hành vi mặc định của form thì rào cái này lại
		});
		// Form này hoat dộng tốt

	});*/
	</script>
</body>
</html>

