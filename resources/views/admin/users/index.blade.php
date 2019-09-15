@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>Manage Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Users</a></li>
        <li class="active">Manage</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">    

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title" style="display:block">Manage Users
                      <span class="pull-right" style="display:inline-block">
                        @can('user-write')
                        <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}"> <i class="fa fa-plus"></i> Add New</a>
                        @endcan  
                      </span>   
                  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="datatable table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Designation</th>
                      <th>Types</th> 
                      <th>Permissions</th> 
                      <th>Images</th>  
                      <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @can('user-read') 
                    @foreach($users as $user)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->mobile }}</td>
                      <td>{{ $user->designation }}</td>
                      <td>
                        <ul style="list-stule:disc;">
                          @foreach($user->roles as $role)
                          <li>{{ ucfirst($role->name) }}</li>   
                          @endforeach
                      </ul> 
                      </td> 
                      <td>
                          <ul style="list-stule:disc;">
                            @foreach($user->permissions as $permission)
                            <li>{{ $permission->name }}</li>       
                            @endforeach
                         </ul> 
                        </td>  
                      <td><img src="{{ asset('storage/'.$user->image) }}" alt="" style="width:60px;border-radius:5px"></td>  
                      <td>
                        
                          <div class="button-group">

                            @can('user-read') 
                            <a href="{{ route('users.show', $user->id) }}"><i class="fa fa-eye text-success" style="display:inline-block;margin-right:10px"></i></a>
                            @endcan

                            @can('user-edit') 
                            <a href="{{ route('users.edit', $user->id) }}"><i class="fa fa-pencil-square text-info"></i></a>
                            @endcan

                            @can('user-delete')
                            <form id="delete-form" action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline;border:0">  
                              
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Designation</th>
                            <th>Types</th> 
                            <th>Permissions</th>     
                            <th>Images</th>  
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

@section('title', 'Manage Users')   

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