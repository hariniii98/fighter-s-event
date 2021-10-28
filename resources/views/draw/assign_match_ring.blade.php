@extends('layouts.master_layout')

@php $count = (int)$rings; @endphp
@section('content')

@include('elements.settings_section')


 <!-- Main Content -->

      <div class="section-header">

        <h1>Assign match to ring</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/events')}}">Events</a></div>
          <div class="breadcrumb-item">Assign match to ring</div>
        </div>
      </div>

      <div class="section-body">


            <div id="output-status"></div>
            <div class="row">

                <div class="col-md-12">
                    <form id="setting-form" method="POST" action="{{route('tournament.matches.assign_ring.store')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card" id="settings-card">
                        <div class="card-header">
                        <h4>Assign match to ring</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row align-items-center">
                                <label for="ring_id" class="form-control-label col-sm-3 text-md-right">Ring Number<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="number" id="match_id" name="match_id" value="{{$match_id}}" style="display:none;">
                                    <input type="number" id="stage_id" name="stage_id" value="{{$stage_id}}" style="display:none;">
                                    <input type="number" id="event_id" name="event_id" value="{{$event_id}}" style="display:none;">
                                <select name="ring_id" class="form-control" id="ring_id" required>
                                    <option value="{{isset($check->ring_id)?$check->ring_id:''}}">{{isset($check->ring_id)?$check->ring_id:'--select--'}}</option>
                                    @for($i=1;$i<=$count;$i++)
                                    {{-- @if(isset($check) && $check->ring_id!=$i) --}}
                                    <option value="{{$i}}">{{$i}}</option>
                                    {{-- @endif --}}
                                    @endfor
                                </select>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke text-md-right">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
      </div>
@endsection
