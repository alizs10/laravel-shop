<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductSpecRequest;
use App\Models\Market\Product;
use App\Models\Market\ProductSpec;
use Illuminate\Http\Request;

class ProductSpecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return view('admin.market.product.specs.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.market.product.specs.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductSpecRequest $request, Product $product)
    {
        $spec_values = $request->only('value')['value'];
        $category_specs = $product->category->specs;
        $inputs = [];
        foreach ($spec_values as $key => $spec_value) {
            $input['name'] = $category_specs[$key]['name'];
            $input['value'] = $spec_value;
            $input['product_id'] = $product->id;
            array_push($inputs, $input);
        }

        ProductSpec::insert($inputs);

        return redirect()->route('admin.market.product.spec.index', $product->id)->with('alertify-success', 'مشخصات محصول با موفقیت ثبت شد');
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
    public function edit(ProductSpec $spec)
    {
        return view('admin.market.product.specs.edit', compact('spec'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductSpecRequest $request, ProductSpec $spec)
    {
        $spec->update(['value' => $request->value]);

        return redirect()->route('admin.market.product.spec.index', $spec->product_id)->with('alertify-success', 'مشخصات موردنظر با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSpec $spec)
    {
        $spec->delete();

        return redirect()->route('admin.market.product.spec.index', $spec->product_id)->with('alertify-success', 'مشخصات موردنظر با موفقیت حذف شد');
    }
}
