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
      <h3 class="">Danh sách Sản phẩm</h3>
    
      <div class="card-tools">
        @if(Session::has('success'))
        <div class="text-center">
          <p class="alert alert-success">{{Session::get('success')}}</p>
        </div>
        @endif
        <div class="input-group input-group-sm search-input" style="width: 150px;">
          <form action="" method="post" id="form-search-product">

              <div class="input-group-append">
                  <input type="search" name="search" id="" placeholder="search..."  style="outline: none" >
                  @csrf
                <button id="search_rating" type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
          </form>

        </div>
      </div>
    </div>
    
    {{-- code --}}
  
   

    <table class="table">
      <thead>
        <tr>
          <th style="width:50px" scope="col">STT</th>
          <th scope="col">Category</th>
          <th scope="col">Product_Name</th>
          <th scope="col">Description</th>
          <th scope="col">Amount</th>
          <th scope="col">Price</th>
          <th scope="col">Image</th>
          <th style="width:50px" scope="col">Active</th>
          <th scope="col">#</th>
        </tr>
        
      </thead>
      <tbody id="body_product">
        @if(count($products)==0)
        
          <tr>
            <td colspan="9" class="text-center">
              <h5>Không có sản phẩm</h5>
            </td>
          </tr>
      
        @else
        
        @foreach ($products as $key => $product)
        <tr>
          
          <th scope="row">{{++$key}}</th>
          <td>{{$product->name}}</td>
          <td>{{$product->name_product}}</td>
          <td>{!!$product->description!!}</td>
          
          <td>
          @for($i=0; $i <count($products) ; $i++) 
            @php
             $color='';
             $number=$product->amount;
                if($number >=10){
                  $color='Green';
                }else if($number <= 3){
                  $color='red';
                }else {
                  $color="orange";
                }
               @endphp
         @endfor
         
                <div style="background:{{$color}};" class="noti_check">
                  <p  class="text-center">{{$product->amount}}</p>
                </div>
            </td>
          <td>{{number_format($product->price)}}</td>
          <td><a href="{{asset('storage/uploads/'.$product->img)}}" target="_blank">
            <img src="{{asset('storage/uploads/'.$product->img)}}" width="100px">
          </a></td>
      
          <td><button class="btn-toggle" onclick="handleToggle({{$product->active}},{{$product->id}})">{!! App\Helpers\helper::active($product->active) !!}</button></td>
          <td><a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}">
            <i class="fas fa-edit"></i>
        </a>
           
          </td>
        </tr>
            
        @endforeach
        @endif
      
      </tbody>
    </table>


@endsection 
<script>
function handleToggle(active,id){
  $.ajax({
                    type: 'POST',
                    datatype: 'JSON',
                    data: {id:id,active:active},
                    url: '/admin/products/active',
                    success: function (respond) {
                          if (respond.error !== true ) {       
                          const body_product=document.getElementById('body_product');
                          var key=0;
                          var length_product=respond.products.length
                          var html=respond.products.map(e=>{
                            var str='<span class="btn btn-danger btn-xs">Vô Hiệu</span>';
                            if(e.active==1){
                              str='<span class="btn btn-success btn-xs">Hoạt Động</span>';
                            }
                           
                            for(var i=0;i<length_product;i++){
                              var color='';
                              if(e.amount >=10){
                                color='Green';
                              }else if(e.amount <= 3){
                                      color='red';
                                    }else {
                                      color="orange";
                                    }
                            }
                            
                           key++;
                            return `<tr>
          
                              <th scope="row">${key}</th>
                              <td>${e.name}</td>
                              <td>${e.name_product}</td>
                              <td>${e.description}</td>
                              
                              <td>
                             
                            
                                    <div style="background:${color};" class="noti_check">
                                      <p  class="text-center">${e.amount}</p>
                                    </div>
                                </td>
                              <td>${e.price}</td>
                              <td><a href="{{asset('storage/uploads/${e.img}')}}" target="_blank">
                                <img src="{{asset('storage/uploads/${e.img}')}}" width="100px">
                              </a></td>
                          
                              <td><button class="btn-toggle" onclick="handleToggle(${e.active},${e.id})">
                                ${str} </button></td>
                              <td>
                                <a class="btn btn-primary btn-sm" href="/admin/products/edit/${e.id}">
                                <i class="fas fa-edit"></i>
                               </a>
                              
                              
                              </td>
                            </tr> `;
                  
                     });
                         body_product.innerHTML=html.join('')          
                            
                          
                        } 
                        else  {
                            swal("Thất Bại", respond.message, "error");
                           
                        }

                    
                    }
                })
}
</script>