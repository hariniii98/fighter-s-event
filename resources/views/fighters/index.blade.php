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

        <h1>Fighters</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item"><a href="{{url('/events/index')}}">Events</a></div>
          <div class="breadcrumb-item active">Fighters</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Fighters</h2>



        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Fighters</h4>
                </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table2excel" id="table-2">
                    <thead>
                      <tr>
                        <th class="text-center">
                          <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                          </div>
                        </th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>View Profile</th>
                        @role('admin')
                        <th class="noExl">Action</th>
                        @endrole
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($fighters as $row)
                      <tr>
                        <td>
                          <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                          </div>
                        </td>
                        <td>{{$row->first_name}}</td>
                        <td>{{$row->last_name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->mobile_number}}</td>
                        <td><a href="{{route('event.fighters.profile',$row->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a></td>
                        @role('admin')
                        <td class="noExl"><a href="{{route('users.edit',$row->id)}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Edit</a></td>
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

  <!-- Export to Excel/Csv -->
  <script src="{{asset('assets/js/jquery.table2excel.js')}}"></script>
  <script>
    $(function() {
        $(".exportToExcel").click(function(e){

            var table = $('.table2excel');

            if(table && table.length){
                var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
                $(table).table2excel({
                    exclude: ".noExl",
                    name: "Excel Document Name",
                    filename: "UserList" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                    fileext: ".xls",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true,
                    preserveColors: preserveColors
                });
            }
        });

    });
</script>
@endpush

