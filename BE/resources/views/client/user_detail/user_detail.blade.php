@extends('layouts.client')
@push('styles')
<style>
    .modal-custom {
        background-color: white;
    }
    .modal-custom {
         margin: 0 auto; 
    }

    .dropdown-menu a:hover {
        background-color: aquamarine;
        /* Đổi màu khi đưa chuột vào */
        color: #0069d9;
        /* Đổi màu chữ khi đưa chuột vào */
    }
</style>
@endpush
@section('content')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<br><br><br><br><br><br><br>
<div class="container-fluid">

    <!-- Page Heading -->


    <!-- DataTales Example -->
    <div class="card shadow mb-4">


        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                    <div class="row d-flex justify-content-center">
                        <div class="col-sm-10">
                            <table class="table table-bordered text-center mt-2" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Mã đơn hàng</th>
                                        <th scope="col">Địa chỉ nhận</th>
                                        <th scope="col">Ghi chú</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Ngày đặt hàng</th>
                                        <th scope="col">Trạng thái đơn hàng</th>
                                        <th scope="col">Đơn hàng chi tiết</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($user_detail as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->note}}</td>
                                        <td>{{$order->total_order}}</td>
                                        <td>{{$order->order_date}}</td>
                                        <td>
                                            <!-- <select class="custom-select custom-select-sm form-control switch-status" data-item-id="{{ $order->id }}">
                                                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Chưa xử lý</option>
                                                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đã xác nhận</option>
                                                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đang giao hàng</option>
                                                <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Đã giao hàng</option>
                                                <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>Hủy bỏ</option>
                                            </select> -->
                                            @if( $order->status == 1)
                                            <a href="" class="btn btn-primary">Đang xử lý</a>
                                            @endif
                                            @if( $order->status == 2)
                                            <a href="" class="btn btn-info">Đang xác nhận</a>
                                            @endif
                                            @if( $order->status == 3)
                                            <a href="" class="btn btn-success">Đang giao hàng</a>
                                            @endif
                                            @if( $order->status == 4)
                                            <a href="" class="btn btn-success">Đã giao hàng</a>
                                            @endif
                                            @if( $order->status == 5)
                                            <a href="" class="btn btn-danger">Đã hủy</a>
                                            @endif
                                            @if ($order->status == 5)
                                            <div class="cancel-reason mt-2">
                                                <span class="btn btn-danger">Lý do hủy: {{$order->reason}}</span>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if( $order->status == 1 || $order->status == 2)
                                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#cancelOrderModal">Hủy đơn hàng</a>
                                            <div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-custom" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="cancelOrderModalLabel">Xác nhận hủy đơn hàng</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Bạn có chắc chắn muốn hủy đơn hàng này không?</p>
                                                            <!-- Display the cancellation reason form when confirming the cancellation -->
                                                            <div class="cancel-reason mt-2" style="display:none;">
                                                                <form class="cancel-form" action="{{ route('order.client', $order->id) }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$order->id}}" name="orderId">
                                                                    <input type="text" class="form-control" name="reason" placeholder="Nhập lý do hủy đơn">
                                                                    <button class="btn btn-primary mt-2">Xác nhận</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                            <!-- Add a confirmation button to display the cancellation reason form -->
                                                            <button type="button" class="btn btn-danger" id="confirmCancel">Xác nhận hủy</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <a href="{{route('userorder',$order->id)}}" class="btn btn-info">Xem chi tiết</a>
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
    $(document).ready(function() {
        // Store the order ID when the cancel button is clicked
        var orderId;

        $('.cancel-order').on('click', function() {
            orderId = $(this).data('item-id');
            // Open the modal
            $('#cancelOrderModal').modal('show');
        });

        // Handle the cancellation when the confirm button is clicked
        $('#confirmCancel').on('click', function() {
            // Show the cancellation reason form
            $('.cancel-reason').show();
        });
    });
</script>
@endpush