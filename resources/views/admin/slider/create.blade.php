@extends('admin.layout.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row" style="margin-bottom: 30px; float:right;">
                <a href="{{ route('admin/slider/list') }}" class="btn btn-primary"><i
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
                    <form action="{{ route('admin/slider/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Mô tả</label>
                            <input type="text"  value="{{ old('description') }}" class="form-control" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ảnh Slide</label>
                            <input type="file" class="form-control" name="image_path">
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
@endsection
