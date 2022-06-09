<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategorySpecRequest;
use App\Models\Market\CategorySpec;
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function manage(ProductCategory $productCategory)
    {
        $specs = $productCategory->specs;
        return view('admin.market.category-spec.manage', compact('specs', 'productCategory'));
    }
}
