@extends('admin.layout.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row" style="margin-bottom: 30px; float:right;">
            <a href="{{ route('admin/slider/create') }}" class="btn btn-primary">Thêm Slider</a>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tên Slider</th>
                <th scope="col">Ảnh slider</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($sliders as $slider)
              <tr>
                <th scope="row">{{ $slider->id }}</th>
                <td>{{ $slider->name }}</td>
                <td>
                  <img src="{{ $slider->image_path }}" style="width: 100px; height: 100px;" alt="{{ $slider->name }}">
                </td>
                <td>
                    <a href="{{ route('admin/slider/edit', ['id' => $slider->id]) }}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                    <a href="{{ route('admin/slider/delete', ['id' => $slider->id]) }}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection
