$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
/* ----------------------------------------------------------------DELETE----------------------------------------------------------------*/

function removeRow(id, url) {
    swal({
        title: "Xoá Dữ Liệu",
        text: "Bạn Thực Sự Muốn Xoá Dữ Liệu Này Chứ ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        //delete
        if (willDelete) {
            $.ajax({
                type: 'DELETE',
                datatype: 'JSON',
                data: { id },
                url: url,
                success: function (result) {
                    if (result.error === false) {
                        swal("Tốt! Xoá Thành Công !", {
                            icon: "success",
                          });
                          setTimeout(() => {location.reload()}, 1000);
                    } else {
                        swal("Lỗi! Xoá Thất Bại!", {
                            icon: "error",
                          });
                    }
                }
            })
         
        }
        // not delete
        else {
          swal("Dữ Liệu Của Bạn Vẫn An Toàn!");
        }
      });
   /* if (wal('Xóa mà không thể khôi phục. Bạn có chắc ?')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                   location.reload();
                } else {
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })
    }*/
}