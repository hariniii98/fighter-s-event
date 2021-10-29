@extends('layouts.master_layout')

@push('css-styles')
<style>
    .wh-40{
        width:40px !important;
        height:40px !important;
    }
</style>
@endpush

@section('content')
@include('elements.settings_section')

 <!-- Main Content -->

      <div class="section-header">

        <h1>Payments</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/events')}}">Events</a></div>
          <div class="breadcrumb-item">Payments</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Payments</h2>


        <div id="output-status"></div>
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>Payments</h4>
                </div>
                <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-2">
                        <thead>
                    <tr>
                        <th>
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                        </div>
                        </th>
                        <th>S No</th>
                        <th>Event Name</th>
                        <th>User Name</th>
                        <th>User Mobile Number</th>
                        <th>Payment Mode</th>
                        <th>Reference Number</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    @php $s_no=1; @endphp
                   <tbody>
                    @foreach($payments as $row)
                    <tr>
                        <td class="p-0 text-center">
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                        </div>
                        </td>
                        <td>{{$s_no++}}</td>
                        <td>{{$row->event_name}}</td>
                        <td>{{$row->user_name}}</td>
                        <td>{{$row->mobile_number}}</td>
                        <td>{{$row->payment_mode}}</td>
                        <td>{{$row->reference_number==null?'-':$row->reference_number}}</td>
                        <td>{{$row->status}}</td>
                        <td><a href="{{route('payments.edit',$row->id)}}" class="btn-success"><i class="fa fa-pencil "></i></a></td>
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
