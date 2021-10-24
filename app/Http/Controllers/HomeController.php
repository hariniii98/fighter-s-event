<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Event;

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
    public function index()
    {
        $data['events'] = Event::where('end_date','>',Carbon::today())->get();
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
