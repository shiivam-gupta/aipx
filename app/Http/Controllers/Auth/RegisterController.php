<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Mail\RegistrationEmail;
use App\Models\Country;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function showRegistration()
    {
        return view('backend.auth.register');
    }


    public function storeRegistrationStep1(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8|max:30',
            'confirm_password' => 'same:password',
            'captcha' => 'same:confirm_captcha',

        ]);

        $user = User::where('email',$request->email)->first();
        $validator->after(function($validator) use($request,$user) {
                
            if(isset($user->company_name)){
                if(!empty($user->company_name)){
                    $validator->errors()->add('email', 'Email Already Exists.');
                }
            }
        });

        if ($validator->fails()) {
            return redirect(route('register'))
                        ->withErrors($validator)
                        ->withInput();
        }


        $input = $request->all();
        // dd($input);
        $data['password'] = $input['password'] = Hash::make($input['password']);
        if(!empty($user)){
            if(empty($user->company_name)){
                $user = User::updateOrCreate([
                    'email'   => $request->email,
                ],$data);
                
            }
        } else{
            $user = User::create($input);
        }

        return redirect(route('register.form2',$user->id))->with('success', 'Register Step 1 completed Successfully.');
    }

    protected function showRegistrationForm2($userId)
    {
        //dd($userId);
        $data = [];
        $data['userId'] = $userId;
        $data['country_code'] = Country::get();
        $data['lunch_hours'] = array('15 Minutes','30 Minutes','45 Minutes','1 Hour','1 Hour 15 minutes','1 Hour 30 minutes','1 Hour 45 Minutes','2 Hours');
        $data['week_start'] = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');

        return view('backend.auth.register-step-2')->with($data);
    }

    public function storeRegistrationStep2(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(),[

            'name' => 'required|min:2|max:60',
            'country_code' => 'required',
            'phone' => 'required|min:10|max:11',
            'company_name' => 'required|min:2|max:60',
            'currency' => 'required|min:2|max:60',
            'pay_rate' => 'required|numeric|min:0|max:1000',
            'vacation_hours' => 'required|numeric|min:0|max:1000',
            'sick_hours' => 'required|numeric|min:0|max:1000',
            'lunch_punch_hours' => 'required',
            'week_start' => 'required',
            'company_logo' => 'required|image|max:2999|mimes:jpeg,jpg,png,jfif',

        ]);

        if ($validator->fails()) {
            return redirect(route('register.form2',$request->userId))
                        ->withErrors($validator)
                        ->withInput();
        }


        $imageName = time() . '.' . $request->company_logo->extension();

        $request->company_logo->move(public_path('Images'), $imageName);

        $input = $request->all();
        $input['role_id'] = 2;
        // dd($input);
        //$input['password'] = Hash::make($input['password']);
        //dd($input);
        $input['company_logo'] = $imageName;
        $user = User::find($request->userId)->first();
        $email = $request->email;
        $data = ([
            'name' => $request->name,
            'email' => $user->email,
            'phone' => $request->country_code.' '.$request->phone,
        ]);
        //\Mail::to($email)->send(new RegistrationEmail($data));

        $user = User::updateOrCreate([
            'id'   => $request->userId,
        ],$input);
        return redirect(route('login'))->with('success', 'Your Account Created Successfully.');

        //return view('backend.auth.register');
    }
    
}
