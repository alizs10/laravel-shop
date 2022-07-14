<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductGalleryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Product;
use App\Models\Market\ProductGallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $this->authorize('index', Product::class);
        return view('admin.market.product.gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request, Product $product, ImageService $imageService)
    {
        $this->authorize('create', Product::class);

        if ($request->has('image')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-gallery');

            if (count($request->image) > 1) {
                foreach ($request->image as $image) {
                    $imagePath = $imageService->createIndexAndSave($image);
                    $inputs['product_id'] = $product->id;
                    $inputs['image'] = $imagePath;
               
                    ProductGallery::create($inputs);
                }
            } else {
                $imagePath = $imageService->createIndexAndSave($request->image[0]);
                $inputs['product_id'] = $product->id;
                $inputs['image'] = $imagePath;

                ProductGallery::create($inputs);
            }
        }

        return redirect()->route('admin.market.product.gallery.index', $product->id)->with('alertify-success', 'تصاویر با موفقیت آپلود شد');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductGallery $image)
    {
        $this->authorize('delete', Product::class);
        $image->delete();
        return redirect()->back()->with('alertify-danger', 'تصویر با موفقیت حذف شد');

    }
}
