@extends('admin.layout.layout') 
@section('title')
{{$title}}
@endsection 

@section('main-content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title"></h3>

      {{-- <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
          <form action="" method="post" id="form-search-rating">

              <div class="input-group-append">
                  <Select style="width:100px" value="" name="point">
                      <option @php if($point==0) echo 'selected'; @endphp value="0">All</option>
                      <option @php if($point==1) echo 'selected'; @endphp value="1">1 &#10025;</option>
                      <option @php if($point==2) echo 'selected'; @endphp value="2">2 &#10025;</option>
                      <option @php if($point==3) echo 'selected'; @endphp value="3">3 &#10025;</option>
                      <option @php if($point==4) echo 'selected'; @endphp value="4">4 &#10025;</option>
                      <option @php if($point==5) echo 'selected'; @endphp value="5">5 &#10025;</option>
                  </Select>
                  @csrf
                <button id="search_rating" type="submit" class="btn btn-default">
                  <i class="fa fa-filter"></i>
                </button>
              </div>
          </form>

        </div>
      </div> --}}
    </div>
  
    <div class="card-body table-responsive p-0" style="height: 550px;">
    
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Danh Sách đánh giá</h3>
          </div>
          <form action="" method="post" id="form-saerch-rating">
            @csrf
          <div class="card-body">
            <!-- Date -->
            <div class="row form-group">
              <div class="col col-sm-6">
                <label>Tên sản phẩm:</label>
                <div class="input-group date col-sm-5" id="">
                    <input type="text" class="form-control " name="name_product" placeholder="Tên sản phẩm...">
   
                </div>
                <label>Loại sản phẩm:</label>
                <div class="input-group date col-sm-5" id="">
                    <select name="category" class="form-control" id="">
                      <option  value="">Tất cả</option>
                      @foreach($categorys as $category)
                      <option @php if($category_id==$category->id) echo 'selected'; @endphp value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                   
                </div>
              </div>
              <div class="col col-sm-6">
                <label>Số sao:</label>
                <div class="input-group date col-sm-7" id="">
                  <Select class="form-control" value="" name="point">
                    <option  value="">Tất cả</option>
                    <option @php if($point==1) echo 'selected'; @endphp value="1">1 &#10025;</option>
                    <option @php if($point==2) echo 'selected'; @endphp value="2">2 &#10025;</option>
                    <option @php if($point==3) echo 'selected'; @endphp value="3">3 &#10025;</option>
                    <option @php if($point==4) echo 'selected'; @endphp value="4">4 &#10025;</option>
                    <option @php if($point==5) echo 'selected'; @endphp value="5">5 &#10025;</option>
                </Select>
                   
                </div>
                <label>Ngày đánh giá:</label>
                <div class="input-group date col-sm-7" id="">
                   <div class="row form-group">
                     <div class="col col-sm-6">
                      <input type="date" class="form-control " name="start_date" id="start_date">
                     </div>
                     <div class="col col-sm-6">
                      <input type="date" class="form-control " name="end_date" id="end_date">
                     </div>
                     <span class="form-message"></span>
                   </div>
                   
                </div>
              </div>
            </div>
          </div>
         <div class="input-group date col-sm-12 ">
          <button type="submit" class="btn btn-success mr-2">Tìm</button>
          <button type="reset" class="btn btn-info ">Nhập lại</button>
         </div>
        </div>
      </form>
      <table class="table">
        <thead style="background:rgba(0,0,0,.05); ">
          <tr>
           
            <th >STT</th>
            <th >Tên</th>
            <th >Nội dung</th>
            <th >Sao</th>
            <th >Sản phẩm</th>
            <th >Hình ảnh</th>
            <th >Ngày đánh giá</th>
          </tr>
        </thead>
        <tbody>
          @if(count($ratings)==0)
        
          <tr>
            <td colspan="9" class="text-center">
              <h5>Không có đánh giá</h5>
            </td>
          </tr>
      
        @else
        
            @foreach ($ratings as $key => $rating)
            <tr>
              <th scope="row">{{++$key}}</th>
              <td>{{$rating->first_name.' '.$rating->last_name}}</td>
              <td>{{$rating->context}}</td>
              <td>{{$rating->point}}&#10025;</td>
              <td>{{$rating->name}}</td>
              <td><a href="{{asset('storage/uploads/'.$rating->img)}}" target="_blank">
                <img src="{{asset('storage/uploads/'.$rating->img)}}" width="100px">
              </a></td>
              <td>{{$rating->created_at->toDateString()}}</td>
              
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
          form: '#form-saerch-rating',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
             
            Validator.isTommorrow('#end_date', function () {
                    return document.querySelector('#form-saerch-rating #start_date').value;
                  }, 'Ngày chọn không hợp lệ')

          ],

      })
  });
</script>