@extends('layouts.app')
@push('css-styles')
<style>
    .invalid-feedback{
        display: block !important;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <div class="card my-2">
                <div class="card-header d-flex justify-content-center">{{ __('Register') }}</div>

                <div class="card-body">
                    <div class="login-brand">
                        <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                    </div>
                    <p align="center">Already have an account? <a href="{{route('login')}}">Login</a></p>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="frist_name">First Name</label><span class="text-danger"> *</span>
                            <input id="frist_name" type="text" class="form-control" @error('first_name') is-invalid @enderror value="{{ old('first_name') }}" name="first_name" autocomplete="off" autofocus>
                            @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            @if(isset($role))
                            <input id="role" type="text" class="form-control" name="role" value="{{$role}}" style="display:none;">
                            @endif
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" type="text" class="form-control" autocomplete="off" name="last_name" >
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="form-control-label col-sm-2">Photo<span class="text-danger"> *</span></label>
                            <div class="col-sm-6 col-md-6">
                                <div class="custom-file">
                                <input type="file" name="user_image" class="custom-file-input" id="user_image" @error('first_name') is-invalid @enderror value="{{ old('user_image') }}" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label">Choose File</label>
                                @error('user_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                            </div>
                            <img src="{{asset('vf')}}"  id="blah" class="col-sm-3" width="1000" height="150">
                        </div>
                        @if(isset($role)&&$role=="fighter")
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label for="occupation">Occupation</label><span class="text-danger"> *</span>
                                <input id="occupation" type="text" class="form-control" @error('occupation') is-invalid @enderror value="{{ old('occupation') }}" name="occupation" autocomplete="off">
                                @error('occupation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label for="date_of_birth">Date of Birth</label><span class="text-danger"> *</span>
                                <input id="date_of_birth" type="date" class="form-control" autocomplete="off" @error('date_of_birth') is-invalid @enderror value="{{ old('date_of_birth') }}" name="date_of_birth" >
                                @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label for="blood_group">Blood Group</label><span class="text-danger"> *</span>
                                <select id="blood_group" class="form-control" @error('blood_group') is-invalid @enderror value="{{ old('blood_group') }}" name="blood_group">
                                    <option value="">--select--</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                                @error('blood_group')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label for="height">Height(in cms)</label><span class="text-danger"> *</span>
                                <input id="height" type="number" class="form-control" @error('height') is-invalid @enderror value="{{ old('height') }}" name="height" autocomplete="off">
                                @error('height')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label for="weight">Weight(in kgs)</label><span class="text-danger"> *</span>
                                <input id="weight" type="number" class="form-control" @error('weight') step="0.01" is-invalid @enderror value="{{ old('weight') }}" name="weight" autocomplete="off">
                                @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="facebook_id">Facebook Id</label>
                                <input id="facebook_id" type="text" class="form-control" value="{{ old('facebook_id') }}" name="facebook_id" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="instagram_id">Instagram Id</label>
                                <input id="instagram_id" type="text" class="form-control" value="{{ old('instagram_id') }}" name="instagram_id" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="mobile_number">Mobile Number</label><span class="text-danger"> *</span>
                                <input id="mobile_number" type="number" class="form-control" @error('mobile_number') is-invalid @enderror value="{{ old('mobile_number') }}" name="mobile_number" autocomplete="off">
                                @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="mobile_number2">Mobile Number 2(Emergency)</label><span class="text-danger"> *</span>
                                <input id="mobile_number2" type="number" class="form-control" @error('mobile_number2') is-invalid @enderror value="{{ old('mobile_number2') }}" name="mobile_number2" autocomplete="off">
                                @error('mobile_number2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="club_name">Club Name</label><span class="text-danger"> *</span>
                            <input id="club_name" type="text" class="form-control" @error('club_name') step="0.01" is-invalid @enderror value="{{ old('club_name') }}" name="club_name" autocomplete="off">
                            @error('club_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Complete Address</label><span class="text-danger"> *</span>
                            <input id="address" type="text" class="form-control" @error('address') step="0.01" is-invalid @enderror value="{{ old('address') }}" name="address" autocomplete="off">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @else
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number</label><span class="text-danger"> *</span>
                            <input id="mobile_number" type="number" class="form-control" @error('mobile_number') is-invalid @enderror value="{{ old('mobile_number') }}" name="mobile_number" autocomplete="off">
                            @error('mobile_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @endif
                        <div class="form-group">
                            <label for="email">Email</label><span class="text-danger"> *</span>
                            <input id="email" type="email" class="form-control" autocomplete="off" @error('email') is-invalid @enderror value="{{ old('email') }}" name="email" >
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                            <label for="password">Password</label><span class="text-danger"> *</span>
                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" @error('password') is-invalid @enderror name="password" >
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                            </div>
                            <div class="form-group col-12">
                            <label for="password2">Confirm Password</label><span class="text-danger"> *</span>
                            <input id="password2" type="password" class="form-control" name="password_confirmation" @error('password_confirmation') is-invalid @enderror>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
