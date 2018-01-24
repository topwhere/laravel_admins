<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Picture;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class PictureController extends CommonController
{
    //全部图片列表
    //get.admin/writing_list
    public function index(){
        $picture = Picture::all();
        $numbers = count($picture);
        return view('admin.picture.picture_list')->with('data',$picture)->with('numbers',$numbers);
    }

    //添加图片
    //get.admin/picture/create
    public function create(){
        $data = (new Article)->tree();
        return view('admin.picture.add',compact('data',$data));
    }
    //添加图片方法
    //post.admin/picture
    public function store(){
        $file = Input::file('pic_src');
        $input = Input::except('_token','pic_src');
        if($file->isValid()){
            $path = (new Picture())->upload($file);
            if($path['why']){
                $input['pic_src'] = $path['newName'];
                $res = Picture::create($input);
                if($res){
                    return redirect('admin/picture');
                }else{
                    return back()->with('errors','图片上传失败！');
                }
            }else{
                return back()->with('errors','图片上传失败！');
            }
        }

    }
    //编辑分类
    //get.admin/picture/{picture}/edit
    public function edit($id){
        $picture = Picture::find($id);
        $data = (new Article)->tree();
        if($data){
            return view('admin/picture/edit')
                ->with('data',$data)
                ->with('picture',$picture);
        }
    }
    //更新分类
    //put.admin/picture/{picture}
    public function update($id){
        $new_file = Input::file('new_pic_src');
        $input =Input::except('new_pic_src','_method','_token');
        if($new_file){
            $path = (new Picture)->upload($new_file);
            if($path['why']) {
                $input['pic_src'] = $path['newName'];
            }
        }
        $res = Picture::where('id' , $id)->update($input);
        if ($res){
            return redirect('admin/picture');
        }else{
            return back()->with('errors','图片信息更新失败，请稍后重试');
        }



    }
    //显示单个分类信息
    //get.admin/picture/{picture}
    public function show(){
    }
    //删除单个图片
    //delete.admin/picture/{picture}
    public function destroy($id){
        $res = Picture::where('id',$id)->delete();
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
        $picture = Picture::find($input['pic_id']);
        $picture->pic_orders = $input['pic_order'];
        $res = $picture-> update();
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
        $picture = Picture::find($input['pic_id']);
        if($input['pic_or'] == '发布'){
            $input['pic_or'] ='待审核...';
        }else{
            $input['pic_or'] ='发布';
        }
        $picture->pic_or = $input['pic_or'];
        $res = $picture-> update();
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
