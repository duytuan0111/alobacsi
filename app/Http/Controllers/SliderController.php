<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateSlider;
use App\Models\Slider;
use App\Traits\StorageImageTrait;
use Exception;

class SliderController extends Controller
{
    use StorageImageTrait;
    private $slider;
    private $data;

    public function __construct(Slider $slider) 
    {
        $this->slider = $slider;
    }
    //
    public function index() {
        $this->data = [
            'name'  => 'Trang chủ',
            'key'   => 'Danh sách slider'
        ];
        $this->data['sliders'] = $this->slider->latest()->paginate(5);
        return view('admin.slider.index', $this->data);
    }
    public function create() {
        $this->data = [
            'name'  => 'Trang chủ',
            'key'   => 'Thêm mới slider'
        ];
        return view('admin.slider.create', $this->data);
    }
    public function store(CreateSlider $request) {
        try {
            $data = [
                'name'          => $request->name,
                'description'   => $request->description,
            ];
            $dataUploadImages     = $this->StorageTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataUploadImages)) {
                $data['image_path'] = $dataUploadImages['file_path'];
                $data['image_name'] = $dataUploadImages['file_name'];
            }
            $insert = $this->slider->create($data);
            if ($insert) {
                return redirect()->route('admin/slider/list');
            }
        } catch(\Exception $exception) {
            Log::error('Lỗi : '.$exception->getMessage());
        }
        
    }
    public function edit($id) {
        $this->data = [
            'name'  => 'Trang chủ',
            'key'   => 'Cập nhật slider'
        ];
        $this->data['detailSlider'] = $this->slider->find($id);
        return view('admin.slider.edit', $this->data);
    }

    public function update(Request $request, $id) {
        try {
            $dataUpdate = [
                'name'          => $request->name,
                'description'   => $request->description,
            ];
            if (!empty($dataUploadImages)) {
                $dataUpdate['image_path'] = $dataUploadImages['file_path'];
                $dataUpdate['image_name'] = $dataUploadImages['file_name'];
            }
            $update = $this->slider->find($id)->update($dataUpdate);
            if ($update) {
                return redirect()->route('admin/slider/list');
            }
        } catch (Exception $exception) {
            Log::error("Error: ". $exception->getMessage());
        }
    }

    public function delete($id) {   
        $delete = $this->slider->find($id)->delete();
        return redirect()->route('admin/slider/list');
    }
}
