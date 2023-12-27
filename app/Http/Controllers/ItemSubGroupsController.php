<?php

namespace App\Http\Controllers;

use App\Models\ItemGroups;
use App\Models\ItemSubGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ItemSubGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ItemSubGroups::orderBy('item_sub_group_name','desc')->get();
        return view('backend.itemsubgroups.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = ItemGroups::orderBy('item_group_name','desc')->get();
        return view('backend.itemsubgroups.create', compact('items'));
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
            'code' =>'required',
            'name' =>'required',
        ],[
            'item_group.required' => __('app.code').__('app.required'),
            'code.required' => __('app.code').__('app.required'),
            'name.required' => __('app.label_name').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $itemGroups = new ItemSubGroups();
        $itemGroups->item_group_id = $request->item_group;
        $itemGroups->item_sub_group_code = $request->code;
        $itemGroups->item_sub_group_name = $request->name;
        $itemGroups->remark = $request->remark;
        $itemGroups->created_by = Auth::user()->id;
        $itemGroups->updated_by = Auth::user()->id;
        $itemGroups->save();

        return redirect('/item-sub-group')->with('success', __('app.item_sub_group') . __('app.label_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemSubGroups  $itemSubGroups
     * @return \Illuminate\Http\Response
     */
    public function show(ItemSubGroups $itemSubGroups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemSubGroups  $itemSubGroups
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = ItemGroups::orderBy('item_group_name','desc')->get();
        $item = ItemSubGroups::find($id);
        return view('backend.itemsubgroups.edit', compact('items','item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemSubGroups  $itemSubGroups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'item_group' =>'required',
            'code' =>'required',
            'name' =>'required',
        ],[
            'item_group.required' => __('app.code').__('app.required'),
            'code.required' => __('app.code').__('app.required'),
            'name.required' => __('app.label_name').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $itemGroups = ItemSubGroups::find($id);
        $itemGroups->item_group_id = $request->item_group;
        $itemGroups->item_sub_group_code = $request->code;
        $itemGroups->item_sub_group_name = $request->name;
        $itemGroups->remark = $request->remark;
        $itemGroups->updated_by = Auth::user()->id;
        $itemGroups->save();

        return redirect('/item-sub-group')->with('success', __('app.item_sub_group') . __('app.label_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemSubGroups  $itemSubGroups
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemSubGroups = ItemSubGroups::find($id);
        
        $itemSubGroups->delete();
        return redirect('/item-sub-group')->with('success', __('app.item_sub_group') . __('app.label_deleted_successfully'));
    }
}
