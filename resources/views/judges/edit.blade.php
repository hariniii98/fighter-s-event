@extends('layouts.master_layout')


@section('content')

@include('elements.settings_section')


 <!-- Main Content -->

      <div class="section-header">

        <h1>Judges</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/')}}">Events</a></div>
          <div class="breadcrumb-item">Judges</div>
        </div>
      </div>

      <div class="section-body">


            <div id="output-status"></div>
            <div class="row">

                <div class="col-md-12">
                    <form id="setting-form" method="POST" action="{{route('judge_event_ring.store',$judge_id)}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card" id="settings-card">
                        <div class="card-header">
                        <h4>Edit Judge {{$judge->first_name}}&nbsp;{{$judge->last_name}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row align-items-center">
                                <label for="event_id" class="form-control-label col-sm-3 text-md-right">Event Name<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <select name="event_id" class="form-control" id="event_id" required>
                                    <option value="{{isset($check_judge->event_id)?$check_judge->event_id:''}}" @if(isset($check_judge)&&$check_judge!=null) selected @endif>{{isset($event_name)?$event_name:'--select--'}}</option>
                                    @foreach($events as $event)
                                    @if(isset($check_judge)&&$check_judge!=null&&$check_judge->event_id!=$event->id)
                                    <option value="{{$event->id}}">{{$event->name}}</option>
                                    @else
                                    <option value="{{$event->id}}">{{$event->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="ring_id" class="form-control-label col-sm-3 text-md-right">Ring Number<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                <select name="ring_id" class="form-control" id="ring_id" required>
                                    <option value="{{isset($check_judge->ring_id)?$check_judge->ring_id:''}}" @if(isset($check_judge)&&$check_judge!=null) selected @endif>{{isset($check_judge->ring_id)?$check_judge->ring_id:'--select--'}}</option>

                                    @foreach($ring_list as $row)
                                    @php
                                    $count=isset($row->no_of_rings)?$row->no_of_rings:0;
                                    @endphp
                                    @if ($count>0)
                                    @for ($i=1;$count>0;$i++)
                                    @if(isset($check_judge->ring_id))
                                    @if ($i!=$check_judge->ring_id)
                                    <option>{{$i}}</option>
                                    @endif
                                    @else
                                    <option>{{$i}}</option>
                                    @endif

                                    @php
                                        $count--;
                                    @endphp
                                    @endfor

                                    @else
                                    <option>{{$row->ring_id}}</option>
                                    @endif

                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke text-md-right">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <button class="btn btn-secondary" type="button" id="setting-formReset">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

      </div>

@endsection
@push('scripts')
<script>
    $(document).on('click','#setting-formReset',function(){
        $("#setting-form")[0].reset();
    });
    $('#event_id').change(function(){
        var event_id = $(this).val();
        var ring_id = $('#ring_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
        url: "{{route('event.rings')}}",
        type: "POST",
        data:{event_id:event_id},
        success: function(data){
            $('#ring_id')
                        .find('option')
                        .remove();
            $.each(data, function(key, value) {
                    $('#ring_id').append($("<option></option>")
                                .attr("value", value)
                                .text(value));
            });
        }
    });
    });
</script>
@endpush


