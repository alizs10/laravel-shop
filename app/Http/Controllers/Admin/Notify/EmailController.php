<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailRequest;
use App\Models\Notify\Email;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Email::class);
        $emails = Email::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.notify.email.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Email::class);
        return view('admin.notify.email.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request)
    {
        $this->authorize('create', Email::class);

        $inputs = $request->all();
        $inputs['published_at'] = date('Y-m-d H:i:s', intval(substr($request->published_at, 0, 10)));
        $inputs['author_id'] = 1;
        Email::create($inputs);
        return redirect()->route('admin.notify.email.index')->with('alertify-success', 'ایمیل جدید با موفقیت اضافه شد.');
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
    public function edit(Email $email)
    {
        $this->authorize('update', Email::class);
        return view('admin.notify.email.edit', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailRequest $request, Email $email)
    {
        $this->authorize('update', Email::class);
        $inputs = $request->all();
        $inputs['published_at'] = date('Y-m-d H:i:s', intval(substr($request->published_at, 0, 10)));
        $email->update($inputs);
        return redirect()->route('admin.notify.email.index')->with('alertify-warning', 'ایمیل موردنظر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        $this->authorize('delete', Email::class);
        $email->delete();
        return redirect()->route('admin.notify.email.index')->with('alertify-error', 'ایمیل موردنظر با موفقیت حذف شد.');
    }

    public function status(Email $email)
    {
        $this->authorize('update', Email::class);

        $email->status = $email->status == 0 ? 1 : 0;
        $result = $email->save();

        if ($result) {
            if ($email->status == 0)
                return response()->json(['status' => true, 'checked' => false]);
            else
                return response()->json(['status' => true, 'checked' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
