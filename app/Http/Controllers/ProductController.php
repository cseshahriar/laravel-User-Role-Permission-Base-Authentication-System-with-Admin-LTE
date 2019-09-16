<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Category;
use App\Product;
use App\Tax;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();  
        $attributes = Attribute::all(); 
        $taxes = Tax::all();  
        return view('admin.products.create', compact('categories', 'attributes', 'taxes')); 
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
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'category_id' => 'required',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'required|mimes:jpeg,jpg,png|max:512',  
            'price' => 'required|numeric', 
            'special_price' => 'nullable|numeric', 
            'special_price_start' => 'required_with:special_price|date', 
            'special_price_end' => 'required_with:special_price|date', 
            'sku' => 'required|unique:products', 
            'qty' => 'required|numeric', 
            'in_stock' => 'required|numeric', 
            'new_from' => 'nullable|date', 
            'new_to' => 'nullable|date',   
            'tax_id' => 'required',   
            'meta_title' => 'required|string|max:255',
            'meta_keywords' => 'required|string|max:255', 
            'meta_description' => 'required|string',  
            'is_active' => 'nullable|numeric',    
            'attribute_key' => 'nullable',
            'attribute_value' => 'required_with:attribute_key|max:150',
        ]);  

        $ProductObject = new Product; 

        $ProductObject->title = $request->title; 
        $ProductObject->slug = Str::slug($request->slug); 
        $ProductObject->short_description = $request->short_description; 
        $ProductObject->description = $request->description; 

          // image upload 
        $path = 'images/product/no-thumbnail.jpeg'; 
        if ($request->has('thumbnail')) {
            $extension = "." . $request->thumbnail->getClientOriginalExtension(); 
            $name = basename($request->thumbnail->getClientOriginalName(), $extension) . time();
            $name = $name . $extension; 
            $path = $request->thumbnail->storeAs('images/products', $name, 'public'); 
        }
        $ProductObject->thumbnail = $path;  
        $ProductObject->price = $request->price; 
        $ProductObject->special_price = $request->special_price; 
        $ProductObject->special_price_start = $request->special_price_start;  
        $ProductObject->special_price_end = $request->special_price_end;   
        $ProductObject->sku = $request->sku;   
        $ProductObject->qty = $request->qty;   
        $ProductObject->in_stock = $request->in_stock;    
        $ProductObject->new_from = $request->new_from;     
        $ProductObject->new_to = $request->new_to;    
        $ProductObject->tax_id = $request->tax_id;    
        $ProductObject->meta_title = $request->meta_title;    
        $ProductObject->meta_keywords = $request->meta_keywords;    
        $ProductObject->meta_description = $request->meta_description;     
        $ProductObject->is_active = $request->is_active;      
        $productIsSave = $ProductObject->save();    

        // category   
        if($request->category_id) {
            foreach ($request->category_id as $category) { 
                $data = array(
                    'product_id' => $ProductObject->id, 
                    'category_id' => $category
                );
                DB::table('category_products')->insert($data);           
            }
        }
   
        // storage each image
        $images_product = array();
        if ($image = $request->file('image')) { 
            foreach ($image as $files) {
                $extension = "." . $files->getClientOriginalExtension(); 
                $name = basename($files->getClientOriginalName(), $extension) . time();
                $name = $name . $extension; 
                $path = $files->storeAs('images/products', $name, 'public');

                $images_product['image'] = $path;  
                $images_product['product_id'] = $ProductObject->id;  
                
                DB::table('images_product')->insert($images_product);      
            }
        }   


        // product attritutes
        if($ProductObject) {
            foreach ($request->attribute_key as $key => $value) {
                $data = array(
                    'product_id' => $ProductObject->id, 
                    'attribute_key' => $request->attribute_key[$key],
                    'attribute_value' => $request->attribute_value[$key],
                );
                DB::table('attrubute_products')->insert($data);          
            }
        }
   

        if($productIsSave) {
            return redirect(route('product.index'))->with(['message' => 'Product Added Successfully!', 'alert-type' => 'success']);   
        } else {
            return redirect()->back()->with(['message' => 'Oops! something wrong.', 'alert-type' => 'error']);    
        } 

    }  

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();  
        $attributes = Attribute::all(); 
        $taxes = Tax::all(); 

        $product = Product::find($id);
        $product_categories = DB::table('category_products')->where('product_id', $id)->get();  
        $product_attributes = DB::table('attrubute_products')->where('product_id', $id)->get();
        $product_images = DB::table('images_product')->where('product_id', $id)->get(); 

        return view('admin.products.edit', compact(
            'product', 
            'categories', 
            'attributes',
            'taxes',
            'product_categories', 
            'product_attributes',
            'product_images'
        ));    
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([ 
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'category_id' => 'nullable',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|mimes:jpeg,jpg,png|max:512',  
            'price' => 'required|numeric', 
            'special_price' => 'nullable|numeric', 
            'special_price_start' => 'required_with:special_price|date', 
            'special_price_end' => 'required_with:special_price|date', 
            'sku' => 'required|unique:products,sku,'.$id, 
            'qty' => 'required|numeric', 
            'in_stock' => 'required|numeric', 
            'new_from' => 'nullable|date', 
            'new_to' => 'nullable|date',   
            'tax_id' => 'required',   
            'meta_title' => 'required|string|max:255',
            'meta_keywords' => 'required|string|max:255', 
            'meta_description' => 'required|string',  
            'is_active' => 'nullable|numeric',    
            'attribute_key' => 'nullable',
            'attribute_value' => 'required_with:attribute_key|max:150',
        ]);  

        $ProductObject = Product::find($id);  

        $ProductObject->title = $request->title; 
        $ProductObject->slug = Str::slug($request->slug); 
        $ProductObject->short_description = $request->short_description; 
        $ProductObject->description = $request->description; 

          // image upload 
        $path = 'images/product/no-thumbnail.jpeg'; 
        if ($request->has('thumbnail')) {
            $extension = "." . $request->thumbnail->getClientOriginalExtension(); 
            $name = basename($request->thumbnail->getClientOriginalName(), $extension) . time();
            $name = $name . $extension; 
            $path = $request->thumbnail->storeAs('images/products', $name, 'public'); 
            
            $ProductObject->thumbnail = $path;   
        }

        $ProductObject->price = $request->price; 
        $ProductObject->special_price = $request->special_price; 
        $ProductObject->special_price_start = $request->special_price_start;  
        $ProductObject->special_price_end = $request->special_price_end;   
        $ProductObject->sku = $request->sku;   
        $ProductObject->qty = $request->qty;   
        $ProductObject->in_stock = $request->in_stock;    
        $ProductObject->new_from = $request->new_from;     
        $ProductObject->new_to = $request->new_to;    
        $ProductObject->tax_id = $request->tax_id;    
        $ProductObject->meta_title = $request->meta_title;    
        $ProductObject->meta_keywords = $request->meta_keywords;    
        $ProductObject->meta_description = $request->meta_description;     
        $ProductObject->is_active = $request->is_active;      
        $productIsSave = $ProductObject->save();    

        // category   
        if($request->category_id) {
            // detaches
            DB::table('category_products')->where('product_id', $id)->delete();

            foreach ($request->category_id as $category) { 
                $data = array(
                    'product_id' => $ProductObject->id, 
                    'category_id' => $category
                );
                DB::table('category_products')->insert($data);           
            }
        }
   
        // storage each image
        $images_product = array();
        if ($image = $request->file('image')) { 
            
            // detach 
            $product_images = DB::table('images_product')->where('product_id', $id)->get();
            if(!is_null($product_images)) {
                foreach ($product_images as $product_image) { 
                    Storage::delete($product_image->image);       
                } 
            }
            DB::table('images_product')->where('product_id', $id)->delete();

            // update new images   
            foreach ($image as $files) {
                $extension = "." . $files->getClientOriginalExtension(); 
                $name = basename($files->getClientOriginalName(), $extension) . time();
                $name = $name . $extension; 
                $path = $files->storeAs('images/products', $name, 'public');

                $images_product['image'] = $path;  
                $images_product['product_id'] = $ProductObject->id;  
                
                DB::table('images_product')->insert($images_product);      
            }
        }   


        // product attritutes
        if($ProductObject && $request->attribute_key) {
            // detach
            DB::table('attrubute_products')->where('product_id', $id)->delete();             
            
            foreach ($request->attribute_key as $key => $value) {
                $data = array(
                    'product_id' => $ProductObject->id, 
                    'attribute_key' => $request->attribute_key[$key],
                    'attribute_value' => $request->attribute_value[$key],
                );
                DB::table('attrubute_products')->insert($data);          
            }
        }
   

        if($productIsSave) {
            return redirect(route('product.index'))->with(['message' => 'Product Updated Successfully!', 'alert-type' => 'success']);   
        } else {
            return redirect()->back()->with(['message' => 'Oops! something wrong.', 'alert-type' => 'error']);    
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(!is_null($product)) {
            // category_products delete
            DB::table('category_products')->where('product_id', $id)->delete();
            
            // attribute_product delete
            DB::table('attrubute_products')->where('product_id', $id)->delete(); 
            
            // images_products delete
            $product_images = DB::table('images_product')->where('product_id', $id)->get();
            if(!is_null($product_images)) {
                foreach ($product_images as $image) { 
                    Storage::delete($image->image);       
                } 
            }
            DB::table('images_product')->where('product_id', $id)->delete();   

            $product->delete();
            return redirect()->route('product.index')->with(['message' => 'Product deleted successfully', 'alert-type' => 'success']); 
        }
    }
}
