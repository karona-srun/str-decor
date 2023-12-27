<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ProductSubCategory::orderBy('name', 'desc')->get(); 
        return view('backend.product_sub_category.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = ProductCategory::orderBy('name', 'desc')->get(); 
        return view('backend.product_sub_category.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_category' => 'required',
            'code' => 'required',
            'name' => 'required',
        ], [
            'product_category.required' => __('app.product_category') . __('app.required'),
            'code.required' => __('app.code') . __('app.product_category') . __('app.required'),
            'name.required' => __('app.label_name') . __('app.product_category') . __('app.required'),
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $productSubCategory = new ProductSubCategory();
        $productSubCategory->product_category_id = $request->product_category;
        $productSubCategory->code = $request->code;
        $productSubCategory->name = $request->name;
        $productSubCategory->note = $request->note;
        $productSubCategory->created_by = Auth::user()->id;
        $productSubCategory->updated_by = Auth::user()->id;
        $productSubCategory->save();

        return redirect('/product-sub-category')->with('success', __('app.product_sub_category').__('app.label_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductSubCategory  $productSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSubCategory $productSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductSubCategory  $productSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ProductSubCategory::find($id);
        $items = ProductCategory::orderBy('name', 'desc')->get(); 
        return view('backend.product_sub_category.edit', compact('items','item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductSubCategory  $productSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_category' => 'required',
            'code' => 'required',
            'name' => 'required',
        ], [
            'product_category.required' => __('app.product_category') . __('app.required'),
            'code.required' => __('app.code') . __('app.product_category') . __('app.required'),
            'name.required' => __('app.label_name') . __('app.product_category') . __('app.required'),
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $productSubCategory = ProductSubCategory::find($id);
        $productSubCategory->product_category_id = $request->product_category;
        $productSubCategory->code = $request->code;
        $productSubCategory->name = $request->name;
        $productSubCategory->note = $request->note;
        $productSubCategory->updated_by = Auth::user()->id;
        $productSubCategory->save();

        return redirect('/product-sub-category')->with('success', __('app.product_sub_category').__('app.label_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductSubCategory  $productSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del =  ProductSubCategory::find($id);
        $del->delete();
        return redirect('/product-sub-category')->with('danger', __('app.product_sub_category').__('app.label_deleted_successfully'));
    }
}
