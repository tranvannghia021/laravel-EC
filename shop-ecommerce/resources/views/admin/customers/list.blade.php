@extends('admin.layout.layout')
@section('title')
    {{ $title }}
@endsection

@section('main-content')
    <div class=" row">

        <div class="card col-md-10 card-info" >
            
            <div class="card-header">
                <h2 class="card-title"><strong>Danh Sách Khách Hàng</strong></h2>

                <div class="card-tools">
                    <button class="btn btn-dark"><a href="/admin/customers/add"  class="cl-white">Thêm Khách Hàng </a></button>
                
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 650px;">
                <table class="table table-responsive table-head-fixed text-nowrap table-hover table-condensed"
                    >
                    <thead>
                        <tr>
                            <th style="width:9%">Mã</th>
                            <th style="width:20%">Họ Và Tên</th>
                            <th style="width:11%">Điện Thoại</th>
                            <th style="width:12%">Email</th>
                            <th style="width:10%">Trạng Thái</th>
                            <th style="width:20%">Hành Động</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($listCustomers) == 0)
                            <tr>
                                <td colspan="9" class="text-center">
                                    <h5>Không Có Khách Hàng Theo Yêu Cầu</h5>
                                </td>
                            </tr>
                        @else
                            {!! \App\Helpers\Helper::renderListViewCustomer($listCustomers) !!}
                        @endif
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
            {!! \App\Helpers\Helper::renderPopupViewItemCustomer($listCustomers) !!}
           
        </div>
        <div class="card col-md-2 card-warning" >
            <div class="card-header">
                <h2 class="card-title"><strong>Tìm Kiếm Khách Hàng</strong></h2>
            </div>
            <div class="card-body">
                <form action="" method="post" id="form-search-staff">
                    <div class="input-group form-group">
                        @csrf
                        <input type="text" name="search" class="form-control float-right" placeholder="Tìm Theo Tên">
    
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="card-header">
                    <h2 class="card-title"><strong>Lọc Khách Hàng</strong></h2>
                </div>
                <form class="form-horizontal" method="post" action="/admin/customers/list/filter" id="form-horizontal">
                    <br>
                    <div class="form-group">
                        <label>Tìm Theo Email</label>
                        <input type="text" name="email" class="form-control float-right" placeholder="Tìm Theo Email">
                    </div>
                    <div class="form-group">
                        <label>Trạng Thái</label>
                        <select class="form-control" name="status">
                            <option value="-1">Tất Cả</option>
                          <option value="1">Hoạt Động</option>
                          <option value="0">Vô Hiệu Hoá</option>
                        </select>
                      </div>
                      @csrf
                    <input type="submit" class="btn btn-info" value="Lọc">
                </form>
            </div>          
        </div>
       

    </div>

@endsection
