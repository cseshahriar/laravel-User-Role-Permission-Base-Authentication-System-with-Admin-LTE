@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Attribute<small>Create</small></h1> 
      <ol class="breadcrumb">
      <li><a href="{{ route('attribute.index') }}"><i class="fa fa-users"></i> Attributes</a></li>
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
                <div class="panel-heading bg-primary">Create New Attribute</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    @can('permission-write') 
                  
                    <form action="{{route('attribute.store')}}" method="post" enctype="multipart/form-data">
                      @csrf 
                      <div class="form-group">
                          <label class="form-control-label">Name</label>
                          <input type="text" id="name" name="name" class="form-control " value="{{ old('name') }}">
                      </div>

                      <div class="form-group"> 
                          <label class="form-control-label">Description </label>
                          <textarea name="description" id="editor" class="form-control " rows="5" cols="5">{{ old('description') }}</textarea>
                      </div>

                      <div class="form-group row">  
                        
                        <div class="col-md-4">
                          <label class="form-control-label">Is Searchable</label><br>
                          <input type="hidden" id="is_searchable" name="is_searchable" value="0" class="form-control"> 
                          
                          <button id="is_searchable_active"> 
                            <i class=" fa-2x fa fa-toggle-off text-default"></i> 
                          </button> 
                        </div>

                      </div>

                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">Add Attribute</button>
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

@section('title', 'Create Attribute')   

@section('scripts') 
<script>
$(document).ready(function() {
  


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

});  
</script>
@endsection