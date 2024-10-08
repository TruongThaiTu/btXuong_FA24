<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from demo.dashboardpack.com/sales-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 May 2024 07:23:13 GMT -->

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>

    @include('admin.layouts.css')
</head>

<body class="crm_body_bg">


    @include('admin.layouts.sidebar')

    <section class="main_content dashboard_part large_header_bg">

        @include('admin.layouts.header')
        
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>



        @include('admin.layouts.footer')
    </section>




    <div id="back-top" style="display: none;">
        <a title="Go to Top" href="#">
            <i class="ti-angle-up"></i>
        </a>
    </div>

    @include('admin.layouts.js')
</body>

<!-- Mirrored from demo.dashboardpack.com/sales-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 May 2024 07:24:00 GMT -->

</html>
