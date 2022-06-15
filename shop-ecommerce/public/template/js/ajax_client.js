$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// Load More 
function loadMore()
{
    var page = new Number($('#page').val());
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        data : { page },
        url : '/services/load-product',
        success : function (result) {
            
            if (result.data !== '') {
                $('#loadProduct').append(result.data);
                page=page+1;
                $('#page').val(page);
                console.dir(page);
            } else {
                alert('Đã load xong Sản Phẩm');
                $('#btnLoadMore').css('display', 'none');
            }
        }
    })
}
// CART
$('#btn-order').click(function () {
    console.log($('#form-add-order').serialize())
    
    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: $('#form-add-order').serialize(),
        url: '/carts',
        success: function (respond) {
            console.log(respond.message)

            if (respond.error !== true) {
                // swal("Đặt Hàng Thành Công", respond.message, "success");
                setTimeout(() => { window.location = "/checkout" }, 100);
            } else {
                swal("Đặt Hàng Thất Bại", respond.message, "error");

            }
        }
    })
})
// Check Out
document.addEventListener('DOMContentLoaded', function () {

    Validator({
        form: '#form-checkout',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('#last_name', 'Vui lòng nhập tên nhân viên'),
            Validator.isRequired('#first_name', 'Vui lòng nhập họ nhân viên'),
            Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại'),
            Validator.isRequired('#email', 'Vui lòng nhập email'),
            Validator.isRequired('#wards', 'Vui lòng nhập xã/phường'),
            Validator.isRequired('#provinces', 'Vui lòng chọn thành phố/tỉnh'),
            Validator.isRequired('#district', 'Vui lòng chọn quận/huyện'),
            Validator.isRequired('#address', 'Vui lòng nhập địa chỉ'),
            Validator.isEmail('#email'),
            Validator.isPhoneNumber('#phone'),

        ],
       /* onSubmit: function (data) {
            console.log(data);

            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: $('#form-checkout').serialize(),
                url: '/checkout',
                success: function (respond) {
                    console.log(respond.message)


                    if (respond.error !== true) {
                        swal("Đặt Hàng Thành Công", respond.message, "success");
                        setTimeout(() => { window.location = "/" }, 1200);
                    } else {
                        swal("Đặt Hàng Thất Bại", respond.message, "error");

                    }
                }
            })

        }*/
    })
})
// rating
document.addEventListener('DOMContentLoaded', function () {

    Validator({
        form: '#form-add-rating',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('#review', 'Vui lòng viết bình luận'),
      

        ],
        onSubmit: function (data) {
           const point= document.querySelectorAll(".rating_point .zmdi-star").length
          const product_id=document.getElementById('product_id').value
          const context=document.getElementById('review').value
          const _token=document.getElementById('_token').value
            

           console.log({point:point,product_id:product_id,context:context,_token:_token})
            //    {point:point,product_id:product_id,context:context,_token:_token}
                $.ajax({
                    type: 'POST',
                    datatype: 'JSON',
                    data:{point:point,product_id:product_id,context:context,_token:_token},
                    url: '/rating-add',
                    success: function (respond) {
                       
                       if (respond.error !== true) {
                        swal("Bình luận Thành Công", respond.message, "success");
                        setTimeout(() => {  location.reload(); }, 100);
                    } else {
                        swal("BÌnh luận Thất Bại", respond.message, "error");
        
                    }
                    }
                })
        

        }
    })
})
document.addEventListener('DOMContentLoaded', function() {
    // Mong muốn của chúng ta
    Validator({
        form: '#form-change-password',
        formGroupSelector: '.form-group-change-password',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('#old_password'),
            Validator.minLength('#old_password', 6),
            Validator.minLength('#password', 6),
            Validator.isRequired('#password_confirmation'),
            Validator.isConfirmed('#password_confirmation', function() {
                return document.querySelector('#form-change-password #password').value;
            }, 'Mật khẩu nhập lại không chính xác'),
            Validator.isConfirmedFail('#password', function() {
                return document.querySelector('#form-change-password #old_password').value;
            }, 'Mật khẩu nhập lại không được giống mật khẩu cũ')
        ],
        onSubmit: function(data) {
            console.log(data);

            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: $('#form-change-password').serialize(),
                url: '/myprofile/change_password',
                success: function(respond) {
                    console.log(respond.message)


                    if (respond.error !== true) {
                        swal("Đổi Mật Khẩu Thành Công", respond.message, "success");
                        setTimeout(() => {
                            window.location = "/myprofile"
                        }, 1200);
                    } else {
                        swal("Đổi Mật Khẩu Thất Bại", respond.message, "error");

                    }
                }
            })

        }

    });

});