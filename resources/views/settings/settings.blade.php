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

        <h1>General Settings</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/')}}">Dashboard</a></div>
          <div class="breadcrumb-item">General Settings</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">General Settings</h2>


        <div id="output-status"></div>
        <div class="row">

          <div class="col-md-12">
            <form id="setting-form" method="POST" action="{{route('settings.store')}}" enctype="multipart/form-data">
              @csrf
                <div class="card" id="settings-card">
                <div class="card-header">
                  <h4>General Settings</h4>
                </div>
                <div class="card-body">
                  <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Site Title<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <input type="text" name="site_title" class="form-control" id="site-title" autocomplete="off" value="{{isset($settings->site_title)?$settings->site_title:''}}" required>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="site-description" class="form-control-label col-sm-3 text-md-right">Site Description<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <textarea class="form-control" name="site_description" id="site-description" value="{{isset($settings->site_description)?$settings->site_description:''}}" required>{{isset($settings->site_description)?$settings->site_description:''}}</textarea>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label class="form-control-label col-sm-3 text-md-right">Site Logo<span class="text-danger"> *</span></label>

                        <img src="{{asset($site_logo)}}"  id="blah" class="col-sm-2" width="1000" height="150">
                        <input type="hidden" value="{{isset($settings->site_logo)?$settings->site_logo:''}}" name="old_site_logo">



                    <div class="col-sm-3 col-md-3">
                        <div class="custom-file">
                        <input type="file" name="site_logo" class="custom-file-input" id="site-logo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" {{isset($settings->site_logo)?'':'required'}}>
                        <label class="custom-file-label">Choose File</label>
                      </div>
                      <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label class="form-control-label col-sm-3 text-md-right">Favicon<span class="text-danger"> *</span></label>

                    <img src="{{asset($site_favicon)}}"  id="blah-favicon" class="col-sm-2" width="1000" height="150">
                    <input type="hidden" value="{{isset($settings->site_favicon)?$settings->site_favicon:''}}" name="old_site_favicon">



                    <div class="col-sm-3 col-md-3">

                      <div class="custom-file">
                        <input type="file" name="site_favicon" class="custom-file-input" id="site-favicon" onchange="document.getElementById('blah-favicon').src = window.URL.createObjectURL(this.files[0])" {{isset($settings->site_favicon)?'':'required'}}>
                        <label class="custom-file-label">Choose File</label>
                      </div>
                      <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                    </div>
                  </div>

                </div>
                <div class="card-footer bg-whitesmoke text-md-right">
                  <button class="btn btn-primary" type="submit">Save Changes</button>
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
