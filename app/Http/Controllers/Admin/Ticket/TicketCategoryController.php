<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketCategoryRequest;
use App\Models\Ticket\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = TicketCategory::simplePaginate(15);
        return view('admin.ticket.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ticket.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketCategoryRequest $request)
    {
        $inputs = $request->all();
        $result = TicketCategory::create($inputs);
        return redirect()->route('admin.ticket.category.index')->with('alertify-success', 'دسته بندی جدید با موفقیت اضافه شد.');
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
    public function edit(TicketCategory $category)
    {
        return view('admin.ticket.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketCategoryRequest $request, TicketCategory $category)
    {
        $inputs = $request->all();
        $category->update($inputs);
        return redirect()->route('admin.ticket.category.index')->with('alertify-warning', 'دسته بندی موردنظر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.ticket.category.index')->with('alertify-error', 'دسته بندی موردنظر با موفقیت حذف شد.');
    }

    public function status(TicketCategory $category)
    {
        $category->status = $category->status == 0 ? 1 : 0;
        $result = $category->save();

        if ($result) {
            if ($category->status == 0)
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
