<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PageRequest;
use App\Models\Content\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Page::class);
        $pages = Page::orderBy('created_at')->simplePaginate(15);
        return view('admin.content.page.index', compact('pages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Page::class);
        return view('admin.content.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $this->authorize('create', Page::class);
        $inputs = $request->all();
        Page::create($inputs);
        return redirect()->route('admin.content.page.index')->with('alertify-success', 'صفحه جدید با موفقیت ساخته شد.');
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
    public function edit(Page $page)
    {
        $this->authorize('update', Page::class);
        return view('admin.content.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $this->authorize('update', Page::class);
        $inputs = $request->all();
        $page->update($inputs);
        return redirect()->route('admin.content.page.index')->with('alertify-warning', 'صفحه موردنظر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $this->authorize('delete', Page::class);
        $page->delete();
        return redirect()->route('admin.content.page.index')->with('alertify-error', 'صفحه موردنظر با موفقیت حذف شد.');
    }

    public function status(Page $page)
    {
        $this->authorize('update', Page::class);
        $page->status = $page->status == 0 ? 1 : 0;
        $result = $page->save();

        if ($result) {
            if ($page->status == 0)
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
