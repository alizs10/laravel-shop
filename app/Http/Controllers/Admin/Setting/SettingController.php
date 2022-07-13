<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Setting\Setting;
use Database\Seeders\SettingSeeder;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Setting::class);
        
        $setting = Setting::first();
        if (!$setting) {
            $seeder = new SettingSeeder();
            $seeder->run();
            $setting = Setting::first();
        }
        return view('admin.setting.index', compact('setting'));
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
    public function store(Request $request)
    {
        //
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
    public function edit(Setting $setting)
    {
        $this->authorize('update', Setting::class);
        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting, ImageService $imageService)
    {
        $this->authorize('update', Setting::class);
        $inputs = $request->all();

        if ($request->hasFile('logo')) {
            
            $imageService->setExclusiveDirectory('setting');
            $imageService->setImageName('logo');
            $result = $imageService->save($request->file('logo'));
            $inputs['logo'] = $result;
            
            if ($result === false) {
                return redirect()->route('admin.setting.index')->with('alertify-error', 'آپلود لوگو با خطا مواجه شد.');    
            }
        }

        if ($request->hasFile('icon')) {
            
            $imageService->setExclusiveDirectory('setting');
            $imageService->setImageName('icon');
            $result = $imageService->save($request->file('icon'));
            $inputs['icon'] = $result;
            
            if ($result === false) {
                return redirect()->route('admin.setting.index')->with('alertify-error', 'آپلود لوگو با خطا مواجه شد.');    
            }
        }
   
        $result = $setting->update($inputs);
        if ($result) {
            return redirect()->route('admin.setting.index')->with('alertify-success', 'تنظمیات شما با موفقیت اعمال شد');
        } else {
            return redirect()->route('admin.setting.index')->with('alertify-error', 'ویرایش تنظیمات با خطا مواجه شد');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
