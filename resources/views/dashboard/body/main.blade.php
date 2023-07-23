<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard Inventory</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}" />

        <!-- Styles CSS -->
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <!-- Icons -->
        <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>

        <!-- Custom CSS for specific page.  -->
        @yield('specificpagestyles')
    </head>

    <body class="nav-fixed">
        <!-- BEGIN: Navbar Brand -->
        @include('dashboard.body.header')
        <!-- END: Navbar Brand -->

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <!-- BEGIN: Sidenav -->
                @include('dashboard.body.sidebar')
                <!-- END: Sidenav -->
            </div>


            <div id="layoutSidenav_content">
                <main>
                <!-- BEGIN: Content -->
                    @yield('content')
                <!-- END: Content -->
                </main>

                <!-- BEGIN: Footer  -->
                @include('dashboard.body.footer')
                <!-- END: Footer  -->
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script>
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script>
         <script src="{{ asset('assets/js/app.js') }}"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

         <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
         <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        {!! Toastr::message() !!}
        <!-- Custom JS for specific page.  -->
        @yield('specificpagescripts')
    </body>
</html>
