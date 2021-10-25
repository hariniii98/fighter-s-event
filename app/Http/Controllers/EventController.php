<?php

namespace App\Http\Controllers;
use App\Models\EventCategory;
use App\Models\Allowance;
use App\Models\AgeCategory;
use App\Models\WeightCategory;
use App\Models\Sponsor;
use App\Models\Payment;
use App\Models\EventUser;
use App\Models\Event;
use App\Models\User;
use App\Notifications\WhatsappPushNotification;
use Auth;
use App\Models\ExtraRankingPoint;

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

    public function addAgeCategory(){
        return view('events.add_age_category');
    }

    public function showAgeCategories(){
        $data['age_categories'] = AgeCategory::all();
        return view('events.age_categories_show')->with($data);
    }

    public function storeAgeCategory(Request $request){
        $cat = new AgeCategory();
        $cat->min_age = $request->min_age;
        $cat->max_age = $request->max_age;
        $cat->save();
        return redirect(route('age_categories.index'));
    }

    public function deleteAgeCategory($id){
        $cat = AgeCategory::find($id);
        $cat->delete();

        return redirect(route('age_categories.index'));
    }

    public function addWeightCategory(){
        return view('events.add_weight_category');
    }

    public function showWeightCategories(){
        $data['weight_categories'] = WeightCategory::all();
        return view('events.weight_categories_show')->with($data);
    }

    public function storeWeightCategory(Request $request){
        $cat = new WeightCategory();
        $cat->name = $request->name;
        $cat->min_weight = $request->min_weight;
        $cat->max_weight = $request->max_weight;
        $cat->save();
        return redirect(route('weight_categories.index'));
    }

    public function deleteWeightCategory($id){
        $cat = WeightCategory::find($id);
        $cat->delete();

        return redirect(route('weight_categories.index'));
    }

    public function addSponsor(){
        return view('events.add_sponsor');
    }

    public function showSponsors(){
        $data['sponsors'] = Sponsor::all();
        return view('events.sponsors_show')->with($data);
    }

    public function storeSponsor(Request $request){
        $brand_image='';

        if ($request['brand_image']) {
            $image = $request['brand_image'];
            $brand_image = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/sponsors_images');
            $image->move($destinationPath, $brand_image);
        }
        $cat = new Sponsor();
        $cat->name = $request->name;
        $cat->brand_image = $brand_image;
        $cat->description = $request->description;
        $cat->save();
        return redirect(route('sponsors.index'));
    }

    public function deleteSponsor($id){
        $cat = Sponsor::find($id);
        $cat->delete();

        return redirect(route('sponsors.index'));
    }

    public function storeEventUser(Request $request){
        $event_user = new EventUser();
        $event_user->user_id = Auth::id();
        $event_user->event_id = $request->event_id;
        $event_user->save();
        $payment = new Payment();
        $payment->event_user_id = $event_user->id;
        $payment->payment_mode = $request->payment_mode;
        $payment->reference_number = $request->reference_number;
        $payment->save();
        return redirect('/home');
    }

    public function payments(){
        $data['payments'] = Payment::select('*')->join('event_users','event_users.id','=','payments.event_user_id')->get();
        foreach($data['payments'] as $key=>$row){
            $event[$key] = Event::find($row->event_id);
            $data['payments'][$key]['event_name'] = $event[$key]->name;
            $user[$key] = User::find($row->user_id);
            $data['payments'][$key]['user_name'] = $user[$key]->first_name.' '.$user[$key]->last_name;
            $data['payments'][$key]['mobile_number'] = $user[$key]->mobile_number;
        }
        return view('events.payments')->with($data);
    }

    public function showExtraRankingPoints(){
        $data['extra_ranking_points'] = ExtraRankingPoint::all();
        return view('events.extra_ranking_points_show')->with($data);
    }

    public function addExtraRankingPoint(){
        return view('events.add_extra_ranking_points');
    }

    public function storeExtraRankingPoint(Request $request){
        $extra = new ExtraRankingPoint();
        $extra->name = $request->name;
        $extra->additional_points = $request->additional_points;
        $extra->save();
        return redirect(route('extra_ranking_points.index'));
    }

    public function deleteExtraRankingPoint(Request $Request,$id){
        $extra = ExtraRankingPoint::find($id);
        $extra->delete();
        return redirect(route('extra_ranking_points.index'));
    }
}
