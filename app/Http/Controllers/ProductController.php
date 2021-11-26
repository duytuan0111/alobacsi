<?php

namespace App\Http\Controllers;

use Auth;
use App\models\tags;
use App\models\Product;
use App\Models\Category;
use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\models\product_tags;
use Illuminate\Http\Request;
use App\models\product_images;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    private $data;
    public function __construct(Category $category, Product $product, product_images $productImage, tags $tag, product_tags $productTag)
    {
        $this->category     = $category;
        $this->product      = $product;
        $this->productImage = $productImage;
        $this->tag          = $tag;
        $this->productTag   = $productTag;
    }
    public function index()
    {
        $this->data = [
            'name'  => 'Trang chủ',
            'key'   => 'Danh sách sản phẩm'
        ];
        $products = $this->product->latest()->paginate(5);
        $this->data['products'] = $products;
        return view('admin.product.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategory($parentId)
    {
        $data         = $this->category->all();
        $recusive     = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function create()
    {
        $this->data = [
            'name'  => 'Trang chủ',
            'key'   => 'Thêm sản phẩm'
        ];
        $htmlOption = $this->getCategory($parentId = '');
        $this->data['htmlOption'] = $htmlOption;
        return view('admin.product.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductAddRequest $request)
    {
        DB::beginTransaction();
        try {
            $dataProductCreate = [
                'name'          => $request->name,
                'price'         => $request->price,
                'content'       => $request->contents,
                'user_id'       => Auth::user()->id,
                'category_id'   => $request->category_id
            ];
            $dataUploadImages     = $this->StorageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadImages)) {
                $dataProductCreate['image_name']            = $dataUploadImages['file_name'];
                $dataProductCreate['feature_image_path']    = $dataUploadImages['file_path'];
            }
            $insert = $this->product->create($dataProductCreate);

            // insert data to product_images
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $productImageDetail = $this->StorageTraitUploadMultiple($fileItem, 'product');
                    $this->productImage->insert([
                        'product_id'    => $insert->id,
                        'image_path'    => $productImageDetail['file_path'],
                        'image_name'    => $productImageDetail['file_name']
                    ]);
                }
            }

            if (!empty($request->tag)) {
                foreach ($request->tag as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate([
                        'name'  => $tagItem
                    ]);
                    $tagIds[] = $tagInstance->id;
                    $this->productTag->create([
                        'product_id' => $insert->id,
                        'tag_id'     => $tagInstance->id
                    ]);
                }
            }
            DB::commit();
            if ($insert) {
                return redirect()->route(('admin/product/list'));
            }
        } catch (\Exception $exception) {
            DB::rollback();
            Log::error('Message:' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $productDetail = $this->product->find($id);
        $this->data = [
            'key'           => 'Chỉnh sửa sản phẩm',
            'name'          => 'Trang chủ',
            'productDetail' => $productDetail
        ];
        $htmlOption = $this->getCategory($parentId = $productDetail->id);
        $this->data['htmlOption'] = $htmlOption;
        return view('admin.product.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $name           = $request->name;
            $price          = $request->price;
            $category_id    = $request->category_id;
            $content        = $request->contents;
            $data_update    = [
                'name'          => $name,
                'price'         => $price,
                'category_id'   => $category_id,
                'content'       => $content
            ];
            $dataUploadImages     = $this->StorageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadImages)) {
                $data_update['image_name']            = $dataUploadImages['file_name'];
                $data_update['feature_image_path']    = $dataUploadImages['file_path'];
            }
            $update = $this->product->find($id)->update($data_update);
            $product = $this->product->find($id);             // insert data to product_images
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete(); //delete image
                foreach ($request->image_path as $fileItem) {
                    $productImageDetail = $this->StorageTraitUploadMultiple($fileItem, 'product');
                    $this->productImage->insert([
                        'product_id'    => $id,
                        'image_path'    => $productImageDetail['file_path'],
                        'image_name'    => $productImageDetail['file_name']
                    ]);
                }
            }
            if (!empty($request->tag)) {
                foreach ($request->tag as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate([
                        'name'  => $tagItem
                    ]);
                    $tagIds[] = $tagInstance->id;
                    $this->productTag->create([
                        'product_id' => $id,
                        'tag_id'     => $tagInstance->id
                    ]);
                }
            }
            $product->tags()->sync($tagIds);
            DB::commit();
            if ($update) {
                return redirect()->route(('admin/product/list'));
            }
        } catch (\Exception $exception) {
            DB::rollback();
            Log::error('Message:' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $delete = $this->product->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ],200);
        } catch (\Exception $exceptions) {
            Log::error('Message: '.$exceptions->getMessage(). '-- line '.$exceptions->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);

        }
    }
}
