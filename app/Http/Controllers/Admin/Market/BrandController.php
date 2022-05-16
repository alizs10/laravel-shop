<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\BrandRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.market.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.market.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        
        if ($request->hasFile('logo')) {
            
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageService->createIndexAndSave($request->file('logo'));
            if ($result === false) {
                return redirect()->route('admin.content.brand.index')->with('alertify-error', 'آپلود تصویر با خطا مواجه شد');    
            }
        }
        
        $inputs['logo'] = $result;
        Brand::create($inputs);
        return redirect()->route('admin.market.brand.index')->with('alertify-success', 'برند جدید با موفقیت اضافه شد');
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
    public function edit(Brand $brand)
    {
        return view('admin.market.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('logo')) {
            
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageService->createIndexAndSave($request->file('logo'));
            $inputs['logo'] = $result;
            $inputs['logo']['currentImage'] = $request->currentImage;
            unset($inputs['currentImage']);
            if ($result === false) {
                return redirect()->route('admin.market.brand.index')->with('alertify-error', 'آپلود تصویر با خطا مواجه شد');    
            }
        } else {
            $image = $brand->logo;
            $image['currentImage'] = $inputs['currentImage'];
            $inputs['logo'] = $image;
        }

        
        $brand->update($inputs);
        return redirect()->route('admin.market.brand.index')->with('alertify-warning', 'برند با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.market.brand.index')->with('alertify-error', 'برند با موفقیت حذف شد');
    }

    public function status(Brand $brand)
    {
        $brand->status = $brand->status == 0 ? 1 : 0;
        $result = $brand->save();

        if ($result) {
            if ($brand->status == 0)
            return response()->json(['status' => true, 'checked' => false]);
            else
            return response()->json(['status' => true, 'checked' => true]);
        }
        else
        {
            return response()->json(['status' => false]);
        }
    }
}
