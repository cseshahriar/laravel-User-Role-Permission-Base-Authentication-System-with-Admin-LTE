@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Permissions
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
      @can('permission-write')
      <li><a href="{{ route('permission.index') }}"><i class="fa fa-users"></i>Permissions</a></li>
      @endcan

      <li class="active">Permissions List</li>  
      </ol>
    </section> 

    <!-- Main content -->
    <section class="content container-fluid">    

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title" style="display:block">Manage Permissions
                      <span class="pull-right" style="display:inline-block">
                      <a class="btn btn-primary btn-sm" href="{{ route('permission.create') }}"> <i class="fa fa-plus"></i> Add New</a>
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
                    </tr>
                    </thead>

                    <tbody>
                    @can('permission-read')
                    @foreach($permissions as $permission) 
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ ucwords($permission->name) }}</td>  
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

@section('title', 'Manage Permissions')     
