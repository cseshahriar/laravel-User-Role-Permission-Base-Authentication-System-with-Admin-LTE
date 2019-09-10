@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Menu<small>Create</small></h1> 
      <ol class="breadcrumb">
      <li><a href="{{ route('menu.index') }}"><i class="fa fa-users"></i> Menu</a></li>
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
            <div class="panel panel-default">
                <div class="panel-heading bg-primary">Create New Menu</div> 
                <div class="panel-body"> 
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    @can('menu-write') 
                  
                    <form action="{{route('menu.store')}}" method="post">
                      @csrf 
                      <div class="form-group">
                          <label class="form-control-label">Name</label>
                          <input type="text" id="txturl" name="name" class="form-control " value="{{ old('name') }}">
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

@section('title', 'Create Category')   

@section('scripts') 
<script>
$(document).ready(function() {
  
  $(document).on('click', '#is_menu_active', function(event) {
    event.preventDefault();
    /* Act on the event */ 

    var isMenuVal = $('#is_menu').val();

    if(isMenuVal == 0) {
      $('#is_menu').val(1);
      $('#is_menu_active i').removeClass('text-default');
      $('#is_menu_active i').addClass('text-success');

      $('#is_menu_active i').removeClass('fa-toggle-off');
      $('#is_menu_active i').addClass('fa-toggle-on');

    } else {
      $('#is_menu').val(0);
      $('#is_menu_active i').removeClass('text-success');
      $('#is_menu_active i').addClass('text-default');

      $('#is_menu_active i').removeClass('fa-toggle-on');
      $('#is_menu_active i').addClass('fa-toggle-off'); 
    }

  });  


  $(document).on('click', '#is_searchable_active', function(event) {
    event.preventDefault();
    /* Act on the event */ 

    var isMenuVal = $('#is_searchable').val();

    if(isMenuVal == 0) {
      $('#is_searchable').val(1);
      $('#is_searchable_active i').removeClass('text-default');
      $('#is_searchable_active i').addClass('text-success');

      $('#is_searchable_active i').removeClass('fa-toggle-off');
      $('#is_searchable_active i').addClass('fa-toggle-on');

    } else {
      $('#is_searchable').val(0);
      $('#is_searchable_active i').removeClass('text-success');
      $('#is_searchable_active i').addClass('text-default');

      $('#is_searchable_active i').removeClass('fa-toggle-on');
      $('#is_searchable_active i').addClass('fa-toggle-off'); 
    }

  });  

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