@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Roles
        <small>Update Roles</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('roles.index') }}"><i class="fa fa-users"></i> Roles</a></li>
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
            <div class="panel panel-primary">
                <div class="panel-heading bg-primary">Updat Role</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    <form action="{{ route('roles.update', $role->id) }}" method="post">
                        
                        @csrf 
                        @method('PUT')
                    
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $role->name }}">
                            </div>  
                        </div> 
                    
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success" style="margin-top:10px">Update Role</button>
                            </div> 
                        </div>  
                    </form>   
                  </div>
            </div>
        </div>
        <!-- /.col -->

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
@endsection 

@section('title', 'Role Update')  