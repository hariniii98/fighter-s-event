@extends('layouts.master_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-6">
            @role('fighter')
            <div class="card">
                <div class="card-header">
                    <h4>Events</h4>
                </div>
                <div class="card-body">
                    <div id="accordion">
                        @foreach($events as $event)
                        <div class="accordion">
                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body{{$event->id}}" aria-expanded="false">
                                <h4>{{$event->name}}</h4>
                            </div>
                            <div class="accordion-body collapse show" id="panel-body{{$event->id}}" data-parent="#accordion">
                                  <p class="mb-0">{{$event->description}}</p>
                                  <!-- Button trigger modal -->
                                  <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Regiter Now!</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
</div>
@endsection
