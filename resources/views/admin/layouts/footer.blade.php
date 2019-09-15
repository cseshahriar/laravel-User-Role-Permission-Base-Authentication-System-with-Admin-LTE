
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        <a href="http://codershahriar.com" target="_blank">Developed by Codershahriar</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>.</strong> All rights reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>

<!-- Optionally, plugins -->
<!-- DataTables -->
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('admin/bower_components/select2/dist/js/select2.min.js') }}"></script>  

<!-- iCheck 1.0.1 -->
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>

<script src="{{ asset('admin/js/toastr.min.js') }}"></script>  
<script src="{{ asset('admin/js/sweetalert.min.js') }}"></script>  
<script src="{{ asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> 


<script>
    @if(Session::has('message')) 
        var type = "{{ Session::get('alert-type', 'info') }}"; 
        switch (type) {
            case 'info' :
                toastr.info("{{ Session::get('message') }}");
                break; 
            case 'success' :
                toastr.success("{{ Session::get('message') }}");
                break; 
            case 'warning' :
                toastr.warning("{{ Session::get('message') }}");
                break; 
            case 'error' :
                toastr.error("{{ Session::get('message') }}");
                break;  
        }
    @endif

    $(function () {
        
        $('.select2').select2();

        $('.datatable').DataTable({ dateFormat: 'yy-mm-dd' });   

        $('.datatable2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false 
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue' 
        });

        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
        });

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
        });
    }); 
</script>

{{-- ext js --}}
@yield('scripts')   

</body>
</html> 