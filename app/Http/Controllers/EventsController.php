<?php

namespace App\Http\Controllers;

use App\Models\AgeCategory;
use App\Models\WeightCategory;
use App\Models\Allowance;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventCategory;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['events'] = Event::all()->whereNull('deleted_at');
        foreach($data['events'] as $key=>$row){
            $event_cat[$key] = EventCategory::find($row->event_category_id);
            $data['events'][$key]['event_category_name'] = $event_cat[$key]->name;
        }
        return view('events.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['event_categories'] = EventCategory::all();
        $data['age_categories'] = AgeCategory::all();
        $data['weight_categories'] = WeightCategory::all();
        $data['allowances'] = Allowance::all();
        $data['sponsors'] = Sponsor::all();
        return view('events.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event_banner_image='';

        if ($request->hasFile('event_banner_image')) {
            $image = $request->file('event_banner_image');
            $event_banner_image = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/event_banners');
            $image->move($destinationPath, $event_banner_image);
        }
        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->event_banner_image = $event_banner_image;
        $event->event_category_id = $request->event_category_id;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->reg_deadine = $request->reg_deadine;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->gender = $request->gender;
        $event->age_category_id = $request->age_category_id;
        $event->weight_category_id = $request->weight_category_id;
        $event->location = $request->location;
        $event->sponsors_ids = json_encode($request->sponsors_ids);
        $event->allowances_ids = json_encode($request->allowances_ids);
        $event->save();

        return redirect(route('events.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['event'] = Event::find($id);
        $data['event_category'] = EventCategory::find($data['event']->event_category_id);
        $data['age_category'] = AgeCategory::find($data['event']->age_category_id);
        $data['weight_category'] = WeightCategory::find($data['event']->weight_category_id);
        $data['event_categories'] = EventCategory::all();
        $data['age_categories'] = AgeCategory::all();
        $data['weight_categories'] = WeightCategory::all();
        $data['allowances'] =Allowance::all();
        $data['sponsors'] = Sponsor::all();
        $data['allowances_ids'] = json_decode($data['event']->allowances_ids);
        $data['sponsors_ids'] = json_decode($data['event']->sponsors_ids);
        return view('events.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


    }

    public function updateEvent(Request $request,$id){
        if ($request->hasFile('event_banner_image')) {
            $image = $request->file('event_banner_image');
            $event_banner_image = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/event_banners');
            $image->move($destinationPath, $event_banner_image);
        }

        $event = Event::find($id);
        $event->name = $request->name;
        if(isset($event_banner_image)){
            $event->event_banner_image = $event_banner_image;
        }
        $event->description = $request->description;
        $event->event_category_id = $request->event_category_id;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->reg_deadine = $request->reg_deadine;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->gender = $request->gender;
        $event->age_category_id = $request->age_category_id;
        $event->weight_category_id = $request->weight_category_id;
        $event->location = $request->location;
        $event->sponsors_ids = json_encode($request->sponsors_ids);
        $event->allowances_ids = json_encode($request->allowances_ids);
        $event->update();

        return redirect(route('events.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
