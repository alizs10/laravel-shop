<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\Market\ProductMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.market.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.create', compact('productCategories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ImageService $imageService)
    {

        $inputs = $request->all();
        $inputs['published_at'] = date('Y-m-d', intval(substr($request->published_at, 0, 10)));

        if ($request->hasFile('image')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.market.product.index')->with('alertify-error', 'آپلود تصویر با خطا مواجه شد');
            }
        }

        $inputs['image'] = $result;

        DB::transaction(function () use ($inputs, $request) {
            $product = Product::create($inputs);

            $meta_keys = $request->meta_key;
            $meta_values = $request->meta_value;

            $metas = array_combine($meta_keys, $meta_values);

            if (count($metas) > 0) {
                foreach ($metas as $key => $value) {
                    if ($value !== null) {
                        ProductMeta::create([
                            'meta_key' => $key,
                            'meta_value' => $value,
                            'product_id' => $product->id,
                        ]);
                    }
                }
            }
        });




        return redirect()->route('admin.market.product.index')->with('alertify-success', 'محصول جدید با موفقیت اضافه شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.edit', compact('product', 'productCategories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product, ImageService $imageService)
    {


        $inputs = $request->all();
        $inputs['published_at'] = date('Y-m-d', intval(substr($request->published_at, 0, 10)));
        if ($request->hasFile('image')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));
            $inputs['image'] = $result;
            $inputs['image']['currentImage'] = $request->currentImage;
            unset($inputs['currentImage']);
            if ($result === false) {
                return redirect()->route('admin.market.product.index')->with('alertify-error', 'آپلود تصویر با خطا مواجه شد');
            }
        }

        $meta_keys = $request->meta_key;
        $meta_values = $request->meta_value;
        $metas = array_combine($meta_keys, $meta_values);


        $oldMetas = $product->metas->toArray();
        $newMetas = $metas;


        foreach ($newMetas as $key => $value) {

            foreach ($oldMetas as $num => $oldMeta) {

                if ($oldMeta['meta_key'] == $key && $oldMeta['meta_value'] == $value) {
                    print_r($key . '-' . $num . '<br>');
                    unset($oldMetas[$num]);
                    unset($newMetas[$key]);
                }
            }
        }



        DB::transaction(function () use ($inputs, $product, $newMetas, $oldMetas) {

            $product->update($inputs);

            if (count($oldMetas) > 0) {
                foreach ($oldMetas as $oldMeta) {
                    ProductMeta::where(['meta_key' => $oldMeta['meta_key'], 'meta_value' => $oldMeta['meta_value'], 'product_id' => $oldMeta['product_id']])->delete();
                }
            }

            if (count($newMetas) > 0) {
                foreach ($newMetas as $new_meta_key => $new_meta_value) {
                    ProductMeta::create([
                        'meta_key' => $new_meta_key,
                        'meta_value' => $new_meta_value,
                        'product_id' => $product->id
                    ]);
                }
            }
        });


        return redirect()->route('admin.market.product.index')->with('alertify-warning', 'محصول جدید با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.market.product.index')->with('alertify-error', 'محصول موردنظر با موفقیت حذف شد');
    }

    public function status(Product $product)
    {
        $product->status = $product->status == 0 ? 1 : 0;
        $result = $product->save();

        if ($result) {
            if ($product->status == 0)
                return response()->json(['status' => true, 'checked' => false]);
            else
                return response()->json(['status' => true, 'checked' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
