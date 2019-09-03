@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Categories
        <small>Manage Categories</small>
      </h1>
      <ol class="breadcrumb">
      @can('permission-write')
      <li><a href="{{ route('category.index') }}"><i class="fa fa-users"></i>Categories</a></li>
      @endcan

      <li class="active">Manage Categories</li>  
      </ol>
    </section> 

    <!-- Main content -->
    <section class="content container-fluid">    

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title" style="display:block">Manage Categories
                      <span class="pull-right" style="display:inline-block">
                      <a class="btn btn-primary btn-sm" href="{{ route('category.create') }}"> <i class="fa fa-plus"></i> Add New</a>
                      </span> 
                  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="datatable table table-bordered table-responsive table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th> 
                      <th>Slug</th> 
                      <th>Description</th> 
                      <th>Image</th> 
                      <th>Childrens</th>
                      <th>Menu</th> 
                      <th>Searchable</th> 
                      <th>Active</th> 
                      <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @can('category-read')
                    @foreach($categories as $category) 
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ ucwords($category->title) }}</td>  
                      <td>{{ $category->slug }}</td>  
                      <td>{!! $category->description !!}</td>  
                      <td>
                        <img src="{{ asset('storage/'.$category->category_image) }}" alt="" style="width:80px"> 
                      </td>   
                      <td>
                          @if($category->childrens()->count() > 0)
                            @foreach($category->childrens as $children)
                              {{ $children->title }},
                            @endforeach  
                          @else
                              <strong>{{"Parent Category"}}</strong>
                          @endif
                      </td>
                      <td>
                        @if($category->is_menu == 1)
                          <span class="text-success">Active</span>
                        @else
                          <span class="text-danger">Inactive</span>
                        @endif
                      </td>  

                      <td>
                        @if($category->is_searchable == 1)
                          <span class="text-success">Active</span>
                        @else
                          <span class="text-danger">Inactive</span>
                        @endif
                      </td>  

                      <td>
                        @if($category->is_active == 1)
                          <span class="text-success">Active</span>
                        @else
                          <span class="text-danger">Inactive</span>
                        @endif
                      </td>  
                      <td>
                          <div class="button-group">
                            @can('permission-edit')
                            <a href="{{ route('category.edit', $category->id) }}"><i class="fa fa-pencil-square text-info"></i></a> 
                            @endcan
                            
                            @can('category-delete') 
                            <form id="delete-form" action="{{ route('category.destroy', $category->id) }}" method="post" style="display: inline;border:0">  
                              
                              @csrf    
                              @method('DELETE')      
    
                              <button class="text-danger delete" type="submit" style="border:0;background:none">	  
                                <i class="fa fa-trash"></i>    
                              </button>     
                            </form> 
                            @endcan

                          </div>    
                      </td>
                    </tr>
                    @endforeach

                      @else 
                        <tr>
                          <td colspan="8">
                              <h3 class="text-danger">Oops! You have no permission for this action!</h3> 
                          </td>
                        </tr>
                    @endcan
                   </tbody>
                  
                    <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Title</th> 
                          <th>Slug</th> 
                          <th>Description</th> 
                          <th>Image</th> 
                          <th>Childrens</th> 
                          <th>Menu</th> 
                          <th>Searchable</th>  
                          <th>Active</th> 
                          <th>Actions</th>
                        </tr>
                    </tfoot> 
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
@endsection 

@section('title', 'Manage Categories')     

@section('scripts') 
<script> 
	$(document).on('click', '.delete', function(e) { 
          
          var form = $(this).parents('form:first'); 

         var confirmed = false;

           e.preventDefault();
          
           swal({
               title : 'Are you sure want to delete?',
               text : "Onec Delete, This will be permanently delete!",
               icon : "warning",
               buttons: true,
               dangerMode : true
           }).then((willDelete) => { 
               if (willDelete) {
                   // window.location.href = link;
                   confirmed = true;

               form.submit();         

               } else {
                   swal("Safe Data!");   
               }
           });
       });
</script> 
@endsection 
