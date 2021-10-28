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

        <h1>Main Events</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{routes('main_events.index')}}">Main Events</a></div>
        </div>
      </div>

      <div class="section-body">


            <div id="output-status"></div>
            <div class="row">

                <div class="col-md-12">
                    <form id="setting-form" method="POST" action="{{route('main_events.store')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card" id="settings-card">
                        <div class="card-header">
                        <h4>Add Main Event</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row align-items-center">
                                <label for="name" class="form-control-label col-sm-3 text-md-right">Name<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <input type="text" name="name" class="form-control" id="name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="name" class="form-control-label col-sm-3 text-md-right">Sub Events<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                @foreach($events as $event)
                                <input type="checkbox" name="event_id[]" id="{{$event->name}}" value="{{$event->id}}">
                                <label for="{{$event->name}}">{{$event->name}}</label>
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


