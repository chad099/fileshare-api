<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data,$rules)
    {
        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      $rules = [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|min:6|confirmed',
      ];

      $this->validator($data,$rules);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function login(Request $request){
        $rules = [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ];
        $v = $this->validator($request->all(),$rules);
        if($v->fails()){
          if($request->isJson()){
            return response()->json(['errors'=>$v->getMessageBag()->toArray()], 400);
          }
          return redirect()->back()
          ->withInput($request->only($this->loginUsername(), 'remember'))
          ->withErrors([
              $this->loginUsername() => $this->getFailedLoginMessage(),
          ]);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if($request->isJson()){
                return response()->json(['auth'=>'success','user'=>Auth::user()], 200);
            }
        return redirect('/home');
        }

        if($request->isJson()){
            return response()->json(['auth'=>'error','errors'=>$this->getFailedLoginMessage()], 400);
        }

        return redirect()->back()
        ->withInput($request->only($this->loginUsername(), 'remember'))
        ->withErrors([
            $this->loginUsername() => $this->getFailedLoginMessage(),
        ]);

    }
}
