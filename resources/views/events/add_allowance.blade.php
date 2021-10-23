@extends('layouts.master_layout')
@section('description', isset($settings->site_description)?$settings->site_description:'')
@section('title', isset($settings->site_title)?$settings->site_title:config('app.name'))
@section('favicon', isset($settings->site_favicon)?asset('assets/images/site_favicons/'.$settings->site_favicon):'')


@section('content')

@php
    $site_logo=isset($settings->site_logo)?'assets/images/site_logos/'.$settings->site_logo:'assets/default_placeholder.png';
    $site_favicon=isset($settings->site_favicon)?'assets/images/site_favicons/'.$settings->site_favicon:'assets/default_placeholder.png';
@endphp

 <!-- Main Content -->

      <div class="section-header">

        <h1>Allowances</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/')}}">Events</a></div>
          <div class="breadcrumb-item">Allowances</div>
        </div>
      </div>

      <div class="section-body">


            <div id="output-status"></div>
            <div class="row">

                <div class="col-md-12">
                    <form id="setting-form" method="POST" action="{{route('allowance.store')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card" id="settings-card">
                        <div class="card-header">
                        <h4>Add Allowance</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row align-items-center">
                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Allowance Name<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <input type="text" name="name" class="form-control" id="site-title" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke text-md-right">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <button class="btn btn-secondary" type="button" id="setting-formReset">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

      </div>

@endsection
@push('scripts')
<script>
    $(document).on('click','#setting-formReset',function(){
        $("#setting-form")[0].reset();
    });
</script>
@endpush


