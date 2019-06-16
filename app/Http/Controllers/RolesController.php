<?php

namespace App\Http\Controllers;

use DB; 
use App\Role;
use App\User;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles')); 
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
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
            'name' => 'required|string|unique:roles'
        ]);

        $Role = new Role;
        $Role->name = strtolower($request->name); 
        $save = $Role->save();
        
        if($save) {

            $notification = array(
                'message' => 'Role added successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('roles.index')->with($notification);
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
        $role = Role::find($id);
        return view('admin.roles.edit', compact('role'));  
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
        $request->validate([
            'name' => 'required|string|unique:roles,name,'.$id
        ]);

        $Role = Role::find($id);
        $Role->name = strtolower($request->name);    
        $save = $Role->save();
        
        if($save) {

            $notification = array(
                'message' => 'Role updated successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('roles.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Role = Role::find($id);

        if(!is_null($Role)) {
            
            $delete = $Role->delete();

            if($delete) {
                $notification = array(
                    'message' => 'Role has been deleted successfully.',
                    'alert-type' => 'success'
                );

                return redirect()->route('roles.index')->with($notification);

            } else {
            
                $notification = array(
                    'message' => 'Oops! Something went wrong', 
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);  

            }

        }
    }

    public function roleuser() 
    {
        $users = User::all();
        return view('admin.roles.roleuser', compact('users')); 
    } 

    public function roleusercreate()
    {
        /**
         * return wher not assign role for user
         */

        $users = DB::table('users')
        ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
        ->select('users.*')
        ->whereNull('role_user.user_id') 
        ->whereNull('role_user.role_id')  
        ->get();

        $roles = Role::all(); 
        return view('admin.roles.roleusercreate', compact('users', 'roles'));  
    }

    public function roleuserstore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'role_id' => 'nullable|array|min:1'
        ]); 
    
       $userid = $request->user_id; 
       $roleAssigns = [];
       foreach($request->role_id as $role){
          $roleAssigns[] = [
              'role_id' => $role,
              'user_id' => $userid 
          ];
       }
     
      $save = DB::table('role_user')->insert($roleAssigns);  

      if($save) {
        $notification = array(
            'message' => 'Role assaign for user successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.roleuser')->with($notification);

    } else {
    
        $notification = array(
            'message' => 'Oops! Something went wrong', 
            'alert-type' => 'error'
        ); 

        return redirect()->back()->with($notification);  

    }

    }
}
