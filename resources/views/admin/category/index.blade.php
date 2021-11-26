@extends('admin.layout.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row" style="margin-bottom: 30px; float:right;">
            <a href="{{ route('admin/category/create') }}" class="btn btn-primary">Thêm danh mục sản phẩm</a>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tên danh mục</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
              <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('admin/category/edit', ['id' => $category->id]) }}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                    <a href="{{ route('admin/category/delete', ['id' => $category->id]) }}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection
