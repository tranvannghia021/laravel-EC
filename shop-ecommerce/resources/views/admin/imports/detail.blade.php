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
  
  <div class="card card-success  " style="padding:1em 8em;min-height: ">
    <div class="text-center"><h1>Chi tiết hóa đơn nhập hàng</h1></div>
        
       
      </div>
   
  @php $sum=0; @endphp
    <table id="order_details" class="table table-bordered">
      <tbody>
        {!! \App\Helpers\Helper::renderImportDetail($imports)!!}
    </tbody></table>
    <a href="{{Route('admin.imports.list')}}" class="btn btn-success ">Quay lại</a>
    {{-- <a href="/admin/orders/print/" class="btn btn-info ">IN</a> --}}
@endsection