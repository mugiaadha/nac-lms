<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Aduca - Education HTML Template</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('frontoffice/images/favicon.png') }}">

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('frontoffice/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontoffice/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontoffice/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontoffice/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontoffice/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontoffice/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('frontoffice/css/style.css') }}">
    <!-- end inject -->
</head>

<body>

    <!-- start cssload-loader -->
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>

    @include('frontoffice.dashboard.parts.header')

    <section class="dashboard-area">
        @include('frontoffice.dashboard.parts.sidebar')

        <div class="dashboard-content-wrap">
            <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3">
                <i class="la la-bars mr-1"></i> Dashboard Nav
            </div>
            <div class="container-fluid">
                @yield('content')

                @include('frontoffice.dashboard.parts.footer')
            </div>
        </div>
    </section>

    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->

    <!-- Modal -->
    <div class="modal fade modal-container" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="la la-exclamation-circle fs-60 text-warning"></span>
                    <h4 class="modal-title fs-19 font-weight-semi-bold pt-2 pb-1" id="deleteModalTitle">Your account will be deleted permanently!</h4>
                    <p>Are you sure you want to delete your account?</p>
                    <div class="btn-box pt-4">
                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Ok, Delete</button>
                    </div>
                </div><!-- end modal-body -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->

    <!-- template js files -->
    <script src="{{ asset('frontoffice/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('frontoffice/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontoffice/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontoffice/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontoffice/js/isotope.js') }}"></script>
    <script src="{{ asset('frontoffice/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontoffice/js/fancybox.js') }}"></script>
    <script src="{{ asset('frontoffice/js/chart.js') }}"></script>
    <script src="{{ asset('frontoffice/js/doughnut-chart.js') }}"></script>
    <script src="{{ asset('frontoffice/js/bar-chart.js') }}"></script>
    <script src="{{ asset('frontoffice/js/line-chart.js') }}"></script>
    <script src="{{ asset('frontoffice/js/datedropper.min.js') }}"></script>
    <script src="{{ asset('frontoffice/js/emojionearea.min.js') }}"></script>
    <script src="{{ asset('frontoffice/js/animated-skills.js') }}"></script>
    <script src="{{ asset('frontoffice/js/jquery.MultiFile.min.js') }}"></script>
    <script src="{{ asset('frontoffice/js/main.js') }}"></script>

    @include('frontoffice.dashboard.parts.toast')
</body>

</html>