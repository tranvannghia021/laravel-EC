{{-- {{dd($products->toArray())}} --}}
@extends('admin.layout.layout') 
@section('title')
{{$title}}
@endsection 
@section('infoStaff')
<a href="#" class="d-block">{{$staff->first_name }} {{ $staff->last_name }}</a>

@endsection
 {{-- content  --}}
 
@section('main-content')
  <!-- Content Wrapper. Contains page content -->
    <div class="text-center">
      <h3>Danh sách danh mục</h3>
    </div>
    {{-- code --}}
    @if(Session::has('success'))
    <div class="text-center">
      <p class="alert alert-success">{{Session::get('success')}}</p>
    </div>
    @endif
    <table class="table">
      <thead>
        <tr>
          <th style="width:50px" scope="col">STT</th>
          <th scope="col">Loại sản phẩm</th>
          <th scope="col">Hình ảnh</th>
          <th scope="col">#</th>
        </tr>
        
      </thead>
      <tbody>
        @foreach ($categories as $key => $cate)
        <tr>
          <th scope="row">{{++$key}}</th>
          <td>{{$cate->name}}</td>
          <td><a href="{{asset('storage/categories/'.$cate->thumb)}}" target="_blank">
            <img src="{{asset('storage/categories/'.$cate->thumb)}}" width="100px">
          </a></td>
        
       
          <td>
        <a class="btn btn-primary btn-sm" href="/admin/group-products/edit/{{ $cate->id }}">
            <i class="fas fa-edit"></i>
        </a>
            <a href="#" class="btn btn-danger btn-sm"
              onclick="removeRow({{ $cate->id }}, '/admin/group-products/destroy')">
                <i class="fas fa-trash"></i>
            </a>
          </td>
        </tr>
            
        @endforeach

      
      </tbody>
    </table>

@endsection 