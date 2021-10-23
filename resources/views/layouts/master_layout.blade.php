<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset = "UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="@yield('description')">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="@yield('favicon')">
  <!-- General CSS Files -->
<link rel="stylesheet" href="{{asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/modules/fontawesome/css/all.min.css')}}">

<!-- CSS Libraries -->
<link rel="stylesheet" href="{{asset('assets/modules/jqvmap/dist/jqvmap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/modules/summernote/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">

<!-- Template CSS -->
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-94034622-3');
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@stack('css-styles')
{{-- @yield('head') --}}
</head>

<body>
    <!--**********************************
          Main wrapper start
      ***********************************-->
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
        <!--**********************************
            Header start
        ***********************************-->

    @include('elements.header')


    <!--**********************************
                Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
            Sidebar start
        ***********************************-->
          <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
              <div class="sidebar-brand">
                <a href="{{url('/')}}"><img src="@yield('logo')" width="150" height="75" class="img-fluid"></a>
              </div>

                    @include('elements.sidebar')

                </aside>
                </div>

                    <!--**********************************
                                Sidebar end
                    ***********************************-->

                    <!--**********************************
                        Content body start
                    ***********************************-->
                    <div class="main-content">
                        <section class="section">

                        <!-- row -->
                        @yield('content')



                        </section>


                    </div>

                    <!--**********************************
                        Content body end
                    ***********************************-->

                    <!--**********************************
                        Footer start
                    ***********************************-->

                    @include('elements.footer')

                    <!--**********************************
                                Footer end
                    ***********************************-->
                    </div>
</div>
</body>

@include('elements.footer_scripts')
@stack('scripts')
{{-- @yield('footer_scripts') --}}
</html>

