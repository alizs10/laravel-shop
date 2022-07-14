<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductColorRequest;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $this->authorize('index', Product::class);
        return view('admin.market.product.color.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $this->authorize('create', Product::class);
        return view('admin.market.product.color.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductColorRequest $request, Product $product)
    {
        $this->authorize('create', Product::class);
        $inputs = $request->all();
        $inputs['product_id'] = $product->id;
        ProductColor::create($inputs);
        return redirect()->route('admin.market.product.color.index', $product->id)->with('alertify-success', 'رنگ جدید با موفقیت اضافه شد');
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
    public function edit(ProductColor $color)
    {
        $this->authorize('update', Product::class);
        return view('admin.market.product.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductColorRequest $request, ProductColor $color)
    {
        $this->authorize('update', Product::class);
        $inputs = $request->all();
        $color->update($inputs);
        return redirect()->route('admin.market.product.color.index', $color->product_id)->with('alertify-warning', 'رنگ موردنظر ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductColor $color)
    {
        $this->authorize('delete', Product::class);
        $color->delete();
        return redirect()->back()->with('alertify-error', 'رنگ موردنظر با موفقیت حذف شد');
    }
}
