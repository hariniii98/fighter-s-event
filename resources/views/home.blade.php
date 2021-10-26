@extends('layouts.master_layout')
@push('css-styles')
<style>
    .wh40{
        width:50px !important;
        height:50px !important;
    }

</style>
@endpush
@section('content')
@include('elements.settings_section')
<div class="section-header">

    <h1>Dashboard</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{url('/home')}}">Dashboard</a></div>
    </div>
</div>

  <div class="section-body">
    <h2 class="section-title">Home</h2>


    <div id="output-status"></div>
    <div class="row justify-content-center">
        <div class="col-8 offset-1">
            @role('fighter|user')
            <div class="card">
                <div class="card-header">
                    <h4>Events</h4>
                </div>
                <div class="card-body">
                    <div id="accordion">
                        @foreach($events as $event)
                        <div class="accordion">
                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body{{$event->id}}" aria-expanded="false">
                                <h4>{{$event->name}}</h4>
                            </div>
                            <div class="accordion-body collapse show" id="panel-body{{$event->id}}" data-parent="#accordion">
                                  <p class="mb-0">{{$event->description}}</p>
                                  <!-- Button trigger modal -->
                                  @if(in_array($event->id,$events_registered_ids))
                                  <p>You have registered for this event!</p>

                                  @else
                                  <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="btn-event" data-id="{{$event->id}}" data-name="{{$event->name}}">Regiter Now!</button>
                                 @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endrole
            @role('judge')
            <div class="card">
                <div class="card-header">
                    <h4>Assign scores</h4>
                </div>
                <div class="card-body">
                    <div id="accordion">

                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('assets/dark-red-background.jpg')}}" class="wh40 mb-3" align="center">
                                        <p>Round1</p>
                                        <div class="form-group col-12">
                                            <label for="score_round1">Score</label><span class="text-danger"> *</span>
                                            <input type="radio" id="round1_score_user1" name="round1_score_user1[]" value="8">
                                            <label for="round1_score_user1" class="mr-3">8</label>
                                            <input type="radio" id="round1_score_user1" name="round1_score_user1[]" value="9">
                                            <label for="round1_score_user1" class="mr-3">9</label>
                                            <input type="radio" id="round1_score_user1" name="round1_score_user1[]" value="10">
                                            <label for="round2_score_user1" class="mr-3">10</label>
                                        </div>
                                        <p>Round2</p>
                                        <div class="form-group col-12">
                                            <label for="score_round2">Score</label><span class="text-danger"> *</span>
                                            <input type="radio" id="round2_score_user1" name="round2_score_user1[]" value="8">
                                            <label for="round2_score_user1" class="mr-3">8</label>
                                            <input type="radio" id="round2_score_user1" name="round2_score_user1[]" value="9">
                                            <label for="round2_score_user1" class="mr-3">9</label>
                                            <input type="radio" id="round2_score_user1" name="round2_score_user1[]" value="10">
                                            <label for="round2_score_user1" class="mr-3">10</label>
                                        </div>
                                        <p>Round3</p>
                                        <div class="form-group col-12">
                                            <label for="score_round3">Score</label><span class="text-danger"> *</span>
                                            <input type="radio" id="round3_score_user1" name="round3_score_user1[]" value="8">
                                            <label for="round3_score_user1" class="mr-3">8</label>
                                            <input type="radio" id="round3_score_user1" name="round3_score_user1[]" value="9">
                                            <label for="round3_score_user1" class="mr-3">9</label>
                                            <input type="radio" id="round3_score_user1" name="round3_score_user1[]" value="10">
                                            <label for="round3_score_user1" class="mr-3">10</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('assets/dark-blue-color-solid-background-1920x1080.png')}}" class="wh40 mb-3">
                                        <p>Round1</p>
                                        <div class="form-group col-12">
                                            <label for="score_round1">Score</label><span class="text-danger"> *</span>
                                            <input type="radio" id="round1_score_user2" name="round1_score_user2[]" value="8">
                                            <label for="round1_score_user2" class="mr-3">8</label>
                                            <input type="radio" id="round1_score_user2" name="round1_score_user2[]" value="9">
                                            <label for="round1_score_user2" class="mr-3">9</label>
                                            <input type="radio" id="round1_score_user2" name="round1_score_user2[]" value="10">
                                            <label for="round1_score_user2" class="mr-3">10</label>
                                        </div>
                                        <p>Round2</p>
                                        <div class="form-group col-12">
                                            <label for="score_round2">Score</label><span class="text-danger"> *</span>
                                            <input type="radio" id="round2_score_user2" name="round2_score_user2[]" value="8">
                                            <label for="round2_score_user2" class="mr-3">8</label>
                                            <input type="radio" id="round2_score_user2" name="round2_score_user2[]" value="9">
                                            <label for="round2_score_user2" class="mr-3">9</label>
                                            <input type="radio" id="round2_score_user2" name="round2_score_user2[]" value="10">
                                            <label for="round2_score_user2" class="mr-3">10</label>
                                        </div>
                                        <p>Round3</p>
                                        <div class="form-group col-12">
                                            <label for="score_round3">Score</label><span class="text-danger"> *</span>
                                            <input type="radio" id="round3_score_user2" name="round3_score_user2[]" value="8">
                                            <label for="round3_score_user2" class="mr-3">8</label>
                                            <input type="radio" id="round3_score_user2" name="round3_score_user2[]" value="9">
                                            <label for="round3_score_user2" class="mr-3">9</label>
                                            <input type="radio" id="round3_score_user2" name="round3_score_user2[]" value="10">
                                            <label for="round3_score_user2" class="mr-3">10</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="remarks">Remarks</label><span class="text-danger"> *</span>
                                <textarea name="remarks[]" class="form-control" id="remarks" col="5" rows="10"></textarea>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="radio" id="TKO" name="technique[]" value="TKO">
                                <label for="TKO" class="mr-3">TKO</label>
                                <input type="radio" id="KO" name="technique[]" value="KO">
                                <label for="KO" class="mr-3">KO</label>
                                <input type="radio" id="SD" name="technique[]" value="SD">
                                <label for="SD" class="mr-3">SD</label>
                                <input type="radio" id="UD" name="technique[]" value="UD">
                                <label for="UD" class="mr-3">UD</label>
                                <input type="radio" id="SUB" name="technique[]" value="SUB">
                                <label for="SUB" class="mr-3">SUB</label>
                                <input type="radio" id="DRAW" name="technique[]" value="DRAW">
                                <label for="DRAW" class="mr-3">DRAW</label>
                                <input type="radio" id="DRAW" name="technique[]" value="OTHERS">
                                <label for="OTHERS" class="mr-3">OTHERS</label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Submit
                                </button>
                            </div>
                        </div>
                        </form>

                    </div>
                </div>
            @endrole
        </div>
    </div>
</div>
@endsection
