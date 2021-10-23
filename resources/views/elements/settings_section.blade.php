@php
$settings=App\Models\Settings::find(1);
@endphp
@section('description', isset($settings->site_description)?$settings->site_description:'')
@section('title', isset($settings->site_title)?$settings->site_title:config('app.name'))
@section('favicon', isset($settings->site_favicon)?asset('assets/images/site_favicons/'.$settings->site_favicon):'')
@section('logo', isset($settings->site_logo)?asset('assets/images/site_logos/'.$settings->site_logo):'')
