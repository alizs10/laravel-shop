<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\FAQRequest;
use App\Models\Content\Faq;

use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Faq::class);
        $faqs = Faq::orderBy('created_at')->simplePaginate(15);
        return view('admin.content.faq.index', compact('faqs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Faq::class);
        return view('admin.content.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FAQRequest $request)
    {
        $this->authorize('create', Faq::class);
        $inputs = $request->all();
        Faq::create($inputs);
        return redirect()->route('admin.content.faq.index')->with('alertify-success', 'سوال جدید با موفقیت اضافه شد.');
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
    public function edit(Faq $faq)
    {
        $this->authorize('update', Faq::class);
        return view('admin.content.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FAQRequest $request, Faq $faq)
    {
        $this->authorize('update', Faq::class);
        $inputs = $request->all();
        $faq->update($inputs);
        return redirect()->route('admin.content.faq.index')->with('alertify-warning', 'سوال موردنظر با موفقیت ویرایش شد.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $this->authorize('delete', Faq::class);
        $faq->delete();
        return redirect()->route('admin.content.faq.index')->with('alertify-error', 'سوال موردنظر با موفقیت حذف شد.');
    }

    public function status(Faq $faq)
    {
        $this->authorize('update', Faq::class);
        $faq->status = $faq->status == 0 ? 1 : 0;
        $result = $faq->save();

        if ($result) {
            if ($faq->status == 0)
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
