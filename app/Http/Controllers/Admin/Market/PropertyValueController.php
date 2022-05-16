<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\PropertyValueRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\PropertyValue;
use Illuminate\Http\Request;

class PropertyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryAttribute $property)
    {
        $products = $property->category->products;
        return view('admin.market.property.value.index', compact('property', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryAttribute $property)
    {
        $products = $property->category->products;
        return view('admin.market.property.value.create', compact('property', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyValueRequest $request, CategoryAttribute $property)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $inputs['type'] = $property->type;
        $inputs['category_attribute_id'] = $property->id;
        PropertyValue::create($inputs);
        return redirect()->route('admin.market.property.value.index', $property->id)->with('alertify-success', 'مقدار فرم کالا با موفقیت ثبت شد');
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
    public function edit(PropertyValue $value)
    {
        $products = $value->attribute->category->products;
        return view('admin.market.property.value.edit', compact('value', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyValueRequest $request, PropertyValue $value)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $value->update($inputs);
        return redirect()->route('admin.market.property.value.index', $value->category_attribute_id)->with('alertify-warning', 'مقدار فرم کالا با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyValue $value)
    {
        $value->delete();
        return redirect()->back()->with('alertify-error', 'مقدار فرم کالا با موفقیت حذف شد');
    }
}
