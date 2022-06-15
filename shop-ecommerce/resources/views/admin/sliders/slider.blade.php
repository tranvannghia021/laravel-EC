@extends('admin.layout.layout') 
@section('title')
{{$title}}
@endsection 

@section('main-content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title">Danh sách ảnh trình chiếu</h3>

      <div class="card-tools">
        @if(Session::has('success'))
        <div class="text-center">
          <p class="alert alert-success">{{Session::get('success')}}</p>
        </div>
        @endif
        <form action="" method="post" id="form-search-slider">
        <div class="input-group input-group-sm" style="width: 150px;">
            @csrf
            <input type="text" name="search" class="form-control float-right" placeholder="Search">
            
            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  
    <div class="card-body table-responsive p-0" style="height: 550px;">
      
      <table class="table">
        <thead >
          <tr>
           
            <th >STT</th>
            <th >Tên</th>
            <th >Chi tiết</th>
            <th >Hình ảnh</th>
            <th >Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          @if(count($sliders)==0)
        
          <tr>
            <td colspan="9" class="text-center">
              <h5>Không có thanh trược nào </h5>
            </td>
          </tr>
      
        @else
        
            @foreach ($sliders as $key => $slider)
            <tr>
              <th scope="row">{{++$key}}</th>
              <td>{{$slider->name}}</td>
              <td>{{$slider->description}}</td>
              <td><a href="{{asset('storage/sliders/'.$slider->thumb)}}" target="_blank">
                <img src="{{asset('storage/sliders/'.$slider->thumb)}}" width="100px">
              </a></td>
             
              <td>{!! App\Helpers\helper::active($slider->active) !!}</td>
              <td>
                    <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{ $slider->id }}">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{ $slider->id }}, '/admin/sliders/destroy')">
                     <i class="fas fa-trash"></i>
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

