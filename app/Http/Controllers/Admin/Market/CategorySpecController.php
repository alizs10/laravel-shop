<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategorySpecRequest;
use App\Models\Market\CategorySpec;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class CategorySpecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Product::class);
        $productCategories = ProductCategory::all();
        $specs = CategorySpec::all();
        return view('admin.market.category-spec.index', compact('productCategories', 'specs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductCategory $productCategory)
    {
        $this->authorize('create', Product::class);
        return view('admin.market.category-spec.create', compact('productCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategorySpecRequest $request, ProductCategory $productCategory)
    {
        $this->authorize('create', Product::class);

      
        $specs = $request->only('spec')['spec'];
        $inputs = [];

        foreach ($specs as $spec) {
            $spec = json_decode($spec);
            $spec->cat_id = $productCategory->id;
            array_push($inputs, (array) $spec);
        }

        CategorySpec::insert($inputs);

        return redirect()->route('admin.market.category-spec.index')->with('alertify-success', 'مشخصات کالا با موفقیت ثبت شد');
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
    public function edit(CategorySpec $spec)
    {
        $this->authorize('update', Product::class);
        return view('admin.market.category-spec.edit', compact('spec'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategorySpecRequest $request,CategorySpec $spec)
    {
        $this->authorize('update', Product::class);
        $inputs  = $request->all();
        $spec->update($inputs);

        return redirect()->route('admin.market.category-spec.manage', $spec->cat_id)->with('alertify-success', 'مشخصات کالا با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorySpec $spec)
    {
        $this->authorize('delete', Product::class);
        $spec->delete();

        return redirect()->route('admin.market.category-spec.manage', $spec->cat_id)->with('alertify-success', 'مشخصات کالا با موفقیت حذف شد');

    }

    public function status(CategorySpec $spec)
    {
        $this->authorize('update', Product::class);
        $spec->status = $spec->status == 0 ? 1 : 0;
        $result = $spec->save();

        if ($result) {
            if ($spec->status == 0)
            return response()->json(['status' => true, 'checked' => false]);
            else
            return response()->json(['status' => true, 'checked' => true]);
        }
        else
        {
            return response()->json(['status' => false]);
        }
    }

    public function manage(ProductCategory $productCategory)
    {
        $this->authorize('index', Product::class);
        $specs = $productCategory->specs;
        return view('admin.market.category-spec.manage', compact('specs', 'productCategory'));
    }
}
