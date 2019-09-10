@extends('admin.layouts.app')

@section('content') 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('admin.profile') }}"><i class="fa fa-dashboard"></i> User Profile</a></li>
        <li class="active">Update</li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
              <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/'.Auth::user()->image) }}" alt="User profile picture"> 

              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

              <p class="text-muted text-center">{{ Auth::user()->designation }}</p>
              <p class="text-muted text-center">Member since {{ Carbon\Carbon::parse(Auth::user()->created_at)->format('M. Y') }}</p>
            </div>
            <!-- /.box-body --> 
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary"> 
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                {{ Auth::user()->education }} 
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>

            <p class="text-muted">{{ Auth::user()->address }}</p> 

              <hr> 

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                @php
                  $skillCollections = Auth::user()->skills; 
                  $skills = explode(',', $skillCollections);   
                  $alerts = array('label-danger', 'label-success', 'label-info', 'label-warning', 'label-primary'); 
                @endphp

                @foreach($skills as $skill)
                  <span class="label {{  Arr::random($alerts) }}">{{ $skill }}</span>
                @endforeach  
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Bio</strong>

            <p>{{ Auth::user()->bio }}</p>  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="panel panel-primary">
              <div class="panel-heading bg-primary">Update Your Profiles</div> 
            <div class="panel-body">
                
                <!-- errors -->
                @include('admin.partials.errors') 

            <form class="form-horizontal" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">

                  @csrf 
                
                    <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Name</label> 
    
                      <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" id="name" value="{{ Auth::user()->name }}" placeholder="Name"> 
                      </div>
                    </div>  
    
                    <div class="form-group">
                      <label for="designation" class="col-sm-2 control-label">Designation</label>
    
                      <div class="col-sm-10">
                      <input type="text" name="designation" class="form-control" id="designation" value="{{ Auth::user()->designation }}" placeholder="Designation">
                      </div> 
                    </div>

                    <div class="form-group">
                        <label for="education" class="col-sm-2 control-label">Education</label>
      
                        <div class="col-sm-10">
                        <input type="text" name="education" class="form-control" id="education" value="{{ Auth::user()->education }}" placeholder="Education"> 
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label">Profile Picture</label>
      
                        <div class="col-sm-10">
                        <input type="file" name="image" class="form-control-file" id="image"> 
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">Mobile Number</label>
      
                        <div class="col-sm-10">
                        <input type="number" name="mobile" class="form-control" id="mobile" value="{{ Auth::user()->mobile }}" placeholder="Mobile Number"> 
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">Phone Number</label>
      
                        <div class="col-sm-10">
                        <input type="number" name="phone" class="form-control" id="mobile" value="{{ Auth::user()->phone }}" placeholder="Phone Number"> 
                        </div> 
                    </div>
                    
    
                    <div class="form-group">
                      <label for="address" class="col-sm-2 control-label">Address</label>
    
                      <div class="col-sm-10">
                        <textarea class="form-control" name="address" id="address" placeholder="Address">{{ Auth::user()->address }}</textarea> 
                      </div> 
                    </div>
    
                    <div class="form-group">
                      <label for="skills" class="col-sm-2 control-label">Skills</label> 

                      <div class="col-sm-10">
                          <textarea class="form-control" name="skills" id="skills" placeholder="Skills">{{ Auth::user()->skills }}</textarea> 

                          <p class="alert alert-warning" role="alert" style="margin-top:10px">
                              Skills must be comma separated. Example : HTML, CSS, JavaScript, PHP, MySQL, Laravel, Git
                          </p>

                      </div>
                    </div>

                    <div class="form-group">
                        <label for="bio" class="col-sm-2 control-label">Bio</label>
      
                        <div class="col-sm-10">
                          <textarea class="form-control" name="bio" id="bio" placeholder="Bio">{{ Auth::user()->bio }}</textarea>  
                        </div> 
                    </div> 
                    
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                      </div>
                    </div>
                  </form>  
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('title', 'Admin Profile')  