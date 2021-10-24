<?php

namespace App\Http\Controllers;
use App\Models\EventCategory;
use App\Models\Allowance;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function showEventCategories(){
        $data['event_categories'] = EventCategory::all();
        return view('events.event_categories_show')->with($data);
    }

    public function addEventCategory(){
        return view('events.add_event_category');
    }

    public function storeEventCategory(Request $request){
        $cat = new EventCategory();
        $cat->name = $request->name;
        $cat->save();
        return redirect(route('event_categories.index'));
    }

    public function deleteEventCategory($id){
        $cat = EventCategory::find($id);
        $cat->delete();

        return redirect(route('event_categories.index'));
    }

    public function showAllowances(){
        $data['allowances'] = Allowance::all();
        return view('events.allowances_show')->with($data);
    }

    public function addAllowance(){
        return view('events.add_allowance');
    }

    public function storeAllowance(Request $request){
        $cat = new Allowance();
        $cat->name = $request->name;
        $cat->save();
        return redirect(route('allowances.index'));
    }

    public function deleteAllowance($id){
        $cat = Allowance::find($id);
        $cat->delete();

        return redirect(route('allowances.index'));
    }

    public function addEvent(){
        $data['event_categories'] = EventCategory::all();
        return view('events.add_event')->with($data);
    }
}
