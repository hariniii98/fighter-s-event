<?php

namespace App\Http\Controllers;

use App\Models\EventUser;
use App\Models\ExtraRankingPoint;
use App\Models\FighterProfile;
use App\Models\Score;
use App\Models\SuperJudgeDecision;
use App\Models\TournamentDraw;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperJudgeDecisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $users_arr=$request->users;
        $next_stage_id=($request->stage_id+1);
        $user_id_j=[];$match_id_j=[];
        /** Match winner Updation */
        $match=TournamentDraw::where('event_id',$request->event_id)->where('stage_id',$request->stage_id)->first();

        $match_ids=json_decode($match->match_ids);
            $max_value=max($match_ids);
            $match_id=($max_value+1);
            $match_id_j[]=$match_id;

        if($request->technique=='draw'){
            $user_a=array($users_arr[0],$users_arr[1]);
        }
        else{

            $user_a=array($request->winner_id);


        }

        array_push($user_id_j,$user_a);


          $user_json_encode=json_encode($user_id_j);
          $match_json_encode=json_encode($match_id_j);


          if(TournamentDraw::where('event_id',$request->event_id)->where('stage_id',$next_stage_id)->count()==0){
            $tournament_draws=new TournamentDraw();
            $tournament_draws->event_id=$request->event_id;
            $tournament_draws->stage_id=$next_stage_id;
            $tournament_draws->user_ids=$user_json_encode;
            $tournament_draws->match_ids=$match_json_encode;
            $tournament_draws->save();
          }
          else{
            $next_tournament_draws=TournamentDraw::where('event_id',$request->event_id)->where('stage_id',$next_stage_id)->first();
            $user_ids=json_decode($next_tournament_draws->user_ids);

            if($request->technique=='draw'){
                $user_a=array($users_arr[0],$users_arr[1]);
            }
            else{

                $user_a=array($request->winner_id);

            }

           array_push($user_ids,$user_a);
           $match_arr=json_decode($match->match_ids);
            $match_id_count=count($match_arr);

           for($m=0;$match_id_count>0;$m++){

            $match_id_inc=($match_arr[$m]+1);

            $match_arr[$m]=(string)$match_id_inc;


           $match_id_count--;
          }

           $user_json_encode=json_encode($user_ids);
           $match_json_encode=json_encode($match_arr);
            $next_tournament_draws->user_ids=$user_json_encode;
            $next_tournament_draws->match_ids=$match_json_encode;
            $next_tournament_draws->save();
          }




        $super_judge_id=Auth::user()->id;
        $super_judge_data=new SuperJudgeDecision();
        $super_judge_data->event_id=$request->event_id;
        $super_judge_data->stage_id=$request->stage_id;
        $super_judge_data->match_id=$request->match_id;
        if($request->technique!='draw'){
            $pos = array_search($request->winner_id, $users_arr);
            unset($users_arr[$pos]);
            $looser_id=array_values($users_arr);
            $super_judge_data->winner_id=$request->winner_id;
            $super_judge_data->looser_id=$looser_id[0];

        }
        else{
            $super_judge_data->winner_ids=json_encode($users_arr);
        }

        $super_judge_data->super_judge_id=$super_judge_id;
        $super_judge_data->remarks=$request->remarks;
        $super_judge_data->decision_type=$request->technique;
        $super_judge_data->save();

        return redirect('/home');

    }
    public function rankings(){

        $fighters=User::join('role_user','users.id','=','role_user.user_id')
        ->join('roles','role_user.role_id','=','roles.id')
        ->whereIn('roles.slug',['fighter'])
        ->select('users.id','users.first_name','users.last_name')
        ->get();

        $count=count($fighters);
        $additional_points=[];
        $scores_arr=[];$event_arr=[];$round_arr=[];$user_arr=[];
        foreach($fighters as $row){

            /** Additional ponits */
            $extra_rankings=FighterProfile::join('extra_ranking_points','extra_ranking_points.id','=','fighter_profiles.ranking_id')
            ->join('event_users','event_users.user_id','=','fighter_profiles.user_id')
            ->where('fighter_profiles.user_id',$row->id)
            ->first();

            if(in_array($row->user_id,$user_arr)==false){
                $user_arr[]=$row->id;
            }

            if(isset($extra_rankings)){
                if(in_array($extra_rankings->event_id,$event_arr)==false){
                    $event_arr[]=$extra_rankings->event_id;
                }

                $additional_points[$row->id]=$extra_rankings->additional_points;


            }
            else{
                $additional_points[$row->id]=0;
            }



        }
        /** Match scores */

    $count=count($event_arr);
    $score_user_arr=[];
     for($e=0;$count>0;$e++){

        $scores=Score::where('event_id',$event_arr[$e])->get();
        $user_count=count($user_arr);



            for($u=0;$user_count>0;$u++){


            foreach($scores as $score){

                   $user_json_decode=json_decode($score->score_details);


                   if(isset($user_json_decode[$u])){
                    $round_arr[$user_arr[$u]][]=($user_json_decode[$u]->round1+$user_json_decode[$u]->round2+$user_json_decode[$u]->round3);
                    if(in_array($user_arr[$u],$score_user_arr)==false){
                     $score_user_arr[]=$user_arr[$u];
                    }
                   }





            // if(count($scores)>0){
            //     dd($scores);
            // }
        }

        $user_count--;
    }


        $count--;
    }
    $total_score='';$user=[];$rank_user=[];
      foreach($score_user_arr as $key){

        $total_score=array_sum($round_arr[$key]) + $additional_points[$key];
        $rank_user[$total_score]=$key;
        $user[]=$key;
      }
      krsort($rank_user);



//         $count=count($fighters);
//         foreach($fighters as $row){
//             $scores=Score::whereJsonContains('score_details', [['user_id' =>2]])->get();
//             $count=count($scores);
//             if($count>0){

//                 dd($scores);

//             }

//         }

// dd($row->id);



        return view('player.rankings',compact('rank_user','user'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuperJudgeDecision  $superJudgeDecision
     * @return \Illuminate\Http\Response
     */
    public function show(SuperJudgeDecision $superJudgeDecision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuperJudgeDecision  $superJudgeDecision
     * @return \Illuminate\Http\Response
     */
    public function edit(SuperJudgeDecision $superJudgeDecision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuperJudgeDecision  $superJudgeDecision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuperJudgeDecision $superJudgeDecision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuperJudgeDecision  $superJudgeDecision
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuperJudgeDecision $superJudgeDecision)
    {
        //
    }
}
