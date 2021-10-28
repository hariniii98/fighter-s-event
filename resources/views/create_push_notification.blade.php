@extends('layouts.master_layout')

@push('css-styles')
<style>
    .red{
        color:red;
        font-size: 14px;
    }
</style>
@endpush
@section('content')

@include('elements.settings_section')


 <!-- Main Content -->

      <div class="section-header">

        <h1>Send Push Notification</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/')}}">Events</a></div>
          <div class="breadcrumb-item">Send Push Notification</div>
        </div>
      </div>

      <div class="section-body">


            <div id="output-status"></div>
            <div class="row">

                <div class="col-md-12">
                    <form id="setting-form" method="POST" action="{{route('whatsapp_push_notification.send')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card" id="settings-card">
                        <div class="card-header">
                        <h4>Send Push Notification</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row align-items-center">
                                <label for="event_id" class="form-control-label col-sm-3 text-md-right">Event Name<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <select name="event_id" class="form-control" id="event_id" required>
                                    <option value="">--select--</option>
                                    @foreach($events as $event)
                                    <option value="{{$event->id}}">{{$event->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <span class="red" id="event_error"></span>
                            <div class="form-group row align-items-center">
                                <label for="role_slug" class="form-control-label col-sm-3 text-md-right">Role<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <select name="role_slug" class="form-control" id="role_slug" required>
                                    <option value="">--select--</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->slug}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <span class="red" id="role_error"></span>
                            <div class="form-group row align-items-center">
                                <label for="role_name" class="form-control-label col-sm-3 text-md-right">Content<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                    <textarea class="form-control" name="content" id="content" required></textarea>
                                </div>
                            </div>
                            <span class="red" id="content_error"></span>
                            <div class="card-footer bg-whitesmoke text-md-right">
                                <button class="btn btn-primary" id="send" type="button">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

      </div>

@endsection
@push('scripts')
<script>
    $('#send').click(function(){
        var event_id = $('#event_id').val();
        var role_slug = $('#role_slug').val();
        var content = $('#content').val();
        $i=false;
        $j=false;
        $k=false;
        if(event_id==""){
            $('#event_error').text('Please select Event');
        }else{
            $i=true;
            $('#event_error').text('');
        }
        if(role_slug==""){
            $('#role_error').text('Please select Role');
        }else{
            $j=true;
            $('#role_error').text('');
        }
        if(content==""){
            $('#content_error').text('Please enter Content');
        }else{
            $k=true;
            $('#content_error').text('');
        }
        if($i&&$j&&$k){
            $('#setting-form').submit();
        }

    });
</script>
@endpush


