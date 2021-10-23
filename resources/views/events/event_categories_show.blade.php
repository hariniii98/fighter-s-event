@extends('layouts.master_layout')
@section('description', isset($settings->site_description)?$settings->site_description:'')
@section('title', isset($settings->site_title)?$settings->site_title:config('app.name'))
@section('favicon', isset($settings->site_favicon)?asset('assets/images/site_favicons/'.$settings->site_favicon):'')


@section('content')

@php
    $site_logo=isset($settings->site_logo)?'assets/images/site_logos/'.$settings->site_logo:'assets/default_placeholder.png';
    $site_favicon=isset($settings->site_favicon)?'assets/images/site_favicons/'.$settings->site_favicon:'assets/default_placeholder.png';
@endphp

 <!-- Main Content -->

      <div class="section-header">

        <h1>Event Categories</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/')}}">Events</a></div>
          <div class="breadcrumb-item">Event Categories</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Event Categories</h2>


        <div id="output-status"></div>
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>Event Categories</h4>
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
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    @foreach($event_categories as $row)
                    <tr>
                        <td class="p-0 text-center">
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                        </div>
                        </td>
                        <td>{{$event->name}}</td>
                        <td><a href="{{url('/delete_event_category'.'/'.$row->id)}}" class="btn btn-secondary">Detail</a></td>
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
