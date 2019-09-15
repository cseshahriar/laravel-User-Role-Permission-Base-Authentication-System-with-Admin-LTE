@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Attribute<small>Update</small></h1> 
      <ol class="breadcrumb">
      <li><a href="{{ route('attribute.index') }}"><i class="fa fa-users"></i> Attributes</a></li>
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
                <div class="panel-heading bg-primary">Update Attribute</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    @can('permission-write') 
                  
                    <form action="{{route('attribute.update', $attribute->id)}}" method="post" enctype="multipart/form-data">
                      
                      @csrf 
                      @method('PUT') 

                      <div class="form-group">
                          <label class="form-control-label">Name</label>
                          <input type="text" id="name" name="name" class="form-control " value="{{ $attribute->name }}"> 
                      </div>

                      <div class="form-group"> 
                          <label class="form-control-label">Description </label>
                          <textarea name="description" id="editor" class="form-control " rows="5" cols="5">{{ $attribute->description }}</textarea>
                      </div>

                      <div class="form-group">  
                          <label class="form-control-label">Is Searchable</label><br>
                          <select name="is_searchable" id="is_searchable" class="form-control">
                            <option value="1" {{ $attribute->is_searchable == 1 ? 'selected' : ''}}>Yes</option>
                            <option value="0" {{ $attribute->is_searchable == 0 ? 'selected' : ''}}>No</option>
                          </select> 
                      </div>

                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">Save</button>
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

@section('title', 'Update Attribute')   

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