<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;

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
                'occupation' => ['string','required', 'string', 'max:255'],
                'club_name' => ['string','required', 'string'],
                'address' => ['string','required', 'string'],
                'weight' => ['required','integer'],
                'height' => ['required','integer'],
                'mobile_number' => ['required','integer','max:10'],
                'mobile_number2' => ['required','integer','max:10'],
                'blood_group' => ['required','string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required_with:password|same:password|min:6'],
            ]);
        }else{
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['nullable', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile_number' => ['required','integer','max:10'],
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

        $user = config('roles.models.defaultUser')::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile_number' => $data['mobile_number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        if(isset($data['role'])&&$data['role']!=null){
            $role = Role::where('slug',$data['role'])->first();
        }else{
            $role = config('roles.models.role')::where('slug','user')->first();  //set the user role
        }

        $user->attachRole($role);

        return $user;
    }
}
