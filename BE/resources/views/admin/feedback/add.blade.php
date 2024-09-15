@extends('layouts.admin')
@section('content')

@section('title')
Thêm danh mục
@endsection
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="{{route('feedback')}}" class="btn btn-success m-3">Danh sách bình luận</a>
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="{{route('feedback.store')}}" enctype="multipart/form-data">
                @csrf
                <h1 class="h3 mb-2 text-gray-800">Sửa bình luận</h1>
                <div class="row">
                    <div class="col-md-6">
                    <div class="mb-3">
                            <label for="name" class="form-label">ID Người dùng</label>
                            <input type="text" class="form-control" name="user_id" >
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">ID Sản phẩm</label>
                            <input type="text" class="form-control" name="product_id" >
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nội dung</label>
                            <input type="text" class="form-control" name="content" >
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Trạng thái</label>
                            <input type="text" class="form-control" name="status" >
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
                <button type="reset" class="btn btn-danger">Nhập lại</button>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')

@endpush