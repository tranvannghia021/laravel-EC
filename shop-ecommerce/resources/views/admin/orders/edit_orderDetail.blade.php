@extends('admin.layout.layout') 
@section('title')
{{$title}}
@endsection 
 {{-- content  --}}
 @section('infoStaff')
<a href="#" class="d-block">{{$staff->first_name }} {{ $staff->last_name }}</a>

@endsection
@section('main-content')
  <!-- Content Wrapper. Contains page content -->
      {{-- code --}}
      <a href="/admin/orders/list" class="btn btn-success">Quay lại</a>
      <div class="text-center">
          <h1>Cập nhập trạng thái đơn hàng</h1>
      </div>
    <form action="" class="text-center" id="form-edit-order" method="post">
    
        @csrf
        <div class="form-group">
            <label for="">Trạng thái đơn hàng</label>
            <select name="status_value" id="">
           
            @php
                for($i=1;$i<=count($a);$i++){
                  $selected='';
                  if($status_number==$i){
                    $selected='selected';
                  }
                 echo "<option ".$selected." value=".$i.">".$a[$i]."</option>";
                }
            @endphp
            </select>
            <input type="hidden" name='id' value="{{$id_order}}">
        </div>
        <button type="submit" class="btn btn-success btn-sm">Cập nhập</button>
    </form>
@endsection
<script>

  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-edit-order',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
         
          ],
          onSubmit: function (data) {    
              $.ajax({
              type: 'POST',
              datatype: 'JSON',
              data: $('#form-edit-order').serialize() ,
              url: '/admin/orders/edit/{id}',
              success: function (respond) {
                  

                  if (respond.error !== true ) {                       
                      swal("Cập nhập thành Công",respond.message, "success");
                     setTimeout(() => {window.location.href='/admin/orders/list'}, 1200);
                  } 
                  else  {
                      swal("Cập nhập thất Bại", respond.message, "error");
                     
                  }
              }
          })

          }

      })
  });
</script>