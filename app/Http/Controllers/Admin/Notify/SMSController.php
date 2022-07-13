<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\SMSRequest;
use App\Models\Notify\SMS;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', SMS::class);
        $smses = SMS::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.notify.sms.index', compact('smses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', SMS::class);
        return view('admin.notify.sms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SMSRequest $request)
    {
        $this->authorize('create', SMS::class);
        
        $inputs = $request->all();
        $inputs['published_at'] = date('Y-m-d H:i:s', intval(substr($request->published_at, 0, 10)));
        $inputs['author_id'] = 1;
        SMS::create($inputs);
        return redirect()->route('admin.notify.sms.index')->with('alertify-success', 'پیامک جدید با موفقیت اضافه شد.');
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
    public function edit(SMS $sms)
    {
        $this->authorize('update', SMS::class);
        return view('admin.notify.sms.edit', compact('sms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SMSRequest $request, SMS $sms)
    {
        $this->authorize('update', SMS::class);
        $inputs = $request->all();
        $inputs['published_at'] = date('Y-m-d H:i:s', intval(substr($request->published_at, 0, 10)));
        $sms->update($inputs);
        return redirect()->route('admin.notify.sms.index')->with('alertify-warning', 'پیامک موردنظر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SMS $sms)
    {
        $this->authorize('delete', SMS::class);
        $sms->delete();
        return redirect()->route('admin.notify.sms.index')->with('alertify-error', 'پیامک موردنظر با موفقیت حذف شد.');
    }

    public function status(SMS $sms)
    {
        $this->authorize('update', SMS::class);
        $sms->status = $sms->status == 0 ? 1 : 0;
        $result = $sms->save();

        if ($result) {
            if ($sms->status == 0)
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
