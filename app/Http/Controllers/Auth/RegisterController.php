<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\FighterProfile;
use App\Models\User;
use Carbon\Carbon;
use Twilio\Rest\Client;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegisterForm($role){
        $data['role'] = $role;
        $data['coaches']=[];
        if($data['role']=='coach'){
           $data['coaches']=User::join('role_user','users.id','=','role_user.user_id')
           ->join('roles','roles.id','=','role_user.role_id')->where('roles.slug',$data['role'])->get();
        }
        return view('auth.register')->with($data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(isset($data['role'])&&$data['role']=='fighter'){
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['nullable', 'string', 'max:255'],
                'date_of_birth' => ['required'],
                'gender' => ['required'],
                'id_card_type' => ['required'],
                'id_card_number' => ['required', 'string', 'max:255'],
                'occupation' => ['string','required', 'max:255'],
                'club_name' => ['string','required'],
                'coach_name' => ['string','required'],
                'address' => ['string','required'],
                'weight' => ['required'],
                'height' => ['required','integer'],
                'instagram_id' => ['required'],
                'facebook_id' => ['required'],
                'mobile_number' => ['required','string','max:10', 'unique:users'],
                'mobile_number2' => ['required','string','max:10'],
                'state' => ['required'],
                'ranking' =>['required'],
                'blood_group' => ['required','string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'user_image' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required_with:password|same:password|min:6'],
                'terms_and_conditions'=>'accepted',
            ]);
        }
        else if($data['role']=='official'){
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['nullable', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile_number' => ['required','string','max:10', 'unique:users'],
                'user_image' => ['required'],
                'official_licence_id' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required_with:password|same:password|min:6'],
            ]);
        }
        else if($data['role']=='coach'){
            return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['nullable', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile_number' => ['required','string','max:10', 'unique:users'],
                'user_image' => ['required'],
                'coach_state' => ['required'],
                'coach_city' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required_with:password|same:password|min:6'],
            ]);
        }


        else{
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['nullable', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile_number' => ['required','string','max:10', 'unique:users'],
                'user_image' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required_with:password|same:password|min:6'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user_image='';

        if ($data['user_image']) {
            $image = $data['user_image'];
            $user_image = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/user_images');
            $image->move($destinationPath, $user_image);
        }

        $user = config('roles.models.defaultUser')::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile_number' => $data['mobile_number'],
            'user_image' => $user_image,
            'official_licence_id' => $data['role']=='official'?$data['official_licence_id']:'',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if(isset($data['role'])&&$data['role']!=null&&$data['role']=='fighter'){
            $fighter = new FighterProfile();
            $fighter->user_id = $user->id;
            $fighter->date_of_birth = $data['date_of_birth'];
            $fighter->gender = $data['gender'];
            $fighter->id_card_type = $data['id_card_type'];
            $fighter->id_card_number = $data['id_card_number'];
            /** Licence id */
            $fighter->licence_id = $this->licenceIdGeneration($user->id);
            $fighter->emergency_number = $data['mobile_number2'];
            $fighter->height = $data['height'];
            $fighter->weight = $data['weight'];
            $fighter->club_name = $data['club_name'];
            $fighter->address = $data['address'];
            $fighter->facebook_id = $data['facebook_id'];
            $fighter->instagram_id = $data['instagram_id'];
            if($data['ranking']!="none"){
                $fighter->ranking_id = $data['ranking'];
            }
            $fighter->state = $data['state'];
            $fighter->city = $data['city'];
            $fighter->blood_group = $data['blood_group'];
            $fighter->save();
            $role = Role::where('slug',$data['role'])->first();
        }else if(isset($data['role'])&&($data['role']!="fighter"||$data['role']!="user")&&$data['role']!='admin'&&$data['role']!='manager'){
            $role = Role::where('slug',$data['role'])->first();
        }else{
            $role = config('roles.models.role')::where('slug','user')->first();  //set the user role
        }

        //send welcome sms to the registered user
        $mobile_number = '+91'.$data['mobile_number'];
        if($mobile_number){
            $sms_message = "Welcome!. You have been successfully registered for the event.";
            sendSMS($mobile_number,$sms_message);
        }

        $user->attachRole($role);
        return $user;
    }

    private function whatsappNotification(string $recipient)
    {
        $sid    = config('app.twilio_sid');
        $token  = config('app.twilio_token');
        $wa_from= config('app.twilio_from');
        $twilio = new Client($sid, $token);

        $body = "Hello, welcome to Event";

        return $twilio->messages->create("whatsapp:$recipient",["from" => "whatsapp:$wa_from", "body" => $body]);
    }

    public function searchCity(Request $request){
        $path = public_path()."/json/cities.json";
        $json = json_decode(file_get_contents($path), true);
        foreach($json as $key=>$row){
            if($request->state==$key){
                $cities = $row;
            }
        }
        return $cities;
    }

    public function checkRole(){
        $data['roles'] = Role::all();
        return view('check_role')->with($data);
    }
    public function licenceIdGeneration($user_id){


         $prefix='AIMMAF-FIG-LIC-';
         $number = intval('1000') + $user_id;
         $licence=$prefix.''.sprintf('%04d', $number);

         return $licence;
    }
}
