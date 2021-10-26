@extends('layouts.master_layout')
@section('content')
@include('elements.settings_section')
@push('css-styles')
    <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/fontawesome/css/all.min.css')}}">
  <style>
      .fancy {
	ol {
		margin: 0;
		padding: 0;
		list-style: none;
		counter-reset: fancy;
	}
	li {
		margin-bottom: 1rem;
		counter-increment: fancy;
		&:before {
			content: counter(fancy);
			margin-right: 0.8rem;
			background: #fc0;
			border-radius: 50%;
			color: #fff;
			display: inline-block;
			text-align: center;
			padding: 0.8rem 1.1rem;
		}
	}
}
</style>
@endpush


 <!-- Main Content -->

      <div class="section-header">

        <h1>Fighter Instructions</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active">Fighter Instructions</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Fighter Instructions</h2>



        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Fighter Instructions</h4>
                </div>
              <div class="card-body">
                <div class="fancy">
                    <ol>
                        <li>Fighter must reach the venue atleast one hour before the fight.</li>
                        <li>Every fighter must carry their valid ID card proof during the event.</li>
                        <li>Entry Fees to be paid during the registration and is not refundable under any circumstances.</li>
                        <li>Nails & hair should be cut properly and fighters should carry their personal kit like shorts, groin guard and gumshield.</li>
                        <li>Fighters are not allowed to wear any kind of accessories or any gold ornaments during the fight.</li>
                        <li>All the fighters should compulsorily carry fitness certificate from the doctor.</li>
                    </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection
