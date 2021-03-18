<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    /**
     * showLoginForm
     *
     * @return void
     */
    public function showLoginForm(){
        // if(Auth::guard('admin')->check()){
        //     return redirect()->route('admin.dashboard');
        // }
        return view('backend.auth.login');
    }
    
    /**
     * login admin
     *
     * @param  mixed $request
     * @return void
     */
    public function login(Request $request){
        //validation
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        //attempt to login
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>1],$request->remember)){
            return redirect()->intended(route('admin.dashboard'));
        }else{
            if(Auth::guard('admin')->attempt(['username'=>$request->email,'password'=>$request->password,'status'=>1],$request->remember)){
                return redirect()->intended(route('admin.dashboard'));
            }
            $notification=array(
                'message'=>'Invaild Email And Password!',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }    
    /**
     * logout admin guard
     *
     * @return void
     */
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function guard()
    {
        return Auth::guard('admin');
    }
}
