<!doctype html>
  <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title')</title>
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/logo kementan.png')}}"/>
        <link rel="stylesheet" href="{{asset('assets/css/backend-plugin.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/backend.css?v=1.0.0')}}">
        <link rel="stylesheet" href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/vendor/remixicon/fonts/remixicon.css')}}">  
        <link href="http://www.mysite.com/Jquery/javascript.js">  
        @yield('token')
        @yield('css')
    </head>
    <body class=" ">
      <div class="wrapper">
      <div class="iq-sidebar  sidebar-default ">
        @include('layouts.navbar')
      </div>
      <div class="iq-top-navbar">
        @include('layouts.topnav')
      </div>
        <div class="content-page">
          <div class="container-fluid">
            <div class="row">
              @yield('content')
            </div>
          </div>
        </div>
      </div>
        <!-- Backend Bundle JavaScript -->
        <script src="{{asset('assets/js/backend-bundle.min.js')}}"></script>
        
        <!-- Table Treeview JavaScript -->
        <script src="{{asset('assets/js/table-treeview.js')}}"></script>
        
        <!-- Chart Custom JavaScript -->
        <script src="{{asset('assets/js/customizer.js')}}"></script>
        
        <!-- Chart Custom JavaScript -->
        <script async src="{{asset('assets/js/chart-custom.j')}}s"></script>
        
        <!-- app JavaScript -->
        <script src="{{asset('assets/js/app.js')}}"></script>
        @stack('js')
        @stack('script')
        <!-- @stack('customscripts') -->
    </body>
</html>