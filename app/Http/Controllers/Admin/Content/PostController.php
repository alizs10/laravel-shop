<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use App\Models\User;
use App\Notifications\Admin\PostCreated;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Post::class);
        $posts = Post::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        $postCategories = PostCategory::all();
        return view('admin.content.post.create', compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, ImageService $imageService)
    {
        $this->authorize('store', Post::class);

        $inputs = $request->all();
        $inputs['published_at'] = date('Y-m-d', intval(substr($request->published_at, 0, 10)));
    
        if ($request->hasFile('image')) {
            
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.content.post.index')->with('alertify-error', 'آپلود تصویر با خطا مواجه شد.');    
            }
        }

        $inputs['image'] = $result;
        $inputs['author_id'] = 10;
        Post::create($inputs);
        $details = [
            'message' => 'یک پست جدید منتشر کرد',
            'username' => User::find($inputs['author_id'])->fullName,
            'title' => $inputs['title'],
        ];

        $admin = User::find(10);
        $admin->notify(new PostCreated($details));
        return redirect()->route('admin.content.post.index')->with('alertify-success', 'پست جدید با موفقیت اضافه شد.');
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
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);

        $postCategories = PostCategory::all();
        return view('admin.content.post.edit', compact('post', 'postCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post, ImageService $imageService)
    {
        $this->authorize('update', $post);
        $inputs = $request->all();
        $inputs['published_at'] = date('Y-m-d', intval(substr($request->published_at, 0, 10)));

        if ($request->hasFile('image')) {
            
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
            $result = $imageService->createIndexAndSave($request->file('image'));
            $inputs['image'] = $result;
            $inputs['image']['currentImage'] = $request->currentImage;
            unset($inputs['currentImage']);
            if ($result === false) {
                return redirect()->route('admin.content.post.index')->with('alertify-error', 'آپلود تصویر با خطا مواجه شد.');    
            }
        }

        
        $post->update($inputs);
        return redirect()->route('admin.content.post.index')->with('alertify-warning', 'پست موردنظر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $post)
    {
        $this->authorize('delete', $post);
        
        $post->delete();
        return redirect()->route('admin.content.post.index')->with('alertify-error', 'پست موردنظر با موفقیت حذف شد.');
    }

    public function status(Post $post)
    {
   
        $post->status = $post->status == 0 ? 1 : 0;
        $result = $post->save();

        if ($result) {
            if ($post->status == 0)
            return response()->json(['status' => true, 'checked' => false]);
            else
            return response()->json(['status' => true, 'checked' => true]);
        }
        else
        {
            return response()->json(['status' => false]);
        }
    }

    public function commentable(Post $post)
    {
        $post->commentable = $post->commentable == 0 ? 1 : 0;
        $result = $post->save();

        if ($result) {
            if ($post->commentable == 0)
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
