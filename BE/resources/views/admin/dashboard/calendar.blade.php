@extends('layouts.admin')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thống kê hóa đơn theo khoảng ngày </h1>
    </div>
    <div class="mb-3">
        <form method="GET" action="{{ route('dashboard.invoice.calendar') }}" class="mt-2">
            @csrf
            <span><input type="date" name="start_date" id="start_date" class="btn btn-primary" value="{{$startDate}}"></span>-->
            <span><input type="date" name="end_date" id="end_date" class="btn btn-primary" value="{{$endDate}}"></span>
            <button type="submit" class="btn btn-info"><i class="fas fa-search m-1"></i></button>
        </form>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tổng doanh thu
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalConfirmedAmountThisCalendar}} Vnđ</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tổng hóa đơn
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalBookingsThisCalendar}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Doanh thu theo khoảng ngày</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Doanh thu theo khoảng</div>
                            <a class="dropdown-item time-range" href="#">7 ngày qua</a>
                            <a class="dropdown-item time-range-month" href="#">28 ngày qua</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Chọn theo ngày: <input type="date" id="selectedDate"></a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Trạng thái hóa đơn</h6>
                    <div class="dropdown no-arrow">
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Chờ xác nhận
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Đã giao hàng
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Đã hủy
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 mb-4">
          

        </div>
    </div>

</div>
@endsection

@push('scripts')
<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    $(document).ready(function() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        $.ajax({
            url: '/dashboard/getCountStatusCalendar',
            method: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function(response) {
                var status2Count = response.status2 || 0;
                var status3Count = response.status3 || 0;
                var status4Count = response.status4 || 0;
                updatePieChart([status2Count, status3Count, status4Count]);
            },
            error: function(err) {
                console.error('Lỗi:', err);
            }
        });
        var labels = ["Chờ xác nhận", "Đã giao hàng", "Đã hủy"];

        function updatePieChart(statusCounts) {
            // Cập nhật biểu đồ Pie Chart (ví dụ)
            // Không quên cập nhật phần này để phản ánh biểu đồ của bạn
            myPieChart.data.datasets[0].data = statusCounts;
            myPieChart.data.labels = labels;
            myPieChart.update();
        }
    });
</script>
<script>
   $(document).ready(function() {
    var startDate = $('#start_date').val();
    var endDate = $('#end_date').val();
    $.ajax({
        url: '/dashboard/fetchDailyData',
        type: 'GET',
        data: {
            start_date: startDate,
            end_date: endDate
        },
        success: function(response) {
            var dailyData = response.dailyData;
            var days = [];
            var revenues = [];

            // Lặp qua mỗi ngày trong khoảng ngày đã chọn
            var currentDate = new Date(startDate);
            var end = new Date(endDate);
            while (currentDate <= end) {
                var dateKey = currentDate.toISOString().split('T')[0];
                var revenue = dailyData[dateKey] || 0; // Kiểm tra nếu có dữ liệu cho ngày này, nếu không có thì gán 0
                days.push(dateKey);
                revenues.push(revenue);
                currentDate.setDate(currentDate.getDate() + 1); // Tăng ngày để duyệt qua ngày tiếp theo
            }

            // Cập nhật dữ liệu và nhãn cho biểu đồ
            myLineChart.data.labels = days;
            myLineChart.data.datasets[0].data = revenues;

            // Cập nhật biểu đồ
            myLineChart.update();
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
});

</script>
@endpush
