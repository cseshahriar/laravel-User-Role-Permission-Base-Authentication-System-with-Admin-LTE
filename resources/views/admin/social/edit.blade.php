@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Social Profile <small>Update</small></h1> 
      <ol class="breadcrumb">
      <li><a href="{{ route('social.index') }}"><i class="fa fa-user"></i> Social Profile</a></li>
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
                <div class="panel-heading bg-primary">Update Social Profile</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                  
                    <form action="{{route('social.update', $social->id)}}" method="post"> 
                      
                      @csrf 
                      @method('PUT')

                      <div class="form-group">
                          <label class="form-control-label">Name</label>
                          <input type="text" id="name" name="name" class="form-control " value="{{ $social->name }}">
                      </div>
                      
                      <div class="form-group">
                          <label class="form-control-label">Fontawesome Icon Class</label>
                          <input type="text" id="icon_class" name="icon_class" class="form-control " value="{{ $social->icon_class }}">
                      </div>  

                      <div class="form-group">
                          <label class="form-control-label">Profile URL</label>
                          <textarea class="form-control" name="profile_url" id="profile_url" cols="5" rows="5">{{ $social->profile_url }}</textarea>
                      </div>

                        <div class="form-group">
                          <label class="form-control-label">Position</label>
                          <input type="text" id="position" name="position" class="form-control " value="{{ $social->position }}">
                      </div> 
                         
                       <div class="form-group"> 
                        <label class="form-control-label">Activation</label>
                        <select name="is_active" id="is_active" class="form-control">
                          <option value="0" {{ $social->is_active == 0 ? 'selected' : ''}}>Inactive</option>
                          <option value="1" {{ $social->is_active == 1 ? 'selected' : ''}}>Active</option>
                        </select>
                       </div>


                      <div class="form-group">
                          <button type="submit" class="btn btn-success">Update Social Profile</button>  
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

@section('title', 'Update Social Profile')   

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