<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;

class CategoryController extends Controller
{
    private $category;
    private $data;
    //
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        $this->data = [
            'name' => 'Trang chủ',
            'key' => 'Danh mục sản phẩm',
        ];
        $categories = $this->category->latest()->paginate(5);
        $this->data['categories'] = $categories;
        return view('admin.category.index', $this->data);
    }
    public function create()
    {
        $this->data = [
            'name'  => 'Trang chủ',
            'key'   => 'Thêm danh mục sản phẩm'
        ];
        $htmlOption = $this->getCategory($parentId = '');
        $this->data['htmlOption'] = $htmlOption;
        return view('admin.category.create', $this->data);
    }
    public function store(Request $request)
    {
        $name       = $request->input('name');
        $parent_id  = $request->input('parent_id');
        $data       = [
            'name'      => $name,
            'parent_id' => $parent_id,
            'slug'      => str_slug($name, '-')
        ];
        $insert = Category::create($data);
        if ($insert) {
            return redirect()->route('admin/category/list');
        }
    }
    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive   = new Recusive($data);
        $htmlOtion  = $recusive->categoryRecusive($parentId);
        return $htmlOtion;
    }
    public function edit($id)
    {
        $category = $this->category->find($id);
        $this->data = [
            'name' => 'Trang chủ',
            'key' => 'Chỉnh sửa danh mục sản phẩm',
        ];
        $this->data['category'] = $category;
        $this->data['product']  = 
        $htmlOption = $this->getCategory($category->parent_id);
        $this->data['htmlOption'] = $htmlOption;
        return view('admin.category.edit', $this->data);
    }
    public function update($id, Request $request) {
        $name       = $request->input('name');
        $parent_id  = $request->input('parent_id');
        $data_update = [
            'name'      => $name,
            'parent_id' => $parent_id,
            'slug'      => str_slug($name, '-')
        ];
        $update = $this->category->find($id)->update($data_update);
        if ($update) {
            return redirect()->route('admin/category/list');
        }
        
    }
    public function delete($id) {
        $delete = $this->category->find($id)->delete();
        return redirect()->route('admin/category/list');
    }
}
