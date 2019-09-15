<?php

namespace App\Http\Controllers;

use App\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = Tax::all(); 
        return view('admin.tax.index', compact('taxes'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.tax.create');  
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
            'tax_class' => 'required|string|max:60',
            'name' => 'required|string|max:60',
            'country' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:100',
            'rate' => 'required|string|max:100',
            'based_on' => 'required|string|max:150', 
            'is_active' => 'nullable|numeric'
        ]); 

        $TaxObj = new Tax; 
        $TaxObj->tax_class = $request->tax_class;
        $TaxObj->name = $request->name; 
        $TaxObj->country = $request->country;  
        $TaxObj->state = $request->state;   
        $TaxObj->zip = $request->zip;    
        $TaxObj->city = $request->city;   
        $TaxObj->rate = $request->rate;     
        $TaxObj->based_on = $request->based_on;      
        $TaxObj->is_active = $request->is_active;      
        $taxIsSave = $TaxObj->save();

        if ($taxIsSave) {
            return redirect()->route('tax.index')->with(['message' => 'Tax added successfully', 'alert-type' => 'success']);
        } else {
            return redirect()->route('tax.index')->with(['message' => 'Opps! something went wrong', 'alert-type' => 'error']); 
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $tax = Tax::find($id);   
        return view('admin.tax.edit', compact('tax'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)  
    {
        $request->validate([ 
            'tax_class' => 'required|string|max:60',
            'name' => 'required|string|max:60',
            'country' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:100',
            'rate' => 'required|string|max:100',
            'based_on' => 'required|string|max:150', 
            'is_active' => 'nullable|numeric'
        ]);  

        $TaxObj = Tax::find($id);    
        $TaxObj->tax_class = $request->tax_class;
        $TaxObj->name = $request->name; 
        $TaxObj->country = $request->country;  
        $TaxObj->state = $request->state;   
        $TaxObj->zip = $request->zip;    
        $TaxObj->rate = $request->rate;     
        $TaxObj->city = $request->city;      
        $TaxObj->based_on = $request->based_on;      
        $TaxObj->is_active = $request->is_active;      
        $taxIsSave = $TaxObj->save(); 

        if ($taxIsSave) {
            return redirect()->route('tax.index')->with(['message' => 'Tax updated successfully', 'alert-type' => 'success']);
        } else {
            return redirect()->route('tax.index')->with(['message' => 'Opps! something went wrong', 'alert-type' => 'error']); 
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        $TaxObj = Tax::find($id); 

        if (!is_null($TaxObj)) {
            $TaxObj->delete();
            return redirect()->route('tax.index')->with(['message' => 'Tax Deleted Successfully.', 'alert-type' => 'success']); 
        } else {
            return redirect()->route('tax.index')->with(['message' => 'Oops! something went wrong', 'alert-type' => 'error']);   
        }
    }
}
