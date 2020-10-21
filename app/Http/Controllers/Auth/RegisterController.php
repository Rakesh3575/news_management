<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use App\Country;
use App\State;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

 
use DB;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');

     }
 
    protected function validator(array $data)
    {  
      return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
         
        ]);
    }
 
    protected function create(array $data)
    {
        // dd($data); 
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'country' => $data['country_id'],
            'state' => $data['state'],
        ]);
    }

    public function getStateList(Request $request)
    { 
            //dd($request->toArray());
            $states = DB::table("states")
            ->where("country_id",$request->country_id)
            ->pluck("name","id");
            return response()->json($states);
    }
   protected function createAdmin(Request $request)
   { 
         $this->validator($request->all())->validate();
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
         ]);
        return redirect()->intended('login/admin');
    }
    
      public function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }

public function showRegistrationForm()
    {
        $countries = Country::all();
        $states = State::all();
        return view('auth.register', compact('countries', 'states'));
    }

}
