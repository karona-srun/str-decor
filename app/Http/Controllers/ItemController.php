<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemGroups;
use App\Models\ItemSubGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('item_name','desc')->get();
        return view('backend.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemGroups = ItemGroups::orderBy('item_group_name','desc')->get();
        $itemSubGroups = ItemSubGroups::orderBy('item_sub_group_name','desc')->get();
        return view('backend.items.create', compact('itemSubGroups','itemGroups'));
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
            'item_group' =>'required',
            'item_sub_group' =>'required',
            'item_code' =>'required',
            'color' =>'required',
            'item_name' =>'required',
            'scale' =>'required',
            'qty' =>'required',
            'buying_price' =>'required',
            'buying_date' =>'required',
        ],[
            'item_group.required' => __('app.item_group').__('app.required'),
            'item_sub_group.required' => __('app.item_sub_group').__('app.required'),
            'item_code.required' => __('app.code').__('app.required'),
            'color.required' => __('app.label_color_code').__('app.required'),
            'item_name.required' => __('app.label_name').__('app.required'),
            'scale.required' => __('app.label_scale').__('app.required'),
            'qty.required' => __('app.label_qty').__('app.required'),
            'buying_price.required' => __('app.label_buying_price').__('app.required'),
            'buying_date.required' => __('app.label_buying_date').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $imageName = '';
        if ($request->hasFile('photo')) {
            $imageName = 'item_' . time() . rand(1, 99999) . '.' . $request->photo->getClientOriginalExtension();
            $imageName = str_replace(' ', '_', $imageName);
            $request->photo->move(public_path('items'), $imageName);
        }

        $item = new Item();
        $item->item_group_id = $request->item_group;
        $item->item_sub_group_id = $request->item_sub_group;
        $item->photo = $imageName;
        $item->color_code = $request->color;
        $item->item_code = $request->item_code;
        $item->item_name = $request->item_name;
        $item->scale = $request->scale;
        $item->buying_price = $request->buying_price;
        $item->buying_date = $request->buying_date;
        $item->qty = $request->qty;
        $item->condition = $request->condition;
        $item->remark = $request->remark;
        $item->created_by = Auth::user()->id;
        $item->updated_by = Auth::user()->id;
        $item->save();

        return redirect('/itemes')->with('success', __('app.item') . __('app.label_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemGroups = ItemGroups::orderBy('item_group_name','desc')->get();
        $itemSubGroups = ItemSubGroups::orderBy('item_sub_group_name','desc')->get();
        $item = Item::find($id);
        return view('backend.items.edit', compact('itemGroups','itemSubGroups','item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'item_group' =>'required',
            'item_sub_group' =>'required',
            'item_code' =>'required',
            'color' =>'required',
            'item_name' =>'required',
            'scale' =>'required',
            'qty' =>'required',
            'buying_price' =>'required',
            'buying_date' =>'required',
        ],[
            'item_group.required' => __('app.item_group').__('app.required'),
            'item_sub_group.required' => __('app.item_sub_group').__('app.required'),
            'item_code.required' => __('app.code').__('app.required'),
            'color.required' => __('app.label_color_code').__('app.required'),
            'item_name.required' => __('app.label_name').__('app.required'),
            'scale.required' => __('app.label_scale').__('app.required'),
            'qty.required' => __('app.label_qty').__('app.required'),
            'buying_price.required' => __('app.label_buying_price').__('app.required'),
            'buying_date.required' => __('app.label_buying_date').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $item = Item::find($id);

        $imageName = '';
        if ($request->hasFile('photo')) {

            $image_path = "items/".$item->photo;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $imageName = 'item_' . time() . rand(1, 99999) . '.' . $request->photo->getClientOriginalExtension();
            $imageName = str_replace(' ', '_', $imageName);
            $request->photo->move(public_path('items'), $imageName);
            $item->photo = $imageName;
        }

        $item->item_group_id = $request->item_group;
        $item->item_sub_group_id = $request->item_sub_group;
        $item->color_code = $request->color;
        $item->item_code = $request->item_code;
        $item->item_name = $request->item_name;
        $item->scale = $request->scale;
        $item->buying_price = $request->buying_price;
        $item->buying_date = $request->buying_date;
        $item->qty = $request->qty;
        $item->condition = $request->condition;
        $item->remark = $request->remark;
        $item->updated_by = Auth::user()->id;
        $item->save();

        return redirect('/itemes')->with('success', __('app.item') . __('app.label_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect('/itemes')->with('success', __('app.item') . __('app.label_deleted_successfully'));
    }
}
