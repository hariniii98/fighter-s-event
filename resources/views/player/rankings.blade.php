@extends('layouts.master_layout')
@section('content')
@include('elements.settings_section')



 <!-- Main Content -->
 @php
 $instance=new App\Http\Controllers\TournamentDrawController();




 @endphp
      <div class="section-header">

        <h1>Rankings</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></div>
          <div class="breadcrumb-item active">Rankings</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Rankings</h2>




        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Rankings</h4>

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
                          <th>Holder</th>
                          <th>Rank</th>

                        </tr>
                      </thead>
                      <tbody>
                          @php
                              $rank=1;
                          @endphp
                          @foreach($rank_user as $key=>$value)

                        <tr>
                          <td>
                            <div class="custom-checkbox custom-control">
                              <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                              <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                            </div>
                          </td>
                          <td><img class="rounded-circle" width="50" height="50" alt="100x100" src="{{asset('assets/images/user_images/'.$instance->userImage($value))}}"
                            data-holder-rendered="true"><span>&nbsp;&nbsp;</span>{{$instance->userName($value)}}</td>


                          <td><div class="badge badge-danger"><i class="fas fa-trophy"></i><span> {{$rank++}}</span></div></td>


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


