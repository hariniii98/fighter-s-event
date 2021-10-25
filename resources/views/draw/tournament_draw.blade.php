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
      $count=count($draw_counts);

  @endphp
  <div class="row">
    @foreach($draw_counts as $key=>$value)
    @if($key>0)
    @php
        $draw_count=(int)$key;
    @endphp
    <!--Round 1-->
    <div class="container col-sm-1">
      @for($d=0;$draw_count>0;$d++)

      <div class="@if($d%2==0) even @else odd @endif">{{$value[$d]}}</div>
      @php
          $draw_count--;
      @endphp

      @endfor

    </div>
    @endif

    @endforeach


  </div>



    @endsection


