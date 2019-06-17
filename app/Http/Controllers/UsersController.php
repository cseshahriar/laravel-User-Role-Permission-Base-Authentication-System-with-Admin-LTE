<?php

namespace App\Http\Controllers;

use DB; 
use App\Role; 
use Auth; 
use Image; 
use App\User; 
use Illuminate\Http\Request;

class UsersController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function user() 
    {
        return view('home'); 
    }

    public function dashboard() 
    {
        $userRoles = Auth::user()->roles->pluck('name'); 

        if(!$userRoles->contains('admin')) {
            return redirect('/nopermission');     
        }

        return view('admin.dashboard');    
    }

    public function nopermission()
    {
        return view('nopermission');   
    }

    /**
    * Return admin profile view 
    */
    public function adminProfile()
    {
        return view('admin.profile');
    }

    /**
     * Admin Profile Update
     */
    public function adminProfileUpdate(Request $request)
    {
        $userId = Auth::user()->id;

        $request->validate([
            'name' => 'required|string|max:60',
            'designation' => 'required|string|max:100',
            'education' => 'required|string|max:255',
            'skills' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:1024',
            'mobile' => 'nullable|numeric|unique:users,mobile,'.$userId,
            'phone' => 'nullable|numeric|unique:users,phone,'.$userId,
            'address' => 'nullable|string',
            'bio' => 'nullable|string',   
        ]);

        $User = User::find($userId);  

        $User->name = $request->name; 
        $User->designation = $request->designation; 
        $User->education = $request->education; 
        $User->skills = $request->skills; 
        
        // profile picture update
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid().'.'.$image->getClientOriginalExtension();
            $pathWithImgName = public_path('images/users/'.$imageName);
            $pathWithImgNameFoDb = 'images/users/'.$imageName; 
            Image::make($image)->resize(600, 600)->save($pathWithImgName);  
            $User->image = $pathWithImgNameFoDb;         
        }

        $User->mobile = $request->mobile; 
        $User->phone = $request->phone; 
        $User->address = $request->address; 
        $User->bio = $request->bio;  
        $update = $User->save(); 
        
        if($update) {
            $notification = array(
                'message' => 'Your profile has been updated successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.profile')->with($notification); 
        } else {
            $notification = array(
                'message' => 'Oops! Something went wrong', 
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }


    }

   /**
    * Return users 
    *
    * @return array
    */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    } 

    public function create()
    {
        $roles = Role::all(); 
        return view('admin.users.create', compact('roles'));      
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'designation' => 'nullable|string',
            'education' => 'nullable|string',
            'skills' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1024',
            'mobile' => 'required|numeric|unique:users',
            'phone' => 'nullable|numeric|unique:users', 
            'address' => 'nullable|string',
            'bio' => 'nullable|string', 
            'role_id' => 'required|array'
        ]); 

        $User = new User;  

        $User->name = $request->name; 
        $User->email = $request->email; 
        $User->password = bcrypt($request->password); 
        $User->designation = $request->designation; 
        $User->education = $request->education; 
        
        // profile picture update
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid().'.'.$image->getClientOriginalExtension();
            $pathWithImgName = public_path('images/users/'.$imageName);
            $pathWithImgNameFoDb = 'images/users/'.$imageName; 
            Image::make($image)->resize(600, 600)->save($pathWithImgName);  
            $User->image = $pathWithImgNameFoDb;         
        }

        $User->skills = $request->skills; 
        $User->mobile = $request->mobile; 
        $User->phone = $request->phone; 
        $User->address = $request->address; 
        $User->bio = $request->bio;  
        $save = $User->save(); 
        
        if($save) {  

            // save roles for this user
            $roleAssigns = [];
            foreach($request->role_id as $role){
               $roleAssigns[] = [
                   'role_id' => $role,
                   'user_id' => $User->id
               ];  
            }  

            $save = DB::table('role_user')->insert($roleAssigns); 

            $notification = array(
                'message' => 'Your profile has been updated successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('users.index')->with($notification); 
        } else {
            $notification = array(
                'message' => 'Oops! Something went wrong', 
                'alert-type' => 'error' 
            );

            return redirect()->back()->with($notification);
        }

    }

    public function show($id)
    {
        $roles = Role::all(); 
        $user = User::find($id);  
        return view('admin.users.show', compact('roles', 'user'));  
    }

    public function edit($id)
    {
        $roles = Role::all(); 
        $user = User::find($id);
        return view('admin.users.edit', compact('roles', 'user'));  
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:255|unique:users,email,'.$id,
            'designation' => 'nullable|string',
            'education' => 'nullable|string',
            'skills' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1024',
            'mobile' => 'nullable|numeric|unique:users,mobile,'.$id, 
            'phone' => 'nullable|numeric|unique:users,phone,'.$id, 
            'address' => 'nullable|string',
            'bio' => 'nullable|string', 
            'role_id' => 'required|array'   
        ]); 

        $User = User::find($id);   

        $User->name = $request->name; 
        $User->email = $request->email; 
        $User->designation = $request->designation; 
        $User->education = $request->education; 
        
        // profile picture update
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid().'.'.$image->getClientOriginalExtension();
            $pathWithImgName = public_path('images/users/'.$imageName);
            $pathWithImgNameFoDb = 'images/users/'.$imageName; 
            Image::make($image)->resize(600, 600)->save($pathWithImgName);  
            $User->image = $pathWithImgNameFoDb;         
        }

        $User->skills = $request->skills; 
        $User->mobile = $request->mobile; 
        $User->phone = $request->phone; 
        $User->address = $request->address; 
        $User->bio = $request->bio;  
        $save = $User->save();

        if($save) {  

            // delete roles for this user
            if($request->role_id) {
                // delete old role
                $userRoles = DB::table('role_user')->where('user_id', '=', $id)->get(); 
                foreach($userRoles as $userRole) {
                    DB::table('role_user')->where('id', '=', $userRole->id)->delete(); 
                } 
            } 

            // store new roles 
            $roleAssigns = [];
            foreach($request->role_id as $role) {
                $roleAssigns[] = [
                    'role_id' => $role,
                    'user_id' => $id 
                ]; 
            }
     
            $save = DB::table('role_user')->insert($roleAssigns);     

            $notification = array(
                'message' => 'Your has been updated successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('users.index')->with($notification);  
        } else {
            $notification = array(
                'message' => 'Oops! Something went wrong', 
                'alert-type' => 'error' 
            );

            return redirect()->back()->with($notification);
        }
    }

    public function destroy($id)
    {
        $User = User::find($id);

        if(!is_null($User)) {
            
            $delete = $User->delete();

            if($delete) {

                // save roles for this user
                $userRoles = DB::table('role_user')->where('user_id', '=', $id)->get(); 
                foreach($userRoles as $role){
                    $role->delete();
                }  

                $notification = array(
                    'message' => 'User has been deleted successfully.',
                    'alert-type' => 'success'
                );

                return redirect()->route('users.index')->with($notification); 

            } else {
            
                $notification = array(
                    'message' => 'Oops! Something went wrong', 
                    'alert-type' => 'error'
                ); 

                return redirect()->back()->with($notification);  

            }

        }

    }
}
