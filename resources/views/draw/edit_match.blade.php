@extends('layouts.master_layout')
@section('content')
@include('elements.settings_section')
@php
    $instance=new App\Http\Controllers\TournamentDrawController();
@endphp

 <!-- Main Content -->

        <div class="section-header">

            <h1>Matches</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></div>
            <div class="breadcrumb-item active">Edit </div>
            </div>
        </div>Match

      <div class="section-body">
        <h2 class="section-title">Edit Match</h2>


        <div id="output-status"></div>
        <div class="row">

          <div class="col-md-12">

            <form id="role-form" method="POST" action="{{route('tournament.matches.update',$tournament_draws->id)}}" enctype="multipart/form-data">
              @csrf
                <div class="card" id="roles-card">
                <div class="card-header">
                  <h4>Edit Match</h4>
                </div>
                <div class="card-body">
                  <div class="form-group row align-items-center">
                    <label for="role-title" class="form-control-label col-sm-3 text-md-right">Match Number<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <input type="text" name="match_id" class="form-control" id="match_id" autocomplete="off" value="{{$match_id}}" readonly>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="member_1" class="form-control-label col-sm-3 text-md-right">Member 1<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <select class="form-control" name="member_1" id="member_1"  required>
                        <option value="{{$user_list[0]}}">{{$instance->userName($user_list[0])}}</option>
                          @foreach ($tournaments_participants as $row)
                           @if($user_list[0]!=$row->id)
                          <option value="{{$row->id}}">{{$row->first_name}}</option>
                          @endif

                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="member_2" class="form-control-label col-sm-3 text-md-right">Member 2<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                    <select class="form-control" name="member_2" id="member_2" required>
                        <option value="{{$user_list[1]}}">{{$instance->userName($user_list[1])}}</option>
                        @foreach ($tournaments_participants as $row)
                        @if($user_list[1]!=$row->id)
                          <option value="{{$row->id}}">{{$row->first_name}}</option>
                          @endif

                          @endforeach
                    </select>
                    </div>
                  </div>



                </div>
                <div class="card-footer bg-whitesmoke text-md-right">
                  <button class="btn btn-primary" type="submit">Update</button>

                </div>
              </div>
            </form>

          </div>
        </div>
          </div>


@endsection

