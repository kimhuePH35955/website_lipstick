@extends('layouts.admin')
@section('content')

@section('title')
Thêm danh mục
@endsection
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="{{route('user')}}" class="btn btn-success m-3">Danh sách User</a>
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
            <form method="post" action="{{route('user.update',$model->id)}}" enctype="multipart/form-data">
                @csrf
                <h1 class="h3 mb-2 text-gray-800">Thêm User</h1>
                <div class="row">
                    <div class="col-md-6">
                    <div class="mb-3">
                            <label for="name" class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" name="name" value="{{$model->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="{{$model->email}}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Mật khẩu</label>
                            <input type="text" class="form-control" name="password" value="{{$model->password}}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Hình ảnh</label>
                            <br>
                            <img id="mat_truoc_preview" src="{{ $model->image?''.Storage::url($model->image):''}}" class="img-fluid" width="80px" />
                            <input type="file" value="{{$model->image}}" name="image" accept="image/*" class="form-control-file @error('image') is-invalid @enderror" id="cmt_truoc">
                            <label for="cmt_truoc"></label><br />
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