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

      <div class="@if($d%2==0) even  @else odd @endif " style="{{$value[$d]==''?'padding: 13px;!important':''}}">{{$value[$d]}}</div>

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

    @endforeach


  </div>
  @if(count($tournament_draws)==0)
  {{-- <div class="buttons">
    <a href="javascript:void(0);" class="btn btn-primary" id="draw" type="submit">Draw</a>
  </div> --}}
  <button type="submit" class="btn btn-primary">Draw</button>
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
    @push('scripts')
        <script>
    //         $("#draw").on("click",function(){
	// 	    var event_id = "{{$data['event_id']}}";
    //         var stage_ids=[]; match_ids=[]; user_ids=[];
    //         $('input[name^="stage"]').each(function() {
    //             stage_ids.push($(this).val());

    //         });
    //         $('input[name^="match"]').each(function() {
    //             match_ids.push($(this).val());

    //         });
    //         $('input[name^="user"]').each(function() {
    //             user_ids.push($(this).val());

    //         });





	// 	$.ajaxSetup({
	// 		headers: {
	// 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// 		}
	// 	});
	// 	$.ajax({
	// 		type: "POST",
	// 		url: "{{route('tournament.draws.store')}}",
	// 		data:{event_id:event_id,stage_ids:stage_ids,match_ids:match_ids,user_ids:user_ids} ,
	// 		success: function(data){

    //             //window.location.href="{{url('/draw')}}";

	// 		}
	// 	});
	// });
        </script>
    @endpush


