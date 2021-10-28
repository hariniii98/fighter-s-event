<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\TournamentDraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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


        $judge_id=Auth::user()->id;
        $count=count($request->users);
        $data=[];

        for($i=0;$count>0;$i++){

            $user_id=$request->users[$i];
            $data[]=[

                'user_id'=>$user_id,
                'round1'=>$request->round1[$user_id],
                'round2'=>$request->round2[$user_id],
                'round3'=>$request->round3[$user_id],

            ];
            $count--;
        }
        $scores=new Score();
        $scores->event_id=$request->event_id;
        $scores->stage_id=$request->stage_id;
        $scores->match_id=$request->match_id;
        $scores->judge_id=$judge_id;
        $scores->score_details=json_encode($data);
        $scores->remarks=$request->remarks;
        $scores->save();

        return redirect('/home');


    }
    public function matchParticipants($event_id,$stage_id,$match_id){

        $tournament_draws=TournamentDraw::where('event_id',$event_id)->where('stage_id',$stage_id)->first();

        $instance=new TournamentDrawController();
        if(isset($tournament_draws)){
        $matches=$instance->drawJsonDecode($tournament_draws->match_ids);
        $users=$instance->drawJsonDecode($tournament_draws->user_ids);
        $match_count=count($matches);
        }
        else{
            $matches=[];
            $users=[];
        }

        $key=array_search($match_id,$matches);
        $user_list=isset($users[$key])?$users[$key]:[];

        return $user_list;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }
}
