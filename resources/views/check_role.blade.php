@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="form-group">
            <label for="role_name">Register As</label><span class="text-danger"> *</span>
            <select class="form-control" id="role_name" name="role_name" required>
                @foreach($roles as $role)
                @if($role->slug!='admin')
                @if($role->slug!='user')
                @if($role->slug!='unverified')
                <option value="{{$role->slug}}">{{$role->name}}</option>
                @endif
                @endif
                @endif
                @endforeach
            </select>
            <button type="button" class="btn btn-primary mt-3" id="register">Register</button>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#register').click(function(){
        var role_name = $('#role_name').val();
        location.replace(role_name+'/register');
    });
</script>
@endpush
