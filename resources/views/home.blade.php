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
            @role('fighter|user|coach')
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
            <label>Select Match</label>
            <select id="match_id_filter" name="match_id_filter" class="form-control">
                @foreach($judge_matches_numbers_list as $su_list)
                <option value="{{$su_list['match_id']}}">Match {{$su_list['match_id']}}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-primary my-2" id="search">Start</button>

            @foreach ($judge_matches_list as $row)
            @php

                $instance=new App\Http\Controllers\ScoreController();
                $draw_instance=new App\Http\Controllers\TournamentDrawController();
                $response=$instance->matchParticipants($row->event_id,$row->stage_id,$row->match_id);
                $count_users=count($response);
                $is_scored=App\Models\Score::where('judge_id',auth()->user()->id)->where('event_id',$row->event_id)->where('stage_id',$row->stage_id)->where('match_id',$row->match_id)->count();

            @endphp

            <div class="card">
                <div class="card-header">
                    <h4>Assign scores</h4>
                </div>
                @if($is_scored==0)
                @if($count_users>0)
                <div class="card-body">
                    <div id="accordion">

                        <form method="POST" action="{{route('scores.store')}}" enctype="multipart/form-data">
                            @csrf

                        <div class="row">
                            @for($u=0;$count_users>0;$u++)
                            @php
                                if($u%2==0){
                                    $src=asset('assets/dark-red-background.jpg');

                                }
                                else{
                                    $src=asset('assets/dark-blue-color-solid-background-1920x1080.png');
                                }


                            @endphp
                             <input type="hidden" name="users[]" value="{{$response[$u]}}">
                             <input type="hidden" name="event_id" value="{{$row->event_id}}">
                             <input type="hidden" name="stage_id" value="{{$row->stage_id}}">
                             <input type="hidden" name="match_id" value="{{$row->match_id}}">
                            <div class="col-6">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{$src}}" class="wh40 mb-3" align="center">
                                        <p>{{$draw_instance->userName($response[$u])}}</p>
                                        <p>Round1</p>
                                        <div class="form-group col-12">
                                            <label for="score_round1">Score</label><span class="text-danger"> *</span>
                                            <input type="radio" id="round1_score_user1" name="round1[{{$response[$u]}}]" value="8" required>
                                            <label for="round1_score_user1" class="mr-3">8</label>
                                            <input type="radio" id="round1_score_user1" name="round1[{{$response[$u]}}]" value="9">
                                            <label for="round1_score_user1" class="mr-3">9</label>
                                            <input type="radio" id="round1_score_user1" name="round1[{{$response[$u]}}]" value="10">
                                            <label for="round2_score_user1" class="mr-3">10</label>
                                        </div>
                                        <p>Round2</p>
                                        <div class="form-group col-12">
                                            <label for="score_round2">Score</label><span class="text-danger"> *</span>
                                            <input type="radio" id="round2_score_user1" name="round2[{{$response[$u]}}]" value="8" required>
                                            <label for="round2_score_user1" class="mr-3">8</label>
                                            <input type="radio" id="round2_score_user1" name="round2[{{$response[$u]}}]" value="9">
                                            <label for="round2_score_user1" class="mr-3">9</label>
                                            <input type="radio" id="round2_score_user1" name="round2[{{$response[$u]}}]" value="10">
                                            <label for="round2_score_user1" class="mr-3">10</label>
                                        </div>
                                        <p>Round3</p>
                                        <div class="form-group col-12">
                                            <label for="score_round3">Score</label><span class="text-danger"> *</span>
                                            <input type="radio" id="round3_score_user1" name="round3[{{$response[$u]}}]" value="8" required>
                                            <label for="round3_score_user1" class="mr-3">8</label>
                                            <input type="radio" id="round3_score_user1" name="round3[{{$response[$u]}}]" value="9">
                                            <label for="round3_score_user1" class="mr-3">9</label>
                                            <input type="radio" id="round3_score_user1" name="round3[{{$response[$u]}}]" value="10">
                                            <label for="round3_score_user1" class="mr-3">10</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $count_users--;
                            @endphp
                            @endfor


                            <div class="col-12">
                                <label for="remarks">Remarks</label>
                                <textarea name="remarks" class="form-control" id="remarks" col="5" rows="10"></textarea>
                            </div>

                            <div class="form-group card-footer text-md-right">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Submit
                                </button>
                            </div>
                        </div>



                        </form>

                    </div>
                </div>
                @endif


                @else
                <div class="buttons">
                    <p align="center">Already You have scored for this match</p>
                </div>
                @endif
                @endforeach
            @endrole
            @role('superjudge')
            <label>Select Match</label>
            <select id="match_id_filter" name="match_id_filter" class="form-control">
                @foreach($super_judge_matches_numbers_list as $su_list)
                <option value="{{$su_list['match_id']}}">Match {{$su_list['match_id']}}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-primary my-2" id="search">Start</button>
            @foreach ($super_judge_matches_list as $row)
            @php

                $instance=new App\Http\Controllers\ScoreController();
                $draw_instance=new App\Http\Controllers\TournamentDrawController();
                $response=$instance->matchParticipants($row->event_id,$row->stage_id,$row->match_id);
                $count_users=count($response);
                $temp=$count_users;
                $is_scored=App\Models\SuperJudgeDecision::where('super_judge_id',auth()->user()->id)->where('event_id',$row->event_id)->where('stage_id',$row->stage_id)->where('match_id',$row->match_id)->count();

            @endphp
            <div class="card">
                <div class="card-header">
                    <h4>Update remarks and technique</h4>
                </div>
                @if($is_scored==0)
                @if($count_users>0)
                <div class="card-body">
                    <div id="accordion">

                        <form method="POST" action="{{route('super_judge_d.store')}}" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <p class="btn btn-danger">
                            @for($u=0;$count_users>0;$u++)
                           {{$draw_instance->userName($response[$u])}}
                            @if ($u==0)
                                <span class="badge badge-transparent">Vs</span>
                            @endif

                            @php
                                $count_users--;
                            @endphp

                            @endfor
                        </label>

                        <input type="hidden" name="event_id" value="{{$row->event_id}}">
                        <input type="hidden" name="stage_id" value="{{$row->stage_id}}">
                        <input type="hidden" name="match_id" value="{{$row->match_id}}">
                        <div class="col-12 mt-3">
                            <p>Winner</p>
                            @for($u=0;$temp>0;$u++)
                            <input type="hidden" name="users[]" value="{{$response[$u]}}">
                            <input type="radio" id="{{$draw_instance->userName($response[$u])}}" name="winner_id" class="winner {{$response[$u]}}" value="{{$response[$u]}}" {{$u==0?'required':''}} >
                            <label for="{{$draw_instance->userName($response[$u])}}" class="mr-3">{{$draw_instance->userName($response[$u])}}</label>
                            @php
                            $temp--;
                        @endphp

                        @endfor

                        </div><br>
                            <div class="col-12">
                                <label for="remarks">Remarks</label>
                                <textarea name="remarks" class="form-control" id="remarks" col="20" rows="10"></textarea>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="radio" id="TKO" name="technique" value="tko" required>
                                <label for="TKO" class="mr-3">TKO</label>
                                <input type="radio" id="KO" name="technique" value="ko">
                                <label for="KO" class="mr-3">KO</label>
                                <input type="radio" id="SD" name="technique" value="sd">
                                <label for="SD" class="mr-3">SD</label>
                                <input type="radio" id="UD" name="technique" value="ud">
                                <label for="UD" class="mr-3">UD</label>
                                <input type="radio" id="SUB" name="technique" value="sub">
                                <label for="SUB" class="mr-3">SUB</label>
                                <input type="radio" id="DRAW" name="technique" value="draw">
                                <label for="DRAW" class="mr-3">DRAW</label>
                                <input type="radio" id="OTHERS" name="technique" value="others">
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
                @endif
                @else
                <div class="buttons">
                  <p align="center">Already You have scored for this match</p>
                </div>
                @endif


        @endforeach
        @endrole
    </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $("input[name='technique']").on("click",function(){
            var name=$(this).val();
            var val=$(".winner").val();



                if(name!='draw'){
                    $('.'+val).attr('required','required');

                }
                else{
                    $('.'+val).removeAttr('required');

                }



        });
    </script>
    <script>
        $('#search').click(function(){
            var id = $('#match_id_filter').val();
            location.replace('home?match_id='+id);
        });
        </script>
@endpush
