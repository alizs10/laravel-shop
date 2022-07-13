<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MenuRequest;
use App\Models\Content\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Menu::class);
        $menus = Menu::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Menu::class);
        $menus = Menu::all();
        return view('admin.content.menu.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $this->authorize('create', Menu::class);
        $inputs = $request->all();
        $inputs['url'] = Config::get('app.url') . '/' . $inputs['slug'];
        Menu::create($inputs);
        return redirect()->route('admin.content.menu.index')->with('alertify-success', 'منو جدید با موفقیت اضافه شد.');
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
    public function edit(Menu $menu)
    {
        $this->authorize('update', Menu::class);
        $menus = Menu::all();
        return view('admin.content.menu.edit', compact('menus', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $this->authorize('update', Menu::class);
    
        $inputs = $request->all();
        if (!isset($inputs['parent_id']) && empty($inputs['parent_id']) && $inputs['parent_id'] === '') {
            $inputs['parent_id'] = '';
        }
        if (isset($inputs['slug']) && !empty($inputs['slug']) && $inputs['slug'] !== '') {
            $inputs['url'] = Config::get('app.url') . '/' . $inputs['slug'];
        }
        $menu->update($inputs);
        return redirect()->route('admin.content.menu.index')->with('alertify-warning', 'منو موردنظر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $this->authorize('delete', Menu::class);
        $menu->delete();
        return redirect()->route('admin.content.menu.index')->with('alertify-error', 'منو موردنظر با موفقیت حذف شد.');
    }

    public function status(Menu $menu)
    {
        $this->authorize('update', Menu::class);
        $menu->status = $menu->status == 0 ? 1 : 0;
        $result = $menu->save();

        if ($result) {
            if ($menu->status == 0)
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
