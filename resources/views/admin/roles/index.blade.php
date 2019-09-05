@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Role
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('role.index') }}"><i class="fa fa-users"></i>Role</a></li>
        <li class="active">List</li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">    

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title" style="display:block">Role List</h3>
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
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ ucfirst($role->name) }}</td> 
                    </tr>
                    @endforeach
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

@section('title', 'Manage User Roles')  
