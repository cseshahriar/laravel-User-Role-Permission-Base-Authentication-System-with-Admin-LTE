<?php

namespace App\Http\Controllers;

use DB; 
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all(); 
        return view('admin.categories.index', compact('categories')); 
    }


    /**
     * Show the form for creating a new resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create',compact('categories')); 
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
            'title'=>'required|min:2', 
            'slug'=>'required|min:2|unique:categories',
            'description'=>'nullable|string',
            'category_image'=>'nullable|mimes:jpeg,jpg,png|max:1024', 
            'parent_id'=>'nullable', 
            'is_menu'=>'nullable|numeric', 
            'is_searchable'=>'nullable|numeric', 
            'is_active'=>'nullable|numeric', 
        ]);  
        
        $category = new Category;
        $category->title = $request->title;
        $category->slug = Str::slug($request->slug);
        $category->description = $request->description; 

        // image upload 
        $path = 'images/category/no-thumbnail.jpeg'; 
        if ($request->has('category_image')) {
            $extension = "." . $request->category_image->getClientOriginalExtension(); 
            $name = basename($request->category_image->getClientOriginalName(), $extension) . time();
            $name = $name . $extension; 
            $path = $request->category_image->storeAs('images/category', $name, 'public'); 
        }
        $category->category_image = $path;
        $category->is_menu = $request->is_menu;
        $category->is_searchable = $request->is_searchable;
        $category->is_active = $request->is_active;
        $category->save();  

        $category->parents()->attach($request->parent_id, ['created_at'=>now(), 'updated_at'=>now()]);
        return redirect(route('category.index'))->with(['message' => 'Category Added Successfully!', 'alert-type' => 'success']);    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $category = Category::find($id); 
         $categories = Category::where('id','!=', $category->id)->get();
         return view('admin.categories.edit', compact('categories', 'category'));   
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {
        $request->validate([
            'title'=>'required|min:2', 
            'slug'=>'required|min:2|unique:categories,slug,'.$id,
            'description'=>'nullable|string',
            'category_image'=>'nullable|mimes:jpeg,jpg,png|max:1024', 
            'parent_id'=>'nullable', 
            'is_menu'=>'nullable|numeric', 
            'is_searchable'=>'nullable|numeric', 
            'is_active'=>'nullable|numeric', 
        ]);  
        
        $category = Category::find($id); 
        $category->title = $request->title;
        $category->slug = Str::slug($request->slug);
        $category->description = $request->description;   

        // image upload 
        $path = 'images/category/no-thumbnail.jpeg'; 
        if ($request->has('category_image')) { 
            Storage::delete($category->category_image);  
            $extension = "." . $request->category_image->getClientOriginalExtension(); 
            $name = basename($request->category_image->getClientOriginalName(), $extension) . time();
            $name = $name . $extension; 
            $path = $request->category_image->storeAs('images/category', $name, 'public'); 
        }
        $category->category_image = $path;
        $category->is_menu = $request->is_menu;
        $category->is_searchable = $request->is_searchable;
        $category->is_active = $request->is_active;  
     
        // detach all parent categories
        $category->parents()->detach();
        //attach selected parent categories
        $category->parents()->attach($request->parent_id, ['created_at'=>now(), 'updated_at'=>now()]);
        
        //save current record into database
        $saved = $category->save(); 
      
        if ($saved) {
            return redirect(route('category.index'))->with(['message' => 'Category Successfully Updated!', 'alert-type' => 'success']);  
        } else {
            return back()->with(['message' => 'Error Updating Category', 'alert-type' => 'error']); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)   
    {
        $category = Category::find($id);
        // it's remove category_parent but not categories
        $childDelete = $category->childrens()->detach(); 
        Storage::delete($category->category_image);   
        if ( $category->forceDelete()) {
            return back()->with(['message' => 'Category Successfully Deleted!', 'alert-type' => 'success']);
        } else {
            return back()->with(['message' => 'Error Deleting Record', 'alert-type' => 'error']);
        }  
    }

}
