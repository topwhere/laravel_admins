<?php
namespace App\Http\Controllers\Admin;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;


class IndexController extends CommonController{
    public function index(){
        return view('admin.index');
    }
    public function welcome(){
        return view('admin.layer.welcome');
    }
    //更改密码
    public function pass(){
        if($input = Input::all()){
            $rules = [
                'password'=>'required|between:6,20|confirmed',
            ];
            $message = [
                'password.required'=>'新密码不能为空',
                'password.between'=>'新密码必须在6到20位之间',
                'password.confirmed'=>'新密码和确认密码不一致',
            ];
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $user = User::first();
                $_password = Crypt::decrypt($user->userpwd);
                if($input['password_o'] == $_password){
                    $user ->userpwd = Crypt::encrypt($input['password']);
                    $user ->update();
                    return back()->with('errors','修改密码成功！');
                }else{
                    return back()->with('errors','原密码错误');
                }
            }else{
                return back()->withErrors($validator);
            }
        }else{
            return view('admin.pass');
        }
    }


}
