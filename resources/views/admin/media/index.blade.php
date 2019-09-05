@extends('admin.layouts.app') 

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        File
        <small>Manager</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active">File Manager</li>  
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">    

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="box">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                  <iframe src="{{ url('/laravel-filemanager') }}" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>  

                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
@endsection 

@section('title', 'File Manager')  

@section('scripts')
<script>

</script>

@endsection
