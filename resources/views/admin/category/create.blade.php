@extends('admin.layout.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row" style="margin-bottom: 30px; float:right;">
            <a href="{{ route('admin/category/list') }}" class="btn btn-primary"><i class="fas fa-long-arrow-alt-left"></i> Trở lại</a>
        </div>
        <div class="row" style="margin-top: 50px;">
          <div class="col-md-8">
            <form action="{{ route('admin/category/store') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên danh mục sản phẩm</label>
                <input type="text" class="form-control" name="name" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Danh mục cha</label>
                <select class="form-select form-control" name="parent_id" aria-label="Default select example">
                  <option value="0">Chọn danh mục cha</option>
                  {{!! $htmlOption !!}}
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection
