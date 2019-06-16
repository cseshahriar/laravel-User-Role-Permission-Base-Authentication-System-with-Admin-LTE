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
                          <a class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New</a>
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
                      <th>Images</th>  
                      <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->mobile }}</td>
                      <td>{{ $user->designation }}</td>
                      <ul style="list-stule:disc;">
                          @foreach($user->roles as $role)
                          <li>{{ ucfirst($role->name) }}</li>  
                          @endforeach
                      </ul> 
                      <td><img src="{{ asset($user->image) }}" alt="" style="width:60px;border-radius:5px"></td> 
                      <td>
                          <div class="button-group">
                            <a href=""><i class="fa fa-eye text-success" style="display:inline-block;margin-right:10px"></i></a>

                            <a href=""><i class="fa fa-pencil-square text-info"></i></a>

                            <a href=""><i class="fa fa-trash text-danger" style="display:inline-block;margin-left:10px"></i></a>
                          </div>    
                      </td>
                    </tr>
                    @endforeach
                   </tbody>
                  
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Designation</th>
                            <th>Types</th> 
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