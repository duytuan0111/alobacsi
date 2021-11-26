@extends('admin.layout.index')
@section('content')
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff !important;
        }

    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="row" style="margin-bottom: 30px; float:right;">
                <a href="{{ route('admin/product/list') }}" class="btn btn-primary"><i
                        class="fas fa-long-arrow-alt-left"></i> Trở lại</a>
            </div>
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-8">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin/product/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên sản
                                phẩm</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Giá sản phẩm</label>
                            <input type="number" min="0" value="{{ old('price') }}" class="form-control" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ảnh sản phẩm</label>
                            <input type="file" class="form-control" name="feature_image_path">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ảnh chi tiết</label>
                            <input type="file" multiple class="form-control" name="image_path[]">
                        </div>
                        <div class="form-group">
                            <label for="">Nhập tags cho sản phẩm</label>
                            <select class="form-control tag_selects_choose" name="tag[]" multiple="multiple">
                                <option>1</option>
                                <option>12</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Danh mục cha</label>
                            <select class="form-select form-control" name="category_id" aria-label="Default select example">
                                <option value="0">Chọn danh mục cha</option>
                                {{!! $htmlOption !!}}
                            </select>
                        </div>
                </div>
                <div class="col-md-8" style="margin-bottom: 50px;">
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea name="contents" class="form-control editor" rows="3"
                            placeholder="Nhập nội dung">{{ old('contents') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/js/froala_editor.pkgd.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('admin_add/product/add/add.js') }}"></script>
@endsection
