<?php

namespace App\Http\Controllers;

use DB;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menus.create');
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
            'name' => 'required|string|max:100'
        ]);

        $menu = new Menu;
        $menu->name = $request->name;  
        $menu->save(); 

        return redirect(route('menu.index'))->with(['message' => 'Successfully Added New Menu', 'alert-type' => 'success']);    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('admin.menus.edit', compact('menu'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $request->validate([
            'name' => 'required|string|max:100'
        ]);

        $menu = Menu::find($id);
        $menu->name = $request->name;  
        $menu->save(); 

        return redirect(route('menu.index'))->with(['message' => 'Successfully Menu Updated', 'alert-type' => 'success']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        if (!is_null($menu)) {
            $menuItemDelete = DB::table('menu_items')->where('menu_id', $id)->delete();   
            $menu->delete(); 
            return redirect(route('menu.index'))->with(['message' => 'Successfully Menu Deleted', 'alert-type' => 'success']); 
        } 
    }

    public function builder($id)
    {
        $menu = Menu::find($id); 
        $menuItems = DB::table('menu_items')->where('menu_id', $id)->where('parent_id', '=', null)->orderBy('order', 'asc')->get();   

        return view('admin.menus.builder', compact('menu', 'menuItems'));   
    } 

    public function builderCreate($id)  
    {
        $menu = Menu::find($id);
        $parentMenus = DB::table('menu_items')->where('parent_id', null)->get();    
        return view('admin.menus.add_menu_item', compact('parentMenus', 'menu'));   
    }

    public function builderStore(Request $request, $id)   
    {
        $request->validate([
            'parent_id' => 'nullable|numeric',
            'title' => 'required|string',
            'url' => 'required_without:route|string|max:255',
            'route' => 'required_without:url||max:255', 
            'icon_class' => 'nullable|string',
            'color' => 'nullable',
            'parameters' => 'nullable|string',
            'target' => 'nullable' 
        ]);  
        
        $menuItem = DB::table('menu_items')->insert($request->except('_token'));
        if($menuItem) {
             return redirect(route('menu.builder', $id))->with(['message' => 'Successfully Added New Menu Item', 'alert-type' => 'success']);  
        }
    }

    public function builderEdit($id)
    {
        $menuItem = DB::table('menu_items')->where('id', $id)->first();  
        $parentMenus = DB::table('menu_items')->where('parent_id', null)->get();
        return view('admin.menus.edit_menu_item', compact('menuItem', 'parentMenus'));     
    }

    public function builderUpdate(Request $request, $id) 
    {
        // dd($request->all());

         $request->validate([
            'parent_id' => 'nullable|numeric',
            'title' => 'required|string',
            'url' => 'required_without:route|string|max:255',
            'route' => 'required_without:url||max:255', 
            'icon_class' => 'nullable|string',
            'color' => 'nullable',
            'parameters' => 'nullable|string',
            'target' => 'nullable' 
        ]);

        $data = array(
            'parent_id' => $request->parent_id,
            'title' => $request->title,
            'url' => $request->url,
            'route' => $request->route,
            'icon_class' => $request->icon_class,
            'color' => $request->color,
            'parameters' => $request->parameters,
            'target' => $request->target 
        );

        $menuItem = DB::table('menu_items')->where('id', $id)->update($data);    
        return redirect(route('menu.index'))->with(['message' => 'Successfully Updatd Menu Item', 'alert-type' => 'success']);       
        
    }

    public function builderDestroy($id)   
    {
        $menuItemDelete = DB::table('menu_items')->where('id', $id)->delete(); 
        $menuChildItemDelete = DB::table('menu_items')->where('parent_id', '=', $id)->delete();

        if ($menuItemDelete) {    
            return redirect(route('menu.index'))->with(['message' => 'Successfully Deleted Menu Item', 'alert-type' => 'success']);  
        }
    }
}
