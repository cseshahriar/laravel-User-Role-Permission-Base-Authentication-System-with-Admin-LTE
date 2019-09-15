<?php

namespace App\Http\Controllers;

use App\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::all();
        return view('admin.attributes.index', compact('attributes'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributes.create'); 
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
            'name'  => 'required|string|max:255',
            'description'  => 'nullable|string|max:255',
            'is_searchable'  => 'nullable|numeric',
        ]);

        $Attribute = new Attribute; 
        $Attribute->name = $request->name; 
        $Attribute->description = $request->description; 
        $Attribute->is_searchable = $request->is_searchable; 
        $save = $Attribute->save();
        if ($save) {
            return redirect(route('attribute.index'))->with(['message' => 'Attribute added successfully', 'alert-type' => 'success']);  
        } else {
            return redirect(route('attribute.index'))->with(['message' => 'Oops! Something went wrong', 'alert-type' => 'error']);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $attribute = Attribute::find($id);
        return view('admin.attributes.edit', compact('attribute'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'description'  => 'nullable|string|max:255',
            'is_searchable'  => 'nullable|numeric',
        ]);

        $Attribute = Attribute::find($id); 
        $Attribute->name = $request->name; 
        $Attribute->description = $request->description; 
        $Attribute->is_searchable = $request->is_searchable; 
        if ($Attribute) {
            $Attribute->save(); 
            return redirect(route('attribute.index'))->with(['message' => 'Attribute added successfully', 'alert-type' => 'success']);  
        } else {
            return redirect(route('attribute.index'))->with(['message' => 'Oops! Something went wrong', 'alert-type' => 'error']);  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = Attribute::find($id);
        if ($attribute) {
            $attribute->delete(); 
            return redirect(route('attribute.index'))->with(['message' => 'Attribute Deleted Successfully', 'alert-type' => 'success']);   
        } else {
            return redirect(route('attribute.index'))->with(['message' => 'Oops! Something went wrong', 'alert-type' => 'error']);  
        }
    }
}
