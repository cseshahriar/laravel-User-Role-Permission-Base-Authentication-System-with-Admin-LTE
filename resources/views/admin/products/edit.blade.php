@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Category<small>Update</small></h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('category.index') }}"><i class="fa fa-users"></i> Categories</a></li>
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
                <div class="panel-heading bg-primary">Category Update</div> 
                <div class="panel-body">
                      
                    <!-- errors -->
                    @include('admin.partials.errors') 
                    @can('permission-write') 
                  
                    <form action="{{route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                      
                      @csrf 
                      @method('PUT')

                      <div class="form-group">
                          <label class="form-control-label">Title</label>
                          <input type="text" id="txturl" name="title" class="form-control " value="{{ $category->title }}">
                      </div>
                        
                      <div class="form-group">
                          <label class="form-control-label">Slug</label>
                          <input type="text" id="slug" name="slug" class="form-control " value="{{ $category->slug }}">
                      </div>

                      <div class="form-group"> 
                          <label class="form-control-label">Description </label>
                          <textarea name="description" id="editor" class="form-control " rows="5" cols="5">{{ $category->description }}</textarea>
                      </div>

                      <div class="form-group"> 
                          
                          <img src="{{ asset('storage/'.$category->category_image)}}" alt="" style="width: 120px"><br> 

                          <label class="form-control-label">Category Image </label>
                          <input type="file" name="category_image" id="category_image"> 
                      </div> 

                      <div class="form-group">
                        @php 
                          $ids = (isset($category->parents) && $category->parents->count() > 0 ) ? array_pluck($category->parents, 'id') : null; 
                        @endphp

                          <label class="form-control-label">Select Category: </label>
                          <select name="parent_id[]" id="parent_id" class="select2 form-control" multiple="multiple"> 
                            @if(isset($categories)) 
                              <option value="0">Top Level</option>
                              @foreach($categories as $cat)
                              <option value="{{ $cat->id }}" @if(!is_null($ids) && in_array($cat->id, $ids)) {{ 'selected' }} @endif>{{$cat->title}}</option>
                              @endforeach
                            @endif
                          </select>
                      </div>

                      <div class="form-group row">  

                        <div class="col-md-4">
                          <label class="form-control-label">Visible in Menu </label><br>
                          <input type="hidden" id="is_menu" name="is_menu" value="0" class="form-control"> 
                          
                          <button id="is_menu_active">
                            <i class=" fa-2x fa fa-toggle-off text-default"></i> 
                          </button>
                        </div>
                        
                        <div class="col-md-4">
                          <label class="form-control-label">Is Searchable</label><br>
                          <input type="hidden" id="is_searchable" name="is_searchable" value="0" class="form-control"> 
                          
                          <button id="is_searchable_active"> 
                            <i class=" fa-2x fa fa-toggle-off text-default"></i> 
                          </button> 
                        </div>

                        <div class="col-md-4">
                          <label class="form-control-label">Is Active</label><br>
                          <input type="hidden" id="is_active" name="is_active" value="0" class="form-control"> 
                          
                          <button id="is_active_btn"> 
                            <i class=" fa-2x fa fa-toggle-off text-default"></i> 
                          </button>  
                        </div>

                      </div>

                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">Update Category</button>
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

@section('title', 'Category Update')   

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