
@php
    $events=App\Models\Event::all();
@endphp
<div class="form-group">
    <label>Filter</label>
    <select class="form-control form-control-sm" name="event-filter" id="event-filter">
        <option value="">--select event--</option>
        @foreach ($events as $row)
      <option value="{{$row->id}}">{{$row->name}}</option>
     @endforeach
    </select>
  </div>

