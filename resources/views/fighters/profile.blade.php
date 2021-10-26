@extends('layouts.master_layout')
@push('css-styles')
<style>
    .wh40{
        width:50px !important;
        height:50px !important;
    }

</style>
@endpush
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

        <h1>Fighter Profile</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active">Fighter Profile</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Fighter Profile</h2>



        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Fighter Profile</h4>
                </div>
              <div class="card-body">
                  <p><strong>Full Name : </strong>{{$fighter->first_name}}&nbsp;{{$fighter->last_name}}</p>
                  <p><strong>Email : </strong>{{$fighter->email}}</p>
                  <p><strong>Mobile Number : </strong>{{$fighter->mobile_number}}</p>
                  <p><strong>Photo : </strong><img src="{{asset('assets/images/user_images/'.$fighter->user_image)}}" class="wh-40">
                  <p><strong>Date of Birth : </strong>{{$fighter_profile->date_of_birth}}</p>
                  <p><strong>Emergency Number : </strong>{{$fighter_profile->emergency_number}}</p>
                  <p><strong>Height : </strong>{{$fighter_profile->height}}&nbsp;cms</p>
                  <p><strong>Weight : </strong>{{$fighter_profile->weight}}&nbsp;kgs</p>
                  <p><strong>Club Name : </strong>{{$fighter_profile->club_name}}</p>
                  <p><strong>Coach Name : </strong>{{$fighter_profile->coach_name}}</p>
                  <p><strong>Address : </strong>{{$fighter_profile->address}}</p>
                  <p><strong>City : </strong>{{$fighter_profile->city}}</p>
                  <p><strong>State : </strong>{{$fighter_profile->state}}</p>
                  <p><strong>Facebook ID : </strong>{{$fighter_profile->facebook_id}}</p>
                  <p><strong>Instagram ID : </strong>{{$fighter_profile->instagram_id}}</p>
                  <p><strong>Blood Group : </strong>{{$fighter_profile->blood_group}}</p>
                  <p><strong>Ranking : </strong>{{$rank_name}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      @endsection
