@extends('admin.layout.layout')
{{-- đừng xóa title bên đây nó bug ak --}}
@section('title')
    {{ $title }}
@endsection
{{-- itemt navbar --}}


{{-- content --}}
@section('main-content')

    <script type="text/javascript">
        var dataGroupProduct = {!! json_encode($statisticsGroupProduct) !!}
        var dataChartOrderLongTime = {!! json_encode($dataChartOrder) !!}
        var startDate = {!! json_encode($start_date_Chart) !!}
        var endDate = {!! json_encode($end_date_Chart) !!}
        var dataChartRevenue = {!! json_encode($dataChartRevenue) !!}
    </script>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($number_new_revenue) }} VNĐ</h3>

                        <p>Doanh Thu</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <span class="small-box-footer">{{ date('d-m-Y') }} </span>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $number_new_order }}</h3>

                        <p>Đơn Hàng Mới</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <span class="small-box-footer">{{ date('d-m-Y') }} </span>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $number_new_customer_registery }}</h3>

                        <p>Khách Hàng Mới</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <span class="small-box-footer">{{ date('d-m-Y') }} </span>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $number_new_order_cancel }}</h3>

                        <p>Đơn Hàng Thất Bại</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <span class="small-box-footer">{{ date('d-m-Y') }} </span>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

        <div class="row">
            <form class="card card card-warning col-md-12 row" method="get" action="">
                <div class="card-header ">
                    <h3 class="card-title">Thống Kê Tình Hình Kinh Doanh</h3>
                   
                </div>
                <div class="card-body row " style="height:73px">
                  <div class="col-md-7"></div>
                    <input type="date" name="start_date" class=" form-control col-md-2 " style="height:32px">
                    <span class="" >  Đến:  </span>
                    <input type="date" name="end_date" class=" form-control col-md-2 " style="height:32px">
                    <button type="submit" class="btn btn-info  " style="height:32px"><i class="fas fa-search"></i></button>
                </div>

            </form>

            <div class="col-md-12 row">
                <!-- AREA CHART -->
                <div class="card card-success col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Biểu Đồ Thể Hiện Lượng Đặt Hàng</h3>



                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                          
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="areaChartOrder" width="400" height="312" class="chartjs-render-monitor"
                            style="min-height: 250px; height: 470px; max-height: 420px; max-width: 100%; display: block; width: 550px;"
                            ></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-info col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Biểu Đồ Thể Hiện Doanh Thu Cửa Hàng</h3>



                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                          
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="areaChartRevenue" width="400" height="312" class="chartjs-render-monitor"
                            style="min-height: 250px; height: 450px; max-height: 450px; max-width: 100%; display: block; width: 550px;"
                            ></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- DONUT CHART -->
                
                <!-- /.card -->

                <!-- PIE CHART -->
                <div class="card card-success col-md-6">
                    <div class="card-header">
                        <h3 class="card-title">Tỷ Lệ Loại Sản Phẩm Được Mua (Đơn vị: %) - Tháng {!! date('m')!!}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="pieChartGroupProduct"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 550px;"
                            width="687" height="312" class="chartjs-render-monitor"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card col-md-6 card-danger">
                    <div class="card-header">
                      <h3 class="card-title">Khách Hàng Không Đáng Tin Cậy</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">STT</th>
                            <th>Mã</th>
                            <th>Tên Khách Hàng</th>
                            <th >Số Lần Thất Bại</th>
                          </tr>
                        </thead>
                        <tbody>                    
                          {!! \App\Helpers\Helper::renderListCustomerFail($top_customer_cancel_order) !!}
                      
                        </tbody>
                      </table>
                    </div>
                   
                    <!-- /.card-body -->
                
                  </div>
                <!-- /.card -->

            </div>

            <!-- /.col (LEFT) -->
            <div class="col-md-12 row">
                <!-- LINE CHART -->
              
                <!-- /.card -->

                <!-- STACKED BAR CHART -->
                
                <div class="card card-danger col-md-6">
                    <div class="card-header">
                        <h3 class="card-title">Donut Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="donutChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 320px;"
                            width="400" height="312" class="chartjs-render-monitor"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row (main row) -->
    </div>
@endsection
