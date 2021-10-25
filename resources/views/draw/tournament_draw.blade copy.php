@extends('layouts.master_layout')
@section('content')
@include('elements.settings_section')
@push('css-styles')
   @include('draw._css')
   <style>
       .single-line{
        position: relative;
    top: 57px;
    width: 36px;
    border: 1px solid #AAA;
       }
       .final-line{
        margin-top: 45%!important;
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


  <!-- Draw System -->
  @php
      //$count=count($draw_names);
      $draw_count=count($draw_counts);
      //dd($draw_counts);
      $row=1;


  @endphp
  @foreach($draw_counts as $key=>$value)
  <div class="round  {{$row%2==0?'r-of-2':'r-of-4'}}">
    @php

            $draw_name_count=(int)$key;
            //echo $row;

            $draw_count--;

        @endphp

@foreach($draw_names as $names)
<div class="bracket-game  {{$draw_count<=0?'final-line':''}} {{$row%2==0?'cont':''}}">



      @for($d=0;$draw_name_count>0;$d++)

      <div class="player {{$d%2==0?'top win':'bot loss'}}">
       {{$value[$d]}}

      </div>

      @php

      $draw_name_count--;

      @endphp

      @endfor



    </div>

    @php

    $row++;
@endphp
@endforeach



  </div>

  @if($draw_count>0 & $draw_count!=1)
  <!-- Bracket starts-->
  <div class="connectors r-of-2">
    <div class="top-line"></div>
    <div class="clear"></div>
    <div class="bottom-line"></div>
    <div class="clear"></div>
    <div class="vert-line"></div>
    <div class="clear"></div>
    <div class="next-line"></div>
    <div class="clear"></div>
  </div>
  @elseif($draw_count==1)
  <div class="connectors r-of-2">
    <div class="top-line" style="display: none;"></div>
    <div class="clear"></div>
    <div class="bottom-line" style="display: none;"></div>
    <div class="clear"></div>
    <div class="vert-line" style="display: none;"></div>
    <div class="clear"></div>
    <div class="single-line"></div>
    <div class="clear"></div>
  </div>
  @endif

  @endforeach
  <!-- Bracket starts-->
  {{-- <div class="connectors r-of-2">
    <div class="top-line"></div>
    <div class="clear"></div>
    <div class="bottom-line"></div>
    <div class="clear"></div>
    <div class="vert-line"></div>
    <div class="clear"></div>
    <div class="next-line"></div>
    <div class="clear"></div>
  </div> --}}
  <!-- Bracket ends-->
  {{-- <div class="round r-of-2">
    <div class="bracket-game">
      <div class="player top loss">
        Snute
        <div class="score">
          2
        </div>
      </div>
      <div class="player bot win">
        MC
        <div class="score">
          3
        </div>
      </div>
    </div>
  </div> --}}



    @endsection


