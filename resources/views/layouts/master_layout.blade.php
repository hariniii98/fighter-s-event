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
                <a href="{{url('/')}}"><img src="@yield('logo')" width="150" height="75" class="img-fluid" style="height:70px;"></a>
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
                    <div class="main-content mb-5 pb-5">
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
@role('fighter|user')
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Register for Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form id="setting-form" method="POST" action="{{route('event_user.store')}}" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    You are being registered with event <span id="event_name"></span>. Please select the mode of payment online or offline.<br>
                    <div class="form-group row align-items-center mt-3">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Payment Mode<span class="text-danger"> *</span></label>
                        <div class="col-sm-6 col-md-9">
                            <select name="payment_mode" class="form-control" id="payment_mode" required>
                                <option value="">--select--</option>
                                <option value="offline">Offline</option>
                                <option value="online">Online</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right" id="ref_code" style="display: none;">Reference Number<span class="text-danger"> *</span></label>
                        <div class="col-sm-6 col-md-9">
                            <input id="ref_number" name="reference_number" class="form-control" autocomplete="off" style="display:none;">
                            <input id="event__id" name="event_id" class="form-control" value="" autocomplete="off" style="display:none;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
  @endrole
</body>

@include('elements.footer_scripts')
@stack('scripts')
{{-- @yield('footer_scripts') --}}
<script>
    $(document).ready(function(){

    
    $(document).on("click",'#btn-event',function(){
        var event_id = $(this).data("id");
        
        var event_name = $(this).data("name");
        $('#event__id').val(event_id);
        $('#event_name').text(event_name);
    });
    $('#payment_mode').click(function(){
        if($(this).val()=="online"){
            $('#ref_number').css('display','block');
            $('#ref_code').css('display','block');
        }
    });
});
</script>
</html>

