<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class ArticleController extends CommonController
{
    //全部分类列表
    //get.admin/article_list
    public function index(){
        $article = (new Article)->tree();
        $numbers = count($article);
        return view('admin.article.article_list')->with('data',$article)->with('numbers',$numbers);
    }

    //添加分类
    //get.admin/article_list/create
    public function create(){
        $data = Article::where('article_fid',0)->get();
        return view('admin.article.add',compact('data'));
    }
    //处理添加分类
    //post.admin/article_list
    public function store(){
        if($input = Input::except('_token'))
        {
            $rules = [
                'article_title'=>'required',
            ];
            $message = [
                'article_title.required'=>'分类名称不能为空！',
            ];
            $validator = Validator::make($input,$rules,$message);
            if (!$validator->passes()) {
                return back()->withErrors($validator);
            }
            $res = Article::create($input);
            if($res){
                return redirect('admin/article_list');
            }
        }
    }
    //编辑分类
    //get.admin/article_list/{article_list}/edit
    public function edit($id){
        $field = Article::find($id);
        $data = Article::where('article_fid',0)->get();
        return view('admin.article.edit',compact('field','data'));
    }
    //更新分类
    //put.admin/article_list/{article_list}
    public function update($artilce_id){
        $input = Input::except('_token','_method');
        $res = Article::where('id' , $artilce_id)->update($input);
        if($res){
            return redirect('admin/article_list');
   }else{
            return back()->with('errors','分类信息更新失败，请稍后重试');
        }
    }
    //显示单个分类信息，可以考虑用作前端页面分配
    //get.admin/article_list/{article_list}
//    public function show(){
//    }

    //删除单个分类
    //delete.admin/article_list/{article_list}
    public function destroy($id){
        $res = Article::where('id',$id)->delete();
        Article::where('article_fid',$id)->update(['article_fid'=>0]);
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
        $article = Article::find($input['article_id']);
        $article->article_order = $input['artile_order'];
        $res = $article-> update();
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
        $article = Article::find($input['article_id']);
        if($input['artile_or'] == '发布'){
            $input['artile_or'] ='取消';
        }else{
            $input['artile_or'] ='发布';
        }
        $article->article_or = $input['artile_or'];
        $res = $article-> update();
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
