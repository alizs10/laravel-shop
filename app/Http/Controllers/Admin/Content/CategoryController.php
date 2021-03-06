<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Http\Services\Image\ImageCacheService;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', PostCategory::class);
        $postCategories = PostCategory::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('admin.content.category.index', compact('postCategories'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', PostCategory::class);
        return view('admin.content.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request, ImageService $imageService)
    {
        $this->authorize('create', PostCategory::class);
        $inputs = $request->all();
        
        if ($request->hasFile('image')) {
            
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.content.category.index')->with('alertify-error', 'آپلود تصویر با خطا مواجه شد.');    
            }
        }
        
        $inputs['image'] = $result;
        PostCategory::create($inputs);
        return redirect()->route('admin.content.category.index')->with('alertify-success', 'دسته بندی جدید با موفقیت اضافه شد.');
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
    public function edit(PostCategory $postCategory)
    {
        $this->authorize('update', PostCategory::class);
        return view('admin.content.category.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCategoryRequest $request, PostCategory $postCategory, ImageService $imageService)
    {
        $this->authorize('update', PostCategory::class);
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
            $inputs['image'] = $result;
            $inputs['image']['currentImage'] = $request->currentImage;
            unset($inputs['currentImage']);
            if ($result === false) {
                return redirect()->route('admin.content.category.index')->with('alertify-error', 'آپلود تصویر با خطا مواجه شد.');    
            }
        } else {
            $image = $postCategory->image;
            $image['currentImage'] = $inputs['currentImage'];
            $inputs['image'] = $image;
        }

        
        $postCategory->update($inputs);
        return redirect()->route('admin.content.category.index')->with('alertify-warning', 'دسته بندی موردنظر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $postCategory)
    {
        $this->authorize('delete', PostCategory::class);
        $postCategory->delete();
        return redirect()->route('admin.content.category.index')->with('alertify-error', 'دسته بندی موردنظر با موفقیت حذف شد.');
    }

    public function status(PostCategory $postCategory)
    {
        $this->authorize('update', PostCategory::class);
        $postCategory->status = $postCategory->status == 0 ? 1 : 0;
        $result = $postCategory->save();

        if ($result) {
            if ($postCategory->status == 0)
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
