@extends('layouts.admin')
@section('content')

@section('title')
Thêm danh mục
@endsection
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="{{route('table')}}" class="btn btn-success m-3">Danh sách sản phẩm</a>
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
            <form method="post" action="{{route('table.update',$model->id)}}" enctype="multipart/form-data">
                @csrf
                <h1 class="h3 mb-2 text-gray-800">Thêm mới sản phẩm</h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" value="{{$model->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Số lượng sản phẩm</label>
                            <input type="text" class="form-control" name="quantity" value="{{$model->quantity}}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Danh mục</label><br>
                            @foreach($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="category_{{ $category->id }}" name="categories[]" value="{{ $category->id }}" @if(in_array($category->id, $productCategories)) checked @endif>
                                <label class="form-check-label" for="category_{{ $category->id }}">{{ $category->name }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Đã bán</label>
                            <input type="text" class="form-control" name="sold" value="{{$model->sold}}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Giá</label>
                            <input type="text" class="form-control" name="price" value="{{$model->price}}">
                        </div>
                       
                        <div class="mb-3">
                            <label for="name" class="form-label">Mô tả</label>
                            <input type="text" class="form-control" name="description" value="{{$model->description}}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Trạng thái</label>
                            <input type="text" class="form-control" name="status" value="{{$model->status}}">
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
<script>
    $(function() {
        function readURL(input, selector) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $(selector).attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#cmt_truoc").change(function() {
            readURL(this, '#mat_truoc_preview');
        });

        $('#cmt_truoc').on('change', function() {
            var files = $(this)[0].files;

            // Clear previous previews
            $('#image_preview_container').html('');

            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_preview_container').append('<img src="' + e.target.result + '" class="img-fluid" style="max-width: 200px; height:100px; margin-bottom: 10px;">');
                }

                reader.readAsDataURL(files[i]);
            }
        });
    });
</script>
@endpush