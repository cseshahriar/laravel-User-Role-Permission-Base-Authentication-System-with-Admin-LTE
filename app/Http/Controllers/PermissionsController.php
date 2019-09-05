<?php

namespace App\Http\Controllers;

use App\Permission; 
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();  
        return view('admin.permissions.index', compact('permissions')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions'
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $save = $permission->save();

        if($save) {
            $notification = array(
                'message' => 'Permission created successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('permission.index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Opps! something went wrong.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
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
    public function edit($id)
    {
        // $permission = Permission::find($id);  
        // return view('admin.permissions.edit', compact('permission')); 
        
        return redirect()->back()->with(['message' => 'Bad Action!', 'alert-type' => 'error']); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect()->back()->with(['message' => 'Bad Action!', 'alert-type' => 'error']); 

        /* $request->validate([
            'name' => 'required|string|unique:permissions,name,'.$id
        ]); 

        $permission = Permission::find($id);
        $permission->name = $request->name;
        $save = $permission->save();

        if($save) { 
            $notification = array(
                'message' => 'Permission has been updated successfully.', 
                'alert-type' => 'success'
            );

            return redirect()->route('permission.index')->with($notification); 
        } else {
            $notification = array(
                'message' => 'Opps! something went wrong.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification); 
        } */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        return redirect()->back()->with(['message' => 'Bad Action!', 'alert-type' => 'error']); 

        /* $permission = Permission::find($id);
        $delete = $permission->delete(); 
        // permission assaign for user also delete  

        if($delete) {
            $notification = array(
                'message' => 'Permission had been deleted successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('permission.index')->with($notification); 
        } else { 
            $notification = array(
                'message' => 'Opps! something went wrong.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);     
        } */ 
    }
}
