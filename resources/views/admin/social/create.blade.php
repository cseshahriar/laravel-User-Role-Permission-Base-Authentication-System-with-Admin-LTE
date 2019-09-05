@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Social Profile <small>Create</small></h1> 
      <ol class="breadcrumb">
      <li><a href="{{ route('social.index') }}"><i class="fa fa-user"></i> Social Profile</a></li>
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
                <div class="panel-heading bg-primary">Create New Social Profile</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                  
                    <form action="{{route('social.store')}}" method="post"> 
                      @csrf 
                      <div class="form-group">
                          <label class="form-control-label">Name</label>
                          <input type="text" id="name" name="name" class="form-control " value="{{ old('name') }}">
                      </div>
                      
                      <div class="form-group">
                          <label class="form-control-label">Fontawesome Icon Class</label>
                          <input type="text" id="icon_class" name="icon_class" class="form-control " value="{{ old('icon_class') }}">
                      </div>  

                      <div class="form-group">
                          <label class="form-control-label">Profile URL</label>
                          <textarea class="form-control" name="profile_url" id="profile_url" cols="5" rows="5">{{ old('profile_url') }}</textarea>
                      </div>

                        <div class="form-group">
                          <label class="form-control-label">Position</label>
                          <input type="text" id="position" name="position" class="form-control " value="{{ old('position') }}">
                      </div> 
                         
                      <div class="form-group row">  
                        <div class="col-md-4">
                          <label class="form-control-label">Is Active</label><br>
                          <input type="hidden" id="is_active" name="is_active" value="0" class="form-control"> 
                          
                          <button id="is_active_btn"> 
                            <i class=" fa-2x fa fa-toggle-off text-default"></i> 
                          </button>  
                        </div> 
                      </div>

                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">Add New Social Profile</button> 
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

@section('title', 'Create Social Profile')   

@section('scripts') 
<script>
$(document).ready(function() { 

  $(document).on('click', '#is_active_btn', function(event) {
    event.preventDefault();
    /* Act on the event */ 

    var isMenuVal = $('#is_active').val();

    if(isMenuVal == 0) {
      $('#is_active').val(1);
      $('#is_active_btn i').removeClass('text-default');
      $('#is_active_btn i').addClass('text-success');

      $('#is_active_btn i').removeClass('fa-toggle-off');
      $('#is_active_btn i').addClass('fa-toggle-on');

    } else {
      $('#is_active').val(0);
      $('#is_active_btn i').removeClass('text-success');
      $('#is_active_btn i').addClass('text-default');

      $('#is_active_btn i').removeClass('fa-toggle-on');
      $('#is_active_btn i').addClass('fa-toggle-off'); 
    }

  });

});
</script>
@endsection