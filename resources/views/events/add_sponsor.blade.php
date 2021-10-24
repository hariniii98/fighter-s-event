@extends('layouts.master_layout')


@section('content')

@include('elements.settings_section')


 <!-- Main Content -->

      <div class="section-header">

        <h1>Sponsors</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/')}}">Events</a></div>
          <div class="breadcrumb-item">Sponsors</div>
        </div>
      </div>

      <div class="section-body">


            <div id="output-status"></div>
            <div class="row">

                <div class="col-md-12">
                    <form id="setting-form" method="POST" action="{{route('sponsor.store')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card" id="settings-card">
                        <div class="card-header">
                        <h4>Add Sponsor</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row align-items-center">
                                <label for="name" class="form-control-label col-sm-3 text-md-right">Name<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <input type="text" name="name" class="form-control" id="name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="form-control-label col-sm-3 text-md-right">Banner Image<span class="text-danger"> *</span></label>

                                    <img src="{{asset('assets/images/sponsors_images/sponsor-default.jpg')}}"  id="blah" class="col-sm-2" width="1000" height="150">
                                <div class="col-sm-3 col-md-3">
                                    <div class="custom-file">
                                    <input type="file" name="brand_image" class="custom-file-input" id="brand_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" required>
                                    <label class="custom-file-label">Choose File</label>
                                  </div>
                                  <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                                </div>
                              </div>
                            <div class="form-group row align-items-center">
                                <label for="description" class="form-control-label col-sm-3 text-md-right">Description</label>
                                <div class="col-sm-6 col-md-9">
                                    <textarea id="description" name="description" rows="4" cols="50" required></textarea>
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


