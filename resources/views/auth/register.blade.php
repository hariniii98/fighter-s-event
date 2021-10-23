@extends('layouts.app')

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
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="form-group col-12">
                            <label for="frist_name">First Name</label><span class="text-danger"> *</span>
                            <input id="frist_name" type="text" class="form-control" name="first_name" autocomplete="off" autofocus>
                            @if(isset($role))
                            <input id="role" type="text" class="form-control" name="role" value="{{$role}}" style="display:none;">
                            @endrole
                            </div>
                            <div class="form-group col-12">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" type="text" class="form-control" autocomplete="off" name="last_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label><span class="text-danger"> *</span>
                            <input id="email" type="email" class="form-control" autocomplete="off" name="email">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                            <label for="password">Password</label><span class="text-danger"> *</span>
                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                            </div>
                            <div class="form-group col-12">
                            <label for="password2">Password Confirmation</label><span class="text-danger"> *</span>
                            <input id="password2" type="password" class="form-control" name="password_confirmation">
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
