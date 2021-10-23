<?php

namespace App\Http\Controllers;
use App\Models\EventCategory;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function showEventCategories(){
        return view('events.event_categories_show');
    }

    public function addEventCategory(){
        return view('events.add_event_category');
    }

    public function storeEventCatgeory(Request $request){
        $cat = new EventCategory();
        $cat->name = $request->name;
        $cat->save();
        return redirect(route('event_categories.index'));
    }

    public function deleteEvenetCategory($id){
        $cat = EventCategory::find($id);
        $cat->delete();

        return redirect(route('event_categories.index'));
    }
}
