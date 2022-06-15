@extends('admin.layout.layout')
@section('title')
    {{ $title }}
@endsection

@section('main-content')

        <div class="card card-success  " style="padding:1em 8em;min-height: ">
            <div class="card-header">
                
                <h3 class="card-title">Cập nhập Sliders</h3>
    
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  
                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body">
                
      @if(Session::has('error'))
      <div class="text-center">
        <p class="alert alert-dangger">{{Session::get('error')}}</p>
      </div>
      @endif
                @foreach($sliders as $slider)
                <form method="post" action="" id="form-add-sliders" class="row" enctype="multipart/form-data">

                    <!-- text input -->
                    <div class="form-group col-sm-6">
                        <label>Tên</label>
                        <input type="text" name='name' id="name" value="{{$slider->name}}" class="form-control" placeholder="Name ...">
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Chi tiết</label>
                        <input type="text" name="description" value="{{$slider->description}}"   id="description" class="form-control" placeholder="Description ...">
                        <span class="form-message"></span>
                    </div>
                    
            
                    <div class="form-group col-sm-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="thumb" name="thumb"  onchange="ImagesFileAsURL('thumb','displayImg');GetValuefile('thumb','js-show-file');">
                            <label class="custom-file-label"id="js-show-file" for="thumb">{{$slider->thumb}}</label>
                           </div>
                           <span class="form-message"></span>
                          <div id="displayImg">
                          
                            <a href="{{asset('storage/sliders/'.$slider->thumb)}}" target="_blank">
                              <img src="{{asset('storage/sliders/'.$slider->thumb)}}" width="100px">
                            </a>
                          </div>
                        <input type="hidden" value="{{$slider->thumb}}" name="img" >
                    </div>

                    
                    <div class="form-group col-sm-12">
                        <label>Hoạt Động</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" type="radio" id="active" name="active" {{$slider->active ==1 ? 'checked':''}}>
                            <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" {{$slider->active ==0 ? 'checked':''}} >
                            <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                    </div>                         

                            @csrf
                            <div class="col-sm-3"></div>
                            <button type="submit" class="form-submit btn btn-success col-sm-6"> Thêm</button>
                            <div class="col-sm-3"></div>
                </form>
                @endforeach
                        <!-- /.card-body -->
            </div>
            
           

        </div>
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Validator({
                form: '#form-add-sliders',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#name', 'Vui lòng nhập tên '),
                    Validator.isRequired('#description', 'Vui lòng nhập chi tiết'),
                  
                ],
                // onSubmit: function (data) {    
                //    const namb={
                //             name: $('#name').val(),
                //             description: $('#description').val(),
                //             active: $('#active').val(),
                //             thumb: document.getElementById('thumb').files
                //     }
                //      console.log(namb)
                //     $.ajax({
                //     type: 'POST',
                //     datatype: 'JSON',
                //     data: namb,
                //     url: '/admin/sliders/add',
                //     success: function (respond) {
                //         console.log(respond.message)

                //         if (respond.error !== true ) {                       
                //             swal("Thêm Thành Công", "Nhân Viên Đã Được Thêm", "success");
                //            setTimeout(() => {window.location="/admin/staffs/list"}, 1200);
                //         } 
                //         else  {
                //             swal("Thêm Thất Bại", "Email Của Nhân Viên Đã Tồn Tại", "error");
                           
                //         }
                //     }})
               

                // }


            })
        });
    </script>
