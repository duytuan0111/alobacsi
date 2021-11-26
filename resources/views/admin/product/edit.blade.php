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
            <a href="{{ route('admin/product/list') }}" class="btn btn-primary"><i class="fas fa-long-arrow-alt-left"></i> Trở lại</a>
        </div>
        <div class="row" style="margin-top: 50px;">
          <div class="col-md-8">
            <form action="{{ route('admin/product/update', ['id' => $productDetail->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" value="{{ $productDetail->name }}" name="name" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Giá sản phẩm</label>
                <input type="text" class="form-control" value="{{ $productDetail->price }}" name="price" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Ảnh sản phẩm</label>
                <input type="file" class="form-control" name="feature_image_path" >
              </div>
              <div class="col-md-12">
                <div class="row">
                  <img src="{{ $productDetail->feature_image_path }}" style="width:200px; height: 200px; margin-top: 30px;" alt="">
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Ảnh chi tiết</label>
                <input type="file" multiple class="form-control" name="image_path[]" >
                <div class="col-md-12">
                  <div class="row">
                    @foreach ($productDetail->productImage as $productImage)
                    <div class="col-md-3">
                      <img src="{{ $productImage->image_path }}" alt="" style="width: 150px; height: 150px;">
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="">Nhập tags cho sản phẩm</label>
               <select class="form-control tag_selects_choose" name="tag[]"  multiple="multiple">
                 @foreach ($productDetail->tags as $tagItem)
                 <option value="{{ $tagItem->id }}" selected>{{ $tagItem->name }}</option>
                 @endforeach
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
              <textarea name="contents"  class="form-control editor" rows="3"  placeholder="Nhập nội dung">{{ $productDetail->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/js/froala_editor.pkgd.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('admin_add/product/add/add.js') }}"></script>
@endsection
