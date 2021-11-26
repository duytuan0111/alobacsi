@extends('admin.layout.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row" style="margin-bottom: 30px; float:right;">
                <a href="{{ route('admin/product/create') }}" class="btn btn-primary">Thêm sản phẩm</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá sản phẩm</th>
                        <th scope="col">Ảnh sản phẩm</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="tr-{{ $product->id }}">
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price) }}</td>
                            <td>
                                <img src="{{ $product->feature_image_path }}" style="width: 200px; height: 200px" alt="">
                            </td>
                            <td>
                                <a href="{{ route('admin/product/edit', ['id' => $product->id]) }}"
                                    class="btn btn-warning"><i class="far fa-edit"></i></a>
                                <a href data-url="{{ route('admin/product/destroy', ['id' => $product->id]) }}"
                                    class="btn btn-danger action-delete" data-id="{{ $product->id }}"><i
                                        class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- pagination --}}
            <div class="row" style="float:right">
                <div class="col-md-12 text-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.action-delete').on('click', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var urlRequest = $(this).data('url');
                Swal.fire({
                    title: 'Xóa bản ghi?',
                    text: "Bạn có chắc muốn xóa bản ghi này không?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: urlRequest,
                            dataType: 'json',
                            success: function(response) {
                              console.log(response);
                                if (response.code == 200) {
                                    Swal.fire(
                                        'Đã xóa!',
                                        'Đã xóa bản ghi thành công.',
                                        'success'
                                    );
                                    $('.tr-'+id).remove();
                                }
                            },
                            error: function(xhr) {
                                console.log('error');
                            }
                        });
                    }
                })
            });
        });
    </script>
@endsection
