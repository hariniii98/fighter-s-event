@extends('layouts.master_layout')


@section('content')
@include('elements.settings_section')

 <!-- Main Content -->

      <div class="section-header">

        <h1>Age Categories</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/')}}">Events</a></div>
          <div class="breadcrumb-item">Age Categories</div>
        </div>
      </div>

      <div class="section-body">


            <div id="output-status"></div>
            <div class="row">

                <div class="col-md-12">
                    <form id="setting-form" method="POST" action="{{route('weight_category.store')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card" id="settings-card">
                        <div class="card-header">
                        <h4>Add Weight Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row align-items-center">
                                <label for="name" class="form-control-label col-sm-3 text-md-right">Name<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <input type="test" name="name" class="form-control" id="name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="min_weight" class="form-control-label col-sm-3 text-md-right">Minimum Weight<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <input type="number" name="min_weight" class="form-control" id="min_weight" autocomplete="off" step="0.01" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="max_weight" class="form-control-label col-sm-3 text-md-right">Maximum Weight<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <input type="number" name="max_weight" class="form-control" id="max_weight" autocomplete="off"  step="0.01" required>
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


