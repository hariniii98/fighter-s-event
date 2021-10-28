@extends('layouts.master_layout')
@section('content')
@include('elements.settings_section')
@push('css-styles')
   @include('draw._css')
<style>
    .even{
        background-color:blue !important;
        color:#fff !important;
        padding:5px;
        border-radius: 10px;
        text-align: center;
    }
    .odd{
        background-color:red !important;
        color:#fff !important;
        padding:5px;
        border-radius: 10px;
        justify-content: center;
        text-align: center;
    }
    .won{
        background-color:#63ed7a !important;
        color:#fff !important;
        padding: 13px;
        border-radius: 10px;
        justify-content: center;
        text-align: center;
    }
    .re-draw{
        position:absolute;
bottom:0;
    }
</style>
@endpush

<!-- Main Content -->


<div class="section-header">

    <h1>{{$data['event_name']}}</h1>
    <span>&nbsp;&nbsp;</span>
    @php
    $events=App\Models\Event::all();
   @endphp
    <form method="GET" action="{{route('tournament.draws')}}">

        <div class="row">
            <div class="form-group col-sm-10">
    <label>Filter</label>
    <select class="form-control form-control-sm" name="event_id" id="event-filter">
        <option value="{{$data['event_id']!=''?$data['event_id']:''}}">{{$data['event_name']!=''?$data['event_name']:'--select--'}}</option>
        @foreach ($events as $row)
        @if($row->id!=$data['event_id'])
        <option value="{{$row->id}}">{{$row->name}}</option>
        @endif
     @endforeach
    </select>
  </div>
  <div class="form-group col-sm-2" style="margin-top: 12%!important;">
    <button type="submit" class="btn btn-primary">Search</button>

</div>
        </div>

    </form>


    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></div>
      <div class="breadcrumb-item active">Tournament Draw System</div>
    </div>
  </div>


  @php
  $instance=new App\Http\Controllers\TournamentDrawController();
      $tem_c=count($tournament_draws);
      $count=$tem_c;
      $user_last_round=$instance->drawJsonDecode($tournament_draws[($tem_c-1)]->user_ids);
      $last_user_count=count($user_last_round[0]);
      $is_direct_pass=$instance->userDirectPass($tournament_draws,$user_last_round[0]);








  @endphp

  <div class="row">

    @foreach($tournament_draws as $key=>$value)
    @php


     $matches=$instance->drawJsonDecode($value->match_ids);
     $users=$instance->drawJsonDecode($value->user_ids);
     $scores_data=$instance->scoreStage($value->event_id,$value->stage_id);






    @endphp

    @php
        $draw_count=count($matches);
        $temp_count=$draw_count;







    @endphp
  @if($last_user_count>1 || $is_direct_pass==false)
  @if(count($scores_data)>0 & $value->stage_id==1)
  <h5>Matches In Progress</h5>
  @endif
  @elseif($value->stage_id==1)
  <h5>Match Winner</h5>
  @endif
    <!-- Stage -->
    <div class="container col-sm-1">

        <!-- Match -->
        @if(count($users)>0)
      @for($d=0;$draw_count>0;$d++)

        @php

            $user_key=$users[$d];

            $user_count=count($user_key);
            $temp_user_count=$user_count;


        @endphp


      @for($u=0;$user_count>0;$u++)
      <div class="@if($u%2==0) even @else odd @endif">
        @if ($user_key[$u]!='')
        <img class="rounded-circle" width="100" height="70" alt="100x100" src="{{asset('assets/images/user_images/'.$instance->userImage($user_key[$u]))}}"
        data-holder-rendered="true"><span>&nbsp;&nbsp;</span> {{$instance->userName($user_key[$u])}}
            @else
            <span>&nbsp;&nbsp;</span>
        @endif

    </div>
      @php
      $user_count--;

  @endphp

  @endfor


      @php
          $draw_count--;

      @endphp

      @endfor
      @elseif($key==($count-1))
      <div class="won"></div>
      @else
      @php
        if($temp_count!=1){
            $temp_count=$temp_count+2;
        }
        else if($temp_count==1){
            $temp_count=2;
        }




          $exit_count=$temp_count;

      @endphp
      @for($e=0;$exit_count>0;$e++)
      <div class="@if($e%2==0) even @else odd @endif" style="padding: 13px;!important"></div>
      @php
          $exit_count--;
      @endphp
      @endfor

      @endif

    </div>

    @if($last_user_count>1)
@if(count($users[0])>=2)

    @if ($value->stage_id==1 & count($scores_data)==0)
    <div class="re-draw">
        <a href="{{route('tournament.matches.redraw',[$value->event_id,$value->stage_id])}}" class="btn btn-primary">Re Draw the Stage {{$value->stage_id}}</a>
    </div>

    @elseif(count($scores_data)==$temp_count & $value->stage_id!=1)

<div class="re-draw">
    <a href="{{route('tournament.matches.redraw',[$value->event_id,$value->stage_id])}}" class="btn btn-primary">Re Draw the Stage {{$value->stage_id}}</a>
    @if (count($users)%2==0 & count($scores_data)>0)
    <a href="{{route('tournament.direct_pass',[$value->event_id,$value->stage_id])}}" class="btn btn-warning">Direct Pass</a>
    @endif

</div>
@elseif($value->stage_id!=1)

<div class="re-draw">
    <a href="{{route('tournament.matches.redraw',[$value->event_id,$value->stage_id])}}" class="btn btn-primary">Re Draw the Stage {{$value->stage_id}}</a>
    @if (count($users)%2==0 & count($scores_data)>0)
    <a href="{{route('tournament.direct_pass',[$value->event_id,$value->stage_id])}}" class="btn btn-warning">Direct Pass</a>
    @endif

</div>
    @endif

    @endif
    @endif





    @endforeach

  </div>





    @endsection



