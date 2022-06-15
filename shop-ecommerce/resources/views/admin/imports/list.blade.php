@extends('admin.layout.layout') 
@section('title')
{{$title}}
@endsection 

@section('main-content')


<div class="card">
  <div class="text-center">
    <h3>Danh sách Hóa đơn nhập</h3>
    <div class="card-tools">
     
      <div class="input-group input-group-sm search-input" style="width: 150px;">
        <form action="" method="post" id="form-search-import">

            <div class="form-group input-group-append">
              <div class="">

                <input type="date" name="start_date" id="start_date"   >
              </div>
                <div class="">
                  <input type="date" name="end_date" id="end_date"   >
                  <span class="form-message"></span>
                </div>
                @csrf
                <button id="search_rating" type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
        </form>

      </div>
    </div>
  </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 550px;">
      <table class="table" style="width:100%">
        <thead >
          <tr>
           <th >STT</th>
           <th >Ngày nhập</th>
           <th >Tổng tiền</th>
           <th >#</th>
          </tr>
        </thead>
        
        <tbody>
          @if(count($imports)==0)
          
          <tr>
            <td colspan="9" class="text-center">
              <h5>Không có hóa đơn nhập hàng</h5>
            </td>
          </tr>
      
        @else
        @foreach($imports as $key => $import)
        <tr>
          <td>{{++$key}}</td>
          <td>{{date('d-m-y',strtotime($import->created_at))}}</td>
          <td>
           {{number_format($import->total_price)}}
          </td>
         
    <td>
    
      <a class="btn btn-primary btn-sm rounded-circle" href="/admin/imports/show/{{$import->id}}">
        <i class='fa fa-exclamation-circle'></i>
      </a>
    </td>
        </tr>
       @endforeach
         @endif
        </tbody>
      </table>
      
    </div>
    <!-- /.card-body -->
  </div>
  


@endsection

<script>
  document.addEventListener('DOMContentLoaded', function() {
      Validator({
          form: '#form-search-import',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
             
          
              Validator.isTommorrow('#end_date', function () {
                    return document.querySelector('#form-search-import #start_date').value;
                  }, 'Ngày chọn không hợp lệ')
              

          ],
          

      })
  });
</script>