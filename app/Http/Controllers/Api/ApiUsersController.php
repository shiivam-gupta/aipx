<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Mail\RegistrationEmail;
use App\Models\Country;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ApiUsersController extends Controller
{
    public function registerStep1(Request $request){
    	$validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8|max:30',
            'confirm_password' => 'same:password',
            // 'captcha' => 'same:confirm_captcha',

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
            return response()->json(['errors'=>$validator->errors()->first(),'code'=>401,'status'=>'failed','data'=>[]],401);
        }

        $input = $request->all();
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
        $token = $user->createToken('apitoken')->accessToken;
        if ($token == '') {
        	return response()->json(['errors'=>'Unable to generate token','code'=>401,'status'=>'failed','data'=>[]],401);
        }else{
        	$user['access_token'] = $token;
        	return response()->json(['data'=>$user,'code'=>200,'status'=>'success','errors'=>''],200);
        }
        
    }

    public function registerStep2(Request $request){
  
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
            return response()->json(['errors'=>$validator->errors()->first(),'code'=>401,'status'=>'failed','data'=>[]],401);
        }

        $imageName = time() . '.' . $request->company_logo->extension();

        $request->company_logo->move(public_path('Images'), $imageName);

        $input = $request->all();
        $input['role_id'] = 2;
        $input['company_logo'] = $imageName;
        // $user = User::find($request->userId)->first();
        // $email = $request->email;
        $user = User::where('id',$request->userId)->first();
        $email = $user->email;
        $data = ([
            'name' => $request->name,
            'email' => $user->email,
            'phone' => $request->country_code.' '.$request->phone,
        ]);
        \Mail::to($email)->send(new RegistrationEmail($data));

        $user = User::updateOrCreate([
            'id'   => $request->userId,
        ],$input);
        // $token = $user->createToken('apitoken')->accessToken;
        return response()->json(['data'=>$user,'code'=>200,'status'=>'success','errors'=>''],200);
    }

    public function login(Request $request){
    
    	// $this->validateLogin($request);
    	$validator = Validator::make($request->all(),[
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->first(),'code'=>401,'status'=>'failed','data'=>[]],401);
        }

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        $user = User::where('email', $request->email)->first();
        if ($user != null) {
        	if ($user->device_login == 0) {
        		if ($this->attemptLogin($request)) {
	            	$userLoginDevice = User::where('id', $user->id)->update(['device_login' =>1]);
	            	$token = auth()->user()->createToken('apitoken')->accessToken;

	            	if ($token == '') {
			        	return response()->json(['errors'=>'Unable to generate token','code'=>401,'status'=>'failed','data'=>[]],401);
			        }else{
			        	$user['access_token'] = $token;
			        	$user['device_login'] = $userLoginDevice;
			        	return response()->json(['data'=>$user,'code'=>200,'status'=>'success','errors'=>''],200);
			        }
	                // return $this->sendLoginResponse($request);
	            }	
        	}else{
        		return response()->json(['errors'=>'You have already login somewhere','code'=>401,'status'=>'failed','data'=>[]],401);
        	}
        } else {
        	return response()->json(['errors'=>'Email not found in our record','code'=>401,'status'=>'failed','data'=>[]],401);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function username()
    {
        return 'email';
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
        ? new Response('', 204)
        : redirect()->intended($this->redirectPath());
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function guard()
    {
        return Auth::guard();
    }	

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }
}
