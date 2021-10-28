@extends('layouts.master_layout')
@push('css-styles')
<style>
    .red{
        color:red;
        font-size: 14px;
    }
</style>
@endpush
@php $statuses = ["pending","completed"]; @endphp
@section('content')

@include('elements.settings_section')


 <!-- Main Content -->

      <div class="section-header">

        <h1>Payments</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/events/index')}}">Events</a></div>
          <div class="breadcrumb-item">Payments</div>
        </div>
      </div>

      <div class="section-body">


            <div id="output-status"></div>
            <div class="row">

                <div class="col-md-12">
                    <form id="setting-form" method="POST" action="{{route('payment.update',$payment->id)}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card" id="settings-card">
                        <div class="card-header">
                        <h4>Edit Payment</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row align-items-center mt-3">
                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Payment Mode<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                    <select name="payment_mode" class="form-control" id="payment_mode" required>
                                        <option value="{{$payment->payment_mode=="offline"?"offline":"online"}}">{{$payment->payment_mode=="offline"?"Offline":"Online"}}</option>
                                        <option value="{{$payment->payment_mode=="offline"?"online":"offline"}}">{{$payment->payment_mode=="offline"?"Online":"Offline"}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="site-title" class="form-control-label col-sm-3 text-md-right" id="ref_code">Reference Number</label>
                                <div class="col-sm-6 col-md-9">
                                    <input id="ref_number" name="ref_number" class="form-control" autocomplete="off" value="{{$payment->reference_number}}">
                                    <span class="red" id="ref_num_error"></span>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="site-title" class="form-control-label col-sm-3 text-md-right" id="ref_code">Status<span class="text-danger"> *</span></label>
                                <div class="col-sm-6 col-md-9">
                                    <select name="status" class="form-control" id="status" required>
                                        <option value="{{$payment->status=="pending"?"pending":"completed"}}">{{$payment->status=="pending"?"Pending":"Completed"}}</option>
                                        <option value="{{$payment->status=="pending"?"completed":"pending"}}">{{$payment->status=="pending"?"Completed":"Pending"}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke text-md-right">
                                <button class="btn btn-primary" id="btn-event" type="button">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

      </div>

@endsection
@push('scripts')
<script>
    $('#btn-event').click(function(){
        if($('#payment_mode').val()=="online"){
            if($('#ref_number').val()==""){
                $("#ref_num_error").text('Please enter reference number.');
            }else{
                $('#setting-form').submit();
            }
        }else{
            $('#setting-form').submit();
        }
    });
</script>
@endpush


