@extends('layouts.master_layout')
@push('css-styles')
<style>
    .wh-40{
        width:40px !important;
        height:40px !important;
    }
</style>
@endpush

@section('content')
@include('elements.settings_section')
 <!-- Main Content -->

      <div class="section-header">

        <h1>Events</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/')}}">Events</a></div>
        </div>
      </div>

      <div class="section-body">


            <div id="output-status"></div>
            <div class="row">

                <div class="col-md-12">
                    <form id="setting-form" method="POST" action="{{route('events.store')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card" id="settings-card">
                        <div class="card-header">
                        <h4>Add Event</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row align-items-center">
                                <label for="name" class="form-control-label col-sm-3 text-md-right">Name<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <input type="test" name="name" class="form-control" id="name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="description" class="form-control-label col-sm-3 text-md-right">Description</label>
                                <div class="col-sm-6 col-md-9">
                                <textarea name="description" class="form-control" id="description" autocomplete="off"></textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="form-control-label col-sm-3 text-md-right">Banner Image</label>

                                    <img src="{{asset('assets/images/event_banners/event-banner-default.jpg')}}"  id="blah" class="col-sm-2" width="1000" height="150">
                                    <input type="hidden" value="{{isset($event->event_banner_image)?$event->event_banner_image:''}}" name="old_event_banner_image">



                                <div class="col-sm-3 col-md-3">
                                    <div class="custom-file">
                                    <input type="file" name="event_banner_image" class="custom-file-input" id="event_banner_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                    <label class="custom-file-label">Choose File</label>
                                  </div>
                                  <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                                </div>
                              </div>
                            <div class="form-group row align-items-center">
                                <label for="min_weight" class="form-control-label col-sm-3 text-md-right">Event Category<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                    <select class="form-control" name="event_category_id" id="event_category">
                                        <option value="">--select--</option>
                                        @foreach($event_categories as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="start_date" class="form-control-label col-sm-3 text-md-right">Start Date<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <input type="date" name="start_date" class="form-control" id="start_date" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="end_date" class="form-control-label col-sm-3 text-md-right">End Date<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <input type="date" name="end_date" class="form-control" id="end_date" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="reg_deadline" class="form-control-label col-sm-3 text-md-right">Registration Deadline</label>
                                <div class="col-sm-6 col-md-9">
                                <input type="date" name="reg_deadline" class="form-control" id="reg_deadline" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="start_time" class="form-control-label col-sm-3 text-md-right">Start Time</label>
                                <div class="col-sm-6 col-md-9">
                                <input type="time" name="start_time" class="form-control" id="start_time" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="end_time" class="form-control-label col-sm-3 text-md-right">End Time</label>
                                <div class="col-sm-6 col-md-9">
                                <input type="time" name="end_time" class="form-control" id="end_time" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="age_category" class="form-control-label col-sm-3 text-md-right">Age Category<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                    <select class="form-control" name="age_category_id" id="age_category">
                                        <option value="">--select--</option>
                                        @foreach($age_categories as $row)
                                        <option value="{{$row->id}}">{{$row->min_age}}&nbsp;-&nbsp;{{$row->max_age}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="gender" class="form-control-label col-sm-3 text-md-right">Gender<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="">--select--</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="weight_category" class="form-control-label col-sm-3 text-md-right">weight Category<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                    <select class="form-control" name="weight_category_id" id="weight_category">
                                        <option value="">--select--</option>
                                        @foreach($weight_categories as $row)
                                        <option value="{{$row->id}}">{{$row->name}}({{$row->min_weight}}&nbsp;-&nbsp;{{$row->max_weight}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="location" class="form-control-label col-sm-3 text-md-right">Location<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <input type="test" name="location" class="form-control" id="location" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="location" class="form-control-label col-sm-3 text-md-right">Allowances<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                    @foreach ($allowances as $allowance)
                                        <input type="checkbox" id="{{$allowance->id}}" name="allowances_ids[]" value="{{$allowance->id}}">
                                        <label for="{{$allowance->id}}">{{$allowance->name}}</label><br>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="location" class="form-control-label col-sm-3 text-md-right">Sponsors<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                    @foreach ($sponsors as $sponsor)
                                        <input type="checkbox" id="{{$sponsor->id}}" name="sponsors_ids[]" value="{{$sponsor->id}}">
                                        <label for="{{$sponsor->id}}">{{$sponsor->name}}<img src="{{asset('assets/images/sponsors_images/'.$sponsor->brand_image)}}" class="wh-40"></label><br>
                                    @endforeach
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


