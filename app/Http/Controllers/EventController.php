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
use App\Models\FighterProfile;
use App\Models\JudgeEventRing;
use App\Models\SuperJudgeEventRing;
use App\Models\RefereeEventRing;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf as SPDF;
use Illuminate\Support\Facades\DB;
use App\Models\Settings;
use App\Models\Role;
use Twilio\TwiML\Voice\Pay;
use App\Models\CreateMainEvent;

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

    public function showFighters($id){
        $data['event_users_ids'] = EventUser::where('event_id',$id)->pluck('user_id')->toArray();
        $data['fighters']=User::join('role_user','role_user.user_id','=','users.id')
               ->join('roles','role_user.role_id','=','roles.id')
               ->select('users.*','roles.name as role')->where('roles.slug','fighter')->whereIn('users.id',$data['event_users_ids'])
               ->get();

        return view('fighters.index')->with($data);
    }

    public function showFightersProfile($id){
        $data['fighter'] = User::find($id);
        $data['fighter_profile'] = FighterProfile::where('user_id',$id)->first();
        if(isset($data['fighter_profile']->ranking_id)){
            $data['ranking_name'] = ExtraRankingPoint::find($data['fighter_profile']->ranking_id)->value('name');
        }else{
            $data['ranking_name'] = 'None';
        }

        return view('fighters.profile')->with($data);
    }

    public function showAllJudges(){
        $data['judges']=User::join('role_user','role_user.user_id','=','users.id')
               ->join('roles','role_user.role_id','=','roles.id')
               ->select('users.*','roles.name as role')->where('roles.slug','judge')
               ->get();

        return view('judges.index')->with($data);
    }

    public function editJudge($id){
        $data['judge_id'] = $id;
        $data['judge'] = User::find($id);
        $data['check_judge'] = JudgeEventRing::where('judge_id',$id)->first();
        if($data['check_judge']){
             $event = Event::where('id',$data['check_judge']->event_id)->first();
             $data['event_name'] = $event->name;
        }
        $data['events'] = Event::where('end_date','>=',Carbon::today())->get();
        $data['ring_list']=Event::all();
        return view('judges.edit')->with($data);
    }

    public function checkEventRings(Request $request){
        $event = Event::find($request->event_id);
        $count = $event->no_of_rings;
        for($i=0;$i<$count;$i++){
            $rings[$i] = $i+1;
        }
        return $rings;
    }

    public function storeJudgeEventRing(Request $request,$id){
        //check for existing row
        $check = JudgeEventRing::where('judge_id',$id)->first();
            if(isset($check)&&$check!=null){
                $check->ring_id = $request->ring_id;
                $check->event_id = $request->event_id;
                $check->update();
            }else{
                $check=new JudgeEventRing();
                $check->judge_id = $id;
                $check->event_id = $request->event_id;
                $check->ring_id = $request->ring_id;
                $check->save();
            }

            return redirect(route('event.judges'));
    }

    public function showFighterInstructions(){
        return view('fighters.instructions');
    }

    public function showAllSuperJudges(){
        $data['super_judges']=User::join('role_user','role_user.user_id','=','users.id')
               ->join('roles','role_user.role_id','=','roles.id')
               ->select('users.*','roles.name as role')->where('roles.slug','superjudge')
               ->get();



        return view('super_judges.index')->with($data);
    }

    public function storeSuperJudgeEventRing(Request $request,$id){
        //check for existing row
        $check = SuperJudgeEventRing::where('super_judge_id',$id)->first();
            if(isset($check)&&$check!=null){
                $check->event_id = $request->event_id;
                $check->ring_id = $request->ring_id;
                $check->update();
            }else{
                $check=new SuperJudgeEventRing();
                $check->super_judge_id = $id;
                $check->event_id = $request->event_id;
                $check->ring_id = $request->ring_id;
                $check->save();
            }

            return redirect(route('event.super_judges'));
    }

    public function editSuperJudge($id){
        $data['judge_id'] = $id;
        $data['judge'] = User::find($id);
        $data['check_judge'] = SuperJudgeEventRing::where('super_judge_id',$id)->first();
        if($data['check_judge']){
             $event = Event::where('id',$data['check_judge']->event_id)->first();
             $data['event_name'] = $event->name;
        }
        $data['events'] = Event::where('end_date','>=',Carbon::today())->get();
        $data['ring_list']=Event::all();
        return view('super_judges.edit')->with($data);
    }

    public function showAllReferees(){
        $data['referees']=User::join('role_user','role_user.user_id','=','users.id')
               ->join('roles','role_user.role_id','=','roles.id')
               ->select('users.*','roles.name as role')->where('roles.slug','referee')
               ->get();

        return view('referees.index')->with($data);
    }

    public function storeRefereeEventRing(Request $request,$id){
        //check for existing row
        $check = RefereeEventRing::where('referee_id',$id)->first();
            if(isset($check)&&$check!=null){
                $check->event_id = $request->event_id;
                $check->ring_id = $request->ring_id;
                $check->update();
            }else{
                $check=new RefereeEventRing();
                $check->referee_id = $id;
                $check->event_id = $request->event_id;
                $check->ring_id = $request->ring_id;
                $check->save();
            }

            return redirect(route('event.referees'));
    }

    public function editReferee($id){
        $data['judge_id'] = $id;
        $data['judge'] = User::find($id);
        $data['check_judge'] = RefereeEventRing::where('referee_id',$id)->first();
        if($data['check_judge']){
             $event = Event::where('id',$data['check_judge']->event_id)->first();
             $data['event_name'] = $event->name;
        }
        $data['events'] = Event::where('end_date','>=',Carbon::today())->get();
        return view('referees.edit')->with($data);
    }

    public function getIdCard($id){
        $settings = Settings::find(1);
        $user = User::find($id);
        $role = DB::table('role_user')->where('user_id',$id)->first();
        $role= Role::find($role->role_id);
        $pdf = SPDF::loadView('id_card',compact('settings','user','role'));
        return $pdf->stream('itsolutionstuff.pdf');
       // dd();
        //return $pdf->download('itsolutionstuff.pdf');
    }

    public function createWhatsappPushNotification(){
        $data['events'] = Event::where('end_date','>=',Carbon::today())->get();
        $data['roles'] = Role::all();
        return view('create_push_notification')->with($data);
    }

    public function sendWhatsappPushNotification(Request $request){
        if($request->role_slug=='admin'||$request->role_slug=='manager'){
            $users=User::join('role_user','role_user.user_id','=','users.id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->select('users.*','roles.name as role')->where('roles.name',$request->role_slug)
                ->get();
            foreach($users as $row){
                sendSMS('+91'.$row->mobile_number,$request->content);
            }
        }else{
            $check_all_event_users = EventUser::where('event_id',$request->event_id)->pluck('user_id')->toArray();
            $users=User::join('role_user','role_user.user_id','=','users.id')
                ->join('roles','role_user.role_id','=','roles.id')
                ->select('users.*','roles.name as role')->where('roles.name',$request->role_slug)->whereIn('users.id',$check_all_event_users)
                ->get();
            foreach($users as $row){
                sendSMS('+91'.$row->mobile_number,$request->content);
            }
        }

        return redirect('/home');
    }

    public function paymentsEdit($id){
        $data['payment'] = Payment::find($id);
        return view('events.edit_payment')->with($data);
    }

    public function paymentUpdate(Request $request,$id){
        $payment = Payment::find($id);
        $payment->payment_mode = $request->payment_mode;
        $payment->reference_number = $request->ref_number;
        $payment->status = $request->status;
        $payment->update();
        return redirect(route('payments.index'));
    }

    public function showMainEvents(){
        $data['main_events'] = CreateMainEvent::all();
        foreach($data['main_events'] as $key=>$row){
            $event_ids[$key] = json_decode($row->sub_event_ids);
            if($event_ids[$key]!=null){
                foreach($event_ids[$key] as $key1=>$id){
                    $event[$key1] = Event::find($id);
                    $data['sub_events_names'][$key][$key1] = $event[$key1]->name;
                }
            }else{
                $data['sub_events_names'][$key] = array();
            }
        }
        return view('main_events.show')->with($data);
    }

    public function createMainEvent(){
        $data['events'] = Event::all();
        return view('main_events.create')->with($data);
    }

    public function storeMainEvent(Request $request){
        $main_event = new CreateMainEvent();
        $main_event->name = $request->name;
        if($request->event_id){
            $main_event->sub_event_ids = json_encode($request->event_id);
        }
        $main_event->save();
        return redirect(route('main_events.index'));
    }

    public function updateMainEvent(Request $request,$id){
        $main_event = CreateMainEvent::find($id);
        $main_event->name = $request->name;
        $main_event->sub_event_ids = json_encode($request->event_id);
        $main_event->update();
        return redirect(route('main_events.index'));
    }

    public function editMainEvent($id){
        $data['main_event'] = CreateMainEvent::find($id);
        $data['sub_ev_ids'] = json_decode($data['main_event']->sub_event_ids);
        $data['events'] = Event::all();
        return view('main_events.edit')->with($data);
    }
}
