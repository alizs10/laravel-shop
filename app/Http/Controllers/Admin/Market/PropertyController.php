<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\PropertyRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\ProductCategory;
use App\Models\Market\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = CategoryAttribute::all();
        return view('admin.market.property.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        return view('admin.market.property.create', compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $inputs = $request->all();
        CategoryAttribute::create($inputs);
        return redirect()->route('admin.market.property.index')->with('alertify-success', 'فرم کالا با موفقیت اضافه شد');

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
    public function edit(CategoryAttribute $property)
    {
        $productCategories = ProductCategory::all();
        return view('admin.market.property.edit', compact('property', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, CategoryAttribute $property)
    {
        $inputs = $request->all();
        $property->update($inputs);
        return redirect()->route('admin.market.property.index')->with('alertify-warning', 'فرم کالا موردنظر ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryAttribute $property)
    {
        $property->delete();
        return redirect()->back()->with('alertify-error', 'فرم کالا موردنظر با موفقیت حذف شد');
    }
}
