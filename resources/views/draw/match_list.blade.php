@extends('layouts.master_layout')
@section('content')
@include('elements.settings_section')
@push('css-styles')
    <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/fontawesome/css/all.min.css')}}">
@endpush


 <!-- Main Content -->

      <div class="section-header">

        <h1>Matches</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></div>
          <div class="breadcrumb-item active">Matches</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Matches</h2>




        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Matches</h4>
                <span><a href="{{route('tournament.matches.create')}}" class="btn btn-icon icon-left btn-info"><i class="fas fa-plus"></i> Add</a></span>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-2">
                    <thead>
                      <tr>
                        <th class="text-center">
                          <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                          </div>
                        </th>
                        <th>Event Name</th>
                        <th>Stage No</th>
                        <th>Match No</th>
                        <th>Participants</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                        @php
                            $count=count($match_ids);

                        @endphp
                        @foreach($match_ids as $key=>$value)

                      <tr>
                        <td>
                          <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                          </div>
                        </td>
                        <td>{{$event_name[$key]}}</td>
                        <td>{{'Stage '.$stage_ids[$key]}}</td>


                        <td>{{'Match '.$value}} </td>
                        @php

                            $users=isset($user_ids[$value])?$user_ids[$value]:[];

                            $user_count=count($users);
                            $user_value='';
                        @endphp
                        @if($user_count>0)
                        <td class="btn btn-danger">
                        @for($u=0;$user_count>0;$u++)
                        @php
                            $user_value=isset(App\Models\User::find($users[$u])->first_name)?App\Models\User::find($users[$u])->first_name:''
                        @endphp
                        <span>{{$user_value}}</span>
                        @if ($u==0)
                        <span class="badge badge-transparent">Vs</span>
                        @endif

                        @php

                            $user_count--;
                        @endphp
                        @endfor



                       </td>
                       @else
                       <td>
                           --
                       </td>
                       @endif


                       <td>
                        @if (count($match_ids)>0)
                        <a href="{{route('tournament.matches.edit',[$tournament_draw_ids[$key],$value])}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Edit</a>
                        @endif
                       @if ($user_value!='')
                       <a href="{{route('tournament.matches.edit',[$tournament_draw_ids[$key],$value])}}" class="btn btn-icon icon-left btn-dark"><i class="fa fa-tasks"></i> Assign to Ring</a>
                       @endif
                       </td>





                      </tr>

                      @endforeach


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



@endsection
@push('scripts')
    <!-- JS Libraies -->
  <script src="{{asset('assets/modules/datatables/datatables.min.js')}}"></script>
  <script src="{{asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
  <script src="{{asset('assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
@endpush

