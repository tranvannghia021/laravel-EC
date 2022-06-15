$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/*------------------------------------Login_Admin-------------------------*/

function showError(input) {
    var thisAlert = $(input).parent();

    $(thisAlert).addClass('alert-error');
}

function hideValidate(input) {
    var thisAlert = $(input).parent();

    $(thisAlert).removeClass('alert-error');
}
// focus ẩn message error
$('.validate-form .input100').each(function(){
    $(this).focus(function(){
       hideValidate(this);
    });
});
$(document).ready(function(){

    //ONCHANGE  2 cái đều phải có
    $('#form-login-admin').change(function () {
                $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: $('#form-login-admin').serialize(),
                url: '/admin/user/login/store',
                success: function (respond) {
                    
                    if (respond.error === true) {                       
                        if(respond.fail_node == 'email') {
                           let input=document.querySelector('input[type=email]');
                           showError(input)
                        }  
                        else if(respond.fail_node == 'password') {
                            let input=document.querySelector('input[type=password]');
                            showError(input)
                           
                        }
                    } 
                }
            })
    })
    // ONCLICK 2 cái đều phải có
    $('#btn-form-login-admin').click(function () {
       
                  $.ajax({
                  type: 'POST',
                  datatype: 'JSON',
                  data: $('#form-login-admin').serialize(),
                  url: '/admin/user/login/store',
                  success: function (respond) {
                      
                      if (respond.error === true) {                       
                          if(respond.fail_node == 'email') {
                             let input=document.querySelector('input[type=email]');
                             showError(input)
                          }  
                          else if(respond.fail_node == 'password') {
                              let input=document.querySelector('input[type=password]');
                              showError(input)
                          }
                      } else {
                         
                          if(respond.fail_node == null)   swal("Chào Bạn", "Bạn Đã Đăng Nhập Thành Công", "success");
                          setTimeout(() => {window.location="/admin"}, 2000);
                          
                      }
                  }
              })
      })
})
/*===----REGISTERY CUSTOMER------*/
/*Hàm ẩn messa on focus*/

/*     var input=document.querySelector('.form-group .from-email-registery')
        input.focus(()=>{
            input.removeClass('invalid-emai')
        })*/
       

/*Ajax
$('#form-submit-registery').click(function () {
    
    $.ajax({
    type: 'POST',
    datatype: 'JSON',
    data: $('#form-registery').serialize(),
    url: '/registery/store/',
    success: function (respond) {
        
        if (respond.error === true && respond.fail_node === 'email') {                       
            let input=document.querySelector('.form-group .form-message-email');
            input.innerText=respond.message
            input.classList.add('invalid-email')
            
        } 
        else if (respond.error === false) {
            swal("Chào Bạn", "Bạn Đã Đăng Ký Tài Khoản Thành Công", "success");
            setTimeout(() => {window.location="/login"}, 1600);
        }
    }
    })
})

/* Login Customer */
$('#form-submit-login').click(function () {
    console.log('CLick Click')

    
})

// search rating

