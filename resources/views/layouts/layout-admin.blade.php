<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OutOfHate - Admin Control Pannel</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('acp_assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('acp_assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('acp_assets/plugins/dropzone/min/dropzone.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('acp_assets/plugins/summernote/summernote-bs4.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts._admin-parts.aside')
        <!-- Sidebar End -->
        
        @yield('content')
    </div>
    
    <script src="{{asset('acp_assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('acp_assets/js/sidebarmenu.js')}}"></script>
    <script src="{{asset('acp_assets/js/app.min.js')}}"></script>
    <script src="{{asset('acp_assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
    <script src="{{asset('acp_assets/libs/simplebar/dist/simplebar.js')}}"></script>
    <script src="{{asset('acp_assets//js/dashboard.js')}}"></script>
    <script src="{{asset('acp_assets/plugins/dropzone/min/dropzone.min.js')}}"></script>
    <script src="{{asset('acp_assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
    
    @yield('customJS')

</body>

</html>