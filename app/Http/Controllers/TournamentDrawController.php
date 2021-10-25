<?php

namespace App\Http\Controllers;

use App\Models\EventUser;
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
                                 //dd();
                                 //$draw_counts=array_values(array_unique($draw_counts));

                                //  foreach($draw as $key=>$value){

                                //     $draw_code[]=json_encode($value);
                                //     //$draw_key[]=$key;

                                //  }

                                 //$draw[]=['name'=>$data['first_name'],'id'=>$data['id']];
                                 //$draw_names = json_encode($draw,TRUE);
                                 //$draw_code=implode($draw_code,'|');
                                // dd($draw_code);
                                 //$draw_names=implode($draw_names,',');
                                 //$draw_code = json_encode($draw_code,TRUE);
                                 //$draw_code=['name'=>$data['first_name'],'id'=>$data['id']];

                                 // var draw_code="{{$draw_code}}";
        //     draw_code=draw_code.replace(/&quot;/g, '"');
       // dd($draw_names,$draw_counts);






        return view('draw.tournament_draw',compact('tournaments_participants','data','draw_ids','draw_names','draw_counts'));
    }
}
