@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add<small>Menu Item</small></h1>  
      <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-users"></i>Menu Item</a></li>
        <li class="active">Add</li>  
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
                <div class="panel-heading bg-primary">Create a New Menu Item</div> 
                <div class="panel-body"> 
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    @can('menu-write') 
                  
                    <form action="{{ route('menu.builder.store', $menu->id) }}" method="post">
                      
                      @csrf   
                      
                      <input type="hidden" name="menu_id" value="{{ $menu->id }}">

                      <div class="form-group">
                          <label class="form-control-label">Parent Menu (Optional)</label>
                          <select name="parent_id" id="parent_id" class="form-control">
                            <option value="" selected disabled>Select Parent Menu</option>
                            @foreach($parentMenus as $parentMenu)
                            <option value="{{ $parentMenu->id }}">{{ $parentMenu->title }}</option>
                            @endforeach 
                          </select>
                      </div> 

                      <div class="form-group">
                          <label class="form-control-label">Title of the Menu Item</label>
                          <input type="text" id="title" name="title" class="form-control " value="{{ old('title') }}">
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Static URL</label>
                          <input type="text" id="url" name="url" class="form-control " value="{{ old('url') }}">
                      </div>

                      <div class="form-group">
                          <label class="form-control-label">Dynamic Route</label>
                          <input type="text" id="route" name="route" class="form-control " value="{{ old('route') }}">
                      </div>  


                      <div class="form-group">
                          <label class="form-control-label">Route Parameters</label>
                          <textarea name="parameters" id="parameters" cols="3" rows="3" class="form-control" placeholder="{ 'key' : 'value' }">{{ old('parameters') }}</textarea>
                      </div> 
                
                      <div class="form-group">
                          <label class="form-control-label">Font Awesome Icon class for the Menu Item (Use a Font Awesome Font Class)</label> 
                          <input type="text" id="icon_class" name="icon_class" class="form-control " value="{{ old('icon_class') }}"> 
                      </div>
                
                      <div class="form-group">
                          <label class="form-control-label">Color in RGB or Hex (optional)</label>
                          <input type="color" id="color" name="color" class="form-control" value="">  
                      </div>  

                      <div class="form-group">
                        <label class="form-control-label">Open In</label>
                        <select name="target" id="target" class="form-control">
                          <option value="" selected disabled>Select Anchor Tag Target</option>
                          <option value="_blank">New Tab/Window</option>
                          <option value="_self">Same Tab/Window</option>
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

@section('title', 'Add Menu Item')   