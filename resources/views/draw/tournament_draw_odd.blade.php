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
<style>
    ul {
  list-style-type: none;
}

li {
  display: inline-block;
}

input[type="radio"][id^="cb"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

label:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  box-shadow: 0 0 5px #333;
  z-index: -1;
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



  @endphp
  @if($count>0)

  <h1 class="title">Make one member to direct pass</h1><br>

<form action="{{route('tournament.matches.direct_pass')}}" method="POST">
    @csrf
  <div class="row">


      @foreach($draw_counts as $key=>$value)
      <div class="col-sm-3">

      <ul>
        <li>
            <input type="radio" name="direct_pass_member" id="cb{{$key}}" value="{{$draw_ids[$key]}}" required />

            <label for="cb{{$key}}"><img class="rounded-circle" width="100" height="70" alt="100x100" src="{{asset('assets/images/user_images/'.$instance->userImage($draw_ids[$key]))}}"
                data-holder-rendered="true"><span>&nbsp;&nbsp;</span>{{$value[0]}}</label>
        </li>

      </ul>

    </div>



      @endforeach








  </div>


  <button type="submit" class="btn btn-primary" id="direct_pass">Submit</button>


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

     <!-- JS Libraies -->
  <script src="{{asset('assets/modules/sweetalert/sweetalert.min.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('assets/js/page/modules-sweetalert.js')}}"></script>

  <script>
$("#direct_pass").click(function() {

    if ($("input[name='direct_pass_member']").is(":checked")) {
     return true;
    }
    else{
        swal('Error', 'Please Select the member to direct pass', 'error');
    }

});
  </script>

    @endpush



