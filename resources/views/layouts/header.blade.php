    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        {{-- {{Theme::getSetting('title')}}--}}
        {{empty($title) ? 'Title' : $title}}
    </title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="{{url(Theme::find(config('platform_config.current_theme'))->themesPath)}}/plugins/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/custom_css/style.css')}}">
    {{-- <style>
    .content-wrapper{
        background-image: url('{{config('platform_config.background.url')}}');
         background-repeat: {{ config('platform_config.background.repeat') }};
        background-repeat: {{ config('platform_config.background.repeat') }};
        background-size: {{ config('platform_config.background.size') }};
        background-position: {{config('platform_config.background.position')}}; 
        background-color: {{ config('platform_config.background.color') }};
    }
    </style> --}}
    <script type="text/javascript">
        var base_url = '{{url('/')}}';
        const URL_STATIC = "{{env('URL_STATIC')}}";
    </script>