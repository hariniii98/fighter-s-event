@extends('layouts.master_layout')
@section('content')
@include('elements.settings_section')

 <!-- Main Content -->

        <div class="section-header">

            <h1>Users</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('users')}}">Users</a></div>
            <div class="breadcrumb-item active">Edit User</div>
            </div>
        </div>

      <div class="section-body">
        <h2 class="section-title">Edit User</h2>


        <div id="output-status"></div>
        <div class="row">

          <div class="col-md-12">
            @foreach($users as $row)
            <form id="role-form" method="POST" action="{{route('users.update',$row->id)}}" enctype="multipart/form-data">
              @csrf
                <div class="card" id="roles-card">
                <div class="card-header">
                  <h4>Edit User</h4>
                </div>
                <div class="card-body">

                  <div class="form-group row align-items-center">
                    <label for="first-name" class="form-control-label col-sm-3 text-md-right">First Name<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <input type="text" name="first_name" class="form-control" id="first-name" autocomplete="off" value="{{$row->first_name}}" required>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="last-name" class="form-control-label col-sm-3 text-md-right">Last Name</label>
                    <div class="col-sm-6 col-md-9">
                      <input type="text" name="last_name" class="form-control" id="last-name" autocomplete="off" value="{{$row->last_name}}">
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="email" class="form-control-label col-sm-3 text-md-right">Email<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <input type="text" name="email" class="form-control" id="email" autocomplete="off" value="{{$row->email}}" required>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="mobile" class="form-control-label col-sm-3 text-md-right">Mobile Number<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <input type="text" name="mobile_number" class="form-control" id="mobile" autocomplete="off" value="{{$row->mobile_number}}" required>
                    </div>
                  </div>

                  <div class="form-group row align-items-center">
                    <label for="role_id" class="form-control-label col-sm-3 text-md-right">Role<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <select name="role_id" class="form-control" id="role_id" required>
                        <option value="{{$row->role_id}}">{{$row->role}}</option>
                          @foreach ($roles as $role)

                          @if ($role->id!=$row->role_id)
                          <option value="{{$role->id}}">{{$role->name}}</option>
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
            @endforeach

          </div>
        </div>
          </div>


@endsection

