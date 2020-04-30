<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use RedirectsUsers, ThrottlesLogins;

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    public function showLoginForm()
    {
        $getGement = request()->segments();
        $data['urlParam'] = $getGement;
        return view('backend.auth.login')->with($data);
    }

    // use AuthenticatesUsers;
    public function login(Request $request)
    {

        $getGement = request()->segments();

        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        if(!in_array('admin', $getGement)){
            $user = User::where('email', $request->email)->where('role_id','!=',1)->first();
        } else {
            $user = User::where('email', $request->email)->where('role_id',1)->first();
        }
        if ($user != null) {
            if ($user->device_login == 0) {
                //if ($user->userType == $request->userType) {
                if ($this->attemptLogin($request)) {
                    $userLoginDevice = User::where('id', $user->id)->update(['device_login' =>1]);
                    return $this->sendLoginResponse($request);
                }
                // } else {
                //     return back()->with('notFound', 'Email not found in our record.');
                // }
            }else{
                return back()->with('error', 'You have already login somewhere.');
            }
        } else {
            return back()->with('error', 'Email not found in our record.');
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

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $userLoginDeviceLog = User::where('id', Auth::id())->update(['device_login' =>'0']);
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // if ($response = $this->loggedOut($request)) {
        //     return $response;
        // }

        return $request->wantsJson()
        ? new Response('', 204)
        : redirect('/');
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->role_id == 2){
            return redirect(route('company.dashboard'));
        }else if($user->role_id == 1){
            return redirect(route('admin.dashboard'));
        } else {

            return redirect(route('customer.dashboard'));
        }
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

}
