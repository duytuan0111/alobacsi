<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\AddSettingRequest;

class SettingController extends Controller
{
    private $data;
    private $setting;
    public function __construct(Setting $setting)
    {   
        $this->setting = $setting;
    }
    public function index() {
        $this->data = [
            'name'          => 'Trang chủ',
            'key'           => 'Danh sách cài đặt',
            'settings'      => $this->setting->latest()->paginate(5),
        ];
        return view('admin.settings.index', $this->data);
    }
    public function create() {
        $this->data = [
            'name'  => 'Trang chủ',
            'key'   => 'Thêm mới cài đặt'
        ];
        return view('admin.settings.create', $this->data);
    }
    public function store(AddSettingRequest $request) {
        $data = [
            'config_key'    => $request->config_key,
            'config_value'  => $request->config_value,
            'type'          => $request->type,
        ];
        $insert = $this->setting->insert($data);
        if ($insert) {
            return redirect()->route('admin/settings/list');
        }
    }
    public function edit($id) {
        $this->data = [
            'name'          => 'Trang chủ',
            'key'           => 'Cập nhật cài đặt',
        ];
        return view('admin.settings.edit', $this->data);
    }
}
