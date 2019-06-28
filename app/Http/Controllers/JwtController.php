<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JwtUser;
use App\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\RegistersUsers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    //注册页面
    public function showHomeRegister(){
        return view('auth.register');
    }

    /*注册*/
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
//        $post = $request->post();
//        $data = array();
//        $data['remember_token'] = $post['_token'];
//        $data['name'] = $post['name'];
//        $data['email'] = $post['email'];
//        $data['password'] = bcrypt($post['password']);
//        $user = $this->User->addUser($data);
        $where = array();
        $where['email'] = $request->input('email');
        $userInfo = $this->User->getUserInfo($where);
        if($userInfo){
//            return response()->json(['result' => $userInfo]); //response()返回数组形式的
            return redirect('register')->with('message', '用户已存在'); //redirect()返回路由形式的
//            return view('msg')->with(['message'=>'用户已存在', 'url' =>'/register', 'jumpTime'=>2,]); // 返回到页面形式的
        }
        //添加用户
        $credentials = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ];
        $user = JwtUser::create($credentials);
        if($user)
        {
            $token = JWTAuth::fromUser($user);
            return view('auth.login');
        }
    }

    //登录页面
    public function showHomeLogin(){
        return view('auth.login');
    }

    /*登录*/
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        $where = array();
        $where['email'] = $request->input('email');
        $userInfo = $this->User->getUserInfo($where);
        if(!Hash::check($request->input('password'),$userInfo['password'])){
//            $this->failed();//错误返回?
            return redirect('login')->with('message', '密码错误'); //redirect()返回路由形式的
        }
        if ( $token = Auth::guard($this->guard)->attempt($credentials) ) {
            return response()->json(['result' => $token]);
        } else {
            return response()->json(['result'=>false]);
        }
    }

    public function Index(){
        echo 'Your has login ';
        $token = JWTAuth::getToken();
        $user = JWTAuth::parseToken()->authenticate();
        echo "\n".var_dump($user);
    }
}