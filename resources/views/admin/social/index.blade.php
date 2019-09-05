@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Social
        <small>Profiles</small> 
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('social.index') }}"><i class="fa fa-users"></i>Social Profiles</a></li>

      <li class="active">Manage Social Profiles</li>  
      </ol>
    </section>  

    <!-- Main content -->
    <section class="content container-fluid">    

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title" style="display:block">Manage Social Profiles
                      <span class="pull-right" style="display:inline-block">
                      <a class="btn btn-primary btn-sm" href="{{ route('social.create') }}"> <i class="fa fa-plus"></i> Add New</a>
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
                      <th>Icon Class</th> 
                      <th>URL</th> 
                      <th>Position</th> 
                      <th>Active</th> 
                      <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($socials as $social) 
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ ucwords($social->name) }}</td>  
                      <td>{{ $social->icon_class }}</td>  
                      <td>{{ $social->profile_url }}</td>  
                      <td>{{ $social->position }}</td>  
                      <td>
                        @if($social->is_active == 1)
                          <span class="text-success">Active</span>
                        @else
                          <span class="text-danger">Inactive</span>
                        @endif
                      </td>  
                      <td>
                          <div class="button-group">
                            
                            <a href="{{ route('social.edit', $social->id) }}"><i class="fa fa-pencil-square text-info"></i></a> 
                      
                            <form id="delete-form" action="{{ route('social.destroy', $social->id) }}" method="post" style="display: inline;border:0">  
                              
                              @csrf    
                              @method('DELETE')      
    
                              <button class="text-danger delete" type="submit" style="border:0;background:none">	  
                                <i class="fa fa-trash"></i>    
                              </button>     
                            </form> 
                          </div>    
                      </td>
                    </tr>
                    @endforeach
                   </tbody>
                    <tfoot>
                        <tr>
                         <th>#</th>
                          <th>Name</th> 
                          <th>Icon Class</th> 
                          <th>URL</th> 
                          <th>Position</th> 
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

@section('title', 'Manage Social Profiles')     

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
