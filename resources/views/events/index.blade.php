@extends('layouts.master_layout')



@section('content')
@include('elements.settings_section')

 <!-- Main Content -->

      <div class="section-header">

        <h1>Events</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/events')}}">Events</a></div>
          <div class="breadcrumb-item">Events</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Events</h2>


        <div id="output-status"></div>
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>Events <a href="{{route('events.create')}}" class="btn btn-primary">Add Event</a></h4>
                <div class="card-header-form">
                    <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
                <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                    <tr>
                        <th>
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                        </div>
                        </th>
                        <th>S No</th>
                        <th>Name</th>
                        <th>Category Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Registration Deadline</th>
                        <th>View Fighters</th>
                        <th>Action</th>
                    </tr>
                    @php $s_no=1; @endphp
                    @foreach($events as $row)
                    <tr>
                        <td class="p-0 text-center">
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                        </div>
                        </td>
                        <td>{{$s_no++}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->event_category_name}}</td>
                        <td>{{$row->start_date}}</td>
                        <td>{{$row->end_date}}</td>
                        <td>{{$row->registration_deadline}}</td>
                        <td><a href="{{route('event.fighters',$row->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a></td>
                        <td>
                            <div class="d-flex">
                                <a href="{{url('events/'.$row->id.'/edit')}}" class="btn btn-secondary"><i class="fa fa-pencil btn-success"></i></a>
                                <a href="{{url('events/delete'.'/'.$row->id)}}" class="btn btn-secondary" onclick="return confirm('Are you sure,you want to delete?')"><i class="fa fa-trash btn-danger"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
