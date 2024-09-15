@extends('layouts.admin')

@push('styles')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .dropdown-menu a:hover {
        background-color: aquamarine;
        /* Đổi màu khi đưa chuột vào */
        color: #0069d9;
        /* Đổi màu chữ khi đưa chuột vào */
    }
</style>
@endpush
@section('title')
Danh sách vai trò
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Danh sách quản lý đơn hàng</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center">

                <div class="col text-right">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            Hành động
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Thùng rác</a>
                            <a href="#" id="delete-selected" class="dropdown-item">Xoá đã chọn</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="dataTable_length"><label>Hiển thị <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> Mục</label>
                            </div>
                        </div>

                   

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered text-center mt-2" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="">
                                            <input type="checkbox" class="" id="select-all">
                                        </th>
                                        <th scope="col">Tên người mua</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Ghi chú</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Ngày đặt hàng</th>
                                        <th scope="col">Trạng thái đơn hàng</th>
                                        <th>Chức năng</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($order as $order)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="child-checkbox" name="" value="">
                                        </td>
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->email}}</td>
                                        <td>{{$order->note}}</td>
                                        <td>{{$order->total_order}}</td>
                                        <td>{{$order->order_date}}</td>
                                        <td>
                                            <select class="custom-select custom-select-sm form-control switch-status" data-item-id="{{ $order->id }}">
                                                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Chưa xử lý</option>
                                                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đã xác nhận</option>
                                                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đang giao hàng</option>
                                                <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Đã giao hàng</option>
                                                <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>Đã hủy bỏ</option>
                                            </select>
                                            <div class="cancel-reason mt-2" style="display:none;">
                                                <form class="cancel-form" action="{{route('order.update',$order->id)}}" method="POST">
                                                    @csrf 
                                                    <input type="hidden" value="{{$order->id}}" name="orderId">
                                                    <input type="text" class="form-control" name="reason" placeholder="Nhập lý do hủy đơn">
                                                    <button class="btn btn-primary mt-2">Xác nhận</button>
                                                </form>
                                            </div>
                                            @if ($order->status == 5)
                                            <div class="cancel-reason mt-2">
                                                <span class="btn btn-danger">Lý do hủy: {{$order->reason}}</span>
                                            </div>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn" type="button" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route('orderuser',$order->id)}}">Thông tin người đặt hàng</a>
                                                    <a class="dropdown-item" href="{{route('orderdetail',$order->id)}}">Thông tin đơn hàng</a>
                                                    <a class="dropdown-item show_confirm" href="{{route('order.destroy',$order->id)}}">Xoá đơn hàng
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function updateStatus() {
        $('.switch-status').change(function() {
            const orderId = $(this).data('item-id');
            const status = $(this).val();
            const cancelReasonDiv = $(this).closest('td').find('.cancel-reason');

            if (status == 5) {
                cancelReasonDiv.show();
            } else {
                cancelReasonDiv.hide();
            }

            $.ajax({
                method: 'POST',
                url: '/order/status/' + orderId,
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
            });
        });
    }

    updateStatus();
</script>
@endpush


@endsection