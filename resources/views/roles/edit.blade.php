@extends('layouts.master_layout')
@section('content')
@include('elements.settings_section')

 <!-- Main Content -->

        <div class="section-header">

            <h1>Roles</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></div>
            <div class="breadcrumb-item active">Edit Role</div>
            </div>
        </div>

      <div class="section-body">
        <h2 class="section-title">Edit Role</h2>


        <div id="output-status"></div>
        <div class="row">

          <div class="col-md-12">

            <form id="role-form" method="POST" action="{{route('roles.update',$roles->id)}}" enctype="multipart/form-data">
              @csrf
                <div class="card" id="roles-card">
                <div class="card-header">
                  <h4>Edit Role</h4>
                </div>
                <div class="card-body">
                  <div class="form-group row align-items-center">
                    <label for="role-title" class="form-control-label col-sm-3 text-md-right">Role Name<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <input type="text" name="role_name" class="form-control" id="role-name" autocomplete="off" value="{{$roles->name}}" required>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="role-description" class="form-control-label col-sm-3 text-md-right">Role Description<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <textarea class="form-control" name="role_description" id="role-description" value="{{$roles->description}}" required>{{$roles->description}}</textarea>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="role-level" class="form-control-label col-sm-3 text-md-right">Role Level<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                        <input type="number" name="role_level" class="form-control" id="role-level" autocomplete="off" value="{{$roles->level}}" required>

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

