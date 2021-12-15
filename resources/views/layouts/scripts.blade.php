<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)

</script>
<!-- Bootstrap 4 -->
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/chart.js/Chart.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/moment/moment.min.js"></script>
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/dist/js/pages/dashboard3.js"></script>
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/select2/js/select2.full.min.js"></script>
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/bootstrap-select-1.13.14/dist/js/bootstrap-select.js"></script>
<script src="{{asset('custom_js/jquery.pjax.js')}}"></script>
<!-- DataTables -->
<script src="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('js/dataTablebutton.min.js') }}"></script>
<script src="{{ asset('js/buttonHtml5.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('custom_js/javascript.js')}}"></script>
<script src="{{ asset('custom_js/initTable.js')}}"></script>
<script src="{{ asset('/custom_js/rolemanage.js')}}"></script>
<script src="{{ asset('/custom_js/closerequest.js')}}"></script>
<script src="{{ asset('/custom_js/updateprofile.js')}}"></script>
<script src="{{ asset('/custom_js/smsworld.js')}}"></script>
<script src="{{ asset('/custom_js/checkuserinfo.js')}}"></script>
<script>
@if($errors->any())
    showError('{{$errors->first()}}');
@endif
@if (session()->has('success'))
   swal.fire({
        icon: 'success',
        title: 'Success!',
        html: `{{ (session()->has('html')) ? session()->get('html') : '' }}`
    });
@endif
@if (session()->has('error'))
   swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: `{{ (session()->has('html')) ? session()->get('html') : '' }}`
    });
@endif
</script>
