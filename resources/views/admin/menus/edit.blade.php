@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Menu<small>Update</small></h1> 
      <ol class="breadcrumb">
      <li><a href="{{ route('menu.index') }}"><i class="fa fa-users"></i> Menu</a></li>
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
                <div class="panel-heading bg-primary">Update Menu</div> 
                <div class="panel-body"> 
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    @can('menu-write') 
                  
                    <form action="{{route('menu.update', $menu->id)}}" method="post"> 
                      
                      @csrf 
                      @method('PUT')

                      <div class="form-group">
                          <label class="form-control-label">Name</label>
                          <input type="text" id="txturl" name="name" class="form-control " value="{{ $menu->name }}">
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

@section('title', 'Update Menu')   
