<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JwtUser;
use App\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\RegistersUsers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class JwtController extends Controller
{
    use RegistersUsers, ThrottlesLogins;
    //
    protected $guard = 'apijwt';
    protected $User;
    public function __construct(User $User)
    {
        $this->User = $User;
    }

    /*注册*/
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ];
//        $post = $request->post();
//        $data = array();
//        $data['remember_token'] = $post['_token'];
//        $data['name'] = $post['name'];
//        $data['email'] = $post['email'];
//        $data['password'] = bcrypt($post['password']);
//        $user = $this->User->addUser($data);
        $user = JwtUser::create($credentials);
        if($user)
        {
            $token = JWTAuth::fromUser($user);
            return response()->json(['result' => $token]);
        }

    }
    public function Index(){
        echo 'Your has login ';
        $token = JWTAuth::getToken();
        $user = JWTAuth::parseToken()->authenticate();
        echo "\n".var_dump($user);
    }

    /*登录*/
    public function login(Request $request)
    {

        $credentials = $request->only('email','password');

        if ( $token = Auth::guard($this->guard)->attempt($credentials) ) {

            return response()->json(['result' => $token]);
        } else {
            return response()->json(['result'=>false]);
        }
    }
}