<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->where('commentable_type', 'App\Models\Market\Product')->simplePaginate(15);
        return view('admin.market.comment.index', compact('comments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, Comment $comment)
    {
        $inputs = $request->all();
        $request->merge(['body' => Purifier::clean($request->get('body'))]);
        $inputs['author_id'] = 10;
        $inputs['commentable_type'] = $comment->commentable_type;
        $inputs['commentable_id'] = $comment->commentable_id;
        $inputs['parent_id'] = $comment->id;
        $inputs['status'] = 1;
        $inputs['seen'] = 1;
        $inputs['approved'] = 1;
  
        Comment::create($inputs);
        return redirect()->route('admin.market.comment.index')->with('alertify-success', 'پاسخ شما با موفقیت ارسال شد');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        if (!$comment->seen) {
            $comment->seen = 1;
            $result = $comment->save();
            if (!$result) {
                return view('admin.market.comment.show', compact('comment'))->with('alertify-error', 'هنگام نمایش نظر خطایی رخ داده است');
            }
        }

        return view('admin.market.comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('admin.market.comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $inputs = $request->all();
        $comment->update($inputs);
        return redirect()->route('admin.market.comment.index')->with('alertify-warning', 'پاسخ شما با موفقیت ویرایش شد');
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

    public function status(Comment $comment)
    {
        $comment->status = $comment->status == 0 ? 1 : 0;
        $result = $comment->save();

        if ($result) {
            if ($comment->status == 0)
                return response()->json(['status' => true, 'checked' => false]);
            else
                return response()->json(['status' => true, 'checked' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function approve(Comment $comment)
    {
        $comment->approved = $comment->approved == 0 ? 1 : 0;
        $result = $comment->save();

        if ($result) {
            if ($comment->approved == 0)
                return response()->json(['status' => true, 'approved' => false]);
            else
                return response()->json(['status' => true, 'approved' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
