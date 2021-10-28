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
        {{App\Models\User::find($direct_pass_member)->first_name}}
        @else
        {{$value[$d]}}
        @endif
        @else
        {{$value[$d]}}
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



