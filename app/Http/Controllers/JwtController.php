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
        $where = array();
        $where['email'] = $request->input('email');
        $userInfo = $this->User->getUserInfo($where);
        if($userInfo){
//            return response()->json(['result' => $userInfo]); //response()返回数组形式的
//            return redirect('register')->with('message', '用户已存在'); //redirect()返回路由形式的
            return view('msg')->with(['message'=>'用户已存在', 'url' =>'/register', 'jumpTime'=>2,]); // 返回到页面形式的
        }
        $user = JwtUser::create($credentials);
        if($user)
        {
            $token = JWTAuth::fromUser($user);
            $data = array();
            $data['remember_token'] = $token;
            $this->User->editUser($where,$data);
            return view('home',['data'=>$token]);
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