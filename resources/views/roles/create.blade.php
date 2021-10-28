@extends('layouts.master_layout')
@section('content')
@include('elements.settings_section')

 <!-- Main Content -->

        <div class="section-header">

            <h1>Roles</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></div>
            <div class="breadcrumb-item active">Add Role</div>
            </div>
        </div>

      <div class="section-body">
        <h2 class="section-title">Add Role</h2>


        <div id="output-status"></div>
        <div class="row">

          <div class="col-md-12">
            <form id="role-form" method="POST" action="{{route('roles.store')}}" enctype="multipart/form-data">
              @csrf
                <div class="card" id="roles-card">
                <div class="card-header">
                  <h4>Add Role</h4>
                </div>
                <div class="card-body">
                  <div class="form-group row align-items-center">
                    <label for="role-title" class="form-control-label col-sm-3 text-md-right">Role Name<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <input type="text" name="role_name" class="form-control" id="role-name" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="role-description" class="form-control-label col-sm-3 text-md-right">Role Description<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                      <textarea class="form-control" name="role_description" id="role-description"  required></textarea>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="role-level" class="form-control-label col-sm-3 text-md-right">Role Level<span class="text-danger"> *</span></label>
                    <div class="col-sm-6 col-md-9">
                        <input type="number" name="role_level" class="form-control" id="role-level" autocomplete="off" required>

                    </div>
                  </div>



                </div>
                <div class="card-footer bg-whitesmoke text-md-right">
                  <button class="btn btn-primary" type="submit">Save Changes</button>
                  <button class="btn btn-secondary" type="button" id="role-formReset">Reset</button>
                </div>
              </div>
            </form>
          </div>
        </div>
          </div>


@endsection
@push('scripts')
<script>
    $(document).on('click','#role-formReset',function(){
        $("#role-form")[0].reset();
    });
</script>
@endpush
