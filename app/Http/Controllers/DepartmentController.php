<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depart = Department::orderBy('name','desc')->get();
        return view('backend.department.index', compact('depart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.department.create');
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
            'department_name' => 'required',
        ],[
            'department_name.required' => __('app.department_name').__('app.required')
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $depart = new Department();
        $depart->name = $request->department_name;
        $depart->note = $request->note;
        $depart->created_by = Auth::user()->id;
        $depart->updated_by = Auth::user()->id;
        $depart->save();
        
        return redirect('/department')->with('success', __('app.department').__('app.label_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $position = Department::find($id);
        $position->created_by = $position->creator->name;
        $position->updated_by = $position->updator->name;
        $position->created_at = $position->created_at->format('d-m-Y h:i:s A');
        $position->updated_at = $position->updated_at->format('d-m-Y h:i:s A');
        return response()->json($position);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $depart = Department::find($id);
        $depart->created_by = $depart->creator->name;
        $depart->updated_by = $depart->updator->name;
        $depart->created_at = $depart->created_at->format('d-m-Y h:i:s A');
        $depart->updated_at = $depart->updated_at->format('d-m-Y h:i:s A');
        return response()->json($depart);
        // $depart = Department::find($id);
        // return view('backend.department.edit', compact('depart'));
    }

    public function updateDepartment(Request $request)
    {
        $depart = Department::find($request->id);
        $depart->name = $request->name;
        $depart->note = $request->note;
        $depart->updated_by = Auth::user()->id; 
        $depart->save();

        return redirect('/department')->with('success', __('app.department').__('app.label_updated_successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        return redirect('/department')->with('success', __('app.department').__('app.label_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $depart = Department::find($id);
        $depart->delete();

        return redirect('/department')->with('danger', __('app.department').__('app.label_deleted_successfully'));
    }
}
