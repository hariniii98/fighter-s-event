<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use App\Models\TournamentDraw;
use App\Models\User;
use Illuminate\Http\Request;

class TournamentDrawController extends Controller
{
    /** Draw the tournament */
    public function draw($direct_pass_member=null){



        $data=[];
        $draw_names=[];
        $draw_ids=[];
        $draw_counts=[];
        $tournament_draws=[];
        $stage_id=[];$match_id=[];
        $data['event_name']='';
        $data['event_id']='';
        $data['first_name']=[];
        $data['last_name']=[];
        $data['id']=[];
        $member_details=[];


        if(isset($direct_pass_member)){
            $tournaments_participants=EventUser::join('users','event_users.user_id','=','users.id')
            ->join('role_user','event_users.user_id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
           //  ->join('payments','payments.event_user_id','=','event_users.user_id')
           //  ->where('payments.status','completed')
           ->join('events','event_users.event_id','=','events.id')
            ->where('event_users.user_id','!=',$direct_pass_member)
            ->whereIn('roles.slug',['fighter'])
            ->select('users.id','users.first_name','users.last_name','events.name as event_name','event_users.event_id')
            ->get();

        }
        else{
            $tournaments_participants=EventUser::join('users','event_users.user_id','=','users.id')
                                 ->join('role_user','event_users.user_id','=','role_user.user_id')
                                 ->join('roles','role_user.role_id','=','roles.id')
                                //  ->join('payments','payments.event_user_id','=','event_users.user_id')
                                //  ->where('payments.status','completed')
                                 ->join('events','event_users.event_id','=','events.id')
                                 ->whereIn('roles.slug',['fighter'])
                                 ->select('users.id','users.first_name','users.last_name','events.name as event_name','event_users.event_id')
                                 ->get();
        }



                           if(count($tournaments_participants)>0){
                                 foreach($tournaments_participants as $key=>$row){

                                          $data['event_name']=$row->event_name;
                                          $data['event_id']=$row->event_id;
                                          $data['first_name'][]=$row->first_name;
                                          $data['last_name'][]=$row->last_name;
                                          $data['id'][]=$row->id;

                                 }
                                 $count=count($data['id']);
                                 $total_member_count=$count;
                                 $row_no=1;

                                 if(($count)%2==0){
                                  for($i=0;$count>0;$i++){
                                     if($count>0){
                                        if(($count)%2==0 || $count==1){
                                            $members_count=$count;

                                            for($m=0;$members_count>0;$m++){
                                                if($total_member_count==$count){

                                                    $draw_names[]=$data['first_name'][$m];
                                                    $draw_ids[]=$data['id'][$m];
                                                    $draw_counts[$count][]=$data['first_name'][$m];

                                                }
                                                else{

                                                   $draw_names[]='';
                                                   $draw_ids[]='';
                                                   $draw_counts[$count][]='';

                                                }


                                               $members_count--;
                                            }

                                        }



                                     }
                                     $count=$count/2;


                                 }
                                }
                                 else{



                                     for($i=0;$count>0;$i++){

                                            $draw_names[]=$data['first_name'][$i];
                                            $draw_ids[]=$data['id'][$i];
                                            $draw_counts[$i][]=$data['first_name'][$i];




                                       $count--;
                                    }


                                 }




        $tournament_draws=TournamentDraw::where('event_id',$data['event_id'])->get(); // 1 event now

        foreach($tournament_draws as $row){
          $stage_id[]=$row->stage_id;
          $match_id[]=$row->match_ids;
          $user_id[]=$row->user_ids;

        }
    }
      if(isset($direct_pass_member)){

        $member_details['tournaments_participants']=$tournaments_participants;
        $member_details['data']=$data;
        $member_details['draw_ids']=$draw_ids;
        $member_details['draw_names']=$draw_names;
        $member_details['draw_counts']=$draw_counts;
        $member_details['tournament_draws']=$tournament_draws;
        $member_details['match_id']=$match_id;
        $member_details['stage_id']=$stage_id;

        return $member_details;

      }
      else{
        if(count($tournament_draws)==0){

            if($total_member_count%2==0){

                return view('draw.tournament_draw_even',compact('tournaments_participants','data','draw_ids','draw_names','draw_counts','tournament_draws','match_id','stage_id','direct_pass_member'));

            }
            else{

                return view('draw.tournament_draw_odd',compact('tournaments_participants','data','draw_ids','draw_names','draw_counts','tournament_draws','match_id','stage_id'));
            }


        }
        else{

            return view('draw.exist_draw',compact('data','draw_counts','tournament_draws'));
        }
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

            if(isset($request->user[$stage_id]) || isset($request->direct_pass_member[$stage_id])){
            // if(count($request->user[$stage_id])>0){
            for($j=1;$count>0;$j++){



                if($stage_id==2){

                    $user_count=$count;


                    for($e=0;$user_count>0;$e++){

                         if($e==0){
                            $user_v=$request->direct_pass_member[$stage_id][5][0];
                            $user_id[]=array($user_v,"");
                         }
                           else{
                            $user_id[]=array("","");
                           }






                        $user_count--;
                    }


                     $count=0;

                }
                else{
                    $user_id[]=$request->user[$stage_id][$j];
                }



                $count--;

            }
        // }
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
    public function matchesList(){

        $tournament_draws=TournamentDraw::get(); // 1 event now
        $tournament_count=count($tournament_draws);
        $match_ids=[];$user_ids=[];
        $stage_ids=[];$event_name=[];$tournament_draw_ids=[];

        foreach($tournament_draws as $key=>$row){

            if($key==($tournament_count-1)){

                break;

            }
            else{
            $event=Event::find($row->event_id)->name;

            $match_nos=json_decode($row->match_ids);
            $count=count($match_nos);
            $user_nos=json_decode($row->user_ids);


            if(count($match_nos)>0){
                for($i=0;$count>0;$i++){

                    $event_name[]=$event;
                    $stage_ids[]=$row->stage_id;
                    $tournament_draw_ids[]=$row->id;
                    $match=$match_nos[$i];
                    $user_ids[$match]=isset($user_nos[$i])?$user_nos[$i]:null;

                    $match_ids[]=$match;

                    $count--;

                }
            }

        }

        }



        return view('draw.match_list',compact('tournament_draws','stage_ids','match_ids','user_ids','event_name','tournament_draw_ids'));



    }

    public function matchesDirectPass(Request $request){


        $response=$this->draw($request->direct_pass_member);
        $direct_pass_member=$request->direct_pass_member;
        $tournaments_participants=$response['tournaments_participants'];
        $data=$response['data'];
        $draw_ids=$response['draw_ids'];
        $draw_names=$response['draw_names'];
        $draw_counts=$response['draw_counts'];
        $tournament_draws=$response['tournament_draws'];
        $match_id=$response['match_id'];
        $stage_id=$response['stage_id'];
        return view('draw.tournament_draw_even',compact('tournaments_participants','data','draw_ids','draw_names','draw_counts','tournament_draws','match_id','stage_id','direct_pass_member'));


    }
    public function matchesEdit($tournament_draw_id,$match_id){

        $tournament_draws=TournamentDraw::find($tournament_draw_id); // 1 event now

        $tournaments_participants=EventUser::join('users','event_users.user_id','=','users.id')
                                 ->join('role_user','event_users.user_id','=','role_user.user_id')
                                 ->join('roles','role_user.role_id','=','roles.id')
                                //  ->join('payments','payments.event_user_id','=','event_users.user_id')
                                //  ->where('payments.status','completed')
                                 ->join('events','event_users.event_id','=','events.id')
                                 ->whereIn('roles.slug',['fighter'])
                                 ->select('users.id','users.first_name','users.last_name','events.name as event_name','event_users.event_id')
                                 ->get();

        $user_ids=isset($tournament_draws->user_ids)?json_decode($tournament_draws->user_ids):[];
        $user_list=[];
        $match_count=$match_id;
        if(count($user_ids)>0){
        for($m=0;$match_count>0;$m++){
            $user_list=$user_ids[$m];
            $match_count--;
        }
        }

       return view('draw.edit_match',compact('tournament_draws','match_id','tournaments_participants','user_list'));


    }
    public function matchesUpdate(Request $request,$id){

        $tournament_draws=TournamentDraw::find($id); // 1 event now
        $user_json_decode=json_decode($tournament_draws->user_ids);
        $match_json_decode=json_decode($tournament_draws->match_ids);
        $count=count($match_json_decode);
        $user_arr=[];
        for($m=0;$count>0;$m++){

            if($m==($request->match_id-1)){
                $user_arr[]=array($request->member_1,$request->member_2);
            }
            else{
                $user_arr[]=$user_json_decode[$m];
            }

            $count--;
        }
        $tournament_draws->user_ids=json_encode($user_arr);

        $tournament_draws->save();

        return redirect('/matches/list');



    }
    public function matchesRedraw($event_id){


        $tournament_draws=TournamentDraw::where('event_id',$event_id)->where('stage_id','1')->first(); // stage 1 details
        $user_ids=json_decode($tournament_draws->user_ids);
        $user_arr_count=count($user_ids);
        $total_user_arr=[];
        for($i=0;$user_arr_count>0;$i++){
            $user_push_count=count($user_ids[$i]);
            for($j=0;$user_push_count>0;$j++){
            array_push($total_user_arr,$user_ids[$i][$j]);
            $user_push_count--;
            }
            $user_arr_count--;
        }
        shuffle($total_user_arr); // shuffle the array
        $arr=[];
        $shuffle_count=count($total_user_arr);
        $shuffle_half_count=$shuffle_count/2;

        for($u=0;$shuffle_half_count>0;$u++){

                if($u%2==0){
                    $j=($u*2);
                    $j_value=($j)+1;
                    $arr[$u]=array($total_user_arr[$j],$total_user_arr[$j_value]);
                }
                else{
                    $j=($u*2);
                    $j_value=($j)+1;
                    $arr[$u]=array($total_user_arr[$j],$total_user_arr[$j_value]);
                }












            $shuffle_half_count--;
        }
        $tournament_draws->user_ids=json_encode($arr);
        $tournament_draws->save();



        return redirect('/draw');

    }
}
