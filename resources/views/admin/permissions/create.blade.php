@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Permission
        <small>Create Permission</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('permission.index') }}"><i class="fa fa-users"></i> Permissions</a></li>
        <li class="active">Create</li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">    

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
    
        <!-- /.col -->
        <div class="col-md-10 col-sm-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading bg-primary">Create New Permission</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    @can('permission-write') 
                    <form action="{{ route('permission.store') }}" method="post">
                        @csrf 
                  
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                                <p class="text-warning">Examples: user-read, user-create | user-update | user-delete </p>
                            </div>  
                        </div> 
                     
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" style="margin-top:10px">Add New Permission</button>
                            </div> 
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

@section('title', 'Permission Create')   