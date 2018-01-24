<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Writing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
class WritingController extends CommonController
{

    //全部文章列表
    //get.admin/writing_list
    public function index(){
        //文章分页
        $writing = Writing::orderby('id','desc')->paginate(10);
        $numbers = count($writing);
        return view('admin.writing.writing_list')->with('data',$writing)->with('numbers',$numbers);
    }
    //添加文章链接
    //get.admin/writing_list/create
    public function create(){
        $data = (new Article)->tree();
        return view('admin.writing.add',compact('data',$data));
    }
    //添加文章方法
    //post.admin/writing_list
    public function store(){
        $input = Input::except('_token');
        $res = Writing::create($input);
        if($res){
            return redirect('admin/writing_list');
        }else{
            return back()->with('errors','文章创建失败，请稍后重试');
        }
    }
    //编辑分类
    //get.admin/writing_list/{writing_list}/edit
    public function edit($id){
        $data = Writing::find($id);
        if($data){
            return view('admin.writing.edit')->with('data',$data);
        }else{
            return back()->with('ereors','文章修改跳转失败！');
        }

    }
    //更新分类
    //put.admin/writing_list/{writing_list}
    public function update($id){
        $input = Input::except('_token','_method');
        $res = Writing::where('id' , $id)->update($input);
        if ($res){
            return redirect('admin/writing_list');
        }else{
            return back()->with('errors','文章信息更新失败，请稍后重试');
        }

    }
    //显示单个分类信息
    //get.admin/writing_list/{writing_list}
    public function show(){
    }
    //删除单个文章
    //delete.admin/writing_list/{writing_list}
    public function destroy($id){
        $res = Writing::where('id',$id)->delete();
        if($res){
            $data = [
                'staus'=>0,
                'msg'=>'分类删除成功！',
            ];
        }else{
            $data = [
                'staus'=>1,
                'msg'=>'分类删除失败，请重试！',
            ];
        }
        return $data;



    }
//ajax
    public function onchageorder(){
        $input =Input::all();
        $writing = Writing::find($input['article_id']);
        $writing->orders = $input['artile_order'];
        $res = $writing-> update();
        if($res>0){
            $data = [
                'staus'=>0,
                'msg'=>'排序更新成功',
            ];

        }else{
            $data = [
                'staus'=>0,
                'msg'=>'排序更新失败',
            ];
        }
        return $data;
    }

    public function oar(){
        $input =Input::all();
        $writing = Writing::find($input['article_id']);
        if($input['artile_or'] == '发布'){
            $input['artile_or'] ='待审核...';
        }else{
            $input['artile_or'] ='发布';
        }
        $writing->writing_or = $input['artile_or'];
        $res = $writing-> update();
        if($res>0){
            $data = [
                'staus'=>0,
                'msg'=>'状态更新成功',
            ];

        }else{
            $data = [
                'staus'=>0,
                'msg'=>'状态更新成功',
            ];
        }
        return $data;
    }
}
