
@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
        <small>Create User</small> 
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('users.create') }}"><i class="fa fa-users"></i> Users</a></li>
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
                <div class="panel-heading bg-primary">Create New User</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    
                    @can('user-write')
                    <form class="form-horizontal" action="{{ route('users.store') }}" method="post">
                        @csrf 
                    
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                            </div>
                        </div>  

                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="password-confirm" class="col-sm-2 control-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>

                            <div class="col-sm-10">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password"> 
                            </div>
                        </div>

                        <!-- roles -->
                        <div class="form-group" style="margin-top:10px">
                            <label for="role_id" class="col-sm-2 control-label">User Roles <span class="text-danger">*</span></label>
                            <div class="col-sm-offset-2 col-sm-10" style="margin-top:10px">  
                                @foreach($roles as $role)
                                    <label>
                                        <input type="checkbox" name="role_id[]" class="minimal" value="{{ $role->id }}" {{ $role->name == 'admin' ? 'checked' : ''}}> 
                                        <span style="display:inline-block;margin-right:15px">{{ ucfirst($role->name) }}</span>
                                        
                                    </label>    
                                @endforeach  
                            </div>
                        </div>


                        <!-- roles -->
                        <div class="form-group" style="margin-top:10px">
                                <label for="role_id" class="col-sm-2 control-label">Permissions for User <span class="text-danger">*</span></label>
                                <div class="col-sm-offset-2 col-sm-10" style="margin-top:10px">  
                                    @foreach($permissions as $permission)
                                        <label>
                                            <input type="checkbox" name="permission_id[]" class="minimal" value="{{ $permission->id }}"> <span style="display:inline-block;margin-right:15px">{{ ucfirst($permission->name) }}</span> 
                                        </label>     
                                    @endforeach   
                                </div>
                            </div>


                        <div class="form-group">
                            <label for="designation" class="col-sm-2 control-label">Designation</label>
                            <div class="col-sm-10">
                                <input type="text" name="designation" class="form-control" placeholder="Designationil" value="{{ old('designation') }}"> 
                            </div>
                        </div>  

                        <div class="form-group">
                            <label for="education" class="col-sm-2 control-label">Education</label>
                            <div class="col-sm-10">
                                <input type="text" name="education" class="form-control" placeholder="Education" value="{{ old('education') }}"> 
                            </div>
                        </div>   

                        <div class="form-group">
                            <label for="image" class="col-sm-2 control-label">Profile Picture</label>
          
                            <div class="col-sm-10">
                            <input type="file" name="image" class="form-control-file" id="image"> 
                            </div> 
                        </div>
    
                        <div class="form-group">
                            <label for="mobile" class="col-sm-2 control-label">Mobile Number <span class="text-danger">*</span></label>
          
                            <div class="col-sm-10">
                            <input type="number" name="mobile" class="form-control" id="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number"> 
                            </div> 
                        </div>
    
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">Phone Number</label>
          
                            <div class="col-sm-10">
                            <input type="number" name="phone" class="form-control" id="mobile" value="{{ old('phone') }}" placeholder="Phone Number"> 
                            </div> 
                        </div>
                        
        
                        <div class="form-group">
                          <label for="address" class="col-sm-2 control-label">Address</label>
        
                          <div class="col-sm-10">
                            <textarea class="form-control" name="address" id="address" placeholder="Address">{{ old('address') }}</textarea> 
                          </div>  
                        </div>
        
                        <div class="form-group">
                          <label for="skills" class="col-sm-2 control-label">Skills</label> 
    
                          <div class="col-sm-10">
                              <textarea class="form-control" name="skills" id="skills" placeholder="Skills">{{ old('skills') }}</textarea>  
    
                              <p class="alert alert-warning" role="alert" style="margin-top:10px">
                                  Skills must be comma separated. Example : HTML, CSS, JavaScript, PHP, MySQL, Laravel, Git
                              </p>
    
                          </div>
                        </div>
    
                        <div class="form-group">
                            <label for="bio" class="col-sm-2 control-label">Bio</label>
          
                            <div class="col-sm-10">
                              <textarea class="form-control" name="bio" id="bio" placeholder="Bio">{{ old('bio') }}</textarea>  
                            </div> 
                        </div> 
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10"> 
                                <button type="submit" class="btn btn-success" style="margin-top:10px">Add New Admin</button> 
                            </div> 
                        </div>  
                    </form>  
                    @else   
                        <h3 class="text-danger">Opps! You have no permission for this action!</h3>  
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

@section('title', 'User Create')  