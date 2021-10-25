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
        padding:5px;
        border-radius: 10px;
        justify-content: center;
        text-align: center;
    }
</style>
@endpush

<!-- Main Content -->


<div class="section-header">

    <h1>{{$data['event_name']}}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></div>
      <div class="breadcrumb-item active">Tournament Draw System</div>
    </div>
  </div>

  @php
      $count=count($tournament_draws);

  @endphp

  <div class="row">

    @foreach($tournament_draws as $key=>$value)
    @php

     $instance=new App\Http\Controllers\TournamentDrawController();
     $matches=$instance->drawJsonDecode($value->match_ids);
     $users=$instance->drawJsonDecode($value->user_ids);

    @endphp

    @php
        $draw_count=count($matches);
        $temp_count=$draw_count;




    @endphp


    <!-- Stage -->
    <div class="container col-sm-1">
        <!-- Match -->
        @if(count($users)>0)
      @for($d=0;$draw_count>0;$d++)

        @php
            $user_key=$users[$d];

            $user_count=count($user_key);

        @endphp


      @for($u=0;$user_count>0;$u++)
      <div class="@if($u%2==0) even @else odd @endif" >{{$instance->userName($user_key[$u])}}</div>
      @php
      $user_count--;

  @endphp

  @endfor


      @php
          $draw_count--;

      @endphp

      @endfor
      @elseif($key==($count-1))
      <div class="won" >Match Winner</div>
      @else
      @php
        if($temp_count!=1){
            $temp_count=$temp_count+2;
        }
        else if($temp_count==1){
            $temp_count=2;
        }

        //$temp_count=($temp_count!=1)?$temp_count+2:$temp_count+1;


          $exit_count=$temp_count;

      @endphp
      @for($e=0;$exit_count>0;$e++)
      <div class="@if($e%2==0) even @else odd @endif" >Match Winner</div>
      @php
          $exit_count--;
      @endphp
      @endfor

      @endif

    </div>




    @endforeach


  </div>





    @endsection



