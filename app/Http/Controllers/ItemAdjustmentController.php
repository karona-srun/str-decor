<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemAdjustment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ItemAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ItemAdjustment::get();
        return view('backend.itemsadjustment.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::orderBy('item_name','desc')->get();
        return view('backend.itemsadjustment.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'item_code' =>'required',
            'item' =>'required',
            'color' =>'required',
            'item_name' =>'required',
            'qty' =>'required',
        ],[
            'item.required' => __('app.item').__('app.required'),
            'qty.required' => __('app.label_qty').__('app.required'),
            'item_code.required' => __('app.code').__('app.required'),
            'color.required' => __('app.label_color_code').__('app.required'),
            'item_name.required' => __('app.label_name').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        };

        $item = new ItemAdjustment();
        $item->color_code = $request->color;
        $item->item_code = $request->item_code;
        $item->item_name = $request->item_name;
        $item->item_id = $request->item;
        $item->qty = $request->qty;
        $item->condition = $request->condition;
        $item->remark = $request->remark;
        $item->created_by = Auth::user()->id;
        $item->updated_by = Auth::user()->id;
        $item->save();

        return redirect('/adjustment')->with('success', __('app.item_adjustment') . __('app.label_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemAdjustment  $itemAdjustment
     * @return \Illuminate\Http\Response
     */
    public function show(ItemAdjustment $itemAdjustment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemAdjustment  $itemAdjustment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ItemAdjustment::find($id);
        $items = Item::orderBy('item_name','desc')->get();
        return view('backend.itemsadjustment.edit', compact('item','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemAdjustment  $itemAdjustment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(),[
            'item_code' =>'required',
            'item' =>'required',
            'color' =>'required',
            'item_name' =>'required',
            'qty' =>'required',
        ],[
            'item.required' => __('app.item').__('app.required'),
            'qty.required' => __('app.label_qty').__('app.required'),
            'item_code.required' => __('app.code').__('app.required'),
            'color.required' => __('app.label_color_code').__('app.required'),
            'item_name.required' => __('app.label_name').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        };

        $item = ItemAdjustment::find($id);
        $item->color_code = $request->color;
        $item->item_code = $request->item_code;
        $item->item_name = $request->item_name;
        $item->item_id = $request->item;
        $item->qty = $request->qty;
        $item->condition = $request->condition;
        $item->remark = $request->remark;
        $item->created_by = Auth::user()->id;
        $item->updated_by = Auth::user()->id;
        $item->save();

        
        return redirect('/adjustment')->with('success', __('app.item_adjustment') . __('app.label_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemAdjustment  $itemAdjustment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemAdjustment = ItemAdjustment::find($id);
        $itemAdjustment->delete();
        return redirect('/adjustment')->with('success', __('app.item_adjustment') . __('app.label_deleted_successfully'));
    }
}
