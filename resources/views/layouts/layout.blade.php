<!DOCTYPE html>
<html lang="en">

<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>@yield('title')</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="{{ asset('assets/front/images/favicon.ico') }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ asset('assets/front/images/apple-touch-icon.png') }}">

<!-- Design fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/colors.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/version/marketing.css') }}">

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
    .media-body {
        position: relative;
    }
    .delete-comment {
        position: absolute;
        top: 0;
        right: 0;
        cursor: pointer;
        color: red;
    }
</style>

</head>
<body>

<div id="wrapper">

    @include('layouts.navbar')

    <section class="section lb m3rem">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">

                    @yield('content')

                </div><!-- end col -->

                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">

                    @include('layouts.sidebar')

                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

    @include('layouts.footer')

    <div class="dmtop">Scroll to Top</div>

</div><!-- end wrapper -->

<script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/front/js/tether.min.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/front/js/animate.js') }}"></script>
<script src="{{ asset('assets/front/js/custom.js') }}"></script>

</body>
</html>
