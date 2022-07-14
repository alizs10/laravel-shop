<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\DeliveryRequest;
use App\Models\Market\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Delivery::class);
        $deliveryMethods = Delivery::all();
        return view('admin.market.delivery.index', compact('deliveryMethods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Delivery::class);
        return view('admin.market.delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryRequest $request)
    {
        $this->authorize('create', Delivery::class);
        $inputs = $request->all();
        Delivery::create($inputs);
        return redirect()->route('admin.market.delivery.index')->with('alertify-success', 'روش ارسال جدید ثیت شد');
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
    public function edit(Delivery $delivery_method)
    {
        $this->authorize('update', Delivery::class);
        return view('admin.market.delivery.edit', compact('delivery_method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryRequest $request, Delivery $delivery_method)
    {
        $this->authorize('update', Delivery::class);
        $inputs = $request->all();
        $delivery_method->update($inputs);
        return redirect()->route('admin.market.delivery.index')->with('alertify-warning', 'روش ارسال با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery_method)
    {
        $this->authorize('delete', Delivery::class);
        $delivery_method->delete();
        return redirect()->route('admin.market.delivery.index')->with('alertify-error', 'روش ارسال با موفقیت حذف شد');
    }

    public function status(Delivery $delivery_method)
    {
        $this->authorize('update', Delivery::class);
        $delivery_method->status = $delivery_method->status == 0 ? 1 : 0;
        $result = $delivery_method->save();

        if ($result) {
            if ($delivery_method->status == 0)
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
