<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\AdvertisementBanerRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\AdvertisementBaner;
use Illuminate\Http\Request;

class AdvertisementBanerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $baners = AdvertisementBaner::all();
        $positions = AdvertisementBaner::$positions;
        return view('admin.content.advertisement-baner.index', compact('baners', 'positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = AdvertisementBaner::$positions;
        return view('admin.content.advertisement-baner.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementBanerRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'baners');
            $result = $imageService->save($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.content.advertisement-baner.index')->with('alertify-error', 'آپلود تصویر با خطا مواجه شد.');
            }
        }
        $inputs['image'] = $result;
        $baner = AdvertisementBaner::create($inputs);
        return redirect()->route('admin.content.advertisement-baner.index')->with('alertify-success', 'بنر جدید با موفقیت اضافه شد.');
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
    public function edit(AdvertisementBaner $baner)
    {
        $positions = AdvertisementBaner::$positions;
        return view('admin.content.advertisement-baner.edit', compact('baner', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisementBanerRequest $request, AdvertisementBaner $baner, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'baners');
            $result = $imageService->save($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.content.advertisement-baner.index')->with('alertify-error', 'آپلود تصویر با خطا مواجه شد.');
            }
            $inputs['image'] = $result;
        }

        $baner->update($inputs);
        return redirect()->route('admin.content.advertisement-baner.index')->with('alertify-success', 'بنر جدید با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdvertisementBaner $baner)
    {
        $baner->delete();
        return redirect()->route('admin.content.advertisement-baner.index')->with('alertify-error', 'بنر موردنظر با موفقیت حذف شد.');
    }

    public function status(AdvertisementBaner $baner)
    {
        $baner->status = $baner->status == 0 ? 1 : 0;
        $result = $baner->save();

        if ($result) {
            if ($baner->status == 0)
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
