<?php

namespace App\Http\Controllers;

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
     * Manage users
     */
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
}
