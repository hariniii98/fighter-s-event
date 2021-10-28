@extends('layouts.master_layout')
@section('content')
@include('elements.settings_section')
@php
    $instance=new App\Http\Controllers\TournamentDrawController();
@endphp

 <!-- Main Content -->

        <div class="section-header">

            <h1>Matches</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></div>
            <div class="breadcrumb-item active">Add </div>
            </div>
        </div>Match

      <div class="section-body">
        <h2 class="section-title">Add Match</h2>


        <div id="output-status"></div>
        <div class="row">

          <div class="col-md-12">

            <form id="role-form" method="POST" action="{{route('tournament.matches.store')}}" enctype="multipart/form-data">
              @csrf
                <div class="card" id="roles-card">
                <div class="card-header">
                  <h4>Add Match</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row align-items-center">
                        <label for="event" class="form-control-label col-sm-3 text-md-right">Event Name<span class="text-danger"> *</span></label>
                        <div class="col-sm-6 col-md-9">
                          <select class="form-control" name="event" id="event"  required>

                            <option value="">--select--</option>
                              @foreach ($events as $row)

                              <option value="{{$row->id}}">{{$row->name}}</option>


                              @endforeach

                          </select>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="stage" class="form-control-label col-sm-3 text-md-right">Stage<span class="text-danger"> *</span></label>
                        <div class="col-sm-6 col-md-9">
                          <select class="form-control" name="stage" id="stage"  required>


                          </select>
                        </div>
                      </div>
                  <div class="form-group row align-items-center">
                    <label for="role-title" class="form-control-label col-sm-3 text-md-right">Match Number<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <input type="number" name="match_id" class="form-control" id="match_id" autocomplete="off" readonly>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="member_1" class="form-control-label col-sm-3 text-md-right">Member 1<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <select class="form-control" name="member_1" id="member_1"  required>

                        <option value="">--select--</option>
                          @foreach ($tournaments_participants as $row)

                          <option value="{{$row->id}}">{{$row->first_name}}</option>


                          @endforeach

                      </select>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="member_2" class="form-control-label col-sm-3 text-md-right">Member 2<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                    <select class="form-control" name="member_2" id="member_2" required>

                        <option value="">--select--</option>
                        @foreach ($tournaments_participants as $row)

                        <option value="{{$row->id}}">{{$row->first_name}}</option>


                        @endforeach

                    </select>
                    </div>
                  </div>



                </div>
                <div class="card-footer bg-whitesmoke text-md-right">
                  <button class="btn btn-primary" type="submit">Update</button>

                </div>
              </div>
            </form>

          </div>
        </div>
          </div>


@endsection
@push('scripts')
<script>
    $('#event').change(function(){
        var event_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
        url: "{{route('stage.search')}}",
        type: "POST",
        data:{id:event_id},
        success: function(data){
            $('#stage').append(data);
        }
    });
    });

</script>
<script>
    $('#stage').change(function(){
        var stage_id = $(this).val();
        var event_id = $("#event").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
        url: "{{route('tournament.matches.auto-increment')}}",
        type: "POST",
        data:{event_id:event_id,stage_id:stage_id},
        success: function(data){
            $('#match_id').val(data);
        }
    });
    });

</script>
@endpush

