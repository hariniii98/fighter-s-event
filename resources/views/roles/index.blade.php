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

        <h1>Roles</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></div>
          <div class="breadcrumb-item active">Roles</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Roles</h2>



        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Roles</h4>
                @role('admin')
                <span><a href="{{route('roles.create')}}" class="btn btn-icon icon-left btn-info"><i class="fas fa-plus"></i> Add</a></span>
                @endrole
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
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Level</th>
                        @role('admin')
                        <th>Action</th>
                        @endrole
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $row)
                      <tr>
                        <td>
                          <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                          </div>
                        </td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->slug}}</td>
                        <td>{{$row->description}}</td>
                        <td><div class="badge badge-success">{{$row->level}}</div></td>
                        @role('admin')
                        <td><a href="{{route('roles.edit',$row->id)}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Edit</a></td>
                        @endrole
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

