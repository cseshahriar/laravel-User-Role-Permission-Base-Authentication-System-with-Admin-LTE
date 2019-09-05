<?php

namespace App\Http\Controllers;

use App\SocialProfile;
use Illuminate\Http\Request;

class SocialProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials = SocialProfile::all();
        return view('admin.social.index', compact('socials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.social.create');
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
            'name' => 'required|string|max:100',
            'icon_class' => 'required|string|max:30',
            'profile_url' => 'required|string|max:255',
            'position' => 'required|numeric|unique:social_profiles',
            'is_active' => 'required|numeric',
        ]);

        $socialProfile = new SocialProfile();
        $socialProfile->name = $request->name;
        $socialProfile->icon_class = $request->icon_class;
        $socialProfile->profile_url = $request->profile_url;
        $socialProfile->position = $request->position;
        $socialProfile->is_active = $request->is_active;
        $socialProfile->save(); 

        return redirect(route('social.index'))->with(['message' => 'Social Added Successfully', 'alert-type' => 'success']); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SocialProfile  $socialProfile
     * @return \Illuminate\Http\Response
     */
    public function show(SocialProfile $socialProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SocialProfile  $socialProfile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $social = SocialProfile::find($id);
        return view('admin.social.edit', compact('social')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SocialProfile  $socialProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'icon_class' => 'required|string|max:30',
            'profile_url' => 'required|string|max:255',
            'position' => 'required|numeric|unique:social_profiles,position,'.$id,
            'is_active' => 'required|numeric',
        ]);

        $socialProfile = SocialProfile::find($id);
        $socialProfile->name = $request->name;
        $socialProfile->icon_class = $request->icon_class;
        $socialProfile->profile_url = $request->profile_url;
        $socialProfile->position = $request->position;
        $socialProfile->is_active = $request->is_active;
        $socialProfile->save();  


        return redirect(route('social.index'))->with(['message' => 'Social Profile Updated Successfully', 'alert-type' => 'success']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialProfile  $socialProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $socialProfile = SocialProfile::find($id);
        if(!is_null($socialProfile)) {
            $socialProfile->delete(); 
        }
        return redirect(route('social.index'))->with(['message' => 'Social Deleted Successfully', 'alert-type' => 'success']); 
    }
}
