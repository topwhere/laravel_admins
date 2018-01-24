<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-16
 * Time: 17:09
 */
namespace App\Http\Controllers\Admin;
use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login(){
        if(session('user')){
            return redirect('admin/index');
        };
        if($input = Input::all()){
            $user = User::first();
            if($user->username != $input['username']  ){
                return back()->with('msg','用户名错误');
            }else if(Crypt::decrypt($user->userpwd) != $input['userpass']){
                return back()->with('msg','密码错误');
            }
            $code = new \Code;
            $cokes =  $code -> get();
            if(strtoupper($input['yzm'])!=strtoupper($cokes)){
                return back()->with('msg','验证码错误');
            }
            session(['user' => $user]);
            return redirect('admin/index');
        }else{
            return view('admin.login');
        }
    }
    //引入验证码类
    public function code()
    {
        $code = new \Code;
        $code -> make();
    }
    //退出登录
    public function exit(){
        session(['user'=> null]);
        return redirect('admin/login');
    }
    //引入验证码类
    public function aaa()
    {
        return view('index.index');
    }


    //传值方式
//    public function aaa()
//    {
//        $data =[];
//        return view('welcome',compact($data));
//    }
}
