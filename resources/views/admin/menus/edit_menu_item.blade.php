@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Update<small>Menu Item</small></h1>  
      <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-users"></i>Menu Item</a></li>
        <li class="active">Update</li>  
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">    

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
    
        <!-- /.col -->
        <div class="col-md-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading bg-primary">Update Menu Item</div> 
                <div class="panel-body"> 
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    @can('menu-write') 
                  
                    <form action="{{ route('menu.builder.update', $menuItem->id) }}" method="post">
                      
                      @csrf   
                      @method('PUT')   

                      <div class="form-group">
                          <label class="form-control-label">Parent Menu (Optional)</label>
                          <select name="parent_id" id="parent_id" class="form-control">
                            <option value="" @if($menuItem) {{ 'selected' }} @endif disabled>Select Parent Menu</option>
                            @foreach($parentMenus as $parentMenu)
                            <option value="{{ $parentMenu->id }}" {{ $menuItem->parent_id == $parentMenu->id ? 'selected' : ''}}>{{ $parentMenu->title }}</option>
                            @endforeach 
                          </select> 
                      </div> 

                      <div class="form-group">
                          <label class="form-control-label">Title of the Menu Item</label>
                          <input type="text" id="title" name="title" class="form-control " value="{{ $menuItem->title }}">
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Static URL</label>
                          <input type="text" id="url" name="url" class="form-control " value="{{ $menuItem->url }}">
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Dynamic Route</label>
                          <input type="text" id="route" name="route" class="form-control " value="{{ $menuItem->route }}">
                      </div>  


                      <div class="form-group">
                          <label class="form-control-label">Route Parameters</label>
                          <textarea name="parameters" id="parameters" cols="3" rows="3" class="form-control" placeholder="{ 'key' : 'value' }">{{ $menuItem->parameters }}</textarea>
                      </div> 
                
                      <div class="form-group">
                          <label class="form-control-label">Font Awesome Icon class for the Menu Item (Use a Font Awesome Font Class)</label> 
                          <input type="text" id="icon_class" name="icon_class" class="form-control " value="{{ $menuItem->icon_class }}">   
                      </div>
                
                      <div class="form-group">
                          <label class="form-control-label">Color in RGB or Hex (optional)</label>
                          <input type="color" id="color" name="color" class="form-control" value="{{ $menuItem->color }}">  
                      </div>  

                      <div class="form-group">
                        <label class="form-control-label">Open In</label>
                        <select name="target" id="target" class="form-control">
                          <option value="" selected disabled>Select Anchor Tag Target</option>
                          <option value="_blank" {{ $menuItem->target == '_blank' ? 'selected' : '' }}>New Tab/Window</option>
                          <option value="_self" {{ $menuItem->target == '_self' ? 'selected' : '' }}>Same Tab/Window</option>
                        </select>
                      </div>    

                      <div class="form-group">
                          <button type="submit" class="btn btn-success">Save</button> 
                      </div>

                    </form>
                    @else 
                    <tr>
                      <td colspan="8">
                          <h3 class="text-danger">Oops! You have no permission for this action!</h3>
                      </td>
                    </tr>
                    @endcan
                  </div>
            </div>
        </div>
        <!-- /.col -->

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
@endsection 

@section('title', 'Edit Menu Item')      