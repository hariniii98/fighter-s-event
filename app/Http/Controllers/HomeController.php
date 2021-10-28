<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\JudgeEventRing;
use App\Models\SuperJudgeEventRing;
use Auth;
use CountryState;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data['events'] = Event::where('end_date','>',Carbon::today())->get();
        $data['events_registered_ids'] = EventUser::where('user_id',Auth::id())->pluck('event_id')->toArray();
        $data['judge_matches_numbers_list']=JudgeEventRing::join('assign_rings','assign_rings.ring_id','=','judge_event_rings.ring_id')
        ->select('assign_rings.event_id','assign_rings.stage_id','assign_rings.match_id')->where('judge_event_rings.judge_id',Auth::id())->get();
        if($request->match_id){
        $data['judge_matches_list']=JudgeEventRing::join('assign_rings','assign_rings.ring_id','=','judge_event_rings.ring_id')
        ->select('assign_rings.event_id','assign_rings.stage_id','assign_rings.match_id')->where('assign_rings.match_id',$request->match_id)->where('judge_event_rings.judge_id',Auth::id())->get();
        }else{
            $data['judge_matches_list']=array();
        }
        $data['super_judge_matches_numbers_list']=SuperJudgeEventRing::join('assign_rings','assign_rings.ring_id','=','super_judge_event_rings.ring_id')
        // ->join('judge_event_rings','super_judge_event_rings.ring_id','=','judge_event_rings.ring_id')
        // ->join('scores','scores.judge_id','=','judge_event_rings.judge_id')
         ->select('assign_rings.event_id','assign_rings.stage_id','assign_rings.match_id')->where('super_judge_event_rings.super_judge_id',Auth::id())->get();
        if($request->match_id){
            $data['super_judge_matches_list']=SuperJudgeEventRing::join('assign_rings','assign_rings.ring_id','=','super_judge_event_rings.ring_id')
        // ->join('judge_event_rings','super_judge_event_rings.ring_id','=','judge_event_rings.ring_id')
        // ->join('scores','scores.judge_id','=','judge_event_rings.judge_id')
         ->select('assign_rings.event_id','assign_rings.stage_id','assign_rings.match_id')->where('assign_rings.match_id',$request->match_id)->where('super_judge_event_rings.super_judge_id',Auth::id())->get();
        }else{
            $data['super_judge_matches_list']=array();
        }


        return view('home')->with($data);
    }

    public function users()
    {
        $users=User::join('role_user','role_user.user_id','=','users.id')
               ->join('roles','role_user.role_id','=','roles.id')
               ->select('users.*','roles.name as role')
               ->get();

        return view('users.index',compact('users'));
    }

    public function edit($id)
    {
        $users=User::join('role_user','role_user.user_id','=','users.id')
               ->join('roles','role_user.role_id','=','roles.id')
               ->select('users.*','roles.name as role')
               ->where('users.id',$id)
               ->get();

               $roles=Role::all();

        return view('users.edit',compact('users','roles'));
    }

    public function update(Request $request,$id){

        /** User Update */
        $users=User::find($id);
        $users->first_name=$request->first_name;
        $users->last_name=$request->last_name;
        $users->email=$request->email;
        $users->mobile_number=$request->mobile_number;
        $users->save();

        /** Role Update */
        $role_users=DB::table('role_user')
                    ->where('user_id',$id)
                    ->update(array('role_id'=>$request->role_id));



        return redirect('users/index');


    }


}
