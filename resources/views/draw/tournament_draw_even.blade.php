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

      $count=count($draw_counts);
      $m=1;
      $s=1;
      $r=1;


  @endphp
@if($count>0)
<form action="{{route('tournament.draws.store')}}" method="POST">
    @csrf
  <div class="row">
    <input type="hidden" name="event_id" value="{{$data['event_id']}}">
    @foreach($draw_counts as $key=>$value)
    @if($s==1)
    @if($key>0)
    @php
        $draw_count=(int)$key;

    @endphp
    <input type="hidden" name="stage[]" value="{{$s}}">
    <!-- Stage -->
    <div class="container col-sm-1">
        <!-- Match -->
      @for($d=0;$draw_count>0;$d++)



      @if($s==1)
      <input type="hidden" name="user[{{$s}}][{{$r}}][]" value="{{$draw_ids[$d]}}">
      @php
          $r=$m;
      @endphp
      @endif

      <div class="@if($d%2==0) even  @else odd @endif " @if(isset($direct_pass_member)) @if($d==0 && $s==2) style='' @else  style="{{$value[$d]==''?'padding: 13px;!important':''}}"@endif @else style="{{$value[$d]==''?'padding: 13px;!important':''}}"@endif>
        @if(isset($direct_pass_member))
        <input type="hidden" name="direct_pass_member[{{$s}}][{{$r}}][]" value="{{$direct_pass_member}}">
        @if($d==0 && $s==2)
        <input type="hidden" name="direct_pass_member[{{$s}}][{{$r}}][]" value="{{$direct_pass_member}}">
        <img class="rounded-circle" width="100" height="70" alt="100x100" src="{{asset('assets/images/user_images/'.$instance->userImage($direct_pass_member))}}"
        data-holder-rendered="true"><span>&nbsp;&nbsp;</span>{{App\Models\User::find($direct_pass_member)->first_name}}
        @else
        <img class="rounded-circle" width="100" height="70" alt="100x100" src="{{asset('assets/images/user_images/'.$instance->userImage($draw_ids[$d]))}}"
        data-holder-rendered="true"><span>&nbsp;&nbsp;</span>{{$value[$d]}}
        @endif
        @else
        <img class="rounded-circle" width="100" height="70" alt="100x100" src="{{asset('assets/images/user_images/'.$instance->userImage($draw_ids[$d]))}}"
        data-holder-rendered="true"><span>&nbsp;&nbsp;</span>{{$value[$d]}}
        @endif

    </div>

      @if ($d%2==0)

          <input type="hidden" name="match[{{$s}}][]" value="{{$m++}}">


      @endif


      @php
          $draw_count--;

      @endphp

      @endfor

    </div>
    @php
        $s++;
    @endphp
    @endif
    @endif
    @endforeach


  </div>
  @if(count($tournament_draws)==0)

  <button type="submit" class="btn btn-primary">Draw</button>
  @if (isset($direct_pass_member))
  <a href="{{route('tournament.draws')}}" class="btn btn-warning">Undo</a>
  @endif
  @endif

  </form>
  @else
  <div class="row">
    <div class="container col-sm-1">
  <div>No Members to Draw</div>
    </div>
  </div>
  @endif





    @endsection



