@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
        <small>Update User</small> 
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('users.create') }}"><i class="fa fa-users"></i> Users</a></li>
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
                <div class="panel-heading bg-primary">Update User</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors')  

                    @can('user-edit')  
                    <form class="form-horizontal" action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        
                        @csrf 
                        @method('PUT')  
                    
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}">
                            </div>  
                        </div> 

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                            </div>
                        </div>  

                        <!-- user roels  -->
                        <div class="form-group" style="margin-top:10px">
                            <label for="role_id" class="col-sm-2 control-label">User Roles <span class="text-danger">*</span></label>
                            <div class="col-sm-offset-2 col-sm-10" style="margin-top:10px">  

                                @php 
                                    $userRoles = DB::table('role_user')->where('user_id', '=', $user->id)->get();
                                    $userRolesArray = array();

                                    foreach ($userRoles as $userRole) {
                                        array_push($userRolesArray, $userRole->role_id); 
                                    }
                                @endphp

                                @foreach($roles as $role)
                                    <label>
                                       
                                        <input type="checkbox" name="role_id[]" class="minimal" value="{{ $role->id }}" @if(in_array($role->id, $userRolesArray) == $role->id) {{ 'checked' }} @endif> 
                                        <span style="display:inline-block;margin-right:15px">{{ ucfirst($role->name) }}</span>   
                                    </label>    
                                @endforeach    
                            </div>
                        </div>

                             <!-- checkbox -->
                             <div class="form-group" style="margin-top:10px">
                                    <label for="role_id" class="col-sm-2 control-label">User Permissions <span class="text-danger">*</span></label>
                                    <div class="col-sm-offset-2 col-sm-10" style="margin-top:10px">  
                                       
                                        @php 
                                            $userPermissions = DB::table('permission_user')->where('user_id', '=', $user->id)->get();
                                            $userPermissionsArray = array();
        
                                            foreach ($userPermissions as $userPermission) {
                                                array_push($userPermissionsArray, $userPermission->permission_id); 
                                            }
                                        @endphp 
        
                                        @foreach($permissions as $permission)
                                            <label>
                                                <input type="checkbox" name="permission_id[]" class="minimal" value="{{ $permission->id }}" @if(in_array($permission->id, $userPermissionsArray) == $permission->id) {{ 'checked' }} @endif> 
                                                <span style="display:inline-block;margin-right:15px">{{ ucfirst($permission->name) }}</span>  
                                            </label>    
                                        @endforeach        
                                    </div>
                                </div>


                        <div class="form-group">
                            <label for="designation" class="col-sm-2 control-label">Designation</label>
                            <div class="col-sm-10">
                                <input type="text" name="designation" class="form-control" placeholder="Designationil" value="{{ $user->designation }}"> 
                            </div>
                        </div>  

                        <div class="form-group">
                            <label for="education" class="col-sm-2 control-label">Education</label>
                            <div class="col-sm-10">
                                <input type="text" name="education" class="form-control" placeholder="Education" value="{{ $user->education }}"> 
                            </div>
                        </div>   

                        <div class="form-group">
                                
                            <label for="image" class="col-sm-2 control-label">Profile Picture</label>
          
                            <div class="col-sm-10">
                            <img src="{{ asset($user->image) }}" id="photo" style="margin-bottom: 8px;120px;height:100px;border-radius:5px"><br>
                            <input type="file" name="image" class="form-control-file" id="image">   
                            </div> 
                        </div>
    
                        <div class="form-group">
                            <label for="mobile" class="col-sm-2 control-label">Mobile Number <span class="text-danger">*</span></label>
          
                            <div class="col-sm-10">
                            <input type="number" name="mobile" class="form-control" id="mobile" value="{{ $user->mobile }}" placeholder="Mobile Number"> 
                            </div> 
                        </div>
    
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">Phone Number</label>
          
                            <div class="col-sm-10">
                            <input type="number" name="phone" class="form-control" id="mobile" value="{{ $user->phone }}" placeholder="Phone Number"> 
                            </div> 
                        </div>
                        
        
                        <div class="form-group">
                          <label for="address" class="col-sm-2 control-label">Address</label>
        
                          <div class="col-sm-10">
                            <textarea class="form-control" name="address" id="address" placeholder="Address">{{ $user->address }}</textarea> 
                          </div>  
                        </div>
        
                        <div class="form-group">
                          <label for="skills" class="col-sm-2 control-label">Skills</label> 
    
                          <div class="col-sm-10">
                              <textarea class="form-control" name="skills" id="skills" placeholder="Skills">@foreach($user->roles as $role) {{ ucfirst($role->name.',') }} @endforeach 
                                </textarea>  
    
                              <p class="alert alert-warning" role="alert" style="margin-top:10px"> 
                                  Skills must be comma separated. Example : HTML, CSS, JavaScript, PHP, MySQL, Laravel, Git
                              </p> 
    
                          </div>
                        </div>
    
                        <div class="form-group">
                            <label for="bio" class="col-sm-2 control-label">Bio</label>
          
                            <div class="col-sm-10">
                              <textarea class="form-control" name="bio" id="bio" placeholder="Bio">{{ $user->bio }}</textarea>  
                            </div> 
                        </div> 
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">  
                                <button type="submit" class="btn btn-success" style="margin-top:10px">Update User</button>
                            </div> 
                        </div>  
                    </form>   
                    @else 
                    <h3 class="alert alert-danger">Opps! You have no permission for this action!</h3> 
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

@section('title', 'User Update')  

@section('scripts')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#photo').attr('src', e.target.result).height(80).width(80);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function () {
        readURL(this); 
    });
</script>  
@endsection