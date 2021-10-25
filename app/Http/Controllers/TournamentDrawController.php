<?php

namespace App\Http\Controllers;

use App\Models\EventUser;
use App\Models\TournamentDraw;
use App\Models\User;
use Illuminate\Http\Request;

class TournamentDrawController extends Controller
{
    /** Draw the tournament */
    public function draw(){

        $data=[];
        $draw_names=[];
        $draw_ids=[];
        $draw_counts=[];

        $tournaments_participants=EventUser::join('users','event_users.user_id','=','users.id')
                                 //->join('payments','payments.event_user_id','=','event_users.user_id')
                                 //->where('payments.payment_status','paid')
                                 ->join('events','event_users.event_id','=','events.id')
                                 ->select('users.id','users.first_name','users.last_name','events.name as event_name','event_users.event_id')
                                 ->get();


                                 foreach($tournaments_participants as $key=>$row){

                                          $data['event_name']=$row->event_name;
                                          $data['event_id']=$row->event_id;
                                          $data['first_name'][]=$row->first_name;
                                          $data['last_name'][]=$row->last_name;
                                          $data['id'][]=$row->id;

                                 }
                                 $count=count($data['id']);
                                 $temp_count=$count;
                                 $row_no=1;

                                 for($i=0;$count>0;$i++){
                                     if($count>0){
                                        if(($count)%2==0 || $count==1){
                                            $members_count=$count;

                                            for($m=0;$members_count>0;$m++){
                                                if($temp_count==$count){

                                                    $draw_names[]=$data['first_name'][$m];
                                                    $draw_ids[]=$data['id'][$m];
                                                    $draw_counts[$count][]=$data['first_name'][$m];

                                                }
                                                else{

                                                   $draw_names[]='';
                                                   $draw_ids[]='';
                                                   $draw_counts[$count][]='Match Winner';

                                                }


                                               $members_count--;
                                            }

                                        }



                                     }
                                     $count=$count/2;

                                 }



                                 $stage_id=[];$match_id=[];
        $tournament_draws=TournamentDraw::where('event_id',$data['event_id'])->get(); // 1 event now

        foreach($tournament_draws as $row){
          $stage_id[]=$row->stage_id;
          $match_id[]=$row->match_ids;
          $user_id[]=$row->user_ids;
        }
        //return view('draw.tournament_draw',compact('tournaments_participants','data','draw_ids','draw_names','draw_counts','tournament_draws','match_id','stage_id'));
        if(count($tournament_draws)==0){
            return view('draw.tournament_draw',compact('tournaments_participants','data','draw_ids','draw_names','draw_counts','tournament_draws','match_id','stage_id'));
        }
        else{

            return view('draw.exist_draw',compact('data','draw_counts','tournament_draws'));
        }

    }

    public function store(Request $request)
    {
        $stage_ids=isset($request->stage)?$request->stage:[];
        $match_ids=isset($request->match)?$request->match:[];
        //$user_ids=isset($request->user)?$request->user:[];

        $stage_count=count($stage_ids);



        for($i=0;$stage_count>0;$i++){
            $stage_id=$stage_ids[$i];
            $match_id=$match_ids[$stage_id];
            $count=count($match_id);



            $user_id=[];

            if(isset($request->user[$stage_id])){
            if(count($request->user[$stage_id])>0){
            for($j=1;$count>0;$j++){

                $user_id[]=$request->user[$stage_id][$j];
                $count--;

            }
        }
    }


        $tournament_draws=new TournamentDraw();
        $tournament_draws->event_id=$request->event_id;
        $tournament_draws->stage_id=$stage_id;
        $tournament_draws->match_ids=json_encode($match_id);
        $tournament_draws->user_ids=json_encode($user_id);
        $tournament_draws->save();

        $stage_count--;

    }


    return redirect('/draw');




    }

    public function drawJsonDecode($value){

        $json_decode=json_decode($value);

        return $json_decode;

    }

    public function userName($id){

        $user_name=User::find($id)->first_name;

        return $user_name;

    }
}
