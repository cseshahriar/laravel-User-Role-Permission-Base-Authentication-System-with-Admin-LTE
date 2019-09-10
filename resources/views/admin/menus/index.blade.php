@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Menu
        <small>List</small>
      </h1>
      <ol class="breadcrumb"> 
      @can('permission-write')
      <li><a href="{{ route('menu.index') }}"><i class="fa fa-users"></i>Menus</a></li>
      @endcan

      <li class="active">Manage Menus</li>  
      </ol>
    </section> 

    <!-- Main content -->
    <section class="content container-fluid">    

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title" style="display:block">Manage Menus
                      <span class="pull-right" style="display:inline-block">
                      <a class="btn btn-success btn-sm" href="{{ route('menu.create') }}"> <i class="fa fa-plus"></i> Add New</a>  
                      </span> 
                  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="datatable table table-bordered table-responsive table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th> 
                      <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @can('menu-read')
                    @foreach($menus as $menu) 
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $menu->name }}</td>  
                      <td>
                          <div class="button-group">
                            @can('permission-edit')
                            <a href="{{ route('menu.builder', $menu->id) }}" class="btn btn-sm btn-success"><i class="fa fa-list text-succes"></i> Builder</a> 
                            @endcan  

                            @can('permission-edit')
                            <a href="{{ route('menu.edit', $menu->id) }}" class="text-white btn btn-sm btn-info"><i class="fa fa-pencil-square text-info"></i> Edit</a> 
                            @endcan
                            
                            @can('category-delete') 
                            <form id="delete-form" action="{{ route('menu.destroy', $menu->id) }}" method="post" style="display: inline;border:0">  
                              
                              @csrf    
                              @method('DELETE')      
    
                              <button class="delete btn btn-sm btn-danger" type="submit">	  
                                <i class="fa fa-trash"> Delete</i>    
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
                          <th>Name</th> 
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

@section('title', 'Viewing Menus')      

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
