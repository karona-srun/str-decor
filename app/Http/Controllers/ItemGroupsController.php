<?php

namespace App\Http\Controllers;

use App\Models\ItemGroups;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ItemGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemGroups = ItemGroups::orderBy('item_group_name','desc')->get();
        return view('backend.itemgroups.index', compact('itemGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.itemgroups.create');
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
            'code' =>'required',
            'name' =>'required',
        ],[
            
            'code.required' => __('app.code').__('app.required'),
            'name.required' => __('app.label_name').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $itemGroups = new ItemGroups();
        $itemGroups->item_group_code = $request->code;
        $itemGroups->item_group_name = $request->name;
        $itemGroups->remark = $request->remark;
        $itemGroups->created_by = Auth::user()->id;
        $itemGroups->updated_by = Auth::user()->id;
        $itemGroups->save();

        return redirect('/item-group')->with('success', __('app.item_group') . __('app.label_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemGroups  $itemGroups
     * @return \Illuminate\Http\Response
     */
    public function show(ItemGroups $itemGroups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemGroups  $itemGroups
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ItemGroups::find($id);
        return view('backend.itemgroups.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemGroups  $itemGroups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'code' =>'required',
            'name' =>'required',
        ],[
            
            'code.required' => __('app.code').__('app.required'),
            'name.required' => __('app.label_name').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $itemGroups = ItemGroups::find($id);
        $itemGroups->item_group_code = $request->code;
        $itemGroups->item_group_name = $request->name;
        $itemGroups->remark = $request->remark;
        $itemGroups->updated_by = Auth::user()->id;
        $itemGroups->save();

        return redirect('/item-group')->with('success', __('app.item_group') . __('app.label_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemGroups  $itemGroups
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $itemGroups = ItemGroups::find($id);

        // if ($itemGroups->ItemSubGroups()->count() > 0) {
            
        //     return back()->with('danger', __('app.label_cannot_delete').__('app.item_group').__('app.label_that_have').__('app.item_sub_group'));
        // }   
        
        $itemGroups->delete();
        return redirect('/item-group')->with('success', __('app.item_group') . __('app.label_deleted_successfully'));
    }
}
