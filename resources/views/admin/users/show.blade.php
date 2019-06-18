@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
        <small>Informations</small> 
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> Users</a></li>
        <li class="active">Informations</li> 
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
            <div class="panel-heading bg-primary">User Informations</div> 
                <div class="panel-body">
                      
        
                    <form class="form-horizontal">
                    
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $user->name }}" disabled> 
                            </div>  
                        </div> 

                        <div class="form-group"> 
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control"  value="{{ $user->email }}" disabled>
                            </div>
                        </div>  

                        <!-- checkbox -->
                        <div class="form-group">  
                            <label class="col-sm-2 control-label">User Roles</label>
                            <div class="col-sm-10">  

                                @php 
                                    $userRoles = DB::table('role_user')->where('user_id', '=', $user->id)->get();
                                    $userRolesArray = array();

                                    foreach ($userRoles as $userRole) {
                                        array_push($userRolesArray, $userRole->role_id); 
                                    }
                                @endphp

                                <ul style="list-stule:disc;">
                                @foreach($roles as $role)
                                    <li>{{ $role->name }}</li>         
                                @endforeach   
                               </ul>    
                            </div>
                        </div>

                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">User Permissions</label>
                            <div class="col-sm-10">
                                <ul style="list-stule:disc;">
                                    @foreach($user->permissions as $permission)
                                    <li>{{ $permission->name }}</li>        
                                    @endforeach
                                </ul> 
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="designation" class="col-sm-2 control-label">Designation</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" value="{{ $user->designation }}" disabled> 
                            </div>
                        </div>  

                        <div class="form-group">
                            <label for="education" class="col-sm-2 control-label">Education</label>
                            <div class="col-sm-10">
                                <input type="text" disabled class="form-control" value="{{ $user->education }}"> 
                            </div>
                        </div>   

                        <div class="form-group">
                                
                            <label for="image" class="col-sm-2 control-label">Profile Picture</label>
          
                            <div class="col-sm-10">
                            <img src="{{ asset($user->image) }}" id="photo" style="margin-bottom: 8px;120px;height:100px;border-radius:5px">  
                            </div> 
                        </div>
    
                        <div class="form-group">
                            <label for="mobile" class="col-sm-2 control-label">Mobile Number</label>
          
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="mobile" value="{{ $user->mobile }}" disabled> 
                            </div> 
                        </div>
    
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">Phone Number</label>
          
                            <div class="col-sm-10">
                            <input type="number" class="form-control" disabled value="{{ $user->phone }}"> 
                            </div> 
                        </div>
                        
        
                        <div class="form-group">
                          <label for="address" class="col-sm-2 control-label">Address</label>
        
                          <div class="col-sm-10">
                            <textarea class="form-control" disabled>{{ $user->address }}</textarea> 
                          </div>  
                        </div>
        
                        <div class="form-group">
                          <label for="skills" class="col-sm-2 control-label">Skills</label> 
    
                          <div class="col-sm-10">
                              <textarea class="form-control" disabled>@foreach($user->roles as $role) {{ ucfirst($role->name.',') }} @endforeach 
                                </textarea>  

                          </div>
                        </div>
    
                        <div class="form-group">
                            <label for="bio" class="col-sm-2 control-label">Bio</label>
          
                            <div class="col-sm-10">
                              <textarea class="form-control" disabled>{{ $user->bio }}</textarea>  
                            </div> 
                        </div> 
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">  
                            <a href="{{ route('users.index') }}" class="btn btn-primary" style="margin-top:10px">{{ __('Back') }}</a>
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

@section('title', 'User Profile')  