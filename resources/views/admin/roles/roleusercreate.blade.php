@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Roles
        <small>Create Roles</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('roles.index') }}"><i class="fa fa-users"></i> Roles</a></li>
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
                <div class="panel-heading bg-primary">Create New Role</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    <form action="{{ route('roles.roleuserstore') }}" method="post"> 
                        @csrf 
                    
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <label for="users">Select User</label> 
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="" disabled selected> Select User </option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>  
                        
                        <!-- checkbox -->
                        <div class="form-group" style="margin-top:10px">
                            <div class="col-sm-offset-2 col-sm-10" style="margin-top:10px">
                                <label>Choose Roles for User</label><br>
                                
                                @foreach($roles as $role)
                                    <label>
                                    <input type="checkbox" name="role_id[]" class="minimal" value="{{ $role->id }}"> {{ $role->name }}
                                    </label><br>
                                @endforeach 
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success" style="margin-top:10px">Add New Role</button>
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

@section('title', 'Role Create')  