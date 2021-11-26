@extends('admin.layout.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              Thêm mới cài đặt
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('admin/settings/create').'?type=Text' }}">Text</a></li>
              <li><a href="{{ route('admin/settings/create').'?type=Textarea' }}">Textarea</a></li>
            </ul>
          </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Config key</th>
                <th scope="col">Config Value</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($settings as $setting)
              <tr>
                <th scope="row">{{ $setting->config_key }}</th>
                <td>{{ $setting->config_value }}</td>
                <td>
                    <a href="{{ route('admin/settings/edit', ['id' => $setting->id]) }}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                    <a href="{{ route('admin/slider/delete', ['id' => $setting->id]) }}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection
