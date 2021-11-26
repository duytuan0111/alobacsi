@extends('admin.layout.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row" style="margin-bottom: 30px; float:right;">
                <a href="{{ route('admin/settings/list') }}" class="btn btn-primary"><i
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
                    <form action="{{ route('admin/settings/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Config key</label>
                            <input type="text" class="form-control" value="{{  old('config_key') }}" placeholder="Nhập config key" name="config_key">
                        </div>
                        @if (request()->type === 'Text')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Config value</label>
                                <input type="text" class="form-control" value="{{ old('config_value') }}" placeholder="Nhập config value" name="config_value">
                            </div>
                        @elseif (request()->type === 'Textarea')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Config value</label>
                                <textarea name="config_value" class="form-control" cols="30" rows="10">{{ old('config_value') }}</textarea>
                            </div>
                        @endif
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
